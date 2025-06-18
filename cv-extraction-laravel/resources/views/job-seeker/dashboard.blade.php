@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<!-- Header Section -->
<div class="relative mb-6">
    {{-- <div class="absolute inset-0 bg-[#B9FF66]/10 rounded-2xl"></div> --}}
    <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
        <!-- Header Background Pattern -->
        <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#B9FF66]/10">
                <circle cx="150" cy="150" r="150" fill="currentColor"/>
                <circle cx="150" cy="150" r="120" fill="white"/>
                <circle cx="150" cy="150" r="100" fill="currentColor"/>
                <circle cx="150" cy="150" r="80" fill="white"/>
                <circle cx="150" cy="150" r="60" fill="currentColor"/>
            </svg>
        </div>

        <div class="flex flex-col md:flex-row md:items-start gap-8">
            <div class="flex-shrink-0">
                <div class="p-4 bg-[#B9FF66] rounded-2xl shadow-sm w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                            Dashboard
                        </span>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Welcome Back!</h1>
                        <p class="mt-2 text-lg text-[#191A23]/80">Manage your applications and browse new job opportunities</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Futuristic Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <!-- Total Applications Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Total Applications</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $totalApplications }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">applications</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Applications Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Pending</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $pendingApplications }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">in review</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Shortlisted Card -->
    <div class="stat-card group relative overflow-hidden backdrop-blur-sm border border-[#191A23]/20 rounded-2xl transition-all duration-300 ease-in-out">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/10 opacity-70 z-0"></div>
        <div class="relative z-10 flex items-center gap-3 p-4">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-glow-sm transform transition-transform duration-300 group-hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-[#191A23]/70 text-xs font-medium uppercase tracking-wider mb-0.5">Shortlisted</p>
                <div class="flex items-baseline flex-wrap gap-1.5">
                    <h3 class="text-2xl sm:text-3xl font-bold text-[#191A23] leading-none">{{ $shortlistedApplications }}</h3>
                    <span class="text-xs text-[#191A23]/60 font-medium truncate">positions</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Futuristic Quick Actions -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 mb-8">
    <!-- Browse Jobs Card -->
    <a href="{{ route('job-seeker.jobs.available') }}"
       class="action-card group relative overflow-hidden flex items-center rounded-2xl backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 ease-in-out hover:border-[#B9FF66]/50 hover:shadow-glow-green">
        <div class="absolute inset-0 bg-gradient-to-tr from-[#191A23]/5 via-white/70 to-[#B9FF66]/10 opacity-80 z-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="relative z-10 flex items-center gap-3 p-4 w-full">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm transform transition-all duration-300 group-hover:scale-105 group-hover:bg-[#B9FF66]/50 group-hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">Browse Jobs</h3>
                <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">Find new job opportunities</p>
            </div>
        </div>
    </a>
    
    <!-- My Applications Card -->
    <a href="{{ route('job-seeker.applications.index') }}"
       class="action-card group relative overflow-hidden flex items-center rounded-2xl backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300 ease-in-out hover:border-[#B9FF66]/50 hover:shadow-glow-green">
        <div class="absolute inset-0 bg-gradient-to-tr from-[#191A23]/5 via-white/70 to-[#B9FF66]/10 opacity-80 z-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="relative z-10 flex items-center gap-3 p-4 w-full">
            <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-xl bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/20 shadow-sm transform transition-all duration-300 group-hover:scale-105 group-hover:bg-[#B9FF66]/50 group-hover:shadow-glow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300">My Applications</h3>
                <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">Track your job applications</p>
            </div>
        </div>
    </a>
</div>

<!-- Futuristic Content Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 md:items-start gap-5">
    <!-- Recent Job Listings - Optimized Height -->
    <div class="card-container relative rounded-2xl overflow-hidden flex flex-col backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-[#191A23]/5 via-white/80 to-[#B9FF66]/5 opacity-80 z-0"></div>
        
        <!-- Header - Optimized -->
        <div class="relative z-10 px-5 py-4 flex justify-between items-center border-b border-[#191A23]/10 flex-shrink-0">
            <h2 class="text-base sm:text-lg font-semibold text-[#191A23] flex items-center">
                <div class="flex-shrink-0 w-8 h-8 mr-2 flex items-center justify-center rounded-lg bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                Recent Job Listings
            </h2>
            <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] transition-all duration-200 group/link">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <!-- Scrollable Content Area - Adaptive Height -->
        <div class="relative z-10 overflow-y-auto scrollbar-thin scrollbar-thumb-[#191A23]/10 scrollbar-track-transparent flex-1" style="max-height: clamp(250px, 40vh, 400px);">
            @forelse($recentJobs as $job)
            <div class="job-card group px-5 py-4 hover:bg-[#191A23]/5 transition-all duration-300 @if(!$loop->last) border-b border-[#191A23]/10 @endif">
                <div class="flex justify-between items-start gap-3">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300 truncate">{{ $job->title }}</h3>
                        <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">{{ $job->company_name }} • {{ $job->location }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                            {{ $job->job_type }}
                        </span>
                    </div>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-xs text-[#191A23]/60 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Posted {{ $job->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('job-seeker.jobs.details', $job) }}" class="inline-flex items-center px-2.5 py-1 border border-[#191A23]/20 text-xs font-medium rounded-md text-[#191A23] bg-white/50 hover:bg-[#B9FF66]/30 hover:border-[#B9FF66]/50 transition-all duration-200 shadow-sm hover:shadow-glow-xs">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="p-6 text-center">
                <div class="inline-block p-3 rounded-full bg-[#191A23]/5 mb-3 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-sm text-[#191A23]/60 mb-4">No job listings available at the moment.</p>
                <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-[#191A23] bg-[#B9FF66]/40 hover:bg-[#B9FF66]/60 border border-[#191A23]/20 transition-all duration-300 hover:shadow-glow-sm">
                    Browse All Jobs
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Applications - Optimized Height -->
    <div class="card-container relative rounded-2xl overflow-hidden flex flex-col backdrop-blur-sm border border-[#191A23]/20 transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-tl from-[#191A23]/5 via-white/80 to-[#B9FF66]/5 opacity-80 z-0"></div>
        
        <!-- Header - Optimized -->
        <div class="relative z-10 px-5 py-4 flex justify-between items-center border-b border-[#191A23]/10 flex-shrink-0">
            <h2 class="text-base sm:text-lg font-semibold text-[#191A23] flex items-center">
                <div class="flex-shrink-0 w-8 h-8 mr-2 flex items-center justify-center rounded-lg bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/20 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                My Recent Applications
            </h2>
            <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center text-xs font-medium text-[#191A23] hover:text-[#B9FF66] transition-all duration-200 group/link">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-1 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <!-- Scrollable Content Area - Adaptive Height -->
        <div class="relative z-10 overflow-y-auto scrollbar-thin scrollbar-thumb-[#191A23]/10 scrollbar-track-transparent flex-1" style="max-height: clamp(250px, 40vh, 400px);">
            @forelse($recentApplications as $application)
            <div class="application-card group px-5 py-4 hover:bg-[#191A23]/5 transition-all duration-300 @if(!$loop->last) border-b border-[#191A23]/10 @endif">
                <div class="flex justify-between items-start gap-3">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-semibold text-[#191A23] group-hover:translate-x-0.5 transition-transform duration-300 truncate">{{ $application->jobPosition->title }}</h3>
                        <p class="text-xs text-[#191A23]/70 mt-0.5 truncate">{{ $application->jobPosition->company_name }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200 shadow-yellow-100/50',
                                'in_review' => 'bg-blue-100 text-blue-700 border-blue-200 shadow-blue-100/50',
                                'reviewed' => 'bg-blue-100 text-blue-700 border-blue-200 shadow-blue-100/50',
                                'shortlisted' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#B9FF66]/30 shadow-[#B9FF66]/20',
                                'rejected' => 'bg-red-100 text-red-700 border-red-200 shadow-red-100/50',
                                'hired' => 'bg-purple-100 text-purple-700 border-purple-200 shadow-purple-100/50',
                            ];
                            $statusClass = $statusClasses[$application->status] ?? 'bg-gray-100 text-gray-700 border-gray-200 shadow-gray-100/50';
                            
                            $statusLabels = [
                                'pending' => 'Pending',
                                'in_review' => 'In Review',
                                'reviewed' => 'Reviewed',
                                'shortlisted' => 'Shortlisted',
                                'rejected' => 'Rejected',
                                'hired' => 'Hired'
                            ];
                            $statusLabel = $statusLabels[$application->status] ?? ucfirst($application->status);
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium border shadow-sm {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-xs text-[#191A23]/60 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('job-seeker.applications.show', $application) }}" class="inline-flex items-center px-2.5 py-1 border border-[#191A23]/20 text-xs font-medium rounded-md text-[#191A23] bg-white/50 hover:bg-[#B9FF66]/30 hover:border-[#B9FF66]/50 transition-all duration-200 shadow-sm hover:shadow-glow-xs">
                        View Application
                    </a>
                </div>
            </div>
            @empty
            <div class="p-6 text-center">
                <div class="inline-block p-3 rounded-full bg-[#191A23]/5 mb-3 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-sm text-[#191A23]/60 mb-4">You haven't applied to any jobs yet.</p>
                <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-lg text-[#191A23] bg-[#B9FF66]/40 hover:bg-[#B9FF66]/60 border border-[#191A23]/20 transition-all duration-300 hover:shadow-glow-sm">
                    Find Jobs Now
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>

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
    
    /* Transitions for subtle interactions */
    .job-card, .application-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
</style>
@endsection