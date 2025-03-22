@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="mb-6">
        <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center text-gray-600 hover:text-[#B9FF66] transition-colors">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Applications
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-[#B9FF66] px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-dark flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Application Details
            </h1>
            <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST" class="flex items-center space-x-2">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-md border-gray-300 text-sm focus:border-[#B9FF66] focus:ring-[#B9FF66]">
                    <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_review" {{ $jobApplication->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                    <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-dark bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors">
                    Update Status
                </button>
            </form>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Applicant
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobSeeker->name }}</p>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobSeeker->email }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Position
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobPosition->title }}</p>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Applied On
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            
            @if($jobApplication->cv_data)
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                    </svg>
                    Extracted CV Data
                </h2>
                
                @php
                    $cvData = is_array($jobApplication->cv_data) 
                        ? $jobApplication->cv_data 
                        : json_decode($jobApplication->cv_data, true);
                @endphp
                
                <div class="space-y-4">
                    <!-- Job Matching Analysis Section -->
                    @if($jobApplication->compatibility_analysis)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Job Matching Analysis
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            @php
                                $compData = json_decode($jobApplication->compatibility_analysis, true);
                                $matchScore = $compData['match_score'] ?? 0;
                                $reasoning = $compData['reasoning'] ?? 'No detailed analysis available.';
                                
                                // Get skills analysis data
                                $matchedSkills = [];
                                $missingSkills = [];
                                
                                if (isset($compData['skills_analysis'])) {
                                    $matchedSkills = $compData['skills_analysis']['matched_skills'] ?? [];
                                    $missingSkills = $compData['skills_analysis']['missing_skills'] ?? [];
                                }
                                
                                // Set score color
                                $scoreColor = '';
                                $scoreTextColor = '';
                                $scoreMessage = '';
                                
                                if ($matchScore >= 80) {
                                    $scoreColor = 'bg-green-500';
                                    $scoreTextColor = 'text-green-600';
                                    $scoreMessage = 'Excellent match for this position!';
                                    $scoreMessageBg = 'bg-green-50 text-green-800';
                                } elseif ($matchScore >= 60) {
                                    $scoreColor = 'bg-blue-500';
                                    $scoreTextColor = 'text-blue-600';
                                    $scoreMessage = 'Good match for this position';
                                    $scoreMessageBg = 'bg-blue-50 text-blue-800';
                                } elseif ($matchScore >= 40) {
                                    $scoreColor = 'bg-yellow-500';
                                    $scoreTextColor = 'text-yellow-600';
                                    $scoreMessage = 'Partial match for this position';
                                    $scoreMessageBg = 'bg-yellow-50 text-yellow-800';
                                } else {
                                    $scoreColor = 'bg-red-500';
                                    $scoreTextColor = 'text-red-600';
                                    $scoreMessage = 'Low match for this position';
                                    $scoreMessageBg = 'bg-red-50 text-red-800';
                                }
                            @endphp
                            
                            <!-- Match Score Section -->
                            <div class="mb-6">
                                <div class="bg-gray-50 rounded-xl p-6 text-center">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Match Score</h3>
                                    <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                        <div class="h-4 rounded-full {{ $scoreColor }}" style="width: {{ $matchScore }}%"></div>
                                    </div>
                                    
                                    <div class="flex justify-center items-center mb-3">
                                        <span class="text-4xl font-bold {{ $scoreTextColor }}">{{ $matchScore }}%</span>
                                    </div>
                                    
                                    <div class="inline-block {{ $scoreMessageBg }} px-4 py-2 rounded-lg text-sm font-medium">
                                        {{ $scoreMessage }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Analysis Section -->
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Detailed Analysis</h3>
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-700">
                                    {{ $reasoning }}
                                </div>
                            </div>
                            
                            <!-- Skills Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h3 class="text-lg font-medium text-green-600 flex items-center mb-3">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Matched Skills
                                    </h3>
                                    @if(count($matchedSkills) > 0)
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <ul class="space-y-2">
                                                @foreach($matchedSkills as $skill)
                                                    <li class="flex justify-between items-center">
                                                        <span class="text-gray-700">{{ $skill }}</span>
                                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="bg-gray-50 rounded-lg p-4 text-gray-500 italic">
                                            No matched skills found.
                                        </div>
                                    @endif
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-medium text-red-600 flex items-center mb-3">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Missing Skills
                                    </h3>
                                    @if(count($missingSkills) > 0)
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <ul class="space-y-2">
                                                @foreach($missingSkills as $skill)
                                                    <li class="flex justify-between items-center">
                                                        <span class="text-gray-700">{{ $skill }}</span>
                                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="bg-gray-50 rounded-lg p-4 text-gray-500 italic">
                                            No missing skills identified.
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Experience and Education Analysis -->
                            @if(isset($compData['experience_analysis']) || isset($compData['education_analysis']))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Experience Analysis -->
                                @if(isset($compData['experience_analysis']))
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-3">Experience Analysis</h3>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <ul class="space-y-3">
                                            <li>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Years of Experience:</span>
                                                    <span class="font-medium">{{ $compData['experience_analysis']['years_of_relevant_experience'] ?? 'Not specified' }}</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Meets Requirements:</span>
                                                    @if(isset($compData['experience_analysis']['has_required_experience']))
                                                        @if($compData['experience_analysis']['has_required_experience'])
                                                            <span class="font-medium text-green-600 flex items-center">
                                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                Yes
                                                            </span>
                                                        @else
                                                            <span class="font-medium text-red-600 flex items-center">
                                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                                No
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-500">Not available</span>
                                                    @endif
                                                </div>
                                            </li>
                                            @if(isset($compData['experience_analysis']['experience_match_score']))
                                            <li>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Experience Score:</span>
                                                    <span class="font-medium">{{ $compData['experience_analysis']['experience_match_score'] }}%</span>
                                                </div>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Education Analysis -->
                                @if(isset($compData['education_analysis']))
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-3">Education Analysis</h3>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <ul class="space-y-3">
                                            <li>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Meets Requirements:</span>
                                                    @if(isset($compData['education_analysis']['meets_education_requirements']))
                                                        @if($compData['education_analysis']['meets_education_requirements'])
                                                            <span class="font-medium text-green-600 flex items-center">
                                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                                Yes
                                                            </span>
                                                        @else
                                                            <span class="font-medium text-red-600 flex items-center">
                                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                                No
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-500">Not available</span>
                                                    @endif
                                                </div>
                                            </li>
                                            @if(isset($compData['education_analysis']['education_match_score']))
                                            <li>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Education Score:</span>
                                                    <span class="font-medium">{{ $compData['education_analysis']['education_match_score'] }}%</span>
                                                </div>
                                            </li>
                                            @endif
                                            @if(isset($compData['education_analysis']['relevant_degrees']) && !empty($compData['education_analysis']['relevant_degrees']))
                                            <li>
                                                <span class="text-gray-600">Relevant Degrees:</span>
                                                <ul class="mt-1 list-disc list-inside">
                                                    @foreach($compData['education_analysis']['relevant_degrees'] as $degree)
                                                        <li class="text-gray-700">{{ $degree }}</li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Personal Info Section -->
                    @if(isset($cvData['personal_info']))
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="space-y-3">
                                        @if(isset($cvData['personal_info']['name']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">Name</span>
                                            <span class="text-gray-800 font-medium">{{ $cvData['personal_info']['name'] }}</span>
                                        </div>
                                        @endif

                                        @if(isset($cvData['personal_info']['email']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">Email</span>
                                            <span class="text-gray-800 font-medium">{{ $cvData['personal_info']['email'] }}</span>
                                        </div>
                                        @endif

                                        @if(isset($cvData['personal_info']['phone']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">Phone</span>
                                            <span class="text-gray-800 font-medium">{{ $cvData['personal_info']['phone'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="space-y-3">
                                        @if(isset($cvData['personal_info']['address']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">Address</span>
                                            <span class="text-gray-800 font-medium">{{ $cvData['personal_info']['address'] }}</span>
                                        </div>
                                        @endif

                                        @if(isset($cvData['personal_info']['linkedin']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">LinkedIn</span>
                                            <a href="{{ $cvData['personal_info']['linkedin'] }}" target="_blank" class="text-blue-600 font-medium hover:underline">{{ $cvData['personal_info']['linkedin'] }}</a>
                                        </div>
                                        @endif

                                        @if(isset($cvData['personal_info']['website']))
                                        <div>
                                            <span class="text-gray-500 text-sm block">Website</span>
                                            <a href="{{ $cvData['personal_info']['website'] }}" target="_blank" class="text-blue-600 font-medium hover:underline">{{ $cvData['personal_info']['website'] }}</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Skills Section -->
                    @if(isset($cvData['skills']) && count($cvData['skills']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Skills
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($cvData['skills'] as $skill)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Experience Section -->
                    @if(isset($cvData['experience']) && count($cvData['experience']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Work Experience
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            <div class="space-y-6">
                                @foreach($cvData['experience'] as $experience)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-2">
                                            <div>
                                                <h3 class="text-gray-900 font-medium">{{ $experience['title'] ?? 'Position' }}</h3>
                                                <p class="text-gray-600">{{ $experience['company'] ?? 'Company' }}</p>
                                            </div>
                                            <div class="text-gray-500 text-sm mt-1 md:mt-0 md:text-right">
                                                {{ $experience['start_date'] ?? '' }} 
                                                @if(isset($experience['end_date']))
                                                    - {{ $experience['end_date'] }}
                                                @else
                                                    - Present
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($experience['description']))
                                            <p class="text-gray-700 text-sm mt-2">{{ $experience['description'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Education Section -->
                    @if(isset($cvData['education']) && count($cvData['education']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                                </svg>
                                Education
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            <div class="space-y-6">
                                @foreach($cvData['education'] as $education)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-2">
                                            <div>
                                                <h3 class="text-gray-900 font-medium">{{ $education['degree'] ?? 'Degree' }}</h3>
                                                <p class="text-gray-600">{{ $education['institution'] ?? 'Institution' }}</p>
                                            </div>
                                            <div class="text-gray-500 text-sm mt-1 md:mt-0 md:text-right">
                                                {{ $education['start_date'] ?? '' }} 
                                                @if(isset($education['end_date']))
                                                    - {{ $education['end_date'] }}
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($education['field_of_study']))
                                            <p class="text-gray-700 text-sm mt-2">{{ $education['field_of_study'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Certifications Section -->
                    @if(isset($cvData['certifications']) && count($cvData['certifications']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Certifications
                            </span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200 p-4">
                            <div class="space-y-4">
                                @foreach($cvData['certifications'] as $certification)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        @if(is_array($certification))
                                            <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                                <div>
                                                    <h3 class="text-gray-900 font-medium">{{ $certification['name'] ?? 'Certification' }}</h3>
                                                    @if(isset($certification['issuer']))
                                                        <p class="text-gray-600">{{ $certification['issuer'] }}</p>
                                                    @endif
                                                </div>
                                                @if(isset($certification['date']))
                                                    <div class="text-gray-500 text-sm mt-1 md:mt-0">{{ $certification['date'] }}</div>
                                                @endif
                                            </div>
                                        @else
                                            <div>
                                                <h3 class="text-gray-900 font-medium">{{ $certification }}</h3>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            @if($jobApplication->cover_letter)
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-3">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Cover Letter
                </h2>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    {!! nl2br(e($jobApplication->cover_letter)) !!}
                </div>
            </div>
            @endif
            
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-3">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Uploaded CV
                </h2>
                <a href="{{ asset('storage/cv_files/' . $jobApplication->cv_filename) }}" class="inline-flex items-center px-4 py-2 border border-[#191A23] rounded-xl shadow-sm text-sm font-medium text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors" target="_blank" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download CV
                </a>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Applications
                </a>
                <a href="{{ route('recruiter.job-positions.show', $jobApplication->jobPosition) }}" class="inline-flex items-center px-4 py-2 border border-[#191A23] rounded-xl shadow-sm text-sm font-medium text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Job Position
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 