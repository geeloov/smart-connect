<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    /**
     * Predefined questions and answers for the chatbot (dual perspective)
     */
    private $predefinedQA = [
        // Welcome/Greeting
        [
            'keywords' => ['hello', 'hi', 'hey', 'start', 'help'],
            'question' => 'Hello! How can I help you today?',
            'job_seeker_answer' => 'Hi there! I\'m here to help you with your job search. I can assist with CV uploads, finding job matches, tracking applications, and understanding platform features. What would you like to know?',
            'recruiter_answer' => 'Hi there! I\'m here to help you with your recruitment needs. I can assist with posting jobs, reviewing candidates, CV analysis, and managing applications. What would you like to know?'
        ],
        
        // CV/Resume Management
        [
            'keywords' => ['upload', 'cv', 'resume', 'file', 'pdf', 'extract', 'extraction'],
            'question' => 'How does CV processing work?',
            'job_seeker_answer' => 'To upload your CV: Go to "CV Upload" in your dashboard, select your PDF resume, and click upload. Our AI extracts your skills, experience, and education automatically. You can then use this processed CV to apply for jobs and get compatibility scores.',
            'recruiter_answer' => 'For CV analysis: Use the "CV Extraction" tool to upload candidate resumes. Our AI extracts structured data including skills, experience, and education. You can then compare candidates against job requirements and get compatibility scores to help with selection.'
        ],
        
        // Job Matching & Applications
        [
            'keywords' => ['job', 'match', 'matching', 'compatibility', 'score', 'apply', 'application'],
            'question' => 'How does job matching and applications work?',
            'job_seeker_answer' => 'Browse jobs in the "Available Jobs" section. Click on positions to see compatibility scores based on your CV. Higher scores mean better matches. To apply, click "Apply Now" and select your CV. Track all applications in "My Applications" with real-time status updates.',
            'recruiter_answer' => 'Post jobs via "Post New Job" with detailed requirements. Our system automatically matches candidates and provides compatibility scores. Review applications in "View Applications" where you can see candidate details, compatibility analysis, and update application statuses.'
        ],
        
        // Account & Platform
        [
            'keywords' => ['account', 'login', 'register', 'platform', 'dashboard', 'profile'],
            'question' => 'How do I manage my account and use the platform?',
            'job_seeker_answer' => 'Create an account by selecting "Job Seeker" during registration. Your dashboard shows application status, job recommendations, and CV management. Update your profile anytime to improve job matching accuracy.',
            'recruiter_answer' => 'Create an account by selecting "Recruiter" during registration. Your dashboard shows posted jobs, candidate applications, and recruitment analytics. Manage your company profile to attract better candidates.'
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

    /**
     * Get chatbot response based on user message
     */
    public function getResponse(Request $request): JsonResponse
    {
        $userMessage = strtolower(trim($request->input('message', '')));
        
        if (empty($userMessage)) {
            return response()->json([
                'response' => 'Please type a message and I\'ll be happy to help you!'
            ]);
        }

        // Detect user role from authentication or URL context
        $userRole = $this->detectUserRole($request);

        // Find matching response
        $response = $this->findBestMatch($userMessage, $userRole);
        
        return response()->json([
            'response' => $response
        ]);
    }

    /**
     * Get predefined questions for quick access
     */
    public function getQuickQuestions(Request $request): JsonResponse
    {
        $userRole = $this->detectUserRole($request);
        
        $quickQuestions = [
            'How does CV processing work?',
            'How does job matching and applications work?',
            'How do I manage my account and use the platform?',
            'Is my data safe and private?'
        ];

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

        // Default to general user
        return 'general';
    }

    /**
     * Find the best matching response for user input
     */
    private function findBestMatch(string $userMessage, string $userRole = 'general'): string
    {
        // First, check if the question is relevant to our platform
        if (!$this->isRelevantQuestion($userMessage)) {
            return $this->getIrrelevantQuestionResponse($userRole);
        }

        $bestMatch = null;
        $highestScore = 0;

        foreach ($this->predefinedQA as $qa) {
            $score = 0;
            
            // Check keyword matches
            foreach ($qa['keywords'] as $keyword) {
                if (strpos($userMessage, $keyword) !== false) {
                    $score += strlen($keyword); // Longer keywords get higher scores
                }
            }
            
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $qa;
            }
        }

        // If no good match found but question seems relevant, return helpful response
        if ($highestScore === 0) {
            return $this->getNoMatchResponse($userRole);
        }

        // Return role-specific answer
        return $this->getRoleSpecificAnswer($bestMatch, $userRole);
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