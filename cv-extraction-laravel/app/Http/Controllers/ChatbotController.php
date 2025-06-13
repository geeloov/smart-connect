<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    /**
     * Predefined questions and answers for the chatbot (dual perspective)
     */
    private $predefinedQA;

    public function __construct()
    {
        $this->predefinedQA = [
            // Welcome/Greeting
            [
                'keywords' => ['hello', 'hi', 'hey', 'start', 'help'],
                'question' => 'Hello! How can I help you today?',
                'job_seeker_answer' => 'Hi there! I\'m here to help you with your job search. I can assist with CV uploads, finding job matches, tracking applications, and understanding platform features. What would you like to know?',
                'recruiter_answer' => 'Hi there! I\'m here to help you with your recruitment needs. I can assist with posting jobs, reviewing candidates, CV analysis, and managing applications. What would you like to know?'
            ],
            
            // CV/Resume Management
            [
                'keywords' => ['upload', 'cv', 'resume', 'file', 'pdf', 'extract', 'extraction', 'processing', 'process'],
                'question' => 'How does CV processing work?',
                'job_seeker_answer' => 'To upload your CV: [Go to "CV Upload"](' . route('job-seeker.cv-upload') . ') in your dashboard, select your PDF resume, and click upload. Our AI extracts your skills, experience, and education automatically. You can then use this processed CV to apply for jobs and get compatibility scores.',
                'recruiter_answer' => 'For CV analysis: [Use the "CV Extraction" tool](' . route('recruiter.cv-extraction') . ') to upload candidate resumes. Our AI extracts structured data including skills, experience, and education. You can then compare candidates against job requirements and get compatibility scores to help with selection.'
            ],
            
            // Job Matching & Applications
            [
                'keywords' => ['job', 'match', 'matching', 'compatibility', 'score', 'apply', 'application', 'applications'],
                'question' => 'How does job matching and applications work?',
                'job_seeker_answer' => '[Browse jobs in the "Available Jobs" section](' . route('job-seeker.jobs.available') . '). Click on positions to see compatibility scores based on your CV. Higher scores mean better matches. To apply, click "Apply Now" and select your CV. [Track all applications in "My Applications"](' . route('job-seeker.applications.index') . ') with real-time status updates.',
                'recruiter_answer' => '[Post jobs via "Post New Job"](' . route('recruiter.job-positions.create') . ') with detailed requirements. Our system automatically matches candidates and provides compatibility scores. [Review applications in "View Applications"](' . route('recruiter.applications.index') . ') where you can see candidate details, compatibility analysis, and update application statuses.'
            ],
            
            // Account & Platform
            [
                'keywords' => ['account', 'login', 'register', 'platform', 'dashboard', 'profile', 'manage'],
                'question' => 'How do I manage my account and use the platform?',
                'job_seeker_answer' => 'You can [login here](' . route('login') . ') or [create an account](' . route('register') . ') by selecting "Job Seeker". Your [dashboard](' . route('job-seeker.dashboard') . ') shows application status, job recommendations, and [CV management](' . route('job-seeker.cv-upload') . '). [Update your profile](' . route('job-seeker.profile') . ') anytime to improve job matching accuracy.',
                'recruiter_answer' => 'You can [login here](' . route('login') . ') or [create an account](' . route('register') . ') by selecting "Recruiter". Your [dashboard](' . route('recruiter.dashboard') . ') shows posted jobs, candidate applications, and recruitment analytics. [Manage your company profile](' . route('recruiter.profile') . ') to attract better candidates.'
            ],
            
            // Role-specific: Job seeker applications
            [
                'keywords' => ['apply', 'job', 'application', 'how to apply', 'application process'],
                'question' => 'How do I apply for jobs?',
                'job_seeker_answer' => 'To apply for jobs: 1) [Browse available positions](' . route('job-seeker.jobs.available') . '), 2) Click on a job to view details, 3) Click the "Apply Now" button, 4) Select your CV from your uploaded documents, 5) Add any optional cover letter or notes, 6) Submit your application. You can [track all your applications](' . route('job-seeker.applications.index') . ') in the "My Applications" section.',
                'recruiter_answer' => 'Job seekers can apply through our platform by viewing job listings, clicking on positions of interest, and submitting their applications with their processed CVs. You\'ll receive notifications when new applications arrive and can review them in your dashboard.'
            ],
            
            // Role-specific: Application tracking
            [
                'keywords' => ['track', 'application', 'status', 'progress', 'application status'],
                'question' => 'How can I track my applications?',
                'job_seeker_answer' => 'Track your applications in the [My Applications section](' . route('job-seeker.applications.index') . '). You\'ll see the status of each application (Pending, In Review, Interview Scheduled, etc.) and receive notifications when there are updates. Click on any application to view its details, including any messages from recruiters.',
                'recruiter_answer' => 'Manage candidate applications through your dashboard. You can see all applications, filter by job position, and update their statuses (Pending, In Review, Interview, etc.). The system notifies candidates when you change their application status.'
            ],
            
            // Role-specific: Create job position
            [
                'keywords' => ['create', 'job', 'position', 'post', 'posting', 'new job'],
                'question' => 'How do I create a job position?',
                'job_seeker_answer' => 'As a job seeker, you can\'t create job positions. However, you can browse all available positions posted by recruiters in the [Available Jobs section](' . route('job-seeker.jobs.available') . ') and apply to those that match your skills and interests.',
                'recruiter_answer' => 'To create a job position: 1) Go to [Post New Job](' . route('recruiter.job-positions.create') . '), 2) Fill in the job details including title, description, requirements, and salary range, 3) Select required skills and experience level, 4) Click "Create Job Position". Your job will immediately be visible to matching candidates in the system.'
            ],
            
            // Role-specific: Review applicants
            [
                'keywords' => ['review', 'applicant', 'candidate', 'application', 'evaluate'],
                'question' => 'How do I review applicants?',
                'job_seeker_answer' => 'As a job seeker, you don\'t review other applicants. You can focus on enhancing your own profile and applications to increase your chances of being selected by recruiters.',
                'recruiter_answer' => 'To review applicants: 1) Go to [View Applications](' . route('recruiter.applications.index') . '), 2) Filter by job position if needed, 3) Click on an application to see candidate details, CV, and compatibility score, 4) Update application status as you progress through your hiring process, 5) Use the [Candidate Pipeline](' . route('recruiter.pipeline') . ') for a visual overview of all candidates across different stages.'
            ],
            
            // Technical Support
            [
                'keywords' => ['problem', 'error', 'issue', 'bug', 'not working', 'support'],
                'question' => 'I\'m having technical issues. What should I do?',
                'job_seeker_answer' => 'For technical issues: 1) Refresh the page, 2) Clear browser cache, 3) Ensure your CV is in PDF format with readable text, 4) Check your internet connection. If problems persist, contact our support team.',
                'recruiter_answer' => 'For technical issues: 1) Refresh the page, 2) Clear browser cache, 3) Ensure candidate CVs are in PDF format, 4) Check your internet connection. If problems persist, contact our support team.'
            ],
            
            // Data Security
            [
                'keywords' => ['privacy', 'data', 'security', 'safe', 'confidential'],
                'question' => 'Is my data safe and private?',
                'job_seeker_answer' => 'Yes, your CV and personal data are encrypted and stored securely. We only use your information for job matching. Your data is never shared with third parties without your consent, and you control which recruiters can see your profile.',
                'recruiter_answer' => 'Yes, all candidate data and your company information are encrypted and stored securely. We comply with data protection regulations. Candidate information is only accessible to authorized recruiters, and we maintain strict confidentiality standards.'
            ],
            
            // Goodbye
            [
                'keywords' => ['thanks', 'thank you', 'bye', 'goodbye'],
                'question' => 'Thank you / Goodbye',
                'job_seeker_answer' => 'You\'re welcome! Best of luck with your job search. Feel free to ask if you need any help with applications or platform features!',
                'recruiter_answer' => 'You\'re welcome! Best of luck with your recruitment. Feel free to ask if you need any help with candidate management or platform features!'
            ]
        ];
    }

    /**
     * Get chatbot response based on user message
     */
    public function getResponse(Request $request): JsonResponse
    {
        // Validate request
        $validated = $request->validate([
            'message' => 'required|string|max:500',
            'exact_question' => 'nullable|string',
        ]);
        
        $userMessage = strtolower(trim($validated['message']));
        $exactQuestion = $request->input('exact_question'); // This might be the full quick question
        
        if (empty($userMessage)) {
            return response()->json([
                'response' => 'Please type a message and I\'ll be happy to help you!'
            ]);
        }

        // Detect user role from authentication or URL context
        $userRole = $this->detectUserRole($request);

        // For debugging purposes
        \Log::info('Chatbot request received', [
            'message' => $userMessage,
            'exact_question' => $exactQuestion,
            'role' => $userRole
        ]);

        // First, try to find exact match for quick questions
        if (!empty($exactQuestion)) {
            foreach ($this->predefinedQA as $qa) {
                if (isset($qa['question']) && $this->isSimilarQuestion($exactQuestion, $qa['question'])) {
                    $response = $this->getRoleSpecificAnswer($qa, $userRole);
                    
                    \Log::info('Exact question match found', [
                        'question' => $qa['question'],
                        'user_role' => $userRole
                    ]);
                    
                    return response()->json([
                        'response' => $response,
                        'user_role' => $userRole,
                        'match_type' => 'exact'
                    ]);
                }
            }
        }

        // If no exact match or no exact question provided, find best match based on keywords
        $response = $this->findBestMatch($userMessage, $userRole);
        
        // Log the interaction for analytics
        \Log::info('Chatbot Interaction', [
            'user_role' => $userRole,
            'query' => $userMessage,
            'response_type' => 'text',
            'match_type' => 'keyword'
        ]);
        
        return response()->json([
            'response' => $response,
            'user_role' => $userRole // Sending back role for frontend context
        ]);
    }

    /**
     * Get predefined questions for quick access
     */
    public function getQuickQuestions(Request $request): JsonResponse
    {
        $userRole = $this->detectUserRole($request);
        
        // Base questions for all users
        $quickQuestions = [
            'How does CV processing work?',
            'How does job matching and applications work?',
            'How do I manage my account and use the platform?',
            'Is my data safe and private?'
        ];
        
        // Role-specific additional questions
        if ($userRole === 'recruiter') {
            $quickQuestions[] = 'How do I create a job position?';
            $quickQuestions[] = 'How do I review applicants?';
        } else if ($userRole === 'job_seeker') {
            $quickQuestions[] = 'How do I apply for jobs?';
            $quickQuestions[] = 'How can I track my applications?';
        }
        
        // Take only the first 4 questions to avoid overcrowding
        $quickQuestions = array_slice($quickQuestions, 0, 4);

        return response()->json([
            'questions' => $quickQuestions,
            'role' => $userRole
        ]);
    }

    /**
     * Detect user role from request context
     */
    private function detectUserRole(Request $request): string
    {
        // Check if user is authenticated
        if (auth()->check()) {
            return auth()->user()->role ?? 'general';
        }

        // Check URL context from referer
        $referer = $request->header('referer', '');
        if (strpos($referer, '/recruiter/') !== false) {
            return 'recruiter';
        } elseif (strpos($referer, '/job-seeker/') !== false) {
            return 'job_seeker';
        }
        
        // Check if request has session with role
        if ($request->session()->has('user_role')) {
            return $request->session()->get('user_role');
        }

        // Default to general user
        return 'general';
    }

    /**
     * Find the best matching response for user input
     */
    private function findBestMatch(string $userMessage, string $userRole = 'general'): string
    {
        // Normalize user message: convert to lowercase and remove extra spaces
        $userMessage = strtolower(trim($userMessage));
        
        // First, check for exact question matches (this is important for quick questions)
        foreach ($this->predefinedQA as $qa) {
            if (isset($qa['question']) && $this->isSimilarQuestion($userMessage, strtolower($qa['question']))) {
                // Direct question match gets highest priority
                return $this->getRoleSpecificAnswer($qa, $userRole);
            }
        }
        
        // Next, check if the question is relevant to our platform
        if (!$this->isRelevantQuestion($userMessage)) {
            return $this->getIrrelevantQuestionResponse($userRole);
        }

        $bestMatch = null;
        $highestScore = 0;
        
        // Log for debugging
        \Log::info('Searching for match to: ' . $userMessage);

        foreach ($this->predefinedQA as $qa) {
            $score = 0;
            $matchedKeywords = [];
            
            // Check exact keyword matches
            foreach ($qa['keywords'] as $keyword) {
                // Look for the keyword as a whole word
                if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/i', $userMessage)) {
                    $score += strlen($keyword) * 2; // Whole word matches get double points
                    $matchedKeywords[] = $keyword;
                }
                // Also check for partial matches (with lower score)
                elseif (strpos($userMessage, $keyword) !== false) {
                    $score += strlen($keyword); // Partial matches get regular points
                    $matchedKeywords[] = $keyword;
                }
            }
            
            // Boost score if multiple keywords match (indicating stronger relevance)
            if (count($matchedKeywords) > 1) {
                $score *= (1 + (count($matchedKeywords) * 0.2)); // 20% bonus per additional keyword
            }
            
            // Log potential matches
            if ($score > 0) {
                \Log::info("Potential match found - Question: {$qa['question']}, Score: $score, Matched: " . implode(', ', $matchedKeywords));
            }
            
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $qa;
            }
        }

        // If no good match found but question seems relevant, return helpful response
        if ($highestScore === 0) {
            \Log::info('No matches found for: ' . $userMessage);
            return $this->getNoMatchResponse($userRole);
        }

        \Log::info("Best match selected - Question: {$bestMatch['question']}, Score: $highestScore");
        
        // Return role-specific answer
        return $this->getRoleSpecificAnswer($bestMatch, $userRole);
    }
    
    /**
     * Check if two questions are similar (for direct question matching)
     */
    private function isSimilarQuestion(string $userQuestion, string $predefinedQuestion): bool
    {
        // Normalize both questions
        $userQuestion = strtolower(trim($userQuestion));
        $predefinedQuestion = strtolower(trim($predefinedQuestion));
        
        // Check for exact match
        if ($userQuestion === $predefinedQuestion) {
            return true;
        }
        
        // Check for very close match (with/without question mark, slight differences)
        $userQuestion = rtrim($userQuestion, '?.,!');
        $predefinedQuestion = rtrim($predefinedQuestion, '?.,!');
        
        if ($userQuestion === $predefinedQuestion) {
            return true;
        }
        
        // Check if one is a substring of the other (for truncated questions)
        if (strpos($predefinedQuestion, $userQuestion) === 0 || strpos($userQuestion, $predefinedQuestion) === 0) {
            return true;
        }
        
        // If question is at least 5 words, check for 80% similarity
        $userWords = explode(' ', $userQuestion);
        $predefinedWords = explode(' ', $predefinedQuestion);
        
        if (count($userWords) >= 5) {
            similar_text($userQuestion, $predefinedQuestion, $percent);
            if ($percent > 80) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get role-specific answer from matched Q&A
     */
    private function getRoleSpecificAnswer(array $qa, string $userRole): string
    {
        if ($userRole === 'recruiter' && isset($qa['recruiter_answer'])) {
            return $qa['recruiter_answer'];
        } elseif ($userRole === 'job_seeker' && isset($qa['job_seeker_answer'])) {
            return $qa['job_seeker_answer'];
        }
        
        // Fallback to job_seeker answer or general answer
        return $qa['job_seeker_answer'] ?? $qa['answer'] ?? 'I\'m sorry, I couldn\'t find a specific answer for that question.';
    }

    /**
     * Get response when no match is found but question seems relevant
     */
    private function getNoMatchResponse(string $userRole): string
    {
        $baseMessage = "I understand you're asking about our platform, but I'm not sure how to help with that specific question.";
        
        if ($userRole === 'recruiter') {
            return $baseMessage . " Here are some topics I can assist you with:\n\n" .
                   "• Posting and managing job positions\n" .
                   "• CV analysis and candidate evaluation\n" .
                   "• Application management and status updates\n" .
                   "• Account and company profile settings\n" .
                   "• Platform features and data security\n\n" .
                   "Could you please rephrase your question or ask about one of these topics?";
        } elseif ($userRole === 'job_seeker') {
            return $baseMessage . " Here are some topics I can assist you with:\n\n" .
                   "• CV upload and processing\n" .
                   "• Job search and compatibility matching\n" .
                   "• Application tracking and status\n" .
                   "• Account and profile management\n" .
                   "• Platform features and data security\n\n" .
                   "Could you please rephrase your question or ask about one of these topics?";
        }
        
        // General response
        return $baseMessage . " Here are some topics I can assist you with:\n\n" .
               "• CV upload and processing\n" .
               "• Job matching and applications\n" .
               "• Account management\n" .
               "• Platform features and security\n\n" .
               "Could you please rephrase your question or ask about one of these topics?";
    }

    /**
     * Check if the question is relevant to our platform
     */
    private function isRelevantQuestion(string $userMessage): bool
    {
        // Platform-related keywords
        $platformKeywords = [
            'cv', 'resume', 'job', 'application', 'upload', 'extract', 'extraction', 'match', 'matching',
            'recruiter', 'candidate', 'position', 'apply', 'profile', 'account', 'login', 'register',
            'compatibility', 'score', 'ai', 'platform', 'website', 'service', 'help', 'support',
            'data', 'security', 'privacy', 'file', 'pdf', 'process', 'analysis', 'smart', 'connect',
            'dashboard', 'track', 'status', 'shortlist', 'hire', 'skill', 'experience', 'education',
            'hello', 'hi', 'hey', 'start', 'thanks', 'thank', 'bye', 'goodbye'
        ];

        // Irrelevant/off-topic keywords that should trigger the irrelevant response
        $irrelevantKeywords = [
            'weather', 'news', 'sports', 'politics', 'cooking', 'recipe', 'movie', 'music', 'game',
            'celebrity', 'entertainment', 'shopping', 'travel', 'vacation', 'restaurant', 'food',
            'health', 'medicine', 'doctor', 'exercise', 'fitness', 'diet', 'weight', 'fashion',
            'car', 'vehicle', 'driving', 'traffic', 'animal', 'pet', 'cat', 'dog', 'bird',
            'math', 'science', 'physics', 'chemistry', 'biology', 'history', 'geography',
            'cryptocurrency', 'bitcoin', 'stock', 'investment', 'finance', 'bank', 'money',
            'relationship', 'dating', 'marriage', 'family', 'children', 'school', 'university',
            'love', 'hate', 'kill', 'death', 'war', 'violence', 'drugs', 'alcohol', 'party'
        ];

        // Check for irrelevant keywords first
        foreach ($irrelevantKeywords as $keyword) {
            if (strpos($userMessage, $keyword) !== false) {
                return false;
            }
        }

        // Check for platform-related keywords
        foreach ($platformKeywords as $keyword) {
            if (strpos($userMessage, $keyword) !== false) {
                return true;
            }
        }

        // If message is very short (like greetings), consider it relevant
        if (strlen($userMessage) <= 20) {
            return true;
        }

        // If no platform keywords found and message is longer, it's likely irrelevant
        return false;
    }

    /**
     * Get response for irrelevant questions
     */
    private function getIrrelevantQuestionResponse(string $userRole = 'general'): string
    {
        $responses = [
            "I'm sorry, but I can only provide information about Smart Connect platform features and services. I'm specifically designed to help with CV processing, job matching, and platform-related questions.",
            
            "I appreciate your question, but I'm a specialized assistant for the Smart Connect platform. I can only help with topics related to CV extraction, job applications, and our platform features.",
            
            "I'm unable to assist with that topic as I'm designed specifically for Smart Connect platform support. Please ask me about platform-related features.",
            
            "That's outside my area of expertise. I'm here to help you with Smart Connect platform questions."
        ];

        // Role-specific helpful suggestions
        if ($userRole === 'recruiter') {
            $helpfulSuggestion = "\n\nHere's what I can help you with:\n" .
                               "• Posting and managing job positions\n" .
                               "• CV analysis and candidate evaluation\n" .
                               "• Application management and reviews\n" .
                               "• Company profile and account settings\n" .
                               "• Platform features and security\n\n" .
                               "How can I assist you with any of these recruitment topics?";
        } elseif ($userRole === 'job_seeker') {
            $helpfulSuggestion = "\n\nHere's what I can help you with:\n" .
                               "• CV upload and processing\n" .
                               "• Job search and compatibility matching\n" .
                               "• Application tracking and status\n" .
                               "• Profile and account management\n" .
                               "• Platform features and security\n\n" .
                               "How can I assist you with your job search?";
        } else {
            $helpfulSuggestion = "\n\nHere's what I can help you with:\n" .
                               "• CV upload and AI extraction\n" .
                               "• Job matching and compatibility\n" .
                               "• Application tracking and management\n" .
                               "• Account and profile settings\n" .
                               "• Platform features and security\n\n" .
                               "How can I assist you with any of these topics?";
        }

        return $responses[array_rand($responses)] . $helpfulSuggestion;
    }
}