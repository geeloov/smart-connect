<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get recruiter users to assign job positions to
        $recruiters = User::where('role', 'recruiter')->get();
        
        if ($recruiters->isEmpty()) {
            // Create a default recruiter if none exists
            $recruiters = [User::create([
                'name' => 'Recruiter Demo',
                'email' => 'recruiter@example.com',
                'password' => bcrypt('password'),
                'role' => 'recruiter',
            ])];
        }
        
        // Tech job positions
        $this->createTechJobs($recruiters);
        
        // Business job positions
        $this->createBusinessJobs($recruiters);
        
        // Creative job positions
        $this->createCreativeJobs($recruiters);
        
        // Healthcare job positions
        $this->createHealthcareJobs($recruiters);
    }
    
    private function createTechJobs($recruiters)
    {
        $jobPositions = [
            [
                'title' => 'Senior Software Engineer',
                'company_name' => 'TechInnovate Solutions',
                'location' => 'San Francisco, CA',
                'job_type' => 'Full-time',
                'salary_range' => '$120,000 - $160,000',
                'description' => "We're looking for a Senior Software Engineer to join our growing team at TechInnovate Solutions. You'll be responsible for designing, developing, and implementing software solutions that are scalable, maintainable, and aligned with business goals.

Key Responsibilities:
• Design and develop high-quality software solutions
• Collaborate with cross-functional teams to define, design, and ship new features
• Write clean, maintainable code with comprehensive documentation
• Conduct code reviews and mentor junior engineers
• Troubleshoot, debug and upgrade existing systems
• Stay up-to-date with emerging trends and technologies",
                'requirements' => "• 5+ years of professional software development experience
• Strong proficiency in Java, Python, or C++
• Experience with cloud services (AWS, Azure, or GCP)
• Knowledge of software design patterns and architecture
• Experience with agile development methodologies
• Bachelor's degree in Computer Science or related field (or equivalent experience)
• Excellent problem-solving and communication skills",
                'is_active' => true
            ],
            [
                'title' => 'Frontend Developer',
                'company_name' => 'WebVision Interactive',
                'location' => 'Remote',
                'job_type' => 'Full-time',
                'salary_range' => '$85,000 - $110,000',
                'description' => "WebVision Interactive is seeking a talented Frontend Developer to create stunning user interfaces that captivate and engage our users. You will work closely with designers and backend developers to implement responsive and accessible web applications.

Key Responsibilities:
• Build responsive and interactive user interfaces using modern frontend frameworks
• Implement pixel-perfect UI designs with a focus on usability and accessibility
• Optimize applications for maximum speed and scalability
• Collaborate with UX designers and backend developers
• Write clean, efficient, and well-documented code
• Stay up-to-date with emerging trends and best practices in frontend development",
                'requirements' => "• 3+ years of experience in frontend development
• Expert knowledge of HTML, CSS, and JavaScript
• Proficiency in React, Vue, or Angular
• Experience with responsive design and CSS preprocessors
• Understanding of cross-browser compatibility issues
• Familiarity with RESTful APIs and asynchronous request handling
• Knowledge of version control systems (Git)
• Excellent attention to detail and problem-solving skills",
                'is_active' => true
            ],
            [
                'title' => 'DevOps Engineer',
                'company_name' => 'CloudScale Systems',
                'location' => 'Austin, TX',
                'job_type' => 'Full-time',
                'salary_range' => '$100,000 - $130,000',
                'description' => "CloudScale Systems is looking for a DevOps Engineer to help us build and maintain our infrastructure. You will be responsible for implementing and managing continuous integration/continuous deployment pipelines, automating processes, and ensuring high availability and performance of our systems.

Key Responsibilities:
• Design, implement and maintain CI/CD pipelines
• Automate infrastructure provisioning and configuration
• Manage and optimize cloud resources on AWS
• Implement monitoring, alerting, and logging solutions
• Troubleshoot and resolve infrastructure issues
• Collaborate with development teams to improve deployment processes
• Research and implement new technologies to improve infrastructure reliability and efficiency",
                'requirements' => "• 3+ years of experience in a DevOps or SRE role
• Strong knowledge of Linux/Unix systems
• Experience with infrastructure as code (Terraform, CloudFormation)
• Proficiency with container technologies (Docker, Kubernetes)
• Experience with CI/CD tools (Jenkins, GitLab CI, GitHub Actions)
• Knowledge of scripting languages (Python, Bash)
• AWS certification is a plus
• Strong problem-solving and communication skills",
                'is_active' => true
            ],
            [
                'title' => 'Data Scientist',
                'company_name' => 'DataMind Analytics',
                'location' => 'New York, NY',
                'job_type' => 'Full-time',
                'salary_range' => '$110,000 - $150,000',
                'description' => "DataMind Analytics is seeking a talented Data Scientist to help us extract valuable insights from complex datasets. You will work on challenging problems, develop machine learning models, and communicate findings to stakeholders.

Key Responsibilities:
• Analyze large datasets to identify patterns and trends
• Develop and implement machine learning models
• Create data visualizations and dashboards
• Collaborate with cross-functional teams to solve business problems
• Communicate findings and recommendations to stakeholders
• Stay current with the latest advancements in data science and machine learning",
                'requirements' => "• Master's degree or PhD in Statistics, Computer Science, or related field
• 3+ years of experience in data science or related role
• Strong proficiency in Python or R for data analysis
• Experience with machine learning frameworks (scikit-learn, TensorFlow, PyTorch)
• Knowledge of SQL and database systems
• Experience with data visualization tools
• Strong analytical and problem-solving skills
• Excellent communication and presentation abilities",
                'is_active' => true
            ],
        ];
        
        $this->createJobPositions($jobPositions, $recruiters);
    }
    
    private function createBusinessJobs($recruiters)
    {
        $jobPositions = [
            [
                'title' => 'Marketing Manager',
                'company_name' => 'BrandGrowth Strategies',
                'location' => 'Chicago, IL',
                'job_type' => 'Full-time',
                'salary_range' => '$80,000 - $110,000',
                'description' => "BrandGrowth Strategies is seeking a Marketing Manager to lead our marketing efforts and drive brand awareness and growth. You will develop and implement marketing strategies, oversee campaigns, and analyze their performance to optimize results.

Key Responsibilities:
• Develop and implement comprehensive marketing strategies
• Plan, execute, and measure the performance of marketing campaigns
• Manage social media presence and digital marketing initiatives
• Collaborate with creative teams on content creation
• Analyze market trends and competitor activities
• Manage marketing budget and resources
• Track and report on marketing KPIs",
                'requirements' => "• Bachelor's degree in Marketing, Business, or related field
• 5+ years of marketing experience with at least 2 years in a management role
• Strong understanding of digital marketing channels and best practices
• Experience with marketing automation and CRM software
• Excellent analytical and project management skills
• Creative mindset with strong communication abilities
• Experience with budget management and ROI optimization",
                'is_active' => true
            ],
            [
                'title' => 'Financial Analyst',
                'company_name' => 'Prosperity Financial Group',
                'location' => 'Boston, MA',
                'job_type' => 'Full-time',
                'salary_range' => '$70,000 - $90,000',
                'description' => "Prosperity Financial Group is looking for a detail-oriented Financial Analyst to join our team. You will be responsible for analyzing financial data, preparing reports, and providing insights to support decision-making processes.

Key Responsibilities:
• Perform financial forecasting, reporting, and operational metrics tracking
• Analyze financial data and create financial models
• Prepare monthly, quarterly, and annual financial reports
• Conduct variance analysis and identify trends
• Support budget preparation and management
• Assist with financial audits and compliance
• Research and analyze market trends and competition",
                'requirements' => "• Bachelor's degree in Finance, Accounting, Economics, or related field
• 2+ years of experience in financial analysis or similar role
• Strong proficiency in Excel and financial modeling
• Knowledge of financial reporting and analysis
• Experience with financial software and tools
• Excellent analytical and problem-solving skills
• Attention to detail and ability to work with deadlines
• CFA or pursuing CFA designation is a plus",
                'is_active' => true
            ],
            [
                'title' => 'Human Resources Manager',
                'company_name' => 'PeopleFirst HR Solutions',
                'location' => 'Denver, CO',
                'job_type' => 'Full-time',
                'salary_range' => '$85,000 - $115,000',
                'description' => "PeopleFirst HR Solutions is seeking an experienced Human Resources Manager to oversee our HR functions and initiatives. You will be responsible for developing and implementing HR strategies that support our business objectives and foster a positive work environment.

Key Responsibilities:
• Develop and implement HR policies, procedures, and programs
• Oversee recruitment, onboarding, and employee relations
• Manage performance evaluation processes
• Administer compensation and benefits programs
• Ensure compliance with labor laws and regulations
• Handle employee concerns and conflict resolution
• Develop and implement employee training and development programs
• Foster a positive and inclusive workplace culture",
                'requirements' => "• Bachelor's degree in Human Resources, Business Administration, or related field
• 5+ years of HR experience with at least 2 years in a management role
• SHRM-CP or SHRM-SCP certification preferred
• Knowledge of HR best practices and employment laws
• Experience with HRIS and applicant tracking systems
• Strong interpersonal and conflict resolution skills
• Excellent communication and leadership abilities
• Strategic thinking and problem-solving skills",
                'is_active' => true
            ],
        ];
        
        $this->createJobPositions($jobPositions, $recruiters);
    }
    
    private function createCreativeJobs($recruiters)
    {
        $jobPositions = [
            [
                'title' => 'UX/UI Designer',
                'company_name' => 'Creative Digital Studio',
                'location' => 'Portland, OR',
                'job_type' => 'Full-time',
                'salary_range' => '$75,000 - $95,000',
                'description' => "Creative Digital Studio is looking for a talented UX/UI Designer to create exceptional user experiences. You will work on designing intuitive interfaces for web and mobile applications, conducting user research, and collaborating with development teams.

Key Responsibilities:
• Create wireframes, prototypes, and high-fidelity mockups
• Conduct user research and usability testing
• Develop user personas and journey maps
• Design responsive interfaces for web and mobile applications
• Create and maintain design systems and style guides
• Collaborate with cross-functional teams
• Stay current with UX/UI trends and best practices",
                'requirements' => "• Bachelor's degree in Design, HCI, or related field
• 3+ years of experience in UX/UI design
• Strong portfolio demonstrating your design process and skills
• Proficiency in design tools (Figma, Sketch, Adobe XD)
• Knowledge of information architecture and interaction design principles
• Understanding of accessibility standards and responsive design
• Basic knowledge of HTML, CSS, and JavaScript is a plus
• Excellent communication and collaboration skills",
                'is_active' => true
            ],
            [
                'title' => 'Content Marketing Specialist',
                'company_name' => 'StoryBrand Media',
                'location' => 'Remote',
                'job_type' => 'Full-time',
                'salary_range' => '$60,000 - $80,000',
                'description' => "StoryBrand Media is seeking a creative Content Marketing Specialist to develop engaging content that resonates with our target audience. You will create various types of content, implement content strategies, and analyze their performance.

Key Responsibilities:
• Create compelling content for various channels (blog, social media, email)
• Develop and implement content marketing strategies
• Manage content calendar and ensure timely publication
• Optimize content for SEO and user engagement
• Collaborate with design and marketing teams
• Analyze content performance and make data-driven recommendations
• Stay up-to-date with content marketing trends and best practices",
                'requirements' => "• Bachelor's degree in Marketing, Communications, Journalism, or related field
• 2+ years of experience in content marketing or content creation
• Excellent writing and editing skills
• Knowledge of SEO principles and best practices
• Experience with content management systems
• Familiarity with social media platforms and analytics tools
• Creative thinking and storytelling abilities
• Strong organizational and time management skills",
                'is_active' => true
            ],
            [
                'title' => 'Video Editor',
                'company_name' => 'VisualStory Productions',
                'location' => 'Los Angeles, CA',
                'job_type' => 'Contract',
                'salary_range' => '$35 - $50 per hour',
                'description' => "VisualStory Productions is looking for a talented Video Editor to join our creative team. You will be responsible for editing and assembling recorded footage into a finished product that matches the client's vision and is suitable for broadcasting or digital distribution.

Key Responsibilities:
• Edit video footage according to scripts and project requirements
• Create rough and final cuts
• Add effects, graphics, music, sound effects, and voice-over
• Color correction and audio mixing
• Collaborate with directors and production team
• Ensure technical quality of final videos
• Archive and manage video assets",
                'requirements' => "• Bachelor's degree in Film, Media Production, or related field (or equivalent experience)
• 3+ years of professional video editing experience
• Proficiency in Adobe Premiere Pro and After Effects
• Experience with color grading and audio mixing
• Knowledge of video production workflow
• Strong storytelling and creative skills
• Attention to detail and ability to work under tight deadlines
• Portfolio demonstrating your video editing skills",
                'is_active' => true
            ],
        ];
        
        $this->createJobPositions($jobPositions, $recruiters);
    }
    
    private function createHealthcareJobs($recruiters)
    {
        $jobPositions = [
            [
                'title' => 'Registered Nurse',
                'company_name' => 'Wellness Medical Center',
                'location' => 'Seattle, WA',
                'job_type' => 'Full-time',
                'salary_range' => '$75,000 - $95,000',
                'description' => "Wellness Medical Center is seeking a compassionate and skilled Registered Nurse to join our team. You will provide direct patient care, coordinate with healthcare teams, and ensure the highest quality of care for our patients.

Key Responsibilities:
• Assess patient health problems and needs
• Develop and implement nursing care plans
• Administer medications and treatments
• Monitor and record patient vital signs
• Coordinate with interdisciplinary healthcare teams
• Educate patients and families on health management
• Maintain accurate and detailed medical records
• Ensure compliance with healthcare regulations and standards",
                'requirements' => "• Associate's or Bachelor's degree in Nursing
• Current state RN license
• BLS certification (ACLS preferred)
• 2+ years of clinical nursing experience
• Strong clinical and assessment skills
• Knowledge of medical equipment and procedures
• Excellent communication and interpersonal skills
• Compassionate patient care approach
• Physical ability to stand for extended periods and lift up to 50 lbs",
                'is_active' => true
            ],
            [
                'title' => 'Physical Therapist',
                'company_name' => 'RehabCare Solutions',
                'location' => 'Phoenix, AZ',
                'job_type' => 'Full-time',
                'salary_range' => '$80,000 - $100,000',
                'description' => "RehabCare Solutions is looking for a dedicated Physical Therapist to provide therapeutic services to patients. You will evaluate, plan, and administer treatment programs to help patients improve mobility, relieve pain, and prevent or limit permanent physical disabilities.

Key Responsibilities:
• Evaluate patients' conditions and develop treatment plans
• Administer manual therapy, therapeutic exercises, and other treatments
• Track patients' progress and adjust treatment plans as needed
• Educate patients and their families about the recovery process
• Collaborate with other healthcare professionals
• Maintain detailed patient records
• Ensure compliance with therapy regulations and standards",
                'requirements' => "• Doctor of Physical Therapy (DPT) degree
• Current state physical therapy license
• 2+ years of clinical experience preferred
• Knowledge of evidence-based physical therapy practices
• Experience with electronic medical records systems
• Strong manual therapy skills
• Excellent communication and interpersonal abilities
• Compassionate approach to patient care
• Physical stamina to assist patients with exercises and mobility",
                'is_active' => true
            ],
            [
                'title' => 'Healthcare Administrator',
                'company_name' => 'Integrated Health Systems',
                'location' => 'Nashville, TN',
                'job_type' => 'Full-time',
                'salary_range' => '$90,000 - $120,000',
                'description' => "Integrated Health Systems is seeking an experienced Healthcare Administrator to oversee our facility operations. You will be responsible for managing staff, budgets, and programs while ensuring compliance with healthcare regulations and delivering high-quality patient care.

Key Responsibilities:
• Oversee daily operations of the healthcare facility
• Develop and implement policies and procedures
• Manage departmental budgets and financial resources
• Recruit, train, and supervise staff
• Ensure compliance with healthcare laws and regulations
• Coordinate with medical staff and department heads
• Analyze and improve operational efficiency
• Maintain facility records and prepare reports",
                'requirements' => "• Master's degree in Healthcare Administration, Business Administration, or related field
• 5+ years of experience in healthcare management
• Knowledge of healthcare laws, regulations, and accreditation standards
• Experience with healthcare information systems
• Strong leadership and staff management skills
• Excellent financial and analytical abilities
• Outstanding communication and interpersonal skills
• Problem-solving aptitude and decision-making capabilities",
                'is_active' => true
            ],
        ];
        
        $this->createJobPositions($jobPositions, $recruiters);
    }
    
    private function createJobPositions($jobPositions, $recruiters)
    {
        foreach ($jobPositions as $position) {
            // Randomly select a recruiter for each job position
            $recruiter = $recruiters[array_rand($recruiters instanceof \Illuminate\Database\Eloquent\Collection ? $recruiters->toArray() : $recruiters)];
            
            // Create the job position
            JobPosition::create(array_merge(
                $position,
                ['user_id' => $recruiter->id]
            ));
        }
    }
}
