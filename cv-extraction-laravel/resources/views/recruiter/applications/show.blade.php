@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Applications
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-green-800 font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    
    @if(session('error'))
    <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-red-800 font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Application Card -->
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
        <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-50">
                <circle cx="150" cy="150" r="150" fill="currentColor"/>
                <circle cx="150" cy="150" r="120" fill="white"/>
                <circle cx="150" cy="150" r="100" fill="currentColor"/>
                <circle cx="150" cy="150" r="80" fill="white"/>
                <circle cx="150" cy="150" r="60" fill="currentColor"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="px-6 py-5 border-b border-gray-200 bg-indigo-600">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $jobApplication->jobPosition->title }}</h2>
                        <div class="mt-2 flex items-center text-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>{{ $jobApplication->jobPosition->company_name ?? 'Your Company' }}</span>
                        </div>
                        <div class="mt-1 flex items-center text-indigo-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $jobApplication->jobPosition->location ?? 'Remote' }}</span>
                        </div>
                    </div>
                    
                    @if($jobApplication->compatibility_score)
                    <div class="bg-white rounded-lg p-4 w-40 h-40 flex flex-col items-center justify-center shadow-md border border-gray-200">
                        <div class="relative h-24 w-24">
                            <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 100 100">
                                <circle class="text-gray-200" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10" />
                                <circle
                                    class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-500' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-500' : 'text-red-500') }}"
                                    cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10"
                                    stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-700' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-700' : 'text-red-700') }} text-2xl font-bold" style="text-shadow: 0 0 2px white, 0 0 2px white, 0 0 2px white, 0 0 2px white;">{{ $jobApplication->compatibility_score }}%</span>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <span class="text-gray-800 text-sm font-medium">Candidate Match</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="px-6 py-5">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $jobApplication->jobSeeker->name }}</h3>
                        <p class="text-md text-gray-600">{{ $jobApplication->jobSeeker->email }}</p>
                        <p class="text-sm text-gray-500">Applied {{ $jobApplication->created_at->format('M d, Y') }} ({{ $jobApplication->created_at->diffForHumans() }})</p>
                    </div>
                    <div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'in_review' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'accepted' => 'bg-green-100 text-green-800 border-green-200',
                                'rejected' => 'bg-red-100 text-red-800 border-red-200'
                            ];
                            $statusColor = $statusColors[$jobApplication->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                        @endphp
                        <span class="inline-block {{ $statusColor }} px-3 py-1 rounded-lg text-sm border font-medium">
                            {{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST" class="bg-gray-50 rounded-lg p-5 border border-gray-200 mb-6">
                            @csrf
                            @method('PATCH')
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Application Status</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select id="status" name="status" class="rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 w-full">
                                        <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_review" {{ $jobApplication->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                                        <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                
                                <div class="flex items-end">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full md:w-auto">
                                        Update Status
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <label for="recruiter_notes" class="block text-sm font-medium text-gray-700 mb-1">Feedback to Candidate (Optional)</label>
                                <textarea id="recruiter_notes" name="recruiter_notes" rows="3" class="rounded-lg border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500 w-full" placeholder="Add notes or feedback for the candidate...">{{ $jobApplication->recruiter_notes }}</textarea>
                            </div>
                        </form>

                        <!-- CV Basic Information -->
                        @php
                            $cvData = null;
                            if ($jobApplication->cv_data) {
                                if (is_string($jobApplication->cv_data)) {
                                    try {
                                        $cvData = json_decode($jobApplication->cv_data, true);
                                    } catch (\Exception $e) {
                                        $cvData = null;
                                    }
                                } else {
                                    $cvData = $jobApplication->cv_data;
                                }
                            }
                        @endphp

                        @if($cvData)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                            <div class="px-5 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-white">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Candidate Overview
                                </h3>
                            </div>
                            <div class="p-5">
                                <!-- Summary/Profile if available -->
                                @if(isset($cvData['summary']) && !empty($cvData['summary']))
                                <div class="mb-5">
                                    <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-2">Professional Summary</h4>
                                    <div class="text-gray-700 text-sm bg-gray-50 p-4 rounded-lg border border-gray-100">
                                        {{ $cvData['summary'] }}
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Key Skills Section -->
                                @if(isset($cvData['skills']) && !empty($cvData['skills']) && is_array($cvData['skills']))
                                <div class="mb-5">
                                    <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-2">Key Skills</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($cvData['skills'] as $skill)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                {{ is_string($skill) ? $skill : (isset($skill['name']) ? $skill['name'] : '') }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Contact Information -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                                    @if(isset($cvData['email']) && !empty($cvData['email']))
                                    <div>
                                        <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-1">Email</h4>
                                        <a href="mailto:{{ $cvData['email'] }}" class="text-blue-600 hover:underline">{{ $cvData['email'] }}</a>
                                    </div>
                                    @endif
                                    
                                    @if(isset($cvData['phone']) && !empty($cvData['phone']))
                                    <div>
                                        <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-1">Phone</h4>
                                        <p>{{ $cvData['phone'] }}</p>
                                    </div>
                                    @endif
                                    
                                    @if(isset($cvData['linkedin']) && !empty($cvData['linkedin']))
                                    <div>
                                        <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-1">LinkedIn</h4>
                                        <a href="{{ $cvData['linkedin'] }}" target="_blank" class="text-blue-600 hover:underline">{{ $cvData['linkedin'] }}</a>
                                    </div>
                                    @endif
                                    
                                    @if(isset($cvData['location']) || isset($cvData['address']))
                                    <div>
                                        <h4 class="text-sm uppercase tracking-wide text-gray-500 font-medium mb-1">Location</h4>
                                        <p>{{ $cvData['location'] ?? $cvData['address'] ?? 'Not specified' }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <div>
                        <!-- Compatibility Score Card -->
                        @if($jobApplication->compatibility_score)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                            <div class="px-5 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-white">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Match Analysis
                                </h3>
                            </div>
                            <div class="p-5 text-center">
                                <div class="inline-flex items-center justify-center">
                                    <div class="relative h-32 w-32">
                                        <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 100 100">
                                            <circle class="text-gray-200" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8" />
                                            <circle
                                                class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-500' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-500' : 'text-red-500') }}"
                                                cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8"
                                                stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283"
                                                stroke-linecap="round"
                                            />
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-600' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-600' : 'text-red-600') }} text-2xl font-bold">{{ $jobApplication->compatibility_score }}%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4 class="font-medium text-lg text-gray-900">
                                        {{ $jobApplication->compatibility_score >= 70 ? 'Strong Match' : ($jobApplication->compatibility_score >= 40 ? 'Good Potential' : 'Low Match') }}
                                    </h4>
                                    <p class="text-gray-500 text-sm mt-1">Based on skills, experience, and education requirements</p>
                                </div>
                                
                                <!-- Additional compatibility data if available -->
                                @if(isset($jobApplication->compatibility_analysis) && !empty($jobApplication->compatibility_analysis))
                                @php
                                    $compatibilityData = is_array($jobApplication->compatibility_analysis) 
                                        ? $jobApplication->compatibility_analysis 
                                        : json_decode($jobApplication->compatibility_analysis, true);
                                @endphp
                                
                                @if(is_array($compatibilityData) && !empty($compatibilityData))
                                <div class="mt-6 border-t border-gray-200 pt-4">
                                    <div class="text-left">
                                        @if(isset($compatibilityData['reasoning']))
                                        <div class="mb-4">
                                            <h5 class="text-sm font-medium text-gray-700 mb-1">Analysis</h5>
                                            <p class="text-sm text-gray-600">{{ $compatibilityData['reasoning'] }}</p>
                                        </div>
                                        @endif
                                        
                                        <!-- Skills Breakdown -->
                                        @if(isset($compatibilityData['skills_analysis']) || isset($compatibilityData['matched_skills']) || isset($compatibilityData['missing_skills']))
                                        <div class="mb-4">
                                            <h5 class="text-sm font-medium text-gray-700 mb-1">Skills Breakdown</h5>
                                            
                                            @php
                                                $skillsData = $compatibilityData['skills_analysis'] ?? $compatibilityData;
                                                $matchedSkills = $skillsData['matched_skills'] ?? [];
                                                $missingSkills = $skillsData['missing_skills'] ?? [];
                                                $skillsScore = $skillsData['skills_match_score'] ?? null;
                                            @endphp
                                            
                                            @if($skillsScore !== null)
                                            <div class="flex items-center mb-2">
                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $skillsScore }}%"></div>
                                                </div>
                                                <span class="ml-2 text-sm font-medium text-gray-700">{{ $skillsScore }}%</span>
                                            </div>
                                            @endif
                                            
                                            <div class="grid grid-cols-2 gap-2 text-sm">
                                                <div>
                                                    <span class="text-green-600 font-medium">✓ Matched:</span> 
                                                    {{ count($matchedSkills) }}
                                                </div>
                                                <div>
                                                    <span class="text-red-600 font-medium">✗ Missing:</span> 
                                                    {{ count($missingSkills) }}
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Application Details Card -->
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                            <div class="px-5 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Application Details
                                </h3>
                            </div>
                            <div class="p-5">
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Application ID</span>
                                        <span class="text-sm text-gray-900">#{{ $jobApplication->id }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Submitted</span>
                                        <span class="text-sm text-gray-900">{{ $jobApplication->created_at->format('M d, Y, g:i a') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">CV Filename</span>
                                        <span class="text-sm text-gray-900 max-w-[180px] truncate">{{ $jobApplication->cv_filename }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Position</span>
                                        <span class="text-sm text-gray-900">{{ $jobApplication->jobPosition->title }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-500">Company</span>
                                        <span class="text-sm text-gray-900">{{ $jobApplication->jobPosition->company_name ?? 'Your Company' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cover Letter Section (if exists) -->
    @if($jobApplication->cover_letter)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
            <h3 class="text-base font-medium text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Cover Letter
            </h3>
        </div>
        <div class="px-6 py-4">
            <div class="p-4 rounded-lg prose max-w-none bg-gray-50 border border-gray-100">
                {!! nl2br(e($jobApplication->cover_letter)) !!}
            </div>
        </div>
    </div>
    @endif

    <!-- CV Data Section - Enhanced with Detailed Information -->
    @if($cvData)
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
        <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block opacity-30">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-blue-50">
                <circle cx="150" cy="150" r="150" fill="currentColor"/>
                <circle cx="150" cy="150" r="120" fill="white"/>
                <circle cx="150" cy="150" r="100" fill="currentColor"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Candidate CV Information
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Detailed extracted data from candidate's resume</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-blue-800">
                        Resume Data
                    </span>
                </div>
            </div>

            <div class="px-6 py-5">
                {{-- Personal Information --}}
                @if(isset($cvData['name']) || isset($cvData['email']) || isset($cvData['phone']) || isset($cvData['location']) || isset($cvData['address']) || isset($cvData['summary']) || isset($cvData['profile']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                    </div>
                    
                    <div class="bg-gradient-to-br from-white to-blue-50 rounded-lg p-5 border border-blue-100 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if(isset($cvData['name']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Name</span>
                                <span class="text-md text-gray-900 font-medium">{{ $cvData['name'] }}</span>
                            </div>
                            @endif
                            
                            @if(isset($cvData['email']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Email</span>
                                <a href="mailto:{{ $cvData['email'] }}" class="text-md text-blue-600 hover:text-blue-800 transition">{{ $cvData['email'] }}</a>
                            </div>
                            @endif
                            
                            @if(isset($cvData['phone']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Phone</span>
                                <span class="text-md text-gray-900">{{ $cvData['phone'] }}</span>
                            </div>
                            @endif
                            
                            @if(isset($cvData['location']) || isset($cvData['address']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Location</span>
                                <span class="text-md text-gray-900">{{ $cvData['location'] ?? $cvData['address'] ?? '' }}</span>
                            </div>
                            @endif
                            
                            @if(isset($cvData['linkedin']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">LinkedIn</span>
                                <a href="{{ $cvData['linkedin'] }}" target="_blank" class="text-md text-blue-600 hover:text-blue-800 transition">{{ $cvData['linkedin'] }}</a>
                            </div>
                            @endif
                            
                            @if(isset($cvData['github']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">GitHub</span>
                                <a href="{{ $cvData['github'] }}" target="_blank" class="text-md text-blue-600 hover:text-blue-800 transition">{{ $cvData['github'] }}</a>
                            </div>
                            @endif
                        </div>
                        
                        @if(isset($cvData['summary']) || isset($cvData['profile']))
                        <div class="mt-6">
                            <span class="text-sm font-medium text-gray-500 mb-1 block">Professional Summary</span>
                            <p class="text-gray-800 mt-2 bg-white p-4 rounded-lg border border-blue-100 leading-relaxed">
                                {{ $cvData['summary'] ?? $cvData['profile'] ?? '' }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                {{-- Skills Section --}}
                @if(isset($cvData['skills']) && !empty($cvData['skills']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Skills</h3>
                    </div>
                    
                    <div class="bg-gradient-to-br from-white to-indigo-50 rounded-lg p-5 border border-indigo-100 shadow-sm">
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach((is_array($cvData['skills']) ? $cvData['skills'] : [$cvData['skills']]) as $skill)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200 shadow-sm">
                                    {{ is_array($skill) ? ($skill['name'] ?? $skill[0] ?? '') : $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                {{-- Work Experience --}}
                @if(isset($cvData['work_experience']) || isset($cvData['experience']) || isset($cvData['employment_history']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-purple-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Work Experience</h3>
                    </div>
                    
                    @php
                        $experiences = $cvData['work_experience'] ?? $cvData['experience'] ?? $cvData['employment_history'] ?? [];
                        if (!is_array($experiences)) {
                            $experiences = [$experiences];
                        }
                    @endphp
                    
                    <div class="space-y-5">
                        @foreach($experiences as $experience)
                            <div class="bg-gradient-to-br from-white to-purple-50 rounded-lg p-5 border border-purple-100 shadow-sm hover:shadow-md transition-shadow">
                                @if(is_array($experience))
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-lg">
                                                {{ $experience['title'] ?? $experience['position'] ?? $experience['job_title'] ?? 'Position' }}
                                            </h4>
                                            <p class="text-sm text-purple-700 font-medium">
                                                {{ $experience['company'] ?? $experience['employer'] ?? $experience['organization'] ?? 'Company' }}
                                            </p>
                                        </div>
                                        <div class="mt-2 md:mt-0 bg-white px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-purple-100 inline-flex items-center shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $experience['date'] ?? $experience['duration'] ?? ($experience['start_date'] ?? '') . ' - ' . ($experience['end_date'] ?? 'Present') }}
                                        </div>
                                    </div>
                                    @if(isset($experience['description']) || isset($experience['responsibilities']))
                                        <p class="mt-3 text-sm text-gray-700 whitespace-pre-line bg-white p-4 rounded-lg border border-purple-100 leading-relaxed">
                                            {{ $experience['description'] ?? $experience['responsibilities'] ?? '' }}
                                        </p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-700">{{ $experience }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Education --}}
                @if(isset($cvData['education']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Education</h3>
                    </div>
                    
                    @php
                        $educations = $cvData['education'];
                        if (!is_array($educations)) {
                            $educations = [$educations];
                        }
                    @endphp
                    
                    <div class="space-y-5">
                        @foreach($educations as $education)
                            <div class="bg-gradient-to-br from-white to-green-50 rounded-lg p-5 border border-green-100 shadow-sm hover:shadow-md transition-shadow">
                                @if(is_array($education))
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-lg">
                                                {{ $education['degree'] ?? $education['qualification'] ?? 'Degree' }}
                                            </h4>
                                            <p class="text-sm text-green-700 font-medium">
                                                {{ $education['institution'] ?? $education['school'] ?? $education['university'] ?? 'Institution' }}
                                            </p>
                                            @if(isset($education['field_of_study']) && !empty($education['field_of_study']))
                                            <p class="text-sm text-gray-600">{{ $education['field_of_study'] }}</p>
                                            @endif
                                        </div>
                                        <div class="mt-2 md:mt-0 bg-white px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-green-100 inline-flex items-center shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $education['date'] ?? ($education['start_date'] ?? '') . ' - ' . ($education['end_date'] ?? '') }}
                                        </div>
                                    </div>
                                    @if(isset($education['description']))
                                        <p class="mt-3 text-sm text-gray-700 bg-white p-4 rounded-lg border border-green-100 leading-relaxed">
                                            {{ $education['description'] }}
                                        </p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-700">{{ $education }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Projects Section --}}
                @if(isset($cvData['projects']) && !empty($cvData['projects']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-amber-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Projects</h3>
                    </div>
                    
                    @php
                        $projects = $cvData['projects'];
                        if (!is_array($projects)) {
                            $projects = [$projects];
                        }
                    @endphp
                    
                    <div class="space-y-5">
                        @foreach($projects as $project)
                            <div class="bg-gradient-to-br from-white to-amber-50 rounded-lg p-5 border border-amber-100 shadow-sm hover:shadow-md transition-shadow">
                                @if(is_array($project))
                                    <div class="flex flex-col">
                                        <h4 class="font-medium text-gray-900 text-lg">
                                            {{ $project['name'] ?? $project['title'] ?? 'Project' }}
                                        </h4>
                                        
                                        @if(isset($project['description']) && !empty($project['description']))
                                            <p class="mt-3 text-sm text-gray-700 bg-white p-4 rounded-lg border border-amber-100 leading-relaxed">
                                                {{ $project['description'] }}
                                            </p>
                                        @endif
                                        
                                        @if(isset($project['technologies']) && is_array($project['technologies']) && !empty($project['technologies']))
                                            <div class="mt-3">
                                                <span class="text-sm font-medium text-gray-500 mb-1 block">Technologies Used</span>
                                                <div class="flex flex-wrap gap-1.5 mt-1">
                                                    @foreach($project['technologies'] as $tech)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                            {{ $tech }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-700">{{ $project }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Certifications Section --}}
                @if(isset($cvData['certifications']) && !empty($cvData['certifications']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-teal-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Certifications</h3>
                    </div>
                    
                    @php
                        $certifications = $cvData['certifications'];
                        if (!is_array($certifications)) {
                            $certifications = [$certifications];
                        }
                    @endphp
                    
                    <div class="space-y-5">
                        @foreach($certifications as $cert)
                            <div class="bg-gradient-to-br from-white to-teal-50 rounded-lg p-5 border border-teal-100 shadow-sm hover:shadow-md transition-shadow">
                                @if(is_array($cert))
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-lg">
                                                {{ $cert['name'] ?? $cert['title'] ?? 'Certification' }}
                                            </h4>
                                            @if(isset($cert['issuer']) || isset($cert['authority']) || isset($cert['organization']))
                                                <p class="text-sm text-teal-700 font-medium">
                                                    {{ $cert['issuer'] ?? $cert['authority'] ?? $cert['organization'] ?? '' }}
                                                </p>
                                            @endif
                                        </div>
                                        @if(isset($cert['date']) || isset($cert['year']) || isset($cert['issued_date']))
                                            <div class="mt-2 md:mt-0 bg-white px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-teal-100 inline-flex items-center shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $cert['date'] ?? $cert['year'] ?? $cert['issued_date'] ?? '' }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-700">{{ $cert }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Languages Section --}}
                @if(isset($cvData['languages']) && !empty($cvData['languages']))
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-pink-100 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7 2a1 1 0 011 1v1h3a1 1 0 110 2H9.578a18.87 18.87 0 01-1.724 4.78c.29.354.596.696.914 1.026a1 1 0 11-1.44 1.389c-.188-.196-.373-.396-.554-.6a19.098 19.098 0 01-3.107 3.567 1 1 0 01-1.334-1.49 17.087 17.087 0 003.13-3.733 18.992 18.992 0 01-1.487-2.494 1 1 0 111.79-.89c.234.47.489.928.764 1.372.417-.934.752-1.913.997-2.927H3a1 1 0 110-2h3V3a1 1 0 011-1zm6 6a1 1 0 01.894.553l2.991 5.982a.869.869 0 01.02.037l.99 1.98a1 1 0 11-1.79.895L15.383 16h-4.764l-.724 1.447a1 1 0 11-1.788-.894l.99-1.98.019-.038 2.99-5.982A1 1 0 0113 8zm-1.382 6h2.764L13 11.236 11.618 14z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Languages</h3>
                    </div>
                    
                    <div class="bg-gradient-to-br from-white to-pink-50 rounded-lg p-5 border border-pink-100 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach((is_array($cvData['languages']) ? $cvData['languages'] : [$cvData['languages']]) as $language)
                                @if(is_array($language))
                                    <div class="flex justify-between items-center bg-white p-3 rounded-lg border border-pink-100">
                                        <span class="font-medium text-gray-800">
                                            {{ $language['language'] ?? $language['name'] ?? 'Language' }}
                                        </span>
                                        @if(isset($language['level']) || isset($language['proficiency']))
                                            <span class="text-sm text-pink-700 bg-pink-50 px-3 py-1 rounded-full">
                                                {{ $language['level'] ?? $language['proficiency'] ?? '' }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="bg-white p-3 rounded-lg border border-pink-100">
                                        <span class="font-medium text-gray-800">{{ $language }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                {{-- Additional Sections --}}
                @foreach($cvData as $key => $value)
                    @if(!in_array($key, ['name', 'email', 'phone', 'location', 'address', 'summary', 'profile', 'skills', 'work_experience', 'experience', 'employment_history', 'education', 'projects', 'certifications', 'languages', 'cv_data', 'error']) && !empty($value))
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="p-2 bg-gray-100 rounded-lg mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ ucwords(str_replace('_', ' ', $key)) }}</h3>
                            </div>
                            
                            <div class="bg-gradient-to-br from-white to-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                                @if(is_array($value))
                                    <div class="space-y-3">
                                        @foreach($value as $item)
                                            @if(is_array($item) || is_object($item))
                                                <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                                                    @foreach($item as $itemKey => $itemValue)
                                                        @if(!is_array($itemValue) && !is_object($itemValue))
                                                            <div class="mb-2">
                                                                <span class="text-sm font-medium text-gray-500">{{ ucwords(str_replace('_', ' ', $itemKey)) }}:</span>
                                                                <span class="text-sm text-gray-900 ml-1">{{ $itemValue }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-700 py-2 px-3 bg-white rounded-lg border border-gray-100">{{ $item }}</div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-700 p-4 bg-white rounded-lg border border-gray-100">{{ $value }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-between mt-8">
        <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
            Back to Applications
        </a>
        
        <div class="space-x-4">
            <a href="{{ route('recruiter.job-positions.show', $jobApplication->jobPosition) }}" class="inline-flex items-center px-4 py-2 border border-blue-600 text-sm font-medium rounded-lg text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                View Job Position
            </a>
            
            <!-- View Candidate's CV File (if applicable) -->
            @if($jobApplication->cv_filename)
            <a href="{{ asset('storage/cvs/' . $jobApplication->cv_filename) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-lg text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View Original CV
            </a>
            @endif
        </div>
    </div>
</div>
@endsection 