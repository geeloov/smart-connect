@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="relative mb-12">
            <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-2xl"></div>
            <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl shadow-xl border border-indigo-100 overflow-hidden">
                <!-- Header Background Pattern -->
                <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-50">
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
                        <div class="p-4 bg-indigo-600 rounded-xl shadow-md w-20 h-20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Job Details
                                </span>
                                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $jobPosition->title }}</h1>
                                <div class="mt-2 flex items-center text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <span class="text-lg font-medium">{{ $jobPosition->company_name }}</span>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0 flex flex-col md:flex-row gap-3">
                                <a href="{{ route('job-seeker.applications.create', $jobPosition) }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-lg text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 transform hover:scale-[1.01] shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Apply Now
                                </a>
                                
                                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Print
                                </button>
                            </div>
                        </div>
                        
                        <div class="inline-flex flex-wrap gap-2 mt-5">
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $jobPosition->location }}
                            </div>
                            
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $jobPosition->job_type }}
                            </div>
                            
                            @if($jobPosition->salary_range)
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-green-50 text-green-700 border border-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $jobPosition->salary_range }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                            @if(!$hasApplied)
                                <a href="/job-seeker/applications/{{ $jobPosition->id }}/create" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Apply Now
                                </a>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Already Applied
                                </span>
                                <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    View My Applications
                                </a>
                            @endif
                            <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Job Listings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Details Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Description & Requirements -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Job Description Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Job Description
                        </h2>
                        <span class="text-sm font-medium text-indigo-600 rounded-full bg-indigo-50 px-3 py-1">
                            Details
                        </span>
                    </div>
                    <div class="px-6 py-5">
                        <div id="job-description-content" class="prose prose-indigo max-w-none relative overflow-hidden transition-all duration-300" style="max-height: 200px;">
                            <p class="whitespace-pre-line text-gray-700">{{ $jobPosition->description }}</p>
                            <!-- Gradient overlay for collapsed state -->
                            <div id="description-fade" class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white to-transparent"></div>
                        </div>
                        <button id="toggle-description" class="mt-3 flex items-center justify-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition focus:outline-none">
                            <span id="read-more-text">Read more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Requirements Card -->
                @if($jobPosition->requirements)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Requirements
                        </h2>
                        <span class="text-sm font-medium text-indigo-600 rounded-full bg-indigo-50 px-3 py-1">
                            Qualifications
                        </span>
                    </div>
                    <div class="px-6 py-5">
                        <div class="prose prose-indigo max-w-none">
                            <p class="whitespace-pre-line text-gray-700">{{ $jobPosition->requirements }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Additional Info -->
            <div class="space-y-8">
                <!-- Company Info Card -->
                <div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl shadow-sm border border-indigo-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Company Information
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-700">
                            <span class="font-medium w-24 text-gray-900">Company:</span>
                            <span>{{ $jobPosition->company_name }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <span class="font-medium w-24 text-gray-900">Posted:</span>
                            <span>{{ $jobPosition->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <span class="font-medium w-24 text-gray-900">Posted By:</span>
                            <span>{{ $jobPosition->recruiter->name }}</span>
                        </div>
                    </div>
                    <div class="pt-4 mt-6 border-t border-gray-200">
                        <a href="{{ route('job-seeker.applications.create', $jobPosition) }}" class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 transform hover:scale-[1.01] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Apply for this Job
                        </a>
                    </div>
                </div>

                <!-- Application Info Card -->
                <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-blue-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Application Tips
                    </h3>
                    <div class="space-y-3 text-sm text-gray-700">
                        <p class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Tailor your CV to match the job requirements
                        </p>
                        <p class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Highlight relevant skills and experience
                        </p>
                        <p class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Include a personalized cover letter
                        </p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-blue-100">
                        @if(!$hasApplied)
                            <a href="/job-seeker/applications/{{ $jobPosition->id }}/create" class="flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Start Your Application
                            </a>
                        @else
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                                <p class="text-green-800 font-medium">You've already applied to this position!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Job Description Read More/Less functionality -->
<script>
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

<!-- Sticky Apply Button -->
<div class="fixed bottom-0 left-0 right-0 z-20 p-4 bg-white border-t border-gray-200 shadow-lg transform transition-all duration-300 opacity-0" id="sticky-apply-button">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex-1 mr-4 hidden md:block">
            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $jobPosition->title }}</h3>
            <p class="text-sm text-gray-600 truncate">{{ $jobPosition->company_name }} • {{ $jobPosition->location }}</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('job-seeker.applications.create', $jobPosition) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Apply Now
            </a>
        </div>
    </div>
</div>

<script>
    // Show/hide sticky apply button based on scroll position
    document.addEventListener('DOMContentLoaded', function() {
        const stickyButton = document.getElementById('sticky-apply-button');
        const headerButton = document.querySelector('.mt-4.md\\:mt-0.flex.flex-col.md\\:flex-row.gap-3 a');
        
        if (stickyButton && headerButton) {
            // Hide sticky button initially when at the top
            stickyButton.classList.add('translate-y-full');
            stickyButton.classList.add('opacity-0');
            
            window.addEventListener('scroll', function() {
                // Get position of the header button
                const headerButtonRect = headerButton.getBoundingClientRect();
                const scrollY = window.scrollY || window.pageYOffset;
                
                // If header button is out of view (scrolled past), show sticky button
                if (headerButtonRect.top < 0) {
                    stickyButton.classList.remove('translate-y-full');
                    stickyButton.classList.remove('opacity-0');
                    stickyButton.classList.add('opacity-100');
                } else {
                    stickyButton.classList.add('translate-y-full');
                    stickyButton.classList.remove('opacity-100');
                    stickyButton.classList.add('opacity-0');
                }
            });
        }
    });
</script>

@endsection 