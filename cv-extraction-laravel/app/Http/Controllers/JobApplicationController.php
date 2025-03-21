<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobPosition;
use App\Events\JobApplicationSubmitted;
use App\Events\JobApplicationStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of available job positions for job seekers.
     */
    public function availableJobs(Request $request)
    {
        $query = JobPosition::active()->latest();
        
        // Apply search filters if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('location') && !empty($request->location)) {
            $location = $request->location;
            $query->where('location', 'like', "%{$location}%");
        }
        
        // Apply job type filter if provided
        if ($request->has('job_type') && !empty($request->job_type)) {
            $query->where('job_type', $request->job_type);
        }
        
        // Paginate the results instead of getting all at once
        $jobPositions = $query->paginate(9);
        $jobPositions->appends($request->query());
        
        return view('job-seeker.jobs.available', compact('jobPositions'));
    }
    
    /**
     * Display a job position details.
     */
    public function jobDetails(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Load the recruiter relationship
        $jobPosition->load('recruiter');
        
        // Check if the user has already applied
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = JobApplication::where('user_id', Auth::id())
                ->where('job_position_id', $jobPosition->id)
                ->exists();
        }
        
        return view('job-seeker.jobs.details', compact('jobPosition', 'hasApplied'));
    }
    
    /**
     * Show the form for creating a new job application.
     */
    public function create(JobPosition $jobPosition)
    {
        // Check if the job is active
        if (!$jobPosition->is_active) {
            abort(404, 'Job position not found or no longer active.');
        }
        
        // Check if the user has already applied
        $hasApplied = JobApplication::where('user_id', Auth::id())
            ->where('job_position_id', $jobPosition->id)
            ->exists();
            
        if ($hasApplied) {
            return redirect()->route('job-seeker.applications.index')
                ->with('info', 'You have already applied for this job position.');
        }
        
        return view('job-seeker.applications.create', compact('jobPosition'));
    }
    
    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request, JobPosition $jobPosition)
    {
        $request->validate([
            'cv_file' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);
        
        try {
            // Get the CV file
            $file = $request->file('cv_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Store the CV file
            $filePath = $file->storeAs('cv_files', $fileName, 'public');
            
            // Create multipart form data for the CV extraction API call
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->attach(
                'cv_file', 
                file_get_contents($file->path()), 
                $file->getClientOriginalName()
            )->post(config('services.cv_extraction.api_url', 'http://localhost:5000/api/extract-cv'), [
                'job_description' => $jobPosition->description . ' ' . $jobPosition->requirements,
            ]);
            
            // Check if the API call was successful
            if (!$response->successful()) {
                return redirect()->back()
                    ->with('error', 'Failed to extract CV data: ' . $response->status())
                    ->withInput();
            }
            
            // Get the API response data
            $apiData = $response->json();
            $cvData = $apiData['cv_data'] ?? null;
            $jobMatching = $apiData['job_matching'] ?? null;
            
            // Extract required skills from job position using improved method
            $jobRequirements = $jobPosition->requirements ?? '';
            $jobDescription = $jobPosition->description ?? '';
            $combinedText = $jobRequirements . "\n" . $jobDescription;
            
            $jobSkills = $this->extractSkillsFromText($combinedText);
            
            // If no skills could be extracted, don't set a perfect score
            if (empty($jobSkills)) {
                // Extract some generic skills based on the job title
                $jobTitle = $jobPosition->title ?? '';
                $jobSkills = $this->inferSkillsFromJobTitle($jobTitle);
            }
            
            // Get skills from extracted CV data
            $userSkills = [];
            if ($cvData && isset($cvData['skills']) && is_array($cvData['skills'])) {
                $userSkills = $cvData['skills'];
            }
            
            // Use improved skill matching algorithm
            $skillMatchResults = $this->matchSkills($jobSkills, $userSkills);
            $matchingSkills = $skillMatchResults['matched'];
            $partialMatches = $skillMatchResults['partial'];
            $missingSkills = $skillMatchResults['missing'];
            
            // Calculate weighted compatibility score
            $totalJobSkills = count($jobSkills);
            if ($totalJobSkills > 0) {
                // Full matches get full weight, partial matches get partial weight
                $matchScore = count($matchingSkills) - count($partialMatches);
                $partialScore = 0;
                
                foreach ($partialMatches as $match) {
                    $partialScore += $match['similarity'] * 0.7; // 70% of the weight of a full match
                }
                
                $compatibilityScore = (($matchScore + $partialScore) / $totalJobSkills) * 100;
            } else {
                // Fallback to API-provided score if available, otherwise 50% as default
                $compatibilityScore = $jobMatching['score'] ?? 50;
            }
            
            // Round to 2 decimal places and cap at 100%
            $compatibilityScore = round(min($compatibilityScore, 100), 2);
            
            // Generate detailed reasoning
            $reasoning = $this->generateReasoningText($matchingSkills, $partialMatches, $missingSkills, $totalJobSkills);
            
            // Create expanded compatibility analysis with more details
            $compatibilityAnalysis = json_encode([
                'matching_skills' => array_values($matchingSkills),
                'partial_matches' => $partialMatches,
                'missing_skills' => array_values($missingSkills),
                'reasoning' => $reasoning,
                'candidate_skills' => $userSkills,
                'job_skills' => $jobSkills,
                'score_breakdown' => [
                    'exact_matches' => count($matchingSkills) - count($partialMatches),
                    'partial_matches' => count($partialMatches),
                    'total_job_skills' => $totalJobSkills,
                    'match_percentage' => $compatibilityScore,
                ]
            ]);
            
            // Create the job application
            $jobApplication = JobApplication::create([
                'user_id' => Auth::id(),
                'job_position_id' => $jobPosition->id,
                'cv_filename' => $fileName,
                'cv_data' => $cvData,
                'compatibility_score' => $compatibilityScore,
                'compatibility_analysis' => $compatibilityAnalysis,
                'cover_letter' => $request->cover_letter,
                'status' => 'pending',
                'recruiter_viewed_at' => null,
            ]);
            
            // Dispatch event for new application submission
            event(new JobApplicationSubmitted($jobApplication));
            
            return redirect()->route('job-seeker.applications.show', $jobApplication)
                ->with('success', 'Job application submitted successfully!');
                
        } catch (\Exception $e) {
            Log::error('Error in job application submission: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'An error occurred while submitting your application. Please try again.')
                ->withInput();
        }
    }
    
    /**
     * Extract skills from job requirements text with improved detection.
     * 
     * @param string $text
     * @return array
     */
    private function extractSkillsFromText($text)
    {
        if (empty($text)) {
            return [];
        }

        // Common skills across different domains - same array as before
        $commonSkills = [
            // Programming Languages
            'JavaScript', 'Python', 'Java', 'PHP', 'C#', 'C++', 'TypeScript', 'Ruby', 'Swift', 'Kotlin', 'Go', 'Rust',
            'Scala', 'Perl', 'R', 'Shell', 'Bash', 'SQL', 'NoSQL', 'Objective-C', 'Dart',
            
            // Web Development
            'HTML', 'CSS', 'SASS', 'LESS', 'React', 'Angular', 'Vue.js', 'Node.js', 'Express', 'Next.js', 'Gatsby',
            'jQuery', 'Redux', 'Webpack', 'Babel', 'Bootstrap', 'Tailwind', 'Material UI', 'REST API', 'GraphQL',
            'WordPress', 'Drupal', 'Joomla', 'Magento', 'Shopify',
            
            // Backend Frameworks
            'Laravel', 'Django', 'Flask', 'Spring', 'Spring Boot', 'ASP.NET', 'Ruby on Rails', 'Symfony', 'CodeIgniter',
            'FastAPI', 'NestJS', 'Phoenix', 'Fastify',
            
            // Databases
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQLite', 'Cassandra', 'Oracle', 'SQL Server', 'DynamoDB', 
            'Firebase', 'Elasticsearch', 'MariaDB', 'Firestore', 'Neo4j', 'CouchDB',
            
            // Cloud & DevOps
            'AWS', 'Azure', 'GCP', 'Docker', 'Kubernetes', 'Jenkins', 'Travis CI', 'Circle CI', 'Terraform', 'Ansible',
            'Chef', 'Puppet', 'Serverless', 'Lambda', 'CloudFormation', 'Heroku', 'Digital Ocean', 'Linode', 'Netlify', 'Vercel',
            
            // Mobile Development
            'iOS', 'Android', 'React Native', 'Flutter', 'Xamarin', 'Ionic', 'Cordova', 'SwiftUI', 'Kotlin Multiplatform',
            'Objective-C', 'Jetpack Compose', 'ARKit', 'ARCore',
            
            // Version Control & Tools
            'Git', 'GitHub', 'GitLab', 'Bitbucket', 'Mercurial', 'SVN', 'Jira', 'Confluence', 'Trello', 'Slack',
            'VS Code', 'IntelliJ', 'Eclipse', 'PyCharm', 'WebStorm', 'Android Studio', 'Xcode',
            
            // Design & UI/UX
            'UI/UX Design', 'Wireframing', 'Figma', 'Sketch', 'Adobe XD', 'Photoshop', 'Illustrator', 'InDesign',
            'After Effects', 'Zeplin', 'InVision', 'User Testing', 'Accessibility',
            
            // Data Science & AI
            'Machine Learning', 'Deep Learning', 'AI', 'Data Science', 'TensorFlow', 'PyTorch', 'Keras', 'Pandas',
            'NumPy', 'SciPy', 'scikit-learn', 'Computer Vision', 'NLP', 'Big Data', 'Hadoop', 'Spark', 'Tableau',
            'Power BI', 'Data Mining', 'Statistical Analysis', 'MATLAB',
            
            // Testing
            'QA', 'Testing', 'Unit Testing', 'Integration Testing', 'E2E Testing', 'Jest', 'Mocha', 'Selenium',
            'Cypress', 'JUnit', 'TestNG', 'PHPUnit', 'RSpec', 'PyTest', 'TDD', 'BDD',
            
            // Project Management & Methodology
            'Agile', 'Scrum', 'Kanban', 'Waterfall', 'Lean', 'Six Sigma', 'PMP', 'PRINCE2', 'ITIL',
            'Project Management', 'Product Management', 'Team Leadership',
            
            // Soft Skills
            'Communication', 'Teamwork', 'Leadership', 'Problem Solving', 'Critical Thinking', 'Time Management',
            'Creativity', 'Adaptability', 'Presentation Skills', 'Collaboration',
            
            // Languages
            'English', 'Spanish', 'French', 'German', 'Chinese', 'Japanese', 'Russian', 'Italian', 'Portuguese', 'Arabic'
        ];
        
        // Map of skill variations to canonical names for normalization
        $skillVariations = [
            'javascript' => ['js', 'javascript', 'ecmascript', 'vanillajs', 'es6', 'es2015', 'es2016', 'es2017', 'es2018', 'es2019', 'es2020'],
            'typescript' => ['ts', 'typescript', 'typed javascript'],
            'react' => ['react', 'react.js', 'reactjs', 'react native', 'reactnative'],
            'angular' => ['angular', 'angularjs', 'angular.js', 'angular 2', 'angular 4', 'angular 8', 'angular 9', 'angular 10', 'angular 11', 'angular 12'],
            'vue.js' => ['vue', 'vuejs', 'vue.js', 'vue3', 'vue 3'],
            'node.js' => ['node', 'nodejs', 'node.js'],
            'python' => ['python', 'py', 'python3', 'python 3'],
            'java' => ['java', 'java8', 'java 8', 'java11', 'java 11', 'java17', 'java 17', 'spring', 'spring boot'],
            'c#' => ['c#', 'csharp', 'c-sharp', 'c sharp', '.net', 'dotnet', 'asp.net'],
            'php' => ['php', 'php7', 'php8', 'php 7', 'php 8', 'laravel', 'symfony', 'wordpress'],
            'sql' => ['sql', 'mysql', 'postgresql', 'postgres', 'sqlite', 'sql server', 'tsql', 'plsql', 'oracle'],
            'nosql' => ['nosql', 'mongodb', 'dynamodb', 'cassandra', 'couchdb', 'firebase', 'firestore'],
            'aws' => ['aws', 'amazon web services', 'ec2', 's3', 'lambda', 'cloudfront', 'route53', 'cloudformation'],
            'azure' => ['azure', 'microsoft azure', 'azure functions', 'azure devops'],
            'gcp' => ['gcp', 'google cloud', 'google cloud platform'],
            'docker' => ['docker', 'containerization', 'containers'],
            'kubernetes' => ['kubernetes', 'k8s'],
            'ci/cd' => ['ci/cd', 'continuous integration', 'continuous deployment', 'jenkins', 'circle ci', 'travis ci'],
            'git' => ['git', 'github', 'gitlab', 'bitbucket', 'version control'],
            'html' => ['html', 'html5', 'html 5', 'markup'],
            'css' => ['css', 'css3', 'cascading style sheets', 'scss', 'sass', 'less', 'stylesheets'],
            'machine learning' => ['ml', 'machine learning', 'artificial intelligence', 'ai', 'deep learning'],
            'data science' => ['data science', 'data analysis', 'data analytics', 'big data', 'data engineering'],
            'ui/ux' => ['ui', 'ux', 'ui/ux', 'user interface', 'user experience', 'usability', 'interface design'],
        ];
        
        $foundSkills = [];
        
        // Split the text into sentences to avoid missing skills
        $sentences = preg_split('/[.!?;]/', $text);
        
        // Step 1: First pass - look for exact matches from our common skills list
        foreach ($sentences as $sentence) {
            // Normalize the sentence for better matching
            $normalizedSentence = strtolower($sentence);
            
            // Look for common skills in the sentence
            foreach ($commonSkills as $skill) {
                // Use word boundary check (\b) to match complete words, case insensitive
                if (preg_match('/\b' . preg_quote(strtolower($skill), '/') . '\b/i', $normalizedSentence)) {
                    // Add skill with its original casing from our list
                    $foundSkills[] = $skill;
                }
            }
        }
        
        // Step 2: Second pass - look for contextual patterns that indicate skills
        foreach ($sentences as $sentence) {
            // Look for patterns like "Experience with X" or "Knowledge of X"
            $skillPatterns = [
                '/experience (?:with|in|using) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/knowledge of ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/proficiency (?:with|in) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/familiar (?:with) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/skills (?:in|with) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/understanding of ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/expertise (?:in|with) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/ability to ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/competency (?:in|with) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/background (?:in|with) ([a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
                '/(\d+\+? years?(?:\s+of)?\s+experience(?:\s+in|\s+with)?\s+[a-zA-Z0-9+\s\-\_\.]+?)(?:,|\.|\band\b|$)/i',
            ];
            
            foreach ($skillPatterns as $pattern) {
                if (preg_match_all($pattern, $sentence, $matches)) {
                    foreach ($matches[1] as $match) {
                        $skill = trim($match);
                        
                        // Filter out phrases that are too long or too short to be skills
                        if (strlen($skill) > 2 && strlen($skill) < 60 && !in_array($skill, $foundSkills)) {
                            // Try to normalize the extracted skill to a common name in our list
                            $normalizedSkill = $this->normalizeExtractedSkill($skill, $commonSkills, $skillVariations);
                            if ($normalizedSkill) {
                                $foundSkills[] = $normalizedSkill;
                            } else {
                                // If we can't normalize it, add it as-is
                                $foundSkills[] = $skill;
                            }
                        }
                    }
                }
            }
        }
        
        // Step 3: Look for skills in bullet points and lists
        $bulletPointPattern = '/[•\-\*]\s*([^\n\r]+)/';
        if (preg_match_all($bulletPointPattern, $text, $matches)) {
            foreach ($matches[1] as $bulletPoint) {
                $bulletPoint = trim($bulletPoint);
                
                // Check each common skill against this bullet point
                foreach ($commonSkills as $skill) {
                    if (stripos($bulletPoint, $skill) !== false) {
                        $foundSkills[] = $skill;
                    }
                }
                
                // Check for short phrases (likely to be skills)
                if (str_word_count($bulletPoint) <= 3 && strlen($bulletPoint) > 2 && strlen($bulletPoint) < 30) {
                    $normalizedSkill = $this->normalizeExtractedSkill($bulletPoint, $commonSkills, $skillVariations);
                    if ($normalizedSkill) {
                        $foundSkills[] = $normalizedSkill;
                    } else {
                        $foundSkills[] = $bulletPoint;
                    }
                }
            }
        }
        
        // Step 4: Process and clean the found skills
        $foundSkills = array_filter(array_unique($foundSkills), function($skill) {
            // Filter out common false positives
            $falsePositives = ['the ability', 'a minimum', 'at least', 'experience with', 'knowledge of', 
                'proficiency in', 'located in', 'based in', 'work in', 'we are'];
                
            foreach ($falsePositives as $fp) {
                if (stripos($skill, $fp) !== false) {
                    return false;
                }
            }
            
            return true;
        });
        
        // Sort by skill name
        sort($foundSkills);
        
        return array_values($foundSkills);
    }
    
    /**
     * Normalize extracted skills to canonical names when possible.
     * 
     * @param string $extractedSkill
     * @param array $commonSkills
     * @param array $skillVariations
     * @return string|null
     */
    private function normalizeExtractedSkill($extractedSkill, $commonSkills, $skillVariations)
    {
        $normalizedInput = strtolower(trim($extractedSkill));
        
        // Remove common prefixes/suffixes
        $normalizedInput = preg_replace('/\b(knowledge\s+of|experience\s+with|experience\s+in|proficiency\s+in|skill\s+in|familiarity\s+with)\b/i', '', $normalizedInput);
        $normalizedInput = trim($normalizedInput);
        
        // First try direct match with common skills
        foreach ($commonSkills as $skill) {
            if (strtolower($skill) === $normalizedInput) {
                return $skill; // Return with original casing
            }
        }
        
        // Then try matching against variations
        foreach ($skillVariations as $canonicalName => $variations) {
            foreach ($variations as $variation) {
                if ($variation === $normalizedInput || stripos($normalizedInput, $variation) !== false) {
                    // Find the original casing in the common skills list
                    foreach ($commonSkills as $skill) {
                        if (strtolower($skill) === strtolower($canonicalName)) {
                            return $skill;
                        }
                    }
                    return $canonicalName; // Fallback if not found in common skills
                }
            }
        }
        
        // Try to find closest match in common skills
        $bestMatch = null;
        $highestSimilarity = 0;
        
        foreach ($commonSkills as $skill) {
            $similarity = $this->calculateSimilarity(strtolower($skill), $normalizedInput);
            if ($similarity > $highestSimilarity && $similarity > 0.8) { // 80% similarity threshold
                $highestSimilarity = $similarity;
                $bestMatch = $skill;
            }
        }
        
        return $bestMatch;
    }
    
    /**
     * Calculate similarity between two strings (Jaro-Winkler distance).
     * 
     * @param string $str1
     * @param string $str2
     * @return float
     */
    private function calculateSimilarity($str1, $str2)
    {
        // Simple implementation of similarity using PHP's similar_text function
        $percent = 0;
        similar_text($str1, $str2, $percent);
        return $percent / 100;
    }
    
    /**
     * Improved skill matching function that uses more sophisticated matching.
     * 
     * @param array $jobSkills
     * @param array $userSkills
     * @return array
     */
    private function matchSkills($jobSkills, $userSkills)
    {
        $matchedSkills = [];
        $partialMatches = [];
        $missingSkills = [];
        
        // Create lowercase versions for case-insensitive matching
        $lowercaseUserSkills = array_map('strtolower', $userSkills);
        
        foreach ($jobSkills as $jobSkill) {
            $jobSkillLower = strtolower($jobSkill);
            $bestMatchScore = 0;
            $bestMatch = null;
            
            // Check for exact matches first
            if (in_array($jobSkillLower, $lowercaseUserSkills)) {
                $matchedSkills[] = $jobSkill;
                continue;
            }
            
            // Check for substring matches (e.g., "JavaScript" matches "JavaScript ES6")
            foreach ($userSkills as $index => $userSkill) {
                $userSkillLower = strtolower($userSkill);
                
                // Check if job skill is contained in user skill or vice versa
                if (strpos($userSkillLower, $jobSkillLower) !== false || 
                    strpos($jobSkillLower, $userSkillLower) !== false) {
                    $matchedSkills[] = $jobSkill;
                    $bestMatch = $userSkill;
                    $bestMatchScore = 1.0;
                    break;
                }
                
                // Calculate similarity for approximate matching
                $similarity = $this->calculateSimilarity($jobSkillLower, $userSkillLower);
                
                if ($similarity > $bestMatchScore) {
                    $bestMatchScore = $similarity;
                    $bestMatch = $userSkill;
                }
            }
            
            // If we have a good partial match but not exact enough for full match
            if ($bestMatchScore >= 0.7 && $bestMatchScore < 0.9 && !in_array($jobSkill, $matchedSkills)) {
                $partialMatches[] = [
                    'job_skill' => $jobSkill,
                    'user_skill' => $bestMatch,
                    'similarity' => $bestMatchScore
                ];
            } 
            // If no good match was found
            elseif ($bestMatchScore < 0.7 && !in_array($jobSkill, $matchedSkills)) {
                $missingSkills[] = $jobSkill;
            }
        }
        
        // Add the highest scoring partial matches to matched skills
        foreach ($partialMatches as $partialMatch) {
            $matchedSkills[] = $partialMatch['job_skill'] . ' (similar to: ' . $partialMatch['user_skill'] . ')';
        }
        
        // Return results as an associative array
        return [
            'matched' => array_unique($matchedSkills),
            'partial' => $partialMatches,
            'missing' => $missingSkills
        ];
    }
    
    /**
     * Generate detailed reasoning text for compatibility analysis.
     * 
     * @param array $matchingSkills
     * @param array $partialMatches
     * @param array $missingSkills
     * @param int $totalJobSkills
     * @return string
     */
    private function generateReasoningText($matchingSkills, $partialMatches, $missingSkills, $totalJobSkills)
    {
        $exactMatchCount = count($matchingSkills) - count($partialMatches);
        $partialMatchCount = count($partialMatches);
        $matchPercentage = $totalJobSkills > 0 ? round((($exactMatchCount + ($partialMatchCount * 0.7)) / $totalJobSkills) * 100) : 0;
        
        $reasoning = "Your profile has ";
        
        if ($exactMatchCount > 0) {
            $reasoning .= "$exactMatchCount exact skill match" . ($exactMatchCount > 1 ? "es" : "");
            
            if ($partialMatchCount > 0) {
                $reasoning .= " and $partialMatchCount partial match" . ($partialMatchCount > 1 ? "es" : "");
            }
        } elseif ($partialMatchCount > 0) {
            $reasoning .= "$partialMatchCount partial skill match" . ($partialMatchCount > 1 ? "es" : "");
        } else {
            $reasoning .= "no direct skill matches";
        }
        
        $reasoning .= " out of $totalJobSkills required skills ($matchPercentage% match). ";
        
        // Add details about the matches
        if ($exactMatchCount > 0) {
            $exactMatches = array_diff($matchingSkills, array_map(function($match) {
                return $match['job_skill'] . ' (similar to: ' . $match['user_skill'] . ')';
            }, $partialMatches));
            
            $reasoning .= "Your exact skill matches include: " . implode(", ", array_slice($exactMatches, 0, 5));
            if (count($exactMatches) > 5) {
                $reasoning .= ", and " . (count($exactMatches) - 5) . " more";
            }
            $reasoning .= ". ";
        }
        
        // Add information about partial matches
        if ($partialMatchCount > 0) {
            $reasoning .= "You have related skills that are similar to: ";
            $partialList = [];
            $count = 0;
            
            foreach ($partialMatches as $match) {
                if ($count < 3) {
                    $partialList[] = "{$match['job_skill']} (you have {$match['user_skill']})";
                    $count++;
                } else {
                    break;
                }
            }
            
            $reasoning .= implode(", ", $partialList);
            if (count($partialMatches) > 3) {
                $reasoning .= ", and " . (count($partialMatches) - 3) . " more";
            }
            $reasoning .= ". ";
        }
        
        // Add advice about missing skills
        if (count($missingSkills) > 0) {
            $reasoning .= "Consider developing skills in: " . implode(", ", array_slice($missingSkills, 0, 5));
            if (count($missingSkills) > 5) {
                $reasoning .= ", and " . (count($missingSkills) - 5) . " more";
            }
            $reasoning .= ".";
        } else {
            $reasoning .= "You have all the skills required for this position!";
        }
        
        return $reasoning;
    }
    
    /**
     * Display the job seeker's applications.
     */
    public function index()
    {
        $applications = Auth::user()->jobApplications()
            ->with('jobPosition.recruiter')
            ->latest()
            ->get();
            
        return view('job-seeker.applications.index', compact('applications'));
    }
    
    /**
     * Display the specified job application.
     */
    public function show(JobApplication $jobApplication)
    {
        // Make sure the job seeker can only view their own applications
        if ($jobApplication->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('job-seeker.applications.show', compact('jobApplication'));
    }
    
    /**
     * Update the status of a job application.
     */
    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        // Authorize the user (must be a recruiter and own the job position)
        $this->authorize('view', $jobApplication);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,in_review,accepted,rejected',
            'recruiter_notes' => 'nullable|string|max:1000',
        ]);
        
        try {
            // Only update recruiter_notes if provided
            $updateData = ['status' => $validated['status']];
            
            if ($request->has('recruiter_notes')) {
                $updateData['recruiter_notes'] = $validated['recruiter_notes'];
            }
            
            // Reset seeker_viewed_at when status changes
            if ($jobApplication->status !== $validated['status']) {
                $updateData['seeker_viewed_at'] = null;
            }
            
            $jobApplication->update($updateData);
            
            return redirect()->back()->with('success', 'Application status updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating application status: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'An error occurred while updating the application status. Please try again.')
                ->withInput();
        }
    }
    
    /**
     * Display the job applications for the recruiter's job positions.
     */
    public function recruiterApplications(Request $request)
    {
        $jobPositions = Auth::user()->jobPositions()->with('applications.jobSeeker')->get();
        $applications = collect();
        
        foreach ($jobPositions as $position) {
            $applications = $applications->merge($position->applications);
        }
        
        // Apply filters if provided
        if ($request->has('job_position') && !empty($request->job_position)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->job_position_id == $request->job_position;
            });
        }
        
        if ($request->has('status') && !empty($request->status)) {
            $applications = $applications->filter(function($app) use ($request) {
                return $app->status == $request->status;
            });
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $applications = $applications->sortBy('created_at');
                    break;
                case 'highest_score':
                    $applications = $applications->sortByDesc('compatibility_score');
                    break;
                default:
                    $applications = $applications->sortByDesc('created_at');
                    break;
            }
        } else {
            $applications = $applications->sortByDesc('created_at');
        }
        
        // Convert the collection to a paginator
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        $items = $applications->slice($offset, $perPage)->values();
        
        $applications = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $applications->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );
        
        return view('recruiter.applications.index', compact('applications', 'jobPositions'));
    }
    
    /**
     * Display the specified job application for the recruiter.
     */
    public function recruiterShowApplication(JobApplication $jobApplication)
    {
        // Make sure the recruiter can only view applications for their job positions
        $jobPosition = $jobApplication->jobPosition;
        
        if ($jobPosition->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('recruiter.applications.show', compact('jobApplication'));
    }
    
    /**
     * Add recruiter notes to a job application.
     */
    public function addNotes(Request $request, JobApplication $jobApplication)
    {
        // Authorize the user (must be a recruiter and own the job position)
        $this->authorize('view', $jobApplication);
        
        $validated = $request->validate([
            'recruiter_notes' => 'required|string|max:1000',
        ]);
        
        try {
            $jobApplication->update([
                'recruiter_notes' => $validated['recruiter_notes'],
            ]);
            
            return redirect()->back()->with('success', 'Notes updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating notes: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'An error occurred while updating notes. Please try again.')
                ->withInput();
        }
    }
    
    /**
     * Analyze job compatibility for an application.
     */
    public function analyzeCompatibility(Request $request, JobApplication $jobApplication)
    {
        // Authorize the user (must be a recruiter and own the job position)
        $this->authorize('view', $jobApplication);
        
        try {
            // Get CV data and job position details
            $cvData = is_array($jobApplication->cv_data) 
                ? $jobApplication->cv_data 
                : json_decode($jobApplication->cv_data, true);
                
            $jobPosition = $jobApplication->jobPosition;
            
            if (!$cvData) {
                return response()->json([
                    'success' => false,
                    'message' => 'No CV data available for analysis'
                ], 400);
            }
            
            // Extract skills from CV data and job requirements
            $candidateSkills = $cvData['skills'] ?? [];
            $jobSkills = $this->extractSkillsFromText($jobPosition->requirements);
            
            // Calculate compatibility
            list($compatibilityScore, $matchingSkills, $missingSkills, $partialMatches) = $this->calculateCompatibility($candidateSkills, $jobSkills);
            
            // Create analysis summary
            $scoreBreakdown = [
                'exact_matches' => count($matchingSkills),
                'partial_matches' => count($partialMatches),
                'total_job_skills' => count($jobSkills),
                'match_percentage' => $compatibilityScore,
            ];
            
            $reasoning = $this->generateCompatibilityReasoning($compatibilityScore, $matchingSkills, $missingSkills, $partialMatches);
            
            $compatibilityAnalysis = json_encode([
                'matching_skills' => $matchingSkills,
                'missing_skills' => $missingSkills,
                'partial_matches' => $partialMatches,
                'candidate_skills' => $candidateSkills,
                'job_skills' => $jobSkills,
                'score_breakdown' => $scoreBreakdown,
                'reasoning' => $reasoning,
            ]);
            
            // Update the job application with compatibility data
            $jobApplication->update([
                'compatibility_score' => $compatibilityScore,
                'compatibility_analysis' => $compatibilityAnalysis
            ]);
            
            return response()->json([
                'success' => true,
                'compatibility_score' => $compatibilityScore,
                'compatibility_analysis' => $compatibilityAnalysis
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error analyzing compatibility: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while analyzing compatibility: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Generate reasoning text for compatibility analysis.
     */
    private function generateCompatibilityReasoning($score, $matchingSkills, $missingSkills, $partialMatches)
    {
        if ($score >= 85) {
            return "Excellent match. The candidate has most of the required skills for this position, including key skills like " . 
                   implode(', ', array_slice($matchingSkills, 0, 3)) . ".";
        } elseif ($score >= 70) {
            return "Good match. The candidate has many important required skills, but is missing some skills like " . 
                   implode(', ', array_slice($missingSkills, 0, 2)) . ".";
        } elseif ($score >= 50) {
            return "Moderate match. The candidate has some of the required skills, with " . count($matchingSkills) . 
                   " exact matches and " . count($partialMatches) . " potential skill matches.";
        } else {
            return "Low compatibility. The candidate is missing several key skills required for this position, including " . 
                   implode(', ', array_slice($missingSkills, 0, 3)) . ".";
        }
    }
    
    /**
     * Calculate compatibility between candidate skills and job requirements.
     * 
     * @param array $candidateSkills
     * @param array $jobSkills
     * @return array [$compatibilityScore, $matchingSkills, $missingSkills, $partialMatches]
     */
    private function calculateCompatibility($candidateSkills, $jobSkills)
    {
        // Normalize skill strings for case-insensitive comparison
        $normalizedCandidateSkills = array_map('strtolower', $candidateSkills);
        $normalizedJobSkills = array_map('strtolower', $jobSkills);
        
        // Find exact matches
        $matchingSkills = [];
        foreach ($jobSkills as $index => $jobSkill) {
            if (in_array(strtolower($jobSkill), $normalizedCandidateSkills)) {
                $matchingSkills[] = $jobSkill;
            }
        }
        
        // Find missing skills
        $missingSkills = array_filter($jobSkills, function($skill) use ($normalizedCandidateSkills) {
            return !in_array(strtolower($skill), $normalizedCandidateSkills);
        });
        
        // Find partial matches using token matching
        $partialMatches = [];
        foreach ($missingSkills as $jobSkill) {
            $bestMatch = null;
            $highestSimilarity = 0;
            
            foreach ($candidateSkills as $candidateSkill) {
                $similarity = $this->calculateSkillSimilarity($jobSkill, $candidateSkill);
                
                if ($similarity > 0.6 && $similarity > $highestSimilarity) {
                    $bestMatch = [
                        'job_skill' => $jobSkill,
                        'user_skill' => $candidateSkill,
                        'similarity' => $similarity
                    ];
                    $highestSimilarity = $similarity;
                }
            }
            
            if ($bestMatch) {
                $partialMatches[] = $bestMatch;
            }
        }
        
        // Calculate compatibility score
        $exactMatchCount = count($matchingSkills);
        $partialMatchCount = count($partialMatches) * 0.5; // Partial matches count as half
        $totalJobSkills = count($jobSkills);
        
        $compatibilityScore = $totalJobSkills > 0 
            ? (($exactMatchCount + $partialMatchCount) / $totalJobSkills) * 100 
            : 0;
            
        // Cap at 100%
        $compatibilityScore = min(100, $compatibilityScore);
        
        return [$compatibilityScore, $matchingSkills, $missingSkills, $partialMatches];
    }
    
    /**
     * Calculate similarity between two skills using token matching.
     * 
     * @param string $skillA
     * @param string $skillB
     * @return float Similarity score between 0 and 1
     */
    private function calculateSkillSimilarity($skillA, $skillB)
    {
        // Convert to lowercase
        $skillA = strtolower($skillA);
        $skillB = strtolower($skillB);
        
        // If one is a substring of the other, high similarity
        if (strpos($skillA, $skillB) !== false || strpos($skillB, $skillA) !== false) {
            return 0.8;
        }
        
        // Split into tokens
        $tokensA = explode(' ', preg_replace('/[^\w\s]/', '', $skillA));
        $tokensB = explode(' ', preg_replace('/[^\w\s]/', '', $skillB));
        
        // Find common tokens
        $common = array_intersect($tokensA, $tokensB);
        
        // Calculate Jaccard similarity
        $total = count(array_unique(array_merge($tokensA, $tokensB)));
        return $total > 0 ? count($common) / $total : 0;
    }
}
