@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<!-- Header Section -->
<div class="relative mb-6">
    <div class="absolute inset-0 bg-green-600 opacity-10 rounded-2xl"></div>
    <div class="relative z-10 p-5 sm:p-6 md:p-8 bg-white rounded-lg shadow-sm border border-green-100 overflow-hidden">
        <!-- Header Background Pattern -->
        <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
            <svg width="200" height="200" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-green-50">
                <circle cx="150" cy="150" r="150" fill="currentColor"/>
                <circle cx="150" cy="150" r="120" fill="white"/>
                <circle cx="150" cy="150" r="100" fill="currentColor"/>
                <circle cx="150" cy="150" r="80" fill="white"/>
                <circle cx="150" cy="150" r="60" fill="currentColor"/>
            </svg>
        </div>

        <div class="flex flex-col md:flex-row md:items-start gap-6">
            <div class="flex-shrink-0">
                <div class="p-3 bg-[#B9FF66] rounded-lg shadow-md w-16 h-16 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#B9FF66]/20 text-[#191A23]">
                            Dashboard
                        </span>
                        <h1 class="mt-2 text-2xl sm:text-3xl font-bold text-[#191A23] tracking-tight">Recruiter Dashboard</h1>
                        <p class="mt-1 text-base text-gray-600">Manage job positions and applications from potential candidates</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-all duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-green-600 text-white mr-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total Job Positions</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalJobPositions }}</h3>
                    <span class="text-sm text-green-600 font-medium">positions</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-amber-100 p-6 hover:shadow-md transition-all duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-amber-500 text-white mr-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Active Job Positions</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $activeJobPositions }}</h3>
                    <span class="text-sm text-amber-600 font-medium">active</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-all duration-200">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-blue-600 text-white mr-4 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Total Applications</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $totalApplications }}</h3>
                    <span class="text-sm text-blue-600 font-medium">applications</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('recruiter.job-positions.create') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-green-200 transition-all duration-200 group">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-700 transition-colors">Post New Job</h3>
                <p class="text-gray-500 text-sm">Create a new job position</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('recruiter.cv-extraction') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-green-200 transition-all duration-200 group">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-700 transition-colors">Extract CV</h3>
                <p class="text-gray-500 text-sm">Process a CV with AI</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('recruiter.applications.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-green-200 transition-all duration-200 group">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-green-100 text-green-600 group-hover:bg-green-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-700 transition-colors">View Applications</h3>
                <p class="text-gray-500 text-sm">Manage candidate applications</p>
            </div>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Recent Job Positions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Recent Job Positions
            </h2>
            <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800 transition-colors">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($recentJobPositions as $jobPosition)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $jobPosition->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $jobPosition->company_name }} • {{ $jobPosition->location }}</p>
                    </div>
                    <div>
                        @if($jobPosition->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Active</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">Inactive</span>
                        @endif
                    </div>
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <span class="text-xs text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Posted {{ $jobPosition->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" class="inline-flex items-center px-3 py-1.5 border border-green-600 text-xs font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-green-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 mb-4">No job positions yet.</p>
                <a href="{{ route('recruiter.job-positions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Applications -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Candidate Activity
            </h2>
            <div class="flex space-x-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $totalApplications }} Applications
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    {{ $totalCompatibilityChecks }} CV Checks
                </span>
            </div>
        </div>
        
        <!-- Tabs Navigation -->
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px" aria-label="Tabs">
                <button id="tab-applications" class="tab-button w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-green-500 text-green-600" aria-current="page">
                    Applications
                </button>
                <button id="tab-compatibility" class="tab-button w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Compatibility Checks
                </button>
            </nav>
        </div>
        
        <!-- Applications Tab Content -->
        <div id="tab-content-applications" class="tab-content divide-y divide-gray-100">
            @forelse($recentApplications as $application)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $application->jobSeeker->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Applied for: {{ $application->jobPosition->title }}</p>
                    </div>
                    <div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'reviewed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'shortlisted' => 'bg-green-100 text-green-800 border-green-200',
                                'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                'hired' => 'bg-purple-100 text-purple-800 border-purple-200',
                            ];
                            $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }} border">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <span class="text-xs text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('recruiter.applications.show', $application->id) }}" class="inline-flex items-center px-3 py-1.5 border border-green-600 text-xs font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors">
                        View Application
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-green-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 mb-4">No applications yet.</p>
                <a href="{{ route('recruiter.job-positions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
        
        <!-- Compatibility Checks Tab Content -->
        <div id="tab-content-compatibility" class="tab-content divide-y divide-gray-100 hidden">
            @forelse($compatibilityChecks as $check)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $check->user->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Checked compatibility for: {{ $check->jobPosition->title }}</p>
                    </div>
                    <div>
                        @php
                            $score = $check->compatibility_score;
                            $scoreClass = 'bg-gray-100 text-gray-800 border-gray-200';
                            if ($score >= 80) {
                                $scoreClass = 'bg-green-100 text-green-800 border-green-200';
                            } elseif ($score >= 60) {
                                $scoreClass = 'bg-blue-100 text-blue-800 border-blue-200';
                            } elseif ($score >= 40) {
                                $scoreClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                            } else {
                                $scoreClass = 'bg-red-100 text-red-800 border-red-200';
                            }
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $scoreClass }} border">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $score }}% Match
                        </span>
                    </div>
                </div>
                
                <!-- Skills Summary -->
                <div class="mt-2">
                    @if(!empty($check->matched_skills))
                    <div class="mt-2 flex flex-wrap gap-1">
                        @php
                            $matchedSkills = is_array($check->matched_skills) ? $check->matched_skills : json_decode($check->matched_skills, true);
                            $matchedSkills = is_array($matchedSkills) ? array_slice($matchedSkills, 0, 3) : [];
                        @endphp
                        
                        @foreach($matchedSkills as $skill)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-700">
                            {{ $skill }}
                        </span>
                        @endforeach
                        
                        @if(is_array($matchedSkills) && count($matchedSkills) > 3)
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-700">
                            +{{ count($matchedSkills) - 3 }} more
                        </span>
                        @endif
                    </div>
                    @endif
                </div>
                
                <div class="mt-3 flex justify-between items-center">
                    <span class="text-xs text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Checked {{ $check->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-purple-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 mb-2">No compatibility checks yet.</p>
                <p class="text-gray-500 text-sm mb-4">Job seekers haven't checked compatibility with your job postings.</p>
            </div>
            @endforelse
        </div>
        
        <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 text-right">
            <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800 transition-colors">
                View All Activity
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
    
    <!-- Tab switching script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get the target tab content id
                    const tabId = this.id.replace('tab-', 'tab-content-');
                    
                    // Deactivate all tabs
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-green-500', 'text-green-600');
                        btn.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Activate current tab
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-green-500', 'text-green-600');
                    
                    // Show current tab content
                    document.getElementById(tabId).classList.remove('hidden');
                });
            });
        });
    </script>
</div>
@endsection 