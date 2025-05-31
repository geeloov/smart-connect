@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(isset($jobPosition))
            <!-- Header Section -->
            <div class="relative mb-12">
                {{-- <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-2xl"></div> --}}
                <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
                    <!-- Header Background Pattern -->
                    <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                        <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#B9FF66]/20">
                            <circle cx="150" cy="150" r="150" fill="currentColor"/>
                            <circle cx="150" cy="150" r="120" fill="white"/>
                            <circle cx="150" cy="150" r="100" fill="currentColor"/>
                            <circle cx="150" cy="150" r="80" fill="white"/>
                            <circle cx="150" cy="150" r="60" fill="currentColor"/>
                        </svg>
                </div>
                
                    <!-- Job Position Details -->
                    <div class="flex flex-col md:flex-row md:items-start gap-8">
                        <div class="flex-shrink-0">
                            <div class="p-4 bg-[#B9FF66] rounded-xl shadow-md w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                </div>
        </div>
                        
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                                        Job Application
                                    </span>
                                    <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">{{ $jobPosition->title }}</h1>
                                    <div class="mt-2 flex items-center text-[#191A23]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="text-lg font-medium">{{ $jobPosition->company_name }}</span>
        </div>
</div>

                                <div class="inline-flex flex-wrap gap-2 mt-4 md:mt-0">
                                    <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                                        <span>{{ $jobPosition->location }}</span>
            </div>
            
                                    <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                                        <span>{{ $jobPosition->job_type }}</span>
                    </div>
                                    
                                    @if($jobPosition->salary_range)
                                    <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                        <span>{{ $jobPosition->salary_range }}</span>
                            </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Application Process Steps -->
                            <div class="mt-8">
                                <div class="flex items-center gap-2 mb-3 text-[#191A23]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                    <h3 class="font-semibold">Application Process</h3>
                                    </div>
                                
                                <div class="relative">
                                    <div class="absolute left-5 inset-y-0 w-0.5 bg-[#191A23]/50"></div>
                                    <ul class="space-y-6 relative z-10">
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#191A23] flex items-center justify-center shadow-md mr-4 border border-[#B9FF66]/50">
                                                <span class="text-[#B9FF66] font-medium">1</span>
                                            </div>
                                            <div class="flex-1 pt-1.5">
                                                <h4 class="font-medium text-[#191A23]">{{--Submit Application--}}Upload Your Documents</h4>
                                                <p class="text-sm text-[#191A23]/80 mt-1">Upload your CV and cover letter to apply for this position</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#191A23] flex items-center justify-center shadow-md mr-4 border border-[#B9FF66]/50">
                                                <span class="text-[#B9FF66] font-medium">2</span>
                                            </div>
                                            <div class="flex-1 pt-1.5">
                                                <h4 class="font-medium text-[#191A23]">CV Analysis</h4>
                                                <p class="text-sm text-[#191A23]/80 mt-1">We'll analyze your CV to match it against job requirements</p>
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-[#191A23] flex items-center justify-center shadow-md mr-4 border border-[#B9FF66]/50">
                                                <span class="text-[#B9FF66] font-medium">3</span>
                                            </div>
                                            <div class="flex-1 pt-1.5">
                                                <h4 class="font-medium text-[#191A23]">Recruiter Review</h4>
                                                <p class="text-sm text-[#191A23]/80 mt-1">A recruiter will review your application and compatibility score</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
                                
            <!-- Alert Messages -->
            @if(session('error'))
                <div class="rounded-lg bg-red-50 p-4 border border-red-200 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-lg bg-red-50 p-4 border border-red-200 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">Please correct the following errors:</p>
                            <ul class="mt-2 list-disc pl-5 space-y-1 text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                                </div>
                                @endif
                                
            @if(!isset($compatibilityHistory))
                @php
                    // Initialize empty collection if it doesn't exist
                    $compatibilityHistory = collect([]);
                    $historyStats = [
                        'average_score' => 0,
                        'highest_score' => 0,
                        'lowest_score' => 0,
                        'total_comparisons' => 0,
                        'recent_trend' => 'stable'
                    ];
                @endphp
            @endif
            
            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Job Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Job Description Card -->
                    <div class="bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <div class="border-b border-[#191A23]/30 px-6 py-4 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Job Description
                            </h2>
                            <span class="text-sm font-semibold text-[#191A23] rounded-lg bg-[#B9FF66]/50 px-3 py-1 border border-[#191A23]/50">
                                Details
                            </span>
                        </div>
                        <div class="px-6 py-5">
                            <div id="job-description-content" class="prose prose-sm max-w-none relative overflow-hidden transition-all duration-300 text-[#191A23]" style="max-height: 200px;">
                                <p class="whitespace-pre-line">{{ $jobPosition->description }}</p>
                                <!-- Gradient overlay for collapsed state -->
                                <div id="description-fade" class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white to-transparent"></div>
                            </div>
                            <button id="toggle-description" class="mt-3 flex items-center justify-center text-sm font-medium text-[#191A23] hover:text-[#191A23]/80 transition focus:outline-none">
                                <span id="read-more-text">Read more</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Requirements Card -->
                                @if($jobPosition->requirements)
                    <div class="bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <div class="border-b border-[#191A23]/30 px-6 py-4 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Requirements
                            </h2>
                            <span class="text-sm font-semibold text-[#191A23] rounded-lg bg-[#B9FF66]/50 px-3 py-1 border border-[#191A23]/50">
                                Qualifications
                            </span>
                                    </div>
                        <div class="px-6 py-5">
                            <div id="requirements-content" class="prose prose-sm max-w-none relative overflow-hidden transition-all duration-300 text-[#191A23]" style="max-height: 200px;">
                                <p class="whitespace-pre-line">{{ $jobPosition->requirements }}</p>
                                <!-- Gradient overlay for collapsed state -->
                                <div id="requirements-fade" class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white to-transparent"></div>
                            </div>
                            <button id="toggle-requirements" class="mt-3 flex items-center justify-center text-sm font-medium text-[#191A23] hover:text-[#191A23]/80 transition focus:outline-none">
                                <span id="requirements-read-more-text">Read more</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            </div>
                        </div>
                    @endif
                    </div>
                    
                <!-- Right Column: Application Tips -->
                <div>
                    <div class="bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden sticky top-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <div class="border-b border-[#191A23]/30 bg-[#191A23] px-6 py-4">
                            <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                Application Tips
                                </h2>
                            </div>
                        <div class="p-6">
                            <div class="rounded-lg bg-[#B9FF66]/20 border border-[#191A23]/30 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-[#191A23] font-medium">Important Details</p>
                                        <p class="mt-1 text-sm text-[#191A23]/90">
                                            Make sure to include relevant skills and experiences in your application. The compatibility check will help you evaluate your match for this position.
                                        </p>
                                    </div>
                                </div>
                                </div>
                                
                            <h3 class="font-medium text-[#191A23] mb-3">For Better Results:</h3>
                            <ul class="space-y-4">
                                <li class="flex">
                                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#B9FF66]/40 flex items-center justify-center mr-3 mt-0.5 border border-[#191A23]/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[#191A23] font-medium">Use PDF format</span>
                                        <p class="text-[#191A23]/80 text-sm">Only PDF files (max 10MB) are accepted</p>
                                    </div>
                                    </li>
                                <li class="flex">
                                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#B9FF66]/40 flex items-center justify-center mr-3 mt-0.5 border border-[#191A23]/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[#191A23] font-medium">Highlight relevant skills</span>
                                        <p class="text-[#191A23]/80 text-sm">Match your experience to job requirements</p>
                                    </div>
                                    </li>
                                <li class="flex">
                                    <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#B9FF66]/40 flex items-center justify-center mr-3 mt-0.5 border border-[#191A23]/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[#191A23] font-medium">Include a cover letter</span>
                                        <p class="text-[#191A23]/80 text-sm">Explain why you're perfect for this role</p>
                                    </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Application Form Section -->
            <div class="mt-10">
                <form id="application-form" method="POST" action="{{ route('job-seeker.applications.store', $jobPosition) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="job_position_id" value="{{ $jobPosition->id }}">
                    <div class="space-y-8">
                        <!-- Application Form Card -->
                        <div class="bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                            <div class="border-b border-[#191A23]/30 bg-[#191A23] px-6 py-4">
                                <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                                    Check Your Compatibility
                        </h2>
                    </div>
                            
                    <div class="p-6">
                                <!-- CV Selection Section -->
                                <div class="mb-8">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-base font-medium text-[#191A23] flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Your Default CV
                                        </h3>
                                        <span class="text-sm font-semibold text-[#191A23] bg-[#B9FF66]/50 rounded-lg px-3 py-1 border border-[#191A23]/50">Will be used for compatibility check</span>
                                </div>
                                
                                    <div class="bg-white rounded-lg border border-[#191A23]/50 p-5">
                                        @if(isset($defaultCV))
                                        <div class="mb-5">
                                            <input id="use_default_cv" name="use_default_cv" type="hidden" value="1">
                                            <!-- This is a debugging field and not required by controller -->
                                            <input id="default_cv_id_debug" name="default_cv_id_debug" type="hidden" value="{{ $defaultCV->id }}">
                                            <div class="rounded-lg border border-[#191A23]/30 bg-white p-3 flex items-center">
                                                <div class="p-2 bg-[#B9FF66]/30 rounded-lg mr-3">
                                                    <svg class="h-5 w-5 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                                <div>
                                                    <span class="font-medium text-[#191A23]">{{ $defaultCV->file_name }}</span>
                                                    <p class="text-xs text-[#191A23]/70 mt-0.5">Your default CV will be used for compatibility check</p>
                            </div>
                                                <a href="{{ asset('storage/job_seeker_cvs/' . $defaultCV->file_name) }}" target="_blank" class="ml-auto p-2 text-[#191A23] hover:text-[#B9FF66] transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                </div>
                            </div>
                            @else
                                        <div class="rounded-lg border border-yellow-400 bg-yellow-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm text-yellow-800">
                                                        You don't have a default CV set up. Please 
                                                        {{-- <a href="{{ route('job-seeker.cvs.index') }}" class="font-medium underline text-yellow-900 hover:text-yellow-700">set a default CV in your profile</a> --}}
                                                        set a default CV in your profile before checking compatibility.
                                    </p>
                                </div>
                                            </div>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                <!-- Store job position data for compatibility check -->
                                <input type="hidden" name="job_position_id" value="{{ $jobPosition->id }}">
                                
                                    @if(isset($defaultCV))
                                    <div id="default_cv_display" data-cv-id="{{ $defaultCV->id }}" class="hidden">
                                        {{ $defaultCV->file_name }}
                                    </div>
                                <div id="default_cv_path" data-cv-path="{{ asset('storage/job_seeker_cvs/' . $defaultCV->file_name) }}" class="hidden"></div>
                                    @endif

                                <!-- Store job position details as JSON data -->
                                <script>
                                    // Store job position data for direct access
                                    const jobPositionData = {
                                        id: {{ $jobPosition->id }},
                                        title: "{{ addslashes($jobPosition->title) }}",
                                        description: `{{ addslashes($jobPosition->description) }}`,
                                        requirements: `{{ addslashes($jobPosition->requirements ?? '') }}`,
                                        company_name: "{{ addslashes($jobPosition->company_name) }}"
                                    };
                                </script>
                                
                                <!-- Check if this CV and job combination has already been analyzed -->
                                @php
                                    $existingAnalysis = null;
                                    if(isset($defaultCV) && auth()->check()) {
                                        $existingAnalysis = DB::table('cv_job_compatibility')
                                            ->where('cv_id', $defaultCV->id)
                                            ->where('job_position_id', $jobPosition->id)
                                            ->where('user_id', auth()->id())
                                            ->first();
                                    }
                                @endphp

                                @if($existingAnalysis)
                                <div id="already_analyzed" data-analysis="{{ json_encode($existingAnalysis) }}" class="hidden"></div>
                                @endif
                                
                                <!-- Submit Button -->
                                <div class="mt-8 flex flex-col sm:flex-row sm:justify-center gap-4">
                                    <button type="button" id="checkCompatibilityBtn" 
                                        class="inline-flex items-center justify-center py-3 px-6 rounded-xl border-2 border-[#191A23] bg-[#B9FF66] text-[#191A23] font-semibold hover:bg-[#a7e85c] transition-all duration-200 text-center transform hover:-translate-y-1"
                                        style="box-shadow: 0px 4px 0px 0 #191a23;"
                                        {{ !isset($defaultCV) ? 'disabled' : '' }}
                                        {{ isset($existingAnalysis) ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        {{ isset($existingAnalysis) ? 'Already Analyzed' : 'Check Compatibility' }}
                                        </button>
                                </div>
                                        
                                <div id="compatibility-loading" class="hidden mt-5">
                                    <div class="bg-white border border-[#191A23]/30 rounded-lg p-4">
                                            <div class="flex items-center space-x-3">
                                            <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-[#B9FF66]"></div>
                                            <span class="text-sm text-[#191A23]">Analyzing your CV for compatibility...</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <!-- Terms acceptance text -->
                                <p class="mt-4 text-sm text-[#191A23]/70 text-center">
                                    By checking compatibility, you agree to our 
                                    <a href="#" class="text-[#191A23] hover:text-[#B9FF66] underline">Terms of Service</a> and 
                                    <a href="#" class="text-[#191A23] hover:text-[#B9FF66] underline">Privacy Policy</a>.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Compatibility Results Box -->
                        <div id="compatibility-results" class="hidden"></div>
                    </div>
                    
                    <!-- Cover Letter Section -->
                    <div class="mt-8 bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <div class="border-b border-[#191A23]/30 bg-[#191A23] px-6 py-4">
                            <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Cover Letter
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="cover_letter" class="block text-sm font-medium text-[#191A23] mb-2">Write a personalized message to the employer</label>
                                <textarea id="cover_letter" name="cover_letter" rows="6" class="shadow-sm block w-full focus:ring-[#B9FF66] focus:border-[#B9FF66] sm:text-sm border border-[#191A23]/50 rounded-md p-3 text-[#191A23] placeholder-[#191A23]/60 bg-white focus:bg-white transition-all" placeholder="Explain why you're a great fit for this position...">{{ old('cover_letter') }}</textarea>
                            </div>
                            <p class="text-sm text-[#191A23]/80">
                                A good cover letter can significantly increase your chances of getting an interview. Keep it concise and focused on how your skills and experience align with the job requirements.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Final Submit Button -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit" 
                            class="inline-flex items-center justify-center py-3 px-8 rounded-xl border-2 border-[#191A23] bg-[#B9FF66] text-[#191A23] font-semibold hover:bg-[#a7e85c] transition-all duration-200 text-center transform hover:-translate-y-1 shadow-lg"
                            style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-red-200 overflow-hidden">
                <div class="bg-red-50 border-b border-red-200 px-6 py-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-100 rounded-full p-3">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="ml-4 text-xl font-bold text-red-900">Job Position Not Found</h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="mb-6 text-gray-700">The job position you're trying to apply for doesn't exist or you don't have permission to view it.</p>
                    <a href="javascript:history.back()" class="inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Job Listings
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Compatibility Results Template -->
<script type="text/template" id="compatibility-results-template">
    <div class="bg-white rounded-xl shadow-md border border-[#191A23] overflow-hidden animate-fadeIn" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="border-b border-[#191A23]/30 bg-[#191A23] px-6 py-4">
            <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Compatibility Analysis
            </h2>
        </div>
                                            
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Score Card -->
                <div class="bg-white rounded-xl shadow-md border border-[#191A23] p-5 flex flex-col items-center" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <div id="compatibility-score-circle" class="relative flex items-center justify-center">
                        <svg class="w-32 h-32" viewBox="0 0 36 36">
                            <path class="score-bg"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#191A2320" // Lighter version of #191A23 for background
                                stroke-width="3"
                                stroke-dasharray="100, 100"
                            />
                            <path class="score-value"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none"
                                stroke="#B9FF66" // Default to lime green
                                stroke-width="3"
                                stroke-dasharray="0, 100"
                                id="score-path"
                            />
                        </svg>
                        <div class="absolute text-center">
                            <div class="text-4xl font-bold text-[#191A23]" id="compatibility-score-value">-</div>
                            <div class="text-sm font-medium text-[#191A23]/70">/ 100</div>
                        </div>
                    </div>
                    <h4 class="text-xl font-medium text-[#191A23] mt-3 mb-1">Match Score</h4>
                    <p id="score-description" class="text-center text-sm text-[#191A23]/80">No analysis yet</p>
                    <div id="from-cache-indicator" class="hidden mt-3 text-xs bg-[#B9FF66]/30 text-[#191A23] px-3 py-1 rounded-full border border-[#191A23]/30">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Saved Result
                        </span>
                    </div>
                </div>
                                                    
                <!-- Analysis Card -->
                <div class="md:col-span-2 bg-white rounded-xl shadow-md border border-[#191A23] p-5 transition-all duration-200 hover:shadow-lg" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <h4 class="text-lg font-medium text-[#191A23] mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Analysis Summary
                    </h4>
                    <div id="compatibility-explanation" class="prose prose-sm text-[#191A23]/90 mb-6 p-4 bg-gray-50 rounded-lg border border-[#191A23]/20">
                        <div class="animate-pulse flex space-x-4">
                            <div class="flex-1 space-y-3">
                                <div class="h-2 bg-gray-300 rounded"></div>
                                <div class="h-2 bg-gray-300 rounded w-5/6"></div>
                                <div class="h-2 bg-gray-300 rounded"></div>
                                <div class="h-2 bg-gray-300 rounded w-4/6"></div>
                            </div>
                        </div>
                    </div>
                                                        
                    <!-- Progress Bars -->
                    <div class="mt-4 space-y-5">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-[#191A23] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Skills Match
                                </span>
                                <span id="skills-score" class="text-sm font-medium text-[#191A23]">-</span>
                            </div>
                            <div class="w-full bg-[#191A23]/20 rounded-full h-2.5 overflow-hidden">
                                <div id="skills-progress" class="bg-gradient-to-r from-[#B9FF66] to-[#a3e65a] h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                                                            
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-[#191A23] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Experience Match
                                </span>
                                <span id="experience-score" class="text-sm font-medium text-[#191A23]">-</span>
                            </div>
                            <div class="w-full bg-[#191A23]/20 rounded-full h-2.5 overflow-hidden">
                                <div id="experience-progress" class="bg-gradient-to-r from-[#B9FF66] to-[#a3e65a] h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                                                            
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-[#191A23] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                    Education Match
                                </span>
                                <span id="education-score" class="text-sm font-medium text-[#191A23]">-</span>
                            </div>
                            <div class="w-full bg-[#191A23]/20 rounded-full h-2.5 overflow-hidden">
                                <div id="education-progress" class="bg-gradient-to-r from-[#B9FF66] to-[#a3e65a] h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                                
            <!-- Skills Analysis Section -->
            <div class="mt-6 bg-white rounded-xl shadow-md border border-[#191A23] p-5 transition-all duration-200 hover:shadow-lg" style="box-shadow: 0px 3px 0px 0 #191a23;">
                <h4 class="text-lg font-medium text-[#191A23] mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Skills Analysis
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Matched Skills -->
                    <div class="bg-[#B9FF66]/20 rounded-lg p-4 border border-[#191A23]/30 hover:shadow-sm transition-all duration-200">
                        <h5 class="text-sm font-medium text-[#191A23] mb-3 flex items-center">
                            <div class="flex-shrink-0 h-5 w-5 rounded-full bg-[#B9FF66]/50 flex items-center justify-center mr-2 border border-[#191A23]/40">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            Matched Skills
                        </h5>
                        <div id="matched-skills" class="flex flex-wrap gap-2">
                            <div class="animate-pulse flex flex-wrap gap-2">
                                <div class="h-6 bg-[#B9FF66]/40 rounded-full w-16"></div>
                            </div>
                        </div>
                        <div id="no-matched-skills" class="hidden p-3 bg-white bg-opacity-50 rounded-lg border border-[#B9FF66]/30 text-sm text-[#191A23]/70 italic">
                            No matched skills found
                        </div>
                    </div>
                                                        
                    <!-- Missing Skills -->
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200 hover:shadow-sm transition-all duration-200">
                        <h5 class="text-sm font-medium text-[#191A23] mb-3 flex items-center">
                            <div class="flex-shrink-0 h-5 w-5 rounded-full bg-red-100 flex items-center justify-center mr-2 border border-red-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            Missing Skills
                        </h5>
                        <div id="missing-skills" class="flex flex-wrap gap-2">
                            <div class="animate-pulse flex flex-wrap gap-2">
                                <div class="h-6 bg-red-200 rounded-full w-16"></div>
                            </div>
                        </div>
                        <div id="no-missing-skills" class="hidden p-3 bg-white bg-opacity-50 rounded-lg border border-red-100 text-sm text-[#191A23]/70 italic">
                            No missing skills found
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-sm text-[#191A23]/90 bg-[#B9FF66]/20 p-3 rounded-lg border border-[#191A23]/30">
                    <p class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>This analysis helps you understand how your qualifications align with the job requirements. Consider adding missing skills to your CV for better job matches.</span>
                    </p>
                </div>
            </div>

            <!-- Overall Recommendation Section -->
            <div class="mt-6 bg-white rounded-xl shadow-md border border-[#191A23] p-5 transition-all duration-200 hover:shadow-lg" style="box-shadow: 0px 3px 0px 0 #191a23;">
                <h4 class="text-lg font-medium text-[#191A23] mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    What To Do Next
                </h4>
                
                <div id="recommendation-section" class="p-4 bg-gray-50 rounded-lg border border-[#191A23]/20">
                    <div id="high-score-advice" class="hidden">
                        <p class="text-green-700 font-medium mb-2">Great match! Your CV shows excellent compatibility with this position.</p>
                        <ul class="list-disc list-inside text-sm text-[#191A23]/90 space-y-1">
                            <li>Apply with confidence as your profile strongly aligns with the requirements</li>
                            <li>In your cover letter, emphasize your matched skills and relevant experience</li>
                            <li>Prepare to discuss specific examples of your experience with the matched skills</li>
                        </ul>
                    </div>
                    
                    <div id="medium-score-advice" class="hidden">
                        <p class="text-blue-700 font-medium mb-2">Good potential! You meet many of the requirements for this position.</p>
                        <ul class="list-disc list-inside text-sm text-[#191A23]/90 space-y-1">
                            <li>Apply for this position, highlighting the skills and experience you do have</li>
                            <li>Address how you're developing the missing skills in your cover letter</li>
                            <li>Consider taking quick courses on the missing skills to improve your profile</li>
                        </ul>
                    </div>
                    
                    <div id="low-score-advice" class="hidden">
                        <p class="text-yellow-700 font-medium mb-2">There's a gap between your profile and this position's requirements.</p>
                        <ul class="list-disc list-inside text-sm text-[#191A23]/90 space-y-1">
                            <li>Consider developing the missing skills before applying</li>
                            <li>Look for more suitable positions that better match your current skill set</li>
                            <li>If you're transitioning careers, mention your transferable skills in your cover letter</li>
                        </ul>
                    </div>
                    
                    <div id="very-low-score-advice" class="hidden">
                        <p class="text-red-700 font-medium mb-2">This position may not be the best match for your current profile.</p>
                        <ul class="list-disc list-inside text-sm text-[#191A23]/90 space-y-1">
                            <li>Focus on positions that better match your current skills and experience</li>
                            <li>Consider training or courses to develop the missing skills</li>
                            <li>Update your CV to highlight transferable skills if you still wish to apply</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-4">
                <!-- Submit button removed as requested -->
            </div>
        </div>
    </div>
</script>

<!-- Script for handling compatibility check UI animation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set up the empty history button
        const startCheckingBtn = document.getElementById('start-checking-btn');
        const checkCompatibilityBtn = document.getElementById('checkCompatibilityBtn');
        
        if (startCheckingBtn && checkCompatibilityBtn) {
            startCheckingBtn.addEventListener('click', function() {
                checkCompatibilityBtn.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Initialize the compatibility results template
        const resultsTemplate = document.getElementById('compatibility-results-template');
        const resultsContainer = document.getElementById('compatibility-results');
        
        if (resultsTemplate && resultsContainer) {
            // Function to show the compatibility results
            window.showCompatibilityResults = function(data) {
                // Clone the template and add it to the container
                resultsContainer.innerHTML = resultsTemplate.innerHTML;
                resultsContainer.classList.remove('hidden');
                
                // Animate the score circle
                const scorePath = document.getElementById('score-path');
                const scoreValue = data.compatibility_score || 0;
                
                // Set the score text
                document.getElementById('compatibility-score-value').textContent = scoreValue;
                
                // Update scores and progress bars
                if (data.skills_score) {
                    document.getElementById('skills-score').textContent = data.skills_score + '%';
                    document.getElementById('skills-progress').style.width = data.skills_score + '%';
                }
                
                if (data.experience_score) {
                    document.getElementById('experience-score').textContent = data.experience_score + '%';
                    document.getElementById('experience-progress').style.width = data.experience_score + '%';
                }
                
                if (data.education_score) {
                    document.getElementById('education-score').textContent = data.education_score + '%';
                    document.getElementById('education-progress').style.width = data.education_score + '%';
                }
                
                // Update matched and missing skills
                const matchedSkillsContainer = document.getElementById('matched-skills');
                const missingSkillsContainer = document.getElementById('missing-skills');
                
                if (matchedSkillsContainer) {
                    matchedSkillsContainer.innerHTML = '';
                    
                    if (data.matched_skills && data.matched_skills.length > 0) {
                        data.matched_skills.forEach(skill => {
                            const skillBadge = document.createElement('span');
                            skillBadge.className = 'inline-block px-2 py-1 bg-emerald-100 text-emerald-800 rounded border border-emerald-200 text-xs mr-2 mb-2';
                            skillBadge.textContent = skill;
                            matchedSkillsContainer.appendChild(skillBadge);
                        });
                        document.getElementById('no-matched-skills').classList.add('hidden');
                    } else {
                        document.getElementById('no-matched-skills').classList.remove('hidden');
                    }
                }
                
                if (missingSkillsContainer) {
                    missingSkillsContainer.innerHTML = '';
                    
                    if (data.missing_skills && data.missing_skills.length > 0) {
                        data.missing_skills.forEach(skill => {
                            const skillBadge = document.createElement('span');
                            skillBadge.className = 'inline-block px-2 py-1 bg-rose-100 text-rose-800 rounded border border-rose-200 text-xs mr-2 mb-2';
                            skillBadge.textContent = skill;
                            missingSkillsContainer.appendChild(skillBadge);
                        });
                        document.getElementById('no-missing-skills').classList.add('hidden');
                    } else {
                        document.getElementById('no-missing-skills').classList.remove('hidden');
                    }
                }
                
                // Add explanation
                if (data.explanation) {
                    document.getElementById('compatibility-explanation').innerHTML = `<p class="text-gray-700">${data.explanation}</p>`;
                }
                
                // Set the score description and color
                const scoreDesc = document.getElementById('score-description');
                
                // Show the appropriate recommendation based on score
                const highScoreAdvice = document.getElementById('high-score-advice');
                const mediumScoreAdvice = document.getElementById('medium-score-advice');
                const lowScoreAdvice = document.getElementById('low-score-advice');
                const veryLowScoreAdvice = document.getElementById('very-low-score-advice');
                
                // Hide all advice sections first
                highScoreAdvice.classList.add('hidden');
                mediumScoreAdvice.classList.add('hidden');
                lowScoreAdvice.classList.add('hidden');
                veryLowScoreAdvice.classList.add('hidden');
                
                if (scoreValue >= 80) {
                    scoreDesc.textContent = 'Excellent Match';
                    scoreDesc.className = 'text-center text-sm text-green-600 font-medium';
                    scorePath.setAttribute('stroke', '#10B981'); // Green
                    highScoreAdvice.classList.remove('hidden');
                } else if (scoreValue >= 60) {
                    scoreDesc.textContent = 'Good Match';
                    scoreDesc.className = 'text-center text-sm text-blue-600 font-medium';
                    scorePath.setAttribute('stroke', '#3B82F6'); // Blue
                    mediumScoreAdvice.classList.remove('hidden');
                } else if (scoreValue >= 40) {
                    scoreDesc.textContent = 'Fair Match';
                    scoreDesc.className = 'text-center text-sm text-yellow-600 font-medium';
                    scorePath.setAttribute('stroke', '#F59E0B'); // Yellow
                    lowScoreAdvice.classList.remove('hidden');
                } else {
                    scoreDesc.textContent = 'Poor Match';
                    scoreDesc.className = 'text-center text-sm text-red-600 font-medium';
                    scorePath.setAttribute('stroke', '#EF4444'); // Red
                    veryLowScoreAdvice.classList.remove('hidden');
                }
                
                // Animate the score circle
                setTimeout(() => {
                    scorePath.setAttribute('stroke-dasharray', `${scoreValue}, 100`);
                }, 100);
                
                // Show the cache indicator if data is from cache
                if (data.from_cache) {
                    document.getElementById('from-cache-indicator').classList.remove('hidden');
                }
            };
        }
        
        // Check if we already have analysis results
        const alreadyAnalyzedElement = document.getElementById('already_analyzed');
        if (alreadyAnalyzedElement) {
            try {
                const existingAnalysis = JSON.parse(alreadyAnalyzedElement.dataset.analysis);
                
                // Parse the skills arrays if they're stored as JSON strings
                let matchedSkills = [];
                let missingSkills = [];
                
                try {
                    if (existingAnalysis.matched_skills) {
                        matchedSkills = typeof existingAnalysis.matched_skills === 'string' 
                            ? JSON.parse(existingAnalysis.matched_skills) 
                            : existingAnalysis.matched_skills;
                    }
                } catch (e) {
                    console.error("Error parsing matched skills:", e);
                    matchedSkills = [];
                }
                
                try {
                    if (existingAnalysis.missing_skills) {
                        missingSkills = typeof existingAnalysis.missing_skills === 'string' 
                            ? JSON.parse(existingAnalysis.missing_skills) 
                            : existingAnalysis.missing_skills;
                    }
                } catch (e) {
                    console.error("Error parsing missing skills:", e);
                    missingSkills = [];
                }
                
                // Show the existing analysis results
                const formattedData = {
                    compatibility_score: existingAnalysis.compatibility_score || 0,
                    skills_score: existingAnalysis.skills_score || 0,
                    experience_score: existingAnalysis.experience_score || 0,
                    education_score: existingAnalysis.education_score || 0,
                    matched_skills: matchedSkills,
                    missing_skills: missingSkills,
                    explanation: existingAnalysis.explanation || "We've already analyzed this CV's compatibility with this job position.",
                    from_cache: true
                };
                
                // Display the existing results
                showCompatibilityResults(formattedData);
            } catch (error) {
                console.error("Error parsing existing analysis:", error);
            }
        }
        
        // Handle the check compatibility button click
        document.getElementById('checkCompatibilityBtn').addEventListener('click', function() {
            // Check if button is disabled (already analyzed)
            if (this.disabled) {
                const alreadyAnalyzedElement = document.getElementById('already_analyzed');
                if (alreadyAnalyzedElement && alreadyAnalyzedElement.dataset.analysis) {
                    const existingAnalysis = JSON.parse(alreadyAnalyzedElement.dataset.analysis);
                    
                    // Parse the skills arrays if they're stored as JSON strings
                    let matchedSkills = [];
                    let missingSkills = [];
                    
                    try {
                        if (existingAnalysis.matched_skills) {
                            matchedSkills = typeof existingAnalysis.matched_skills === 'string' 
                                ? JSON.parse(existingAnalysis.matched_skills) 
                                : existingAnalysis.matched_skills;
                        }
                    } catch (e) {
                        console.error("Error parsing matched skills:", e);
                        matchedSkills = [];
                    }
                    
                    try {
                        if (existingAnalysis.missing_skills) {
                            missingSkills = typeof existingAnalysis.missing_skills === 'string' 
                                ? JSON.parse(existingAnalysis.missing_skills) 
                                : existingAnalysis.missing_skills;
                        }
                    } catch (e) {
                        console.error("Error parsing missing skills:", e);
                        missingSkills = [];
                    }
                    
                    const formattedData = {
                        compatibility_score: existingAnalysis.compatibility_score || 0,
                        skills_score: existingAnalysis.skills_score || 0,
                        experience_score: existingAnalysis.experience_score || 0,
                        education_score: existingAnalysis.education_score || 0,
                        matched_skills: matchedSkills,
                        missing_skills: missingSkills,
                        explanation: existingAnalysis.explanation || "We've already analyzed this CV's compatibility with this job position.",
                        from_cache: true
                    };
                    
                    showCompatibilityResults(formattedData);
                    return;
                }
            }
            
            // Show loading state
            const loadingElement = document.getElementById('compatibility-loading');
            if (loadingElement) {
                loadingElement.classList.remove('hidden');
            }
            
            // Get the CV file from the default CV
            const defaultCvId = document.getElementById('default_cv_display').dataset.cvId;
            const fileName = document.getElementById('default_cv_display').textContent.trim();
            
            console.log("Starting compatibility check with CV:", {
                id: defaultCvId,
                fileName: fileName
            });
            
            // First, fetch the CV file
            fetch(`/job-seeker/cv-content/${defaultCvId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error("CV content fetch failed:", {
                            status: response.status,
                            statusText: response.statusText,
                            body: text
                        });
                        throw new Error(`Failed to fetch CV content: ${response.status} ${response.statusText}`);
                    });
                }
                console.log("CV content fetched successfully");
                return response.json();
            })
            .then(data => {
                // Create a blob from the base64 data
                const binaryString = atob(data.file_content);
                const bytes = new Uint8Array(binaryString.length);
                for (let i = 0; i < binaryString.length; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                const blob = new Blob([bytes], { type: 'application/pdf' });
                
                // Create FormData object
                const formData = new FormData();
                
                // Add the CV file and job description to the form data
                formData.append('cv_file', blob, data.file_name);
                formData.append('job_description', jobPositionData.description);
                
                console.log("Sending request to Flask API with:", {
                    fileName: data.file_name,
                    jobDescriptionLength: jobPositionData.description.length
                });
                
                // Send to Flask API for compatibility check
                return fetch('http://localhost:5000/api/check-compatibility-score', {
                    method: 'POST',
                    body: formData
                });
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error("Flask API Error:", {
                            status: response.status,
                            statusText: response.statusText,
                            body: text
                        });
                        throw new Error(`Flask API responded with ${response.status}: ${text}`);
                    });
                }
                console.log("Flask API request successful");
                return response.json();
            })
            .then(data => {
                console.log("Received compatibility data:", data);
                
                // Hide loading state
                document.getElementById('compatibility-loading').classList.add('hidden');
                
                // Format the data for display
                const formattedData = {
                    compatibility_score: data.compatibility_score || 0,
                    skills_score: data.skills_score || 0,
                    experience_score: data.experience_score || 0,
                    education_score: data.education_score || 0,
                    matched_skills: data.matched_skills || [],
                    missing_skills: data.missing_skills || [],
                    explanation: data.explanation || "Compatibility check completed based on your CV and this job position.",
                    from_cache: false
                };
                
                // Show results
                showCompatibilityResults(formattedData);
                
                // Disable the check button to prevent multiple checks
                document.getElementById('checkCompatibilityBtn').disabled = true;
                document.getElementById('checkCompatibilityBtn').innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Already Analyzed
                `;
                
                // Save the compatibility results to the database
                saveCompatibilityToDatabase(formattedData, defaultCvId);
            })
            .catch(error => {
                console.error('Compatibility check failed:', error);
                
                // Hide loading state
                const loadingElement = document.getElementById('compatibility-loading');
                if (loadingElement) {
                    loadingElement.classList.add('hidden');
                }
                
                // Show error alert to user
                const errorElement = document.createElement('div');
                errorElement.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-4';
                errorElement.innerHTML = `
                    <strong>Error:</strong> ${error.message}. Please try again later.
                `;
                document.getElementById('compatibility-results').classList.remove('hidden');
                document.getElementById('compatibility-results').appendChild(errorElement);
                
                // Reset the check button to allow the user to try again
                document.getElementById('checkCompatibilityBtn').disabled = false;
            });
        });
        
        // Function to save compatibility results to database
        function saveCompatibilityToDatabase(data, cvId) {
            // Prepare the data for saving
            const saveData = {
                cv_id: cvId,
                job_position_id: jobPositionData.id,
                compatibility_score: data.compatibility_score,
                skills_score: data.skills_score || 0,
                experience_score: data.experience_score || 0,
                education_score: data.education_score || 0,
                matched_skills: JSON.stringify(data.matched_skills || []),
                missing_skills: JSON.stringify(data.missing_skills || []),
                explanation: data.explanation || "",
            };
            
            console.log("Saving compatibility results to database:", saveData);
            
            // Send the data to the Laravel backend
            fetch('/job-seeker/job-compatibility/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(saveData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error("Save error:", text);
                        throw new Error(`Failed to save compatibility results. Status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(result => {
                console.log("Compatibility results saved successfully:", result);
            })
            .catch(error => {
                console.error('Failed to save compatibility results:', error);
            });
        }
        
        // Handle file selection event
        const fileInput = document.getElementById('cv_file');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileSelected = document.getElementById('file-selected');
                const fileName = document.getElementById('file-name');
                
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;
                    fileSelected.classList.remove('hidden');
                    } else {
                    fileSelected.classList.add('hidden');
                }
            });
        }
        
        // Log form data on submit for debugging (without preventing submission)
        const form = document.getElementById('application-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form is being submitted');
                console.log('Form action:', this.action);
                console.log('Use default CV:', document.getElementById('use_default_cv')?.value);
                console.log('Default CV ID (debug only):', document.getElementById('default_cv_id_debug')?.value);
                console.log('Job Position ID:', document.querySelector('input[name="job_position_id"]')?.value);
                console.log('Cover letter length:', document.getElementById('cover_letter')?.value?.length || 0);
                // Don't prevent the default submission
            });
        }
    });
</script>

<script>
    // Job Description Read More/Less functionality
    document.addEventListener('DOMContentLoaded', function() {
        const jobDescriptionContent = document.getElementById('job-description-content');
        const descriptionFade = document.getElementById('description-fade');
        const toggleButton = document.getElementById('toggle-description');
        const readMoreText = document.getElementById('read-more-text');
        
        if (jobDescriptionContent && toggleButton) {
            // Store the original text height
            let expanded = false;
            
            // Only show the toggle if content is actually long enough
            setTimeout(() => {
                const contentHeight = jobDescriptionContent.scrollHeight;
                if (contentHeight <= 200) {
                    toggleButton.style.display = 'none';
                    descriptionFade.style.display = 'none';
                    jobDescriptionContent.style.maxHeight = 'none';
                }
            }, 100);
            
            // Toggle the description expand/collapse
            toggleButton.addEventListener('click', function() {
                expanded = !expanded;
                
                if (expanded) {
                    jobDescriptionContent.style.maxHeight = jobDescriptionContent.scrollHeight + 'px';
                    readMoreText.textContent = 'Show less';
                    descriptionFade.style.display = 'none';
                    
                    // Update SVG to point upward
                    toggleButton.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />';
                } else {
                    jobDescriptionContent.style.maxHeight = '200px';
                    readMoreText.textContent = 'Read more';
                    descriptionFade.style.display = 'block';
                    
                    // Update SVG to point downward
                    toggleButton.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
                }
            });
        }
    });
</script>

<script>
    // Requirements Read More/Less functionality
    document.addEventListener('DOMContentLoaded', function() {
        const requirementsContent = document.getElementById('requirements-content');
        const requirementsFade = document.getElementById('requirements-fade');
        const toggleRequirementsButton = document.getElementById('toggle-requirements');
        const requirementsReadMoreText = document.getElementById('requirements-read-more-text');
        
        if (requirementsContent && toggleRequirementsButton) {
            // Store the original text height
            let expanded = false;
            
            // Only show the toggle if content is actually long enough
            setTimeout(() => {
                const contentHeight = requirementsContent.scrollHeight;
                if (contentHeight <= 200) {
                    toggleRequirementsButton.style.display = 'none';
                    requirementsFade.style.display = 'none';
                    requirementsContent.style.maxHeight = 'none';
                }
            }, 100);
            
            // Toggle the requirements expand/collapse
            toggleRequirementsButton.addEventListener('click', function() {
                expanded = !expanded;
                
                if (expanded) {
                    requirementsContent.style.maxHeight = requirementsContent.scrollHeight + 'px';
                    requirementsReadMoreText.textContent = 'Show less';
                    requirementsFade.style.display = 'none';
                    
                    // Update SVG to point upward
                    toggleRequirementsButton.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />';
                } else {
                    requirementsContent.style.maxHeight = '200px';
                    requirementsReadMoreText.textContent = 'Read more';
                    requirementsFade.style.display = 'block';
                    
                    // Update SVG to point downward
                    toggleRequirementsButton.querySelector('svg').innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />';
                }
            });
        }
    });
</script>

@endsection 