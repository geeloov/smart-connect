@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Page Header -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Applications
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">Application Details</h1>
                    <p class="mt-2 text-gray-600 max-w-3xl">View the details of your job application including status, match score, and submitted documents.</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <!-- Left Column: Application Status and Job Info -->
            <div class="lg:col-span-1">
                <!-- Application Status Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Application Status</h2>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                #{{ $jobApplication->id }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="rounded-xl p-4 mb-4
                            @if($jobApplication->status == 'pending') bg-yellow-50 border border-yellow-200
                            @elseif($jobApplication->status == 'in_review') bg-blue-50 border border-blue-200
                            @elseif($jobApplication->status == 'accepted') bg-green-50 border border-green-200
                            @elseif($jobApplication->status == 'rejected') bg-red-50 border border-red-200
                            @else bg-gray-50 border border-gray-200
                            @endif">
                            <div class="flex items-center mb-2">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full 
                                    @if($jobApplication->status == 'pending') bg-yellow-100
                                    @elseif($jobApplication->status == 'in_review') bg-blue-100
                                    @elseif($jobApplication->status == 'accepted') bg-green-100
                                    @elseif($jobApplication->status == 'rejected') bg-red-100
                                    @else bg-gray-100
                                    @endif 
                                    flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6
                                        @if($jobApplication->status == 'pending') text-yellow-700
                                        @elseif($jobApplication->status == 'in_review') text-blue-700
                                        @elseif($jobApplication->status == 'accepted') text-green-700
                                        @elseif($jobApplication->status == 'rejected') text-red-700
                                        @else text-gray-700
                                        @endif" 
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        @if($jobApplication->status == 'pending')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        @elseif($jobApplication->status == 'in_review')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        @elseif($jobApplication->status == 'accepted')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        @elseif($jobApplication->status == 'rejected')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        @endif
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold
                                        @if($jobApplication->status == 'pending') text-yellow-800
                                        @elseif($jobApplication->status == 'in_review') text-blue-800
                                        @elseif($jobApplication->status == 'accepted') text-green-800
                                        @elseif($jobApplication->status == 'rejected') text-red-800
                                        @else text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}
                                    </h3>
                                    <p class="text-sm
                                        @if($jobApplication->status == 'pending') text-yellow-600
                                        @elseif($jobApplication->status == 'in_review') text-blue-600
                                        @elseif($jobApplication->status == 'accepted') text-green-600
                                        @elseif($jobApplication->status == 'rejected') text-red-600
                                        @else text-gray-600
                                        @endif">
                                        @if($jobApplication->status == 'pending')
                                            Your application is waiting for review
                                        @elseif($jobApplication->status == 'in_review')
                                            Your application is being reviewed
                                        @elseif($jobApplication->status == 'accepted')
                                            Congratulations! Your application has been accepted
                                        @elseif($jobApplication->status == 'rejected')
                                            We're sorry, your application was not selected
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 pl-14">
                                Applied on {{ $jobApplication->created_at->format('F d, Y') }}
                            </div>
                        </div>
                        
                        <a href="{{ route('job-seeker.jobs.details', $jobApplication->jobPosition) }}" class="block w-full mt-4 px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center">
                            View Original Job Posting
                        </a>
                    </div>
                </div>
                
                <!-- Job Info Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-white">Job Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start mb-6 pb-6 border-b border-gray-200">
                            <div class="flex-shrink-0 h-12 w-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $jobApplication->jobPosition->title }}</h3>
                                <p class="text-gray-600">{{ $jobApplication->jobPosition->company_name }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-500">Location</h4>
                                    <p class="text-sm text-gray-900">{{ $jobApplication->jobPosition->location }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-500">Job Type</h4>
                                    <p class="text-sm text-gray-900">{{ $jobApplication->jobPosition->job_type }}</p>
                                </div>
                            </div>
                            
                            @if($jobApplication->jobPosition->salary_range)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-500">Salary Range</h4>
                                    <p class="text-sm text-gray-900">{{ $jobApplication->jobPosition->salary_range }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Application Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- CV Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Your CV
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between p-4 mb-4 rounded-xl bg-gray-50 border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $jobApplication->cv_filename }}</p>
                                    <p class="text-xs text-gray-500">Submitted with your application</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/cv_files/' . $jobApplication->cv_filename) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Cover Letter Card (if exists) -->
                @if($jobApplication->cover_letter)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-5">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Cover Letter
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="bg-gradient-to-r from-purple-50 to-white p-5 rounded-xl border border-purple-100">
                            <div class="prose prose-indigo max-w-none">
                                <p class="whitespace-pre-line text-gray-700">{{ $jobApplication->cover_letter }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Compatibility Analysis Card (if exists) -->
                @if($jobApplication->compatibility_analysis)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-5">
                        <h2 class="text-lg font-semibold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Compatibility Analysis
                        </h2>
                    </div>
                    <div class="p-6">
                        @php
                            $compData = json_decode($jobApplication->compatibility_analysis, true);
                            $matchScore = $compData['match_score'] ?? 0;
                            $reasoning = $compData['reasoning'] ?? 'No detailed analysis available.';
                            
                            // Get skills analysis data
                            $matchedSkills = [];
                            $missingSkills = [];
                            
                            if (isset($compData['skills_analysis'])) {
                                $matchedSkills = isset($compData['skills_analysis']['matched_skills']) ? 
                                    (is_array($compData['skills_analysis']['matched_skills']) ? 
                                    $compData['skills_analysis']['matched_skills'] : 
                                    [$compData['skills_analysis']['matched_skills']]) : [];
                                
                                $missingSkills = isset($compData['skills_analysis']['missing_skills']) ? 
                                    (is_array($compData['skills_analysis']['missing_skills']) ? 
                                    $compData['skills_analysis']['missing_skills'] : 
                                    [$compData['skills_analysis']['missing_skills']]) : [];
                            }
                            
                            // Handle experience and education analysis
                            $experienceAnalysis = '';
                            if (isset($compData['experience_analysis'])) {
                                $experienceAnalysis = is_string($compData['experience_analysis']) ? 
                                    $compData['experience_analysis'] : 
                                    json_encode($compData['experience_analysis']);
                            }
                            
                            $educationAnalysis = '';
                            if (isset($compData['education_analysis'])) {
                                $educationAnalysis = is_string($compData['education_analysis']) ? 
                                    $compData['education_analysis'] : 
                                    json_encode($compData['education_analysis']);
                            }
                            
                            // Set score color and message
                            if ($matchScore >= 80) {
                                $scoreColor = 'text-green-600';
                                $scoreRingColor = 'text-green-500';
                                $scoreTrackColor = 'text-green-100';
                                $scoreMessage = 'Excellent match!';
                                $scoreBg = 'bg-green-50 border-green-100';
                            } elseif ($matchScore >= 60) {
                                $scoreColor = 'text-blue-600';
                                $scoreRingColor = 'text-blue-500';
                                $scoreTrackColor = 'text-blue-100';
                                $scoreMessage = 'Good match';
                                $scoreBg = 'bg-blue-50 border-blue-100';
                            } elseif ($matchScore >= 40) {
                                $scoreColor = 'text-yellow-600';
                                $scoreRingColor = 'text-yellow-500';
                                $scoreTrackColor = 'text-yellow-100';
                                $scoreMessage = 'Fair match';
                                $scoreBg = 'bg-yellow-50 border-yellow-100';
                            } else {
                                $scoreColor = 'text-red-600';
                                $scoreRingColor = 'text-red-500';
                                $scoreTrackColor = 'text-red-100';
                                $scoreMessage = 'Low match';
                                $scoreBg = 'bg-red-50 border-red-100';
                            }
                        @endphp
                        
                        <!-- Match Score -->
                        <div class="flex items-center p-5 rounded-xl {{ $scoreBg }} mb-6">
                            <div class="relative h-20 w-20">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="currentColor" class="{{ $scoreTrackColor }}" stroke-width="2"></circle>
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="currentColor" class="{{ $scoreRingColor }}" stroke-width="2" stroke-dasharray="{{ $matchScore }}, 100" transform="rotate(-90 18 18)"></circle>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-xl font-bold {{ $scoreColor }}">{{ $matchScore }}</span>
                                </div>
                            </div>
                            
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold {{ $scoreColor }}">{{ $scoreMessage }}</h3>
                                <p class="text-sm text-gray-600">Overall compatibility score</p>
                            </div>
                        </div>
                        
                        <!-- Analysis Summary -->
                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-900 mb-3">Analysis Summary</h3>
                            <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <p class="text-sm text-gray-700">{{ $reasoning }}</p>
                            </div>
                        </div>
                        
                        <!-- Skills Analysis -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Matched Skills -->
                            <div class="rounded-xl p-4 bg-green-50 border border-green-100">
                                <h4 class="text-sm font-medium text-green-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Matched Skills
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @if(count($matchedSkills) > 0)
                                        @foreach($matchedSkills as $skill)
                                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-md border border-green-200 text-xs">{{ $skill }}</span>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 italic">No matched skills found</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Missing Skills -->
                            <div class="rounded-xl p-4 bg-red-50 border border-red-100">
                                <h4 class="text-sm font-medium text-red-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Missing Skills
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    @if(count($missingSkills) > 0)
                                        @foreach($missingSkills as $skill)
                                            <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded-md border border-red-200 text-xs">{{ $skill }}</span>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 italic">No missing skills identified</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(isset($compData['experience_analysis']) || isset($compData['education_analysis']))
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Experience Analysis -->
                            @if(isset($compData['experience_analysis']))
                            <div class="rounded-xl p-4 bg-blue-50 border border-blue-100">
                                <h4 class="text-sm font-medium text-blue-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Experience Analysis
                                </h4>
                                @php
                                    $expData = is_array($compData['experience_analysis']) ? 
                                        $compData['experience_analysis'] : 
                                        json_decode($compData['experience_analysis'], true);
                                    
                                    $expScore = $expData['experience_match_score'] ?? 0;
                                    $hasRequiredExp = $expData['has_required_experience'] ?? false;
                                    $expRelevantYears = $expData['relevant_years_experience'] ?? null;
                                @endphp
                                
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-700">Match Score:</span>
                                    <span class="font-medium px-2 py-1 rounded-full bg-blue-100 text-blue-800">{{ $expScore }}%</span>
                                </div>
                                
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            @if($hasRequiredExp)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="text-sm">{{ $hasRequiredExp ? 'Meets required experience' : 'Does not meet required experience' }}</span>
                                    </div>
                                    
                                    @if($expRelevantYears !== null)
                                    <div class="text-sm">
                                        <span class="text-gray-600">Relevant experience:</span>
                                        <span class="font-medium ml-1">{{ $expRelevantYears }} {{ Str::plural('year', $expRelevantYears) }}</span>
                                    </div>
                                    @endif
                                    
                                    @if(isset($expData['experience_details']) && !empty($expData['experience_details']))
                                    <div class="mt-2 pt-2 border-t border-blue-200">
                                        <span class="text-sm font-medium text-blue-700">Relevant Experience:</span>
                                        <ul class="mt-1 list-disc list-inside text-sm">
                                            @foreach((array)$expData['experience_details'] as $detail)
                                                <li>{{ $detail }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <!-- Education Analysis -->
                            @if(isset($compData['education_analysis']))
                            <div class="rounded-xl p-4 bg-purple-50 border border-purple-100">
                                <h4 class="text-sm font-medium text-purple-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                    </svg>
                                    Education Analysis
                                </h4>
                                @php
                                    $eduData = is_array($compData['education_analysis']) ? 
                                        $compData['education_analysis'] : 
                                        json_decode($compData['education_analysis'], true);
                                    
                                    $eduScore = $eduData['education_match_score'] ?? 0;
                                    $meetsEdu = $eduData['meets_education_requirements'] ?? false;
                                    
                                    // Get the degrees/qualifications
                                    $degrees = [];
                                    if (isset($eduData['degrees']) && !empty($eduData['degrees'])) {
                                        $degrees = is_array($eduData['degrees']) ? $eduData['degrees'] : [$eduData['degrees']];
                                    }
                                @endphp
                                
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-700">Match Score:</span>
                                    <span class="font-medium px-2 py-1 rounded-full bg-purple-100 text-purple-800">{{ $eduScore }}%</span>
                                </div>
                                
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            @if($meetsEdu)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="text-sm">{{ $meetsEdu ? 'Meets education requirements' : 'Does not meet education requirements' }}</span>
                                    </div>
                                    
                                    @if(count($degrees) > 0)
                                    <div class="mt-2 pt-2 border-t border-purple-200">
                                        <span class="text-sm font-medium text-purple-700">Relevant Qualifications:</span>
                                        <ul class="mt-1 list-disc list-inside text-sm">
                                            @foreach($degrees as $degree)
                                                <li>{{ $degree }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 