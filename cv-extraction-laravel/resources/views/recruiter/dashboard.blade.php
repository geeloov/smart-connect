@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<!-- Modern Header Section -->
<div class="relative mb-12">
    {{-- <div class="absolute inset-0 bg-gradient-to-r from-[#B9FF66]/10 via-green-50/20 to-white rounded-3xl"></div> --}}
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

        <div class="relative z-20 flex flex-col md:flex-row md:items-start gap-8">
            <div class="flex-shrink-0">
                <div class="p-4 bg-[#B9FF66] rounded-2xl w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Welcome Back
                        </span>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Recruiter Dashboard</h1>
                        <p class="mt-2 text-lg text-[#191A23]/80">Manage your recruitment process efficiently and effectively</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Futuristic Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <!-- Total Job Positions Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Total Jobs</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $totalJobPositions }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">positions</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Job Positions Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Active Jobs</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $activeJobPositions }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">active</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Applications Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Applications</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $totalApplications }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">total</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Futuristic Quick Actions Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    <!-- Post New Job Card -->
    <a href="{{ route('recruiter.job-positions.create') }}"
       class="action-card group relative overflow-hidden flex items-center rounded-2xl backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 ease-in-out hover:border-[#B9FF66]/50 hover:shadow-glow-green">
        <div class="absolute inset-0 bg-gradient-to-tr from-[#191A23]/5 via-white/70 to-[#B9FF66]/10 opacity-80 z-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="relative z-10 flex items-center gap-3 p-4 w-full">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm transform transition-all duration-300 group-hover:scale-105 group-hover:bg-[#B9FF66]/50 group-hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">Post New Job</h3>
                <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">Create a new job position</p>
            </div>
        </div>
    </a>
    
    <!-- Extract CV Card -->
    <a href="{{ route('recruiter.cv-extraction') }}"
       class="action-card group relative overflow-hidden flex items-center rounded-2xl backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 ease-in-out hover:border-[#B9FF66]/50 hover:shadow-glow-green">
        <div class="absolute inset-0 bg-gradient-to-tr from-[#191A23]/5 via-white/70 to-[#B9FF66]/10 opacity-80 z-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="relative z-10 flex items-center gap-3 p-4 w-full">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm transform transition-all duration-300 group-hover:scale-105 group-hover:bg-[#B9FF66]/50 group-hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">Extract CV</h3>
                <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">Process a CV with AI</p>
            </div>
        </div>
    </a>
    
    <!-- View Applications Card -->
    <a href="{{ route('recruiter.applications.index') }}"
       class="action-card group relative overflow-hidden flex items-center rounded-2xl backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 ease-in-out hover:border-[#B9FF66]/50 hover:shadow-glow-green">
        <div class="absolute inset-0 bg-gradient-to-tr from-[#191A23]/5 via-white/70 to-[#B9FF66]/10 opacity-80 z-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="relative z-10 flex items-center gap-3 p-4 w-full">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm transform transition-all duration-300 group-hover:scale-105 group-hover:bg-[#B9FF66]/50 group-hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">View Applications</h3>
                <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">Manage candidate applications</p>
            </div>
        </div>
    </a>
</div>

<!-- Futuristic Dashboard cards with independent heights -->
<div class="flex flex-col md:flex-row gap-5 md:items-start">
    <!-- Recent Job Positions - Auto Height -->
    <div class="card-container relative rounded-2xl overflow-hidden flex flex-col backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 md:w-1/2 h-auto">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/5 opacity-80 z-0"></div>
        
        <!-- Header - Optimized -->
        <div class="relative z-10 px-5 py-4 flex justify-between items-center border-b border-[#191A23]/10 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-base sm:text-lg font-semibold text-[#191A23]">Recent Job Positions</h2>
            </div>
            <a href="{{ route('recruiter.job-positions.create') }}"
               class="inline-flex items-center px-2.5 py-1.5 text-xs sm:text-sm font-medium text-[#191A23] bg-[#B9FF66]/30 hover:bg-[#B9FF66]/50 border border-[#191A23]/20 rounded-lg transition-all duration-300 hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="whitespace-nowrap">New Position</span>
            </a>
        </div>
        
        <!-- Content Area - Auto Height with Dynamic Height -->
        <div class="relative z-10 overflow-y-auto scrollbar-thin scrollbar-thumb-[#191A23]/10 scrollbar-track-transparent flex-1" style="max-height: min(500px, calc(100vh - 400px));">
            @forelse($recentJobPositions as $jobPosition)
            <div class="position-card group px-5 py-4 hover:bg-[#191A23]/5 transition-all duration-300 @if(!$loop->last) border-b border-[#191A23]/10 @endif">
                <div class="space-y-2.5">
                    <!-- Title and Status -->
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">{{ $jobPosition->title }}</h3>
                        @if($jobPosition->is_active)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                            <span class="w-1.5 h-1.5 mr-1 rounded-full bg-[#B9FF66]"></span>
                            Active
                        </span>
                        @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200 shadow-sm">
                            <span class="w-1.5 h-1.5 mr-1 rounded-full bg-gray-400"></span>
                            Inactive
                        </span>
                        @endif
                    </div>
                    
                    <!-- Company and Location -->
                    <div class="flex flex-wrap items-center gap-x-2 text-xs text-[#191A23]/70">
                        @if(isset($jobPosition->company_name))
                        <span class="font-medium text-[#191A23]/80 truncate">{{ $jobPosition->company_name }}</span>
                        <span class="text-[#191A23]/40">•</span>
                        @endif
                        
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-[#191A23]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="truncate">{{ $jobPosition->location }}</span>
                        </div>
                    </div>
                    
                    <!-- Job Details: Type, Work Arrangement, Applicants -->
                    <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">
                        @if(isset($jobPosition->job_type))
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-[#B9FF66]/10 text-[#191A23] border border-[#191A23]/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $jobPosition->job_type }}
                        </span>
                        @endif
                        
                        @if(isset($jobPosition->work_arrangement))
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ $jobPosition->work_arrangement }}
                        </span>
                        @endif
                        
                        @if(isset($jobPosition->applications_count))
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $jobPosition->applications_count }} {{ Str::plural('applicant', $jobPosition->applications_count) }}
                        </span>
                        @endif
                        
                        @if(isset($jobPosition->salary_range) && !empty($jobPosition->salary_range))
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $jobPosition->salary_range }}
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-end mt-2">
                        <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}"
                           class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] group/link">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-6 text-center">
                <div class="inline-block p-3 rounded-full bg-[#191A23]/5 mb-3 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-sm text-[#191A23]/60 mb-4">No job positions yet</p>
                <a href="{{ route('recruiter.job-positions.create') }}"
                   class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-[#191A23] bg-[#B9FF66]/40 hover:bg-[#B9FF66]/60 border border-[#191A23]/20 transition-all duration-300 hover:shadow-glow-sm">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Candidate Activity - Auto Height -->
    <div class="card-container relative rounded-2xl overflow-hidden flex flex-col backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 md:w-1/2 h-auto">
        <div class="absolute inset-0 bg-gradient-to-tl from-[#191A23]/5 via-white/80 to-[#B9FF66]/5 opacity-80 z-0"></div>
        
        <!-- Header - Optimized -->
        <div class="relative z-10 px-5 py-4 flex justify-between items-center border-b border-[#191A23]/10 flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-base sm:text-lg font-semibold text-[#191A23]">Candidate Activity</h2>
            </div>
        </div>
        
        <!-- Tabs Navigation - Optimized -->
        <div class="relative z-10 border-b border-[#191A23]/10 flex-shrink-0">
            <div class="flex">
                <button type="button"
                        id="tab-applications"
                        class="tab-button relative min-w-0 flex-1 py-3 px-3 text-center border-b-2 text-xs sm:text-sm font-medium border-[#B9FF66] text-[#191A23] focus:outline-none transition-all duration-300"
                        aria-current="page">
                    Applications
                </button>
                <button type="button"
                        id="tab-compatibility"
                        class="tab-button relative min-w-0 flex-1 py-3 px-3 text-center border-b-2 text-xs sm:text-sm font-medium border-transparent text-[#191A23]/60 hover:text-[#191A23] hover:border-[#191A23]/30 focus:outline-none transition-all duration-300">
                    Compatibility Checks
                </button>
            </div>
        </div>
        
        <!-- Tab Content Container - Adaptive Height -->
        <div class="relative z-10 flex-grow flex flex-col min-h-0">
            <!-- Applications Tab Content -->
            <div id="tab-content-applications" class="tab-content flex-grow overflow-y-auto scrollbar-thin scrollbar-thumb-[#191A23]/10 scrollbar-track-transparent" style="max-height: min(500px, calc(100vh - 440px));">
                @forelse($recentApplications as $application)
                <div class="application-card group px-5 py-4 hover:bg-[#191A23]/5 transition-all duration-300 @if(!$loop->last) border-b border-[#191A23]/10 @endif">
                    <div class="space-y-2.5">
                        <!-- Candidate Name and Application Status -->
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300 truncate max-w-[180px] sm:max-w-none">{{ $application->jobSeeker->name }}</h3>
                            @php
                                $statusClasses = [
                                    'pending'     => 'bg-yellow-100 text-yellow-700 border-yellow-200 shadow-yellow-100/50',
                                    'reviewed'    => 'bg-blue-100 text-blue-700 border-blue-200 shadow-blue-100/50',
                                    'shortlisted' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#B9FF66]/30 shadow-[#B9FF66]/20',
                                    'rejected'    => 'bg-red-100 text-red-700 border-red-200 shadow-red-100/50',
                                    'hired'       => 'bg-purple-100 text-purple-700 border-purple-200 shadow-purple-100/50',
                                ];
                                $statusClass = $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-700 border-gray-200 shadow-gray-100/50';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium border shadow-sm {{ $statusClass }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                        
                        <!-- Job Position Information -->
                        <div class="text-xs text-[#191A23]/70">
                            Applied for: <span class="font-medium text-[#191A23]">{{ $application->jobPosition->title }}</span>
                        </div>
                        
                        <!-- Additional Candidate Information - Only shown when application exists -->
                        <div class="flex flex-wrap gap-2 mt-1.5">
                            @if(isset($application->jobSeeker->email))
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ Str::limit($application->jobSeeker->email, 20) }}
                            </span>
                            @endif
                            
                            @if(isset($application->created_at))
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-gray-50 text-gray-700 border border-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $application->created_at->diffForHumans() }}
                            </span>
                            @endif
                            
                            @if(isset($application->cv_score) && $application->cv_score > 0)
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                CV Score: {{ $application->cv_score }}%
                            </span>
                            @endif
                        </div>
                        
                        <!-- View Application Link -->
                        <div class="flex justify-end">
                            <a href="{{ route('recruiter.applications.show', $application->id) }}"
                               class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] group/link">
                                View Application
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <div class="inline-block p-3 rounded-full bg-[#191A23]/5 mb-3 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-sm text-[#191A23]/60 mb-4">No applications yet</p>
                    <a href="{{ route('recruiter.job-positions.create') }}"
                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-[#191A23] bg-[#B9FF66]/40 hover:bg-[#B9FF66]/60 border border-[#191A23]/20 transition-all duration-300 hover:shadow-glow-sm">
                        Create Job Position
                    </a>
                </div>
                @endforelse
            </div>
            
            <!-- Compatibility Checks Tab Content -->
            <div id="tab-content-compatibility-checks" class="tab-content hidden flex-grow overflow-y-auto scrollbar-thin scrollbar-thumb-[#191A23]/10 scrollbar-track-transparent" style="max-height: min(500px, calc(100vh - 440px));">
                @forelse($compatibilityChecks as $check)
                <div class="compatibility-card group px-5 py-4 hover:bg-[#191A23]/5 transition-all duration-300 @if(!$loop->last) border-b border-[#191A23]/10 @endif">
                    <div class="space-y-2.5">
                        <!-- Candidate Name and Job Position -->
                        <div class="flex items-start justify-between flex-wrap gap-2">
                            <div class="min-w-0">
                                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300 truncate">{{ $check->jobSeeker->name }}</h3>
                                <p class="text-xs text-[#191A23]/70 truncate">Checked for: <span class="font-medium">{{ $check->jobPosition->title }}</span></p>
                            </div>
                            <a href="{{ route('recruiter.compatibility-checks.show', $check->id) }}"
                               class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] group/link whitespace-nowrap">
                                View Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Match Score -->
                        <div class="mt-2">
                            <div class="flex justify-between mb-1 items-center">
                                <span class="text-xs text-[#191A23]/70">Match Score</span>
                                <span class="text-sm font-bold text-[#191A23]">{{ round($check->match_percentage) }}%</span>
                            </div>
                            <div class="relative w-full bg-[#191A23]/10 rounded-full h-1.5 overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-[#B9FF66] rounded-full shadow-glow-xs transition-all duration-500 transform-gpu" style="width: {{ round($check->match_percentage) }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Additional Match Information - Only shown when data exists -->
                        @if(isset($check->skills_matched) && $check->skills_matched > 0)
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm text-xs font-medium bg-[#B9FF66]/10 text-[#191A23] border border-[#191A23]/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $check->skills_matched }} matched skills
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <div class="inline-block p-3 rounded-full bg-[#191A23]/5 mb-3 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                        </svg>
                    </div>
                    <p class="text-sm text-[#191A23]/60 mb-4">No compatibility checks yet</p>
                    <a href="{{ route('recruiter.cv-extraction') }}"
                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-[#191A23] bg-[#B9FF66]/40 hover:bg-[#B9FF66]/60 border border-[#191A23]/20 transition-all duration-300 hover:shadow-glow-sm">
                        Perform CV Scan
                    </a>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Footer - Optimized -->
        <div class="relative z-10 border-t border-[#191A23]/10 px-5 py-3 text-right flex-shrink-0 bg-gradient-to-r from-white/60 to-[#B9FF66]/10">
            <a href="{{ route('recruiter.applications.index') }}"
               class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] group/footer">
                View All Activity
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/footer:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Enhanced Tab switching script for independent card layout -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        const candidateActivityCard = document.querySelector('.card-container:nth-child(2)');
        
        // Function to handle tab switching
        function switchTab(clickedTab) {
            const tabId = clickedTab.id.replace('tab-', 'tab-content-');
            
            // Reset all buttons to inactive state
            tabButtons.forEach(btn => {
                btn.classList.remove('border-[#B9FF66]', 'border-[#191A23]', 'text-[#191A23]');
                btn.classList.add('border-transparent', 'text-[#191A23]/60');
            });
            
            // Hide all tab content
            tabContents.forEach(content => {
                content.classList.add('hidden');
                // Keep the flex-grow class for all tabs to maintain layout structure
                // but hide inactive ones
            });
            
            // Set clicked button to active state
            clickedTab.classList.remove('border-transparent', 'text-[#191A23]/60');
            clickedTab.classList.add('border-[#191A23]', 'text-[#191A23]');
            
            // Show the corresponding tab content
            const activeContent = document.getElementById(tabId);
            if (activeContent) {
                activeContent.classList.remove('hidden');
                
                // Force a small reflow to ensure proper height calculation
                requestAnimationFrame(() => {
                    candidateActivityCard.style.height = 'auto';
                });
            }
        }
        
        // Add event listeners to tab buttons
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                switchTab(this);
            });
        });

        // Initialize the first tab as active
        const initialActiveTab = document.getElementById('tab-applications');
        if (initialActiveTab) {
            switchTab(initialActiveTab);
        }
        
        // Add a resize listener to adjust heights on window resize
        window.addEventListener('resize', function() {
            // Force recalculation of heights
            requestAnimationFrame(() => {
                candidateActivityCard.style.height = 'auto';
            });
        });
    });
</script>

<!-- Enhanced styles for futuristic UI -->
<style>
    /* Custom Scrollbar Styles */
    .scrollbar-thin::-webkit-scrollbar {
        width: 3px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: rgba(25, 26, 35, 0.1);
        border-radius: 20px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background-color: rgba(25, 26, 35, 0.2);
    }
    
    /* Firefox scrollbar */
    .scrollbar-thin {
        scrollbar-width: thin;
        scrollbar-color: rgba(25, 26, 35, 0.1) transparent;
    }
    
    /* Glass morphism effect cards */
    .stat-card, .action-card, .card-container {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    /* Subtle glow effects */
    .shadow-glow-xs {
        box-shadow: 0 0 5px 0px rgba(185, 255, 102, 0.3);
    }
    
    .shadow-glow-sm {
        box-shadow: 0 0 8px 1px rgba(185, 255, 102, 0.3);
    }
    
    .shadow-glow-green {
        box-shadow: 0 0 15px 2px rgba(185, 255, 102, 0.25);
    }
    
    /* Adaptive content heights for different screen sizes */
    @media (max-height: 700px) {
        .card-container > div[style*="max-height"] {
            max-height: 250px !important;
        }
    }
    
    @media (min-height: 900px) {
        .card-container > div[style*="max-height"] {
            max-height: 400px !important;
        }
    }
    
    /* Ensure independent height behavior */
    .card-container {
        display: flex;
        flex-direction: column;
        height: fit-content;
        min-height: 0; /* Important for proper flex behavior */
    }
    
    /* Additional independent height styles */
    @media (min-width: 768px) {
        .flex-col.md\:flex-row.md\:items-start > .card-container {
            align-self: flex-start;
            transition: height 0.2s ease-out;
        }
        
        /* Ensure scrollable content works well with flexible heights */
        .tab-content {
            transition: opacity 0.2s ease-out;
            opacity: 0;
        }
        
        .tab-content:not(.hidden) {
            opacity: 1;
        }
    }
    
    /* Transitions for subtle interactions */
    .tab-button, .position-card, .application-card, .compatibility-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
</style>
@endsection 