@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<!-- Modern Header Section -->
<div class="relative mb-8">
    <div class="absolute inset-0 bg-gradient-to-r from-[#B9FF66]/20 to-green-50 rounded-3xl"></div>
    <div class="relative z-10 p-6 sm:p-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-green-100/50">
        <div class="flex flex-col md:flex-row md:items-center gap-6">
            <div class="flex-shrink-0">
                <div class="p-4 bg-gradient-to-br from-[#B9FF66] to-green-400 rounded-2xl shadow-lg w-20 h-20 flex items-center justify-center transform hover:scale-105 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#B9FF66]/30">
                            Welcome Back
                        </span>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-bold text-[#191A23] tracking-tight">Recruiter Dashboard</h1>
                        <p class="mt-2 text-base text-gray-600">Manage your recruitment process efficiently</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Job Positions Card -->
    <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-green-500 to-green-600 text-white mr-4 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Job Positions</p>
                <div class="flex items-baseline space-x-2">
                    <h3 class="text-3xl font-bold text-gray-900">{{ $totalJobPositions }}</h3>
                    <span class="text-sm text-green-600 font-medium">positions</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Job Positions Card -->
    <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 text-white mr-4 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Active Job Positions</p>
                <div class="flex items-baseline space-x-2">
                    <h3 class="text-3xl font-bold text-gray-900">{{ $activeJobPositions }}</h3>
                    <span class="text-sm text-amber-600 font-medium">active</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Applications Card -->
    <div class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white mr-4 shadow-md transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Applications</p>
                <div class="flex items-baseline space-x-2">
                    <h3 class="text-3xl font-bold text-gray-900">{{ $totalApplications }}</h3>
                    <span class="text-sm text-blue-600 font-medium">applications</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Post New Job Card -->
    <a href="{{ route('recruiter.job-positions.create') }}" 
       class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-green-100 to-green-50 text-green-600 mr-4 shadow-sm transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-700 transition-colors">Post New Job</h3>
                <p class="text-gray-500 text-sm mt-1">Create a new job position</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-green-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
    </a>
    
    <!-- Extract CV Card -->
    <a href="{{ route('recruiter.cv-extraction') }}" 
       class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 mr-4 shadow-sm transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">Extract CV</h3>
                <p class="text-gray-500 text-sm mt-1">Process a CV with AI</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
    </a>
    
    <!-- View Applications Card -->
    <a href="{{ route('recruiter.applications.index') }}" 
       class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative flex items-center">
            <div class="p-4 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 text-purple-600 mr-4 shadow-sm transform group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-700 transition-colors">View Applications</h3>
                <p class="text-gray-500 text-sm mt-1">Manage candidate applications</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-purple-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Recent Job Positions -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">Recent Job Positions</h2>
            </div>
            <a href="{{ route('recruiter.job-positions.create') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-600 hover:text-green-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Position
            </a>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($recentJobPositions as $jobPosition)
            <div class="p-6 hover:bg-gray-50 transition-colors group">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-base font-semibold text-gray-900 truncate group-hover:text-green-600 transition-colors">
                                {{ $jobPosition->title }}
                            </h3>
                            @if($jobPosition->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                Active
                            </span>
                            @endif
                        </div>
                        
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm bg-gray-50 text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                {{ $jobPosition->company_name }}
                            </span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm bg-gray-50 text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $jobPosition->location }}
                            </span>
                        </div>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="inline-flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $jobPosition->created_at->diffForHumans() }}
                                </span>
                                <span class="inline-flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $jobPosition->applications_count ?? 0 }} Applications
                                </span>
                            </div>
                            <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-600 hover:text-green-700 transition-colors">
                                View Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
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
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Candidate Activity -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">Candidate Activity</h2>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $totalApplications }} Applications
                </span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    {{ $totalCompatibilityChecks }} CV Checks
                </span>
            </div>
        </div>
        
        <!-- Tabs Navigation -->
        <div class="border-b border-gray-100">
            <nav class="flex -mb-px" aria-label="Tabs">
                <button id="tab-applications" 
                        class="tab-button w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-green-500 text-green-600 hover:bg-green-50 transition-colors" 
                        aria-current="page">
                    Applications
                </button>
                <button id="tab-compatibility" 
                        class="tab-button w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors">
                    Compatibility Checks
                </button>
            </nav>
        </div>
        
        <!-- Applications Tab Content -->
        <div id="tab-content-applications" class="tab-content divide-y divide-gray-100">
            @forelse($recentApplications as $application)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-base font-semibold text-gray-900 truncate">
                                {{ $application->jobSeeker->name }}
                            </h3>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'reviewed' => 'bg-blue-100 text-blue-800',
                                    'shortlisted' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    'hired' => 'bg-purple-100 text-purple-800',
                                ];
                                $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-600">
                            Applied for: <span class="font-medium text-gray-900">{{ $application->jobPosition->title }}</span>
                        </p>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="inline-flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $application->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <a href="{{ route('recruiter.applications.show', $application->id) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-600 hover:text-green-700 transition-colors">
                                View Application
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-blue-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 mb-4">No applications yet.</p>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
        
        <!-- Compatibility Checks Tab Content -->
        <div id="tab-content-compatibility" class="tab-content divide-y divide-gray-100 hidden">
            @forelse($compatibilityChecks as $check)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-base font-semibold text-gray-900 truncate">
                                {{ $check->user->name }}
                            </h3>
                            @php
                                $score = $check->compatibility_score;
                                $scoreClass = 'bg-gray-100 text-gray-800';
                                if ($score >= 80) {
                                    $scoreClass = 'bg-green-100 text-green-800';
                                } elseif ($score >= 60) {
                                    $scoreClass = 'bg-blue-100 text-blue-800';
                                } elseif ($score >= 40) {
                                    $scoreClass = 'bg-yellow-100 text-yellow-800';
                                } else {
                                    $scoreClass = 'bg-red-100 text-red-800';
                                }
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $scoreClass }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $score }}% Match
                            </span>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-600">
                            Checked for: <span class="font-medium text-gray-900">{{ $check->jobPosition->title }}</span>
                        </p>
                        
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
                        
                        <div class="mt-3 flex items-center justify-between">
                            <span class="inline-flex items-center text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $check->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
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
                <p class="text-gray-500 text-sm">Job seekers haven't checked compatibility with your job postings.</p>
            </div>
            @endforelse
        </div>
        
        <div class="border-t border-gray-100 px-6 py-3 bg-gray-50 text-right">
            <a href="{{ route('recruiter.applications.index') }}" 
               class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700 transition-colors">
                View All Activity
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
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
@endsection 