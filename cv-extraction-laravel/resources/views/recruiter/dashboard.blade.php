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

<!-- Modern Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Job Positions Card -->
    <div class="bg-white rounded-2xl border border-[#191A23] p-5" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/30" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm font-medium mb-0.5">Total Job Positions</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-[#191A23]">{{ $totalJobPositions }}</h3>
                    <span class="text-sm text-[#191A23]/70 font-medium self-baseline">positions</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Active Job Positions Card -->
    <div class="bg-white rounded-2xl border border-[#191A23] p-5" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/30" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm font-medium mb-0.5">Active Job Positions</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-[#191A23]">{{ $activeJobPositions }}</h3>
                    <span class="text-sm text-[#191A23]/70 font-medium self-baseline">active</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Applications Card -->
    <div class="bg-white rounded-2xl border border-[#191A23] p-5" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/30" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm font-medium mb-0.5">Total Applications</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-[#191A23]">{{ $totalApplications }}</h3>
                    <span class="text-sm text-[#191A23]/70 font-medium self-baseline">applications</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Post New Job Card -->
    <a href="{{ route('recruiter.job-positions.create') }}" 
       class="block bg-white rounded-2xl border border-[#191A23] p-5 hover:bg-[#191A23]/5 transition-all duration-200 transform hover:-translate-y-0.5" 
       style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/70 text-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-[#191A23]">Post New Job</h3>
                <p class="text-sm text-[#191A23]/80 mt-1">Create a new job position</p>
            </div>
        </div>
    </a>
    
    <!-- Extract CV Card -->
    <a href="{{ route('recruiter.cv-extraction') }}" 
       class="block bg-white rounded-2xl border border-[#191A23] p-5 hover:bg-[#191A23]/5 transition-all duration-200 transform hover:-translate-y-0.5" 
       style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/70 text-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-[#191A23]">Extract CV</h3>
                <p class="text-sm text-[#191A23]/80 mt-1">Process a CV with AI</p>
            </div>
        </div>
    </a>
    
    <!-- View Applications Card -->
    <a href="{{ route('recruiter.applications.index') }}" 
       class="block bg-white rounded-2xl border border-[#191A23] p-5 hover:bg-[#191A23]/5 transition-all duration-200 transform hover:-translate-y-0.5" 
       style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-xl bg-[#B9FF66]/70 text-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <h3 class="text-base font-semibold text-[#191A23]">View Applications</h3>
                <p class="text-sm text-[#191A23]/80 mt-1">Manage candidate applications</p>
            </div>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Recent Job Positions -->
    <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="px-6 py-5 flex justify-between items-center border-b border-[#191A23]/30">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-[#B9FF66]/30 rounded-xl border border-[#191A23]/30" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-[#191A23]">Recent Job Positions</h2>
            </div>
            <a href="{{ route('recruiter.job-positions.create') }}" 
               class="inline-flex items-center px-3 py-1.5 text-sm font-semibold text-[#191A23] hover:text-[#191A23]/80 bg-[#B9FF66]/50 hover:bg-[#B9FF66]/70 border border-[#191A23]/50 rounded-lg" style="box-shadow: 0px 2px 0px 0 #191a23;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Position
            </a>
        </div>
        
        <div>
            @forelse($recentJobPositions as $jobPosition)
            <div class="p-6 hover:bg-[#191A23]/5 transition-all duration-200 @if(!$loop->last) border-b border-[#191A23]/20 @endif">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-[#191A23]">{{ $jobPosition->title }}</h3>
                        @if($jobPosition->is_active)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/50 text-[#191A23] border border-[#191A23]/50" style="box-shadow: 0px 1px 0px 0 #191a23;">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-[#191A23]"></span>
                            Active
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-200 text-gray-700 border border-gray-300">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-gray-500"></span>
                            Inactive
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex items-center text-sm text-[#191A23]/80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-[#191A23]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $jobPosition->location }}</span>
                    </div>
                    
                    <div class="flex justify-end pt-1">
                        <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                           class="inline-flex items-center text-sm font-semibold text-[#191A23] hover:text-[#B9FF66] group">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-[#191A23]/5 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-base text-[#191A23]/70 mb-4">No job positions yet</p>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Candidate Activity -->
    <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="px-6 py-5 flex justify-between items-center border-b border-[#191A23]/30">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-[#B9FF66]/30 rounded-xl border border-[#191A23]/30" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-[#191A23]">Candidate Activity</h2>
            </div>
            <!-- Optional: Add a link here if needed, like "View All Activity" -->
        </div>
        
        <!-- Tabs Navigation -->
        <div class="border-b border-[#191A23]/30">
            <div class="flex">
                <button type="button" 
                        id="tab-applications" 
                        class="tab-button relative min-w-0 flex-1 py-4 px-4 text-center border-b-2 text-sm font-medium border-[#191A23] text-[#191A23] focus:outline-none" 
                        aria-current="page">
                    Applications
                </button>
                <button type="button" 
                        id="tab-compatibility" 
                        class="tab-button relative min-w-0 flex-1 py-4 px-4 text-center border-b-2 text-sm font-medium border-transparent text-[#191A23]/70 hover:text-[#191A23] hover:border-[#191A23]/70 focus:outline-none">
                    Compatibility Checks
                </button>
            </div>
        </div>
        
        <!-- Applications Tab Content -->
        <div id="tab-content-applications" class="tab-content">
            @forelse($recentApplications as $application)
            <div class="p-6 hover:bg-[#191A23]/5 transition-all duration-200 @if(!$loop->last) border-b border-[#191A23]/20 @endif">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-[#191A23]">{{ $application->jobSeeker->name }}</h3>
                        @php
                            $statusBaseClass = 'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border';
                            $statusStyles = [
                                'pending'     => 'bg-yellow-500/20 text-yellow-700 border-yellow-700/50',
                                'reviewed'    => 'bg-blue-500/20 text-blue-700 border-blue-700/50',
                                'shortlisted' => 'bg-[#B9FF66]/30 text-[#191A23] border-[#191A23]/50 style="box-shadow: 0px 1px 0px 0 #191a23;"',
                                'rejected'    => 'bg-red-500/20 text-red-700 border-red-700/50',
                                'hired'       => 'bg-purple-500/20 text-purple-700 border-purple-700/50 style="box-shadow: 0px 1px 0px 0 #191a23;"', // Or a green alternative
                            ];
                            $statusColor = $statusStyles[$application->status] ?? 'bg-gray-500/20 text-gray-700 border-gray-700/50';
                        @endphp
                        <span class="{{ $statusBaseClass }} {{ $statusColor }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    
                    <div class="text-sm text-[#191A23]/80">
                        Applied for: <span class="font-medium text-[#191A23]">{{ $application->jobPosition->title }}</span>
                    </div>
                    
                    <div class="flex justify-end pt-1">
                        <a href="{{ route('recruiter.applications.show', $application->id) }}" 
                           class="inline-flex items-center text-sm font-semibold text-[#191A23] hover:text-[#B9FF66] group">
                            View Application
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-[#191A23]/5 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="text-base text-[#191A23]/70 mb-4">No applications yet</p>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                    Create Job Position
                </a>
            </div>
            @endforelse
        </div>
        
        <!-- Compatibility Checks Tab Content -->
        <div id="tab-content-compatibility-checks" class="tab-content hidden">
            @forelse($compatibilityChecks as $check)
            <div class="p-6 hover:bg-[#191A23]/5 transition-all duration-200 @if(!$loop->last) border-b border-[#191A23]/20 @endif">
                <div class="space-y-3">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-[#191A23]">{{ $check->jobSeeker->name }}</h3>
                            <p class="text-sm text-[#191A23]/80">Checked for: {{ $check->jobPosition->title }}</p>
                        </div>
                        <a href="{{ route('recruiter.compatibility-checks.show', $check->id) }}" 
                           class="inline-flex items-center text-sm font-semibold text-[#191A23] hover:text-[#B9FF66] group whitespace-nowrap pt-1">
                            View Details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="mt-3">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-[#191A23]/80">Match Score</span>
                            <span class="text-lg font-bold text-[#191A23]">{{ round($check->match_percentage) }}%</span>
                        </div>
                        <div class="w-full bg-[#191A23]/10 rounded-full h-2.5">
                            <div class="bg-[#B9FF66] h-2.5 rounded-full" style="width: {{ round($check->match_percentage) }}%; box-shadow: 0px 0px 10px 0px #B9FF66;"></div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-[#191A23]/5 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                    </svg>
                </div>
                <p class="text-base text-[#191A23]/70 mb-4">No compatibility checks performed yet.</p>
                <a href="{{ route('recruiter.cv-extraction') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                    Perform CV Scan
                </a>
            </div>
            @endforelse
        </div>
        
        <div class="border-t border-gray-100 px-6 py-4 bg-gray-50 text-right">
            <a href="{{ route('recruiter.applications.index') }}" 
               class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-700 group">
                View All Activity
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                const tabId = this.id.replace('tab-', 'tab-content-');
                
                // Reset all buttons to inactive state
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-[#191A23]', 'text-[#191A23]');
                    btn.classList.add('border-transparent', 'text-[#191A23]/70');
                    // Hover classes are managed by Tailwind on the base class, no need to toggle here
                });
                
                // Hide all tab content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Set clicked button to active state
                this.classList.remove('border-transparent', 'text-[#191A23]/70');
                this.classList.add('border-[#191A23]', 'text-[#191A23]');
                
                // Show the corresponding tab content
                const activeContent = document.getElementById(tabId);
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                }
            });
        });

        // Ensure the initially active tab (Applications) has the correct styles
        const initialActiveTab = document.getElementById('tab-applications');
        if (initialActiveTab) {
            // Remove potentially incorrect default/inactive styles if any were missed in HTML
            initialActiveTab.classList.remove('border-transparent', 'text-[#191A23]/70');
            // Add active styles (these should match what's in the HTML for the default active tab)
            initialActiveTab.classList.add('border-[#191A23]', 'text-[#191A23]');
        }
    });
</script>
@endsection 