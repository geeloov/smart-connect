import os
import json
import tempfile
from flask import Flask, request, jsonify
import fitz  # PyMuPDF
from werkzeug.utils import secure_filename
from flask_cors import CORS
from dotenv import load_dotenv
from together import Together

# Load environment variables from the correct .env file path
load_dotenv('../cv-extraction-laravel/.env')

# Get the CV_EXTRACTION_API_KEY and use it to set TOGETHER_API_KEY
api_key = os.getenv('CV_EXTRACTION_API_KEY', '')
os.environ['TOGETHER_API_KEY'] = api_key

app = Flask(__name__, static_folder='../frontend', static_url_path='')
CORS(app)  # Enable CORS for all routes

# Initialize Together AI client
together_client = Together()  # It will use TOGETHER_API_KEY from environment

# Add a check to validate the API key was loaded
if not api_key:
    print("WARNING: CV_EXTRACTION_API_KEY not found in .env file. API calls will fail.")
else:
    print(f"API key loaded successfully from cv-extraction-laravel/.env")

ALLOWED_EXTENSIONS = {'pdf'}

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

def extract_text_from_pdf(pdf_path):
    """Extract text from PDF using PyMuPDF."""
    try:
        text = ""
        with fitz.open(pdf_path) as doc:
            for page in doc:
                text += page.get_text()
        return text
    except Exception as e:
        print(f"Error extracting text from PDF: {e}")
        return None

def process_cv_with_together_ai(cv_text, job_description=None):
    """Process CV text with Together AI SDK."""
    # Create prompt content
    if job_description:
        prompt = f"""
You are an expert HR AI specialized in CV analysis and job matching. Your task is to analyze a CV against a job description and provide structured matching results in JSON format.

CV TEXT:
{cv_text}

JOB DESCRIPTION:
{job_description}

OBJECTIVE:
Evaluate how well the candidate's CV matches the job requirements and provide a detailed analysis in a standardized format.

ANALYSIS INSTRUCTIONS:
1. Extract key skills from both the CV and job description
2. Compare the candidate's experience level with job requirements
3. Evaluate educational qualifications against job requirements
4. Provide an overall match score and detailed reasoning
5. Only use factual information found in the CV - do not invent or assume information

SKILL MATCHING CRITERIA:
- Technical skills: Programming languages, frameworks, software, tools, platforms
- Professional skills: Methodologies, certifications, domain expertise
- Only include concrete, specific skills (not soft skills or general qualities)

FORMAT YOUR RESPONSE AS A JSON WITH THE FOLLOWING STRUCTURE:
```json
{{
  "job_matching": {{
    "match_score": 75,  // Overall match score from 0-100 based on objective criteria
    "is_perfect_match": false,  // Boolean indicating if all requirements are met
    "reasoning": "Clear explanation of the overall match including strengths and weaknesses",
    "skills_analysis": {{
      "matched_skills": ["Skill1", "Skill2"],  // Skills found in both CV and job description
      "missing_skills": ["Skill3", "Skill4"],  // Skills required by job but missing in CV
      "skills_match_score": 70  // Percentage of required skills the candidate has
    }},
    "experience_analysis": {{
      "has_required_experience": true,  // Whether candidate meets minimum experience
      "years_of_relevant_experience": 4,  // Numeric value of relevant experience
      "experience_match_score": 80  // Score for experience match
    }},
    "education_analysis": {{
      "meets_education_requirements": true,  // Whether education requirements are met
      "education_match_score": 90,  // Score for education match
      "relevant_degrees": ["Degree1"]  // Relevant degrees found in CV
    }}
  }}
}}
```

IMPORTANT GUIDELINES:
1. Be objective and factual based only on the CV content
2. Do not invent skills or experience not mentioned in the CV
3. For any field where information is genuinely missing, use appropriate defaults (0 for scores, empty arrays for lists, false for booleans)
4. All match scores should be on a scale of 0-100
5. Always include all fields in the response even if some are empty
6. Only return the JSON object, no additional text

Now, analyze the CV against the job description and provide your results in the specified JSON format.
"""
    else:
        prompt = f"""
I need you to extract all the information from this CV into a structured JSON format.

CV TEXT:
{cv_text}

Instructions:
1. Extract every detail from the CV into a structured JSON format.
2. Include all personal information, work experience, education, skills, certifications, languages, and projects.

SKILLS EXTRACTION RULES:
1. Extract ONLY specific technical skills, tools, frameworks, and clearly defined professional competencies
2. A valid skill must be a specific ability, technology, tool, or methodology that can be learned and directly applied in a professional setting
3. Ignore all general qualities, traits, or vague descriptions
4. Ignore section headers, time-related phrases, or general statements

CLEAR EXAMPLES OF VALID SKILLS:
- Technical: JavaScript, Python, React, Vue.js, AWS, Docker, PostgreSQL, Kubernetes, Git, CI/CD, REST API, GraphQL
- Professional: Agile, Scrum, Kanban, UX Research, A/B Testing, SEO, SEM, Financial Modeling, Risk Assessment, Strategic Planning
- Industry-specific: HIPAA Compliance, GDPR, ISO 27001, Six Sigma, PMP, CFA, LEED Certification

EXAMPLES OF WHAT ARE NOT SKILLS:
- Qualities: detail-oriented, hard-working, team player, motivated, responsible
- General phrases: "ability to work under pressure", "excellent communication skills"
- Vague descriptors: "problem-solver", "innovative thinker", "driven individual"

VALIDATION STEP: After identifying skills, review each extracted skill and verify it meets these criteria:
1. Is it a specific technology, tool, methodology, or professional competency?
2. Can it be learned through training or education?
3. Is it something that would appear on a professional certification or training course?
4. Would it make sense in a "Skills" section of a professional resume?

If any candidate skill fails this validation, DO NOT include it in the skills list.

Return the results in the following JSON format:
{{
  "cv_data": {{
    "name": "...",
    "email": "...",
    "phone": "...",
    "address": "...",
    "linkedin": "...",
    "github": "...",
    "website": "...",
    "summary": "...",
    "education": [
      {{
        "degree": "...",
        "institution": "...",
        "field_of_study": "...",
        "start_date": "...",
        "end_date": "..."
      }}
    ],
    "work_experience": [
      {{
        "position": "...",
        "company": "...",
        "start_date": "...",
        "end_date": "...",
        "duration": "...",
        "description": "...",
        "achievements": ["...", "..."]
      }}
    ],
    "skills": ["...", "..."],  // ONLY include actual professional and technical skills here
    "certifications": ["...", "..."],
    "languages": ["...", "..."],
    "projects": [
      {{
        "name": "...",
        "description": "...",
        "technologies": ["...", "..."]
      }}
    ]
  }}
}}

Make sure every possible detail from the CV is included in the JSON. If a field is not available in the CV, return it as null or an empty array.
"""

    try:
        # Using Together chat completions API
        response = together_client.chat.completions.create(
            model="meta-llama/Llama-3.3-70B-Instruct-Turbo",  # You can change the model as needed
            messages=[{"role": "user", "content": prompt}],
            temperature=0.2,
            max_tokens=4096
        )
        
        generated_text = response.choices[0].message.content.strip()
        
        # More robust JSON extraction
        # Try to extract JSON from the response
        json_start = generated_text.find('{')
        json_end = generated_text.rfind('}') + 1
        
        if json_start != -1 and json_end != -1:
            json_str = generated_text[json_start:json_end]
            try:
                return json.loads(json_str)
            except json.JSONDecodeError as e:
                print(f"Error parsing JSON from AI response: {e}")
                print(f"Raw JSON string: {json_str[:100]}...")  # Print first 100 chars for debugging
                
                # Try to clean up the JSON and try again
                try:
                    # Replace common issues that might break JSON
                    cleaned_json = json_str.replace('\n', ' ').replace('\r', ' ')
                    # Try to parse again
                    return json.loads(cleaned_json)
                except json.JSONDecodeError:
                    # If still failing, return structured error
                    if job_description:
                        return {
                            "cv_data": {"name": "Unknown", "skills": []},
                            "job_matching": {
                                "match_score": 50,
                                "is_perfect_match": False,
                                "reasoning": "Could not fully analyze CV due to technical issues.",
                                "skills_analysis": {
                                    "matched_skills": [],
                                    "missing_skills": [],
                                    "skills_match_score": 0
                                }
                            }
                        }
                    else:
                        return {"cv_data": {"name": "Unknown", "skills": []}}
        else:
            print("No JSON structure found in AI response")
            return {"error": "No JSON found in AI response"}
    
    except Exception as e:
        print(f"Error calling Together AI: {e}")
        return {"error": str(e)}

@app.route('/')
def index():
    """Serve the frontend."""
    return app.send_static_file('index.html')

@app.route('/api/extract-cv', methods=['POST'])
def extract_cv():
    """API endpoint to extract CV data."""
    # Check if file is in request
    if 'cv_file' not in request.files:
        return jsonify({"error": "No CV file provided"}), 400
    
    file = request.files['cv_file']
    
    # Check if file is empty
    if file.filename == '':
        return jsonify({"error": "No file selected"}), 400
    
    # Check if file is allowed
    if not file or not allowed_file(file.filename):
        return jsonify({"error": "Invalid file type. Only PDF files are allowed"}), 400
    
    try:
        # Save file to temporary location
        with tempfile.NamedTemporaryFile(delete=False, suffix='.pdf') as temp:
            file.save(temp.name)
            temp_path = temp.name
        
        # Extract text from PDF
        cv_text = extract_text_from_pdf(temp_path)
        
        # Remove temporary file
        os.unlink(temp_path)
        
        if not cv_text:
            return jsonify({"error": "Failed to extract text from PDF"}), 500
        
        # Get job description if provided
        job_description = request.form.get('job_description', None)
        
        # Process CV with Together AI
        result = process_cv_with_together_ai(cv_text, job_description)
        
        if "error" in result:
            return jsonify(result), 500
        
        return jsonify(result), 200
    
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@app.route('/api/match-cv-with-job', methods=['POST'])
def match_cv_with_job():
    """API endpoint to compare a CV with a job description."""
    # Check if required data is provided
    if 'cv_file' not in request.files:
        return jsonify({"error": "No CV file provided"}), 400
    
    if 'job_description' not in request.form or not request.form['job_description']:
        return jsonify({"error": "No job description provided"}), 400
    
    file = request.files['cv_file']
    job_description = request.form['job_description']
    job_title = request.form.get('job_title', 'Not Specified')
    required_skills = request.form.get('required_skills', '')
    experience_years = request.form.get('experience_years', '')
    education_requirements = request.form.get('education_requirements', '')
    
    # Enhance the job description with structured data and explicit parsing instructions
    enhanced_job_description = f"""
Job Title: {job_title}

Job Description:
{job_description}

Explicitly Listed Required Skills: {required_skills}

Required Experience: {experience_years} years

Education Requirements: {education_requirements}

IMPORTANT NOTE FOR SKILLS ANALYSIS:
- Focus on extracting technical, professional, and industry-specific skills only
- The "Explicitly Listed Required Skills" section above should be given priority
- For the job description text, carefully distinguish between actual skills and general job metadata
- Examples of skills: programming languages, frameworks, methodologies, technical tools, certifications
- Non-skills to ignore: seniority levels, employment types, section headers, company descriptions
"""
    
    # Check if file is empty
    if file.filename == '':
        return jsonify({"error": "No file selected"}), 400
    
    # Check if file is allowed
    if not file or not allowed_file(file.filename):
        return jsonify({"error": "Invalid file type. Only PDF files are allowed"}), 400
    
    try:
        # Save file to temporary location
        with tempfile.NamedTemporaryFile(delete=False, suffix='.pdf') as temp:
            file.save(temp.name)
            temp_path = temp.name
        
        # Extract text from PDF
        cv_text = extract_text_from_pdf(temp_path)
        
        # Remove temporary file
        os.unlink(temp_path)
        
        if not cv_text:
            return jsonify({"error": "Failed to extract text from PDF"}), 500
        
        # Process CV with Enhanced Job Description
        result = process_cv_with_together_ai(cv_text, enhanced_job_description)
        
        # Improved error handling
        if isinstance(result, dict) and "error" in result:
            error_message = result["error"]
            print(f"Error in AI processing: {error_message}")
            return jsonify({
                "job_matching": {
                    "match_score": 50,
                    "is_perfect_match": False,
                    "reasoning": f"Error in AI processing: {error_message}. Please try again later.",
                    "skills_analysis": {
                        "matched_skills": [],
                        "missing_skills": []
                    }
                }
            }), 200  # Return 200 with default values instead of 500
        
        # Extract the detailed analysis from the new format
        if "job_matching" in result:
            job_matching = result["job_matching"]
            
            # Create a comprehensive compatibility analysis
            compatibility_analysis = {
                "overall_score": job_matching.get("match_score", 0),
                "skills": {
                    "matched": job_matching.get("skills_analysis", {}).get("matched_skills", []),
                    "missing": job_matching.get("skills_analysis", {}).get("missing_skills", []),
                    "score": job_matching.get("skills_analysis", {}).get("skills_match_score", 0)
                },
                "experience": {
                    "years_required": experience_years,
                    "years_candidate": job_matching.get("experience_analysis", {}).get("years_of_relevant_experience", 0),
                    "has_required": job_matching.get("experience_analysis", {}).get("has_required_experience", False),
                    "score": job_matching.get("experience_analysis", {}).get("experience_match_score", 0),
                    "gaps": job_matching.get("experience_analysis", {}).get("experience_gaps", [])
                },
                "education": {
                    "required": education_requirements,
                    "meets_requirements": job_matching.get("education_analysis", {}).get("meets_education_requirements", False),
                    "score": job_matching.get("education_analysis", {}).get("education_match_score", 0),
                    "relevant_degrees": job_matching.get("education_analysis", {}).get("relevant_degrees", [])
                },
                "reasoning": job_matching.get("reasoning", ""),
                "is_perfect_match": job_matching.get("is_perfect_match", False)
            }
            
            # Add the enhanced analysis to the result
            result["compatibility_analysis"] = compatibility_analysis
            
            # For backward compatibility, maintain match_score in the top level
            if "match_score" not in result:
                result["match_score"] = job_matching.get("match_score", 0)
            
            return jsonify(result), 200
        
        # Fallback to existing analysis generation if the new format is not available
        elif "cv_data" in result:
            # For backward compatibility, create a default job_matching object
            result["job_matching"] = {
                "match_score": 50,
                "is_perfect_match": False,
                "reasoning": "Basic analysis completed. Unable to provide detailed matching.",
                "skills_analysis": {
                    "matched_skills": [],
                    "missing_skills": []
                }
            }
            return jsonify(result), 200
        
        # If we don't recognize the response format, return a structured error response
        return jsonify({
            "job_matching": {
                "match_score": 50,
                "is_perfect_match": False,
                "reasoning": "Unable to process matching at this time due to an unexpected response format.",
                "skills_analysis": {
                    "matched_skills": [],
                    "missing_skills": []
                }
            }
        }), 200
    
    except Exception as e:
        print(f"Error in match_cv_with_job: {str(e)}")
        # Return a structured error response
        return jsonify({
            "job_matching": {
                "match_score": 50,
                "is_perfect_match": False,
                "reasoning": f"An error occurred during processing: {str(e)}",
                "skills_analysis": {
                    "matched_skills": [],
                    "missing_skills": []
                }
            }
        }), 200  # Return 200 with default values instead of 500

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000) 