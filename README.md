# AI-Powered CV Extraction Tool

This application extracts structured data from CVs in PDF format using the Together AI API. It offers a beautiful, modern TailwindCSS interface and detailed JSON output with all information from the CV.

## Features

- **PDF CV Upload**: Extract text from PDF resumes and CVs
- **AI-Powered Extraction**: Utilize Together AI API to structure CV data into JSON
- **Job Matching Analysis**: Compare CV with job descriptions for match scoring
- **Complete Information Extraction**: Extracts personal details, work experience, education, skills, certifications, languages, projects, and more
- **Structured JSON Output**: All CV data is returned in a well-organized JSON format
- **Modern UI**: Beautiful, responsive interface using TailwindCSS

## Architecture

- **Frontend**: HTML, TailwindCSS, JavaScript
- **Backend**: Python with Flask
- **PDF Processing**: PyMuPDF for text extraction
- **AI Processing**: Together AI SDK with Llama-3.3-70B model

## Requirements

- Python 3.7+
- Together AI API key
- Web browser

## Installation

1. Clone this repository:
```bash
git clone <repository-url>
cd cv-extraction-tool
```

2. Install Python dependencies:
```bash
pip install -r requirements.txt
```

3. Set up your Together AI API key:
```bash
# Copy the example .env file
cp .env.example .env

# Edit the .env file and add your Together API key
```

## Usage

1. Start the Flask application:
```bash
python backend/app.py
```

2. Open your web browser and go to:
```
http://localhost:5000
```

3. Upload a CV in PDF format and optionally provide a job description for matching analysis.

4. View the structured results with the option to see formatted data or raw JSON.

## API Endpoint

The application exposes the following API endpoint:

- **POST /api/extract-cv**:
  - Request: Multipart form data with 'cv_file' (PDF file) and optional 'job_description' (text)
  - Response: JSON with extracted CV data and optional job matching analysis

## Example Response

```json
{
  "cv_data": {
    "name": "John",
    "surname": "Doe",
    "fullname": "John Doe",
    "email": "johndoe@example.com",
    "phone": "+123456789",
    "address": "123 Main St, New York, USA",
    "linkedin": "https://www.linkedin.com/in/johndoe",
    "github": "https://github.com/johndoe",
    "website": "https://johndoe.com",
    "summary": "Experienced software engineer with a strong background in Python and AI.",
    "education": [
      {
        "degree": "MSc in Computer Science",
        "university": "Harvard University",
        "year": "2022"
      }
    ],
    "work_experience": [
      {
        "job_title": "Software Engineer",
        "company": "Google",
        "years": "2020-2023",
        "responsibilities": [
          "Developed scalable web applications",
          "Worked with Python, Django, and React"
        ]
      }
    ],
    "skills": ["Python", "JavaScript", "Machine Learning"],
    "certifications": ["AWS Certified Developer"],
    "languages": ["English", "German"],
    "projects": [
      {
        "title": "AI Chatbot",
        "description": "Developed an AI-powered chatbot using GPT and Django.",
        "technologies": ["Python", "Django", "OpenAI API"]
      }
    ]
  },
  "job_matching": {
    "match_score": 85,
    "is_perfect_match": true,
    "reasoning": "The candidate has 5+ years of experience in Python, matching the job requirement. Education and skills align well.",
    "missing_criteria": []
  }
}
```

## Together AI Integration

This application uses the Together Python SDK to interact with the Together AI API. It leverages the Llama-3.3-70B-Instruct-Turbo model for CV data extraction and job matching analysis. The API key is stored in a `.env` file for security.

## Notes

- PDF parsing quality depends on the PDF structure. Some PDFs may not extract well if they have complex layouts or are image-based.
- The Together AI model extracts as much information as possible from the provided text.
- For best results, upload clearly formatted, text-based PDFs.
- The job matching feature works best with detailed job descriptions.

## License

This project is licensed under the MIT License - see the LICENSE file for details. 