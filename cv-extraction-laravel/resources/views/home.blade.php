@extends('layouts.app')

@section('content')
<style>
.aspect-w-16 {
  position: relative;
  padding-bottom: calc(var(--tw-aspect-h) / var(--tw-aspect-w) * 100%);
  --tw-aspect-w: 16;
}
.aspect-h-12 {
  --tw-aspect-h: 12;
}
.aspect-w-16 > * {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}
</style>

<div class="bg-[#F3F3F3] min-h-screen">
    <!-- Hero Section -->
    <section class="py-16 md:py-24 relative overflow-hidden">
        <!-- Background Circles -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-[#B9FF66]/10 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-[#B9FF66]/10 rounded-full translate-x-1/3 translate-y-1/3 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <div class="mb-6">
                        <div class="inline-block bg-[#B9FF66] rounded-[10px] px-5 py-3 shadow-md transform transition-all duration-300 hover:scale-[1.02]" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#191A23] leading-tight">
                                Transform CV <br class="hidden sm:block">analysis with AI
                            </h2>
                        </div>
                    </div>
                    <p class="text-[#191A23] text-lg md:text-xl mb-8 max-w-xl leading-relaxed">
                        Our AI-powered CV extraction tool helps recruiters and job seekers analyze resumes efficiently, 
                        extract structured data, and match candidates to job descriptions with precision.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('cv-extraction.index') }}" class="inline-flex items-center justify-center bg-[#B9FF66] text-[#191A23] font-semibold py-4 px-6 rounded-xl border-2 border-[#191A23] hover:bg-[#a7e85c] transition-all duration-200 text-center transform hover:-translate-y-1" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <span>Try CV Extraction Tool</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center bg-white text-[#191A23] font-semibold py-4 px-6 rounded-xl border-2 border-[#191A23] hover:bg-gray-50 transition-all duration-200 text-center transform hover:-translate-y-1" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <span>Learn More</span>
                            <svg width="20" height="20" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="ml-2 flex-shrink-0">
                                <circle cx="20.5" cy="20.5" r="20.5" fill="#191A23"></circle>
                                <path d="M11.25 24.701C10.5326 25.1152 10.2867 26.0326 10.701 26.75C11.1152 27.4674 12.0326 27.7133 12.75 27.299L11.25 24.701ZM30.7694 16.3882C30.9838 15.588 30.5089 14.7655 29.7087 14.5511L16.6687 11.0571C15.8685 10.8426 15.046 11.3175 14.8316 12.1177C14.6172 12.9179 15.0921 13.7404 15.8923 13.9548L27.4834 17.0607L24.3776 28.6518C24.1631 29.452 24.638 30.2745 25.4382 30.4889C26.2384 30.7033 27.0609 30.2284 27.2753 29.4282L30.7694 16.3882ZM12.75 27.299L30.0705 17.299L28.5705 14.701L11.25 24.701L12.75 27.299Z" fill="#B9FF66"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="order-1 md:order-2 relative">
                    <div class="absolute -z-10 w-72 h-72 bg-[#B9FF66] rounded-full blur-3xl opacity-30 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="relative border-2 border-[#191A23] rounded-2xl overflow-hidden p-6 bg-white transform transition-all duration-300 hover:-translate-y-2" style="box-shadow: 0px 8px 0px 0 #191a23;">
                        <div class="aspect-w-16 aspect-h-12">
                            <img src="{{ asset('images/svg/cv-extraction-illustration.svg') }}" alt="CV Extraction Illustration" class="w-full max-w-lg mx-auto">
                        </div>
                        <div class="absolute top-0 right-0 bg-[#B9FF66] border-l-2 border-b-2 border-[#191A23] rounded-bl-lg px-4 py-2">
                            <span class="text-sm font-bold text-[#191A23]">AI Powered</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted By Section -->
    <section class="py-12 bg-white border-y border-[#191A23] overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-center text-lg font-medium text-[#191A23] mb-8">Trusted by professionals from</h3>
            
            <style>
                @keyframes slide-left {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                
                .animate-slide-left {
                    animation: slide-left 25s linear infinite;
                }
                
                .group:hover .group-hover\:animation-pause {
                    animation-play-state: paused;
                }
            </style>
            
            <div class="relative group overflow-hidden whitespace-nowrap py-8 [mask-image:_linear-gradient(to_right,_transparent_0,_white_100px,white_calc(100%-100px),_transparent_100%)]">
                <div class="animate-slide-left group-hover:animation-pause inline-block w-max">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                </div>
                
                <!-- Duplicate for seamless looping -->
                <div class="animate-slide-left group-hover:animation-pause inline-block w-max">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="{{ asset('images/svg/example-logo-trusted.svg') }}" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-12">
                <div class="inline-block px-3 py-2 rounded-[10px] bg-[#B9FF66] mb-2">
                    <h2 class="text-3xl font-medium text-[#191A23]">Features</h2>
                </div>
                <p class="text-[#191A23] max-w-2xl">
                    Our CV extraction tool uses AI to analyze and extract structured data from resumes, 
                    making the recruitment process more efficient and effective.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <h3 class="text-xl font-medium text-[#191A23]">Data Extraction</h3>
                            </div>
                            <p class="text-[#191A23]">
                                Extract personal details, education, work experience, skills, and more from any PDF resume with high accuracy.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center">
                            <img src="{{ asset('images/svg/data-extraction-ilustration.svg') }}" alt="Data Extraction" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <svg width="30" height="30" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                            <circle cx="20.5" cy="20.5" r="20.5" fill="#191A23"></circle>
                            <path d="M11.25 24.701C10.5326 25.1152 10.2867 26.0326 10.701 26.75C11.1152 27.4674 12.0326 27.7133 12.75 27.299L11.25 24.701ZM30.7694 16.3882C30.9838 15.588 30.5089 14.7655 29.7087 14.5511L16.6687 11.0571C15.8685 10.8426 15.046 11.3175 14.8316 12.1177C14.6172 12.9179 15.0921 13.7404 15.8923 13.9548L27.4834 17.0607L24.3776 28.6518C24.1631 29.452 24.638 30.2745 25.4382 30.4889C26.2384 30.7033 27.0609 30.2284 27.2753 29.4282L30.7694 16.3882ZM12.75 27.299L30.0705 17.299L28.5705 14.701L11.25 24.701L12.75 27.299Z" fill="#B9FF66"></path>
                        </svg>
                        <span class="font-medium text-[#191A23]">Learn more</span>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <h3 class="text-xl font-medium text-[#191A23]">AI Analysis</h3>
                            </div>
                            <p class="text-[#191A23]">
                                Advanced AI algorithms that understand context and extract meaningful information from complex CV formats.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center">
                            <img src="{{ asset('images/svg/ai-analysis-ilustration.svg') }}" alt="AI Analysis" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <svg width="30" height="30" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                            <circle cx="20.5" cy="20.5" r="20.5" fill="#191A23"></circle>
                            <path d="M11.25 24.701C10.5326 25.1152 10.2867 26.0326 10.701 26.75C11.1152 27.4674 12.0326 27.7133 12.75 27.299L11.25 24.701ZM30.7694 16.3882C30.9838 15.588 30.5089 14.7655 29.7087 14.5511L16.6687 11.0571C15.8685 10.8426 15.046 11.3175 14.8316 12.1177C14.6172 12.9179 15.0921 13.7404 15.8923 13.9548L27.4834 17.0607L24.3776 28.6518C24.1631 29.452 24.638 30.2745 25.4382 30.4889C26.2384 30.7033 27.0609 30.2284 27.2753 29.4282L30.7694 16.3882ZM12.75 27.299L30.0705 17.299L28.5705 14.701L11.25 24.701L12.75 27.299Z" fill="#B9FF66"></path>
                        </svg>
                        <span class="font-medium text-[#191A23]">Learn more</span>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <h3 class="text-xl font-medium text-[#191A23]">Job Matching</h3>
                            </div>
                            <p class="text-[#191A23]">
                                Match candidate resumes to job descriptions automatically, with scoring and detailed analysis.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center">
                            <img src="{{ asset('images/svg/job-matching-ilustration.svg') }}" alt="Job Matching" class="w-16 h-16 object-contain">
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <svg width="30" height="30" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                            <circle cx="20.5" cy="20.5" r="20.5" fill="#191A23"></circle>
                            <path d="M11.25 24.701C10.5326 25.1152 10.2867 26.0326 10.701 26.75C11.1152 27.4674 12.0326 27.7133 12.75 27.299L11.25 24.701ZM30.7694 16.3882C30.9838 15.588 30.5089 14.7655 29.7087 14.5511L16.6687 11.0571C15.8685 10.8426 15.046 11.3175 14.8316 12.1177C14.6172 12.9179 15.0921 13.7404 15.8923 13.9548L27.4834 17.0607L24.3776 28.6518C24.1631 29.452 24.638 30.2745 25.4382 30.4889C26.2384 30.7033 27.0609 30.2284 27.2753 29.4282L30.7694 16.3882ZM12.75 27.299L30.0705 17.299L28.5705 14.701L11.25 24.701L12.75 27.299Z" fill="#B9FF66"></path>
                        </svg>
                        <span class="font-medium text-[#191A23]">Learn more</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-16 md:py-24 bg-white border-y border-[#191A23]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-12">
                <div class="inline-block px-3 py-2 rounded-[10px] bg-[#B9FF66] mb-2">
                    <h2 class="text-3xl font-medium text-[#191A23]">How It Works</h2>
                </div>
                <p class="text-[#191A23]">
                    Extract structured data from resumes in just three simple steps
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step Card 1 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between items-start">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <span class="text-xl font-medium text-[#191A23]">Step 1</span>
                            </div>
                            <h3 class="text-xl font-medium text-[#191A23] mb-2">Upload CV</h3>
                            <p class="text-[#191A23]">
                                Upload a PDF resume and optionally include a job description for matching.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-[#191A23] rounded-full flex items-center justify-center text-[#B9FF66] font-bold text-xl">
                            1
                        </div>
                    </div>
                </div>

                <!-- Step Card 2 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between items-start">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <span class="text-xl font-medium text-[#191A23]">Step 2</span>
                            </div>
                            <h3 class="text-xl font-medium text-[#191A23] mb-2">AI Processing</h3>
                            <p class="text-[#191A23]">
                                Our AI analyzes the document, extracts key information, and structures the data.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-[#191A23] rounded-full flex items-center justify-center text-[#B9FF66] font-bold text-xl">
                            2
                        </div>
                    </div>
                </div>

                <!-- Step Card 3 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex justify-between items-start">
                        <div class="mb-6">
                            <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66] mb-4">
                                <span class="text-xl font-medium text-[#191A23]">Step 3</span>
                            </div>
                            <h3 class="text-xl font-medium text-[#191A23] mb-2">View Results</h3>
                            <p class="text-[#191A23]">
                                Review extracted data in a structured format with job matching analysis if applicable.
                            </p>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-[#191A23] rounded-full flex items-center justify-center text-[#B9FF66] font-bold text-xl">
                            3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section id="use-cases" class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="mb-12">
                <div class="inline-block px-3 py-2 rounded-[10px] bg-[#B9FF66] mb-2">
                    <h2 class="text-3xl font-medium text-[#191A23]">Use Cases</h2>
                </div>
                <p class="text-[#191A23]">
                    Our CV extraction tool is designed to help various professionals streamline their recruitment processes
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Use Case 1 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex items-start justify-between mb-6">
                        <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66]">
                            <h3 class="text-xl font-medium text-[#191A23]">Recruiters & HR Teams</h3>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-[#191A23] rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Process high volumes of applications quickly</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Match candidates to job requirements automatically</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Create standardized candidate profiles</span>
                        </li>
                    </ul>
                </div>

                <!-- Use Case 2 -->
                <div class="bg-[#F3F3F3] p-8 rounded-[25px] border border-[#191A23] relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="flex items-start justify-between mb-6">
                        <div class="inline-block px-3 py-1 rounded-[7px] bg-[#B9FF66]">
                            <h3 class="text-xl font-medium text-[#191A23]">Job Seekers</h3>
                        </div>
                        <div class="flex-shrink-0 w-12 h-12 bg-[#191A23] rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Analyze resume compatibility with job postings</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Identify missing skills and qualifications</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[#191A23]">Get insights on how to improve resume effectiveness</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-24 bg-white border-y border-[#191A23] relative overflow-hidden">
        <!-- Background Circles -->
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#B9FF66]/10 rounded-full translate-x-[-30%] translate-y-[30%] pointer-events-none"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#B9FF66]/10 rounded-full translate-x-[30%] translate-y-[-30%] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto">
                <div class="bg-[#F3F3F3] p-8 md:p-12 rounded-[30px] border-2 border-[#191A23] text-center transform transition-all duration-300 hover:-translate-y-1" style="box-shadow: 0px 8px 0px 0 #191a23;">
                    <div class="inline-block px-5 py-3 rounded-[10px] bg-[#B9FF66] mb-6 transform transition-all duration-300 hover:scale-[1.02] shadow-md" style="box-shadow: 0px 4px 0px 0 #191a23;">
                        <h2 class="text-3xl md:text-4xl font-bold text-[#191A23]">Ready to Transform?</h2>
                    </div>
                    <p class="text-[#191A23] mb-8 text-lg md:text-xl max-w-xl mx-auto">
                        Try our AI-powered CV extraction tool now and experience the difference
                    </p>
                    <a href="{{ route('cv-extraction.index') }}" class="inline-flex items-center justify-center bg-[#B9FF66] text-[#191A23] font-semibold py-4 px-8 rounded-xl border-2 border-[#191A23] hover:bg-[#a7e85c] transition-all duration-200 text-center transform hover:-translate-y-1" style="box-shadow: 0px 4px 0px 0 #191a23;">
                        <span>Get Started Now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection 