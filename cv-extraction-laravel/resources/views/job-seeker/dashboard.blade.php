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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] p-6 hover:shadow-md transition-all duration-200" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66] text-[#191A23] mr-4 shadow-sm border border-[#191A23]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm">Total Applications</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-[#191A23]">{{ $totalApplications }}</h3>
                    <span class="text-sm text-[#191A23]/90 font-medium">applications</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] p-6 hover:shadow-md transition-all duration-200" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66] text-[#191A23] mr-4 shadow-sm border border-[#191A23]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm">Pending Applications</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-[#191A23]">{{ $pendingApplications }}</h3>
                    <span class="text-sm text-[#191A23]/90 font-medium">in review</span>
                </div>  
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] p-6 hover:shadow-md transition-all duration-200" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66] text-[#191A23] mr-4 shadow-sm border border-[#191A23]/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[#191A23]/80 text-sm">Shortlisted</p>
                <div class="flex items-baseline space-x-1">
                    <h3 class="text-2xl font-bold text-[#191A23]">{{ $shortlistedApplications }}</h3>
                    <span class="text-sm text-[#191A23]/90 font-medium">positions</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <a href="{{ route('job-seeker.jobs.available') }}" class="bg-white rounded-2xl border border-[#191A23] p-6 hover:border-[#B9FF66] hover:-translate-y-1 transition-all duration-200 group" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66]/10 text-[#191A23] group-hover:bg-[#B9FF66] group-hover:text-[#191A23] mr-4 transition-all duration-200 shadow-sm border border-[#191A23]/50 group-hover:border-[#191A23]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-[#191A23] group-hover:text-[#191A23] transition-colors">Browse Jobs</h3>
                <p class="text-[#191A23]/70 text-sm">Find new job opportunities</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('job-seeker.cv-upload') }}" class="bg-white rounded-2xl border border-[#191A23] p-6 hover:border-[#B9FF66] hover:-translate-y-1 transition-all duration-200 group" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66]/10 text-[#191A23] group-hover:bg-[#B9FF66] group-hover:text-[#191A23] mr-4 transition-all duration-200 shadow-sm border border-[#191A23]/50 group-hover:border-[#191A23]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-[#191A23] group-hover:text-[#191A23] transition-colors">Upload CV</h3>
                <p class="text-[#191A23]/70 text-sm">Update your CV profile</p>
            </div>
        </div>
    </a>
    
    <a href="{{ route('job-seeker.applications.index') }}" class="bg-white rounded-2xl border border-[#191A23] p-6 hover:border-[#B9FF66] hover:-translate-y-1 transition-all duration-200 group" style="box-shadow: 0px 4px 0px 0 #191a23;">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-[#B9FF66]/10 text-[#191A23] group-hover:bg-[#B9FF66] group-hover:text-[#191A23] mr-4 transition-all duration-200 shadow-sm border border-[#191A23]/50 group-hover:border-[#191A23]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-medium text-[#191A23] group-hover:text-[#191A23] transition-colors">My Applications</h3>
                <p class="text-[#191A23]/70 text-sm">Track your job applications</p>
            </div>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 md:items-start gap-8">
    <!-- Recent Job Listings -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="border-b border-[#191A23]/30 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Recent Job Listings
            </h2>
            <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center text-sm font-medium text-[#191A23] hover:text-[#B9FF66] transition-colors">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="divide-y divide-[#191A23]/20">
            @forelse($recentJobs as $job)
            <div class="p-6 hover:bg-[#B9FF66]/10 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-[#191A23]">{{ $job->title }}</h3>
                        <p class="text-sm text-[#191A23]/80 mt-1">{{ $job->company_name }} • {{ $job->location }}</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-xl text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                            {{ $job->job_type }}
                        </span>
                    </div>
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <span class="text-xs text-[#191A23]/70 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Posted {{ $job->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('job-seeker.jobs.details', $job) }}" class="inline-flex items-center px-3 py-1.5 border border-[#191A23] text-xs font-medium rounded-xl text-[#191A23] bg-transparent hover:bg-[#B9FF66] hover:border-[#B9FF66] transition-colors">
                        View Details
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-[#191A23]/10 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-[#191A23]/70 mb-4">No job listings available at the moment.</p>
                <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] border-2 border-[#191A23] transition-colors" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    Browse All Jobs
                </a>
            </div>
            @endforelse
        </div>
    </div>
    
    <!-- Recent Applications -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="border-b border-[#191A23]/30 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                My Recent Applications
            </h2>
            <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center text-sm font-medium text-[#191A23] hover:text-[#B9FF66] transition-colors">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="divide-y divide-[#191A23]/20">
            @forelse($recentApplications as $application)
            <div class="p-6 hover:bg-[#B9FF66]/10 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-medium text-[#191A23]">{{ $application->jobPosition->title }}</h3>
                        <p class="text-sm text-[#191A23]/80 mt-1">{{ $application->jobPosition->company_name }}</p>
                    </div>
                    <div>
                        @php
                            $statusBaseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-xl text-xs font-medium border';
                            $statusColors = [
                                'pending' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                'in_review' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                'reviewed' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                'shortlisted' => 'bg-[#B9FF66] text-[#191A23] border-[#191A23]',
                                'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                'hired' => 'bg-[#B9FF66] text-[#191A23] border-[#191A23]',
                            ];
                            $statusShadow = (
                                $application->status === 'shortlisted' || $application->status === 'hired'
                                ? 'box-shadow: 0px 1px 0px 0 #191a23;' 
                                : ''
                            );
                            $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                            
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
                        <span class="{{ $statusBaseClasses }} {{ $statusColor }}" style="{{ $statusShadow }}">
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>
                <div class="mt-3 flex justify-between items-center">
                    <span class="text-xs text-[#191A23]/70 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </span>
                    <a href="{{ route('job-seeker.applications.show', $application) }}" class="inline-flex items-center px-3 py-1.5 border border-[#191A23] text-xs font-medium rounded-xl text-[#191A23] bg-transparent hover:bg-[#B9FF66] hover:border-[#B9FF66] transition-colors">
                        View Application
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="inline-block p-4 rounded-full bg-[#191A23]/10 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-[#191A23]/70 mb-4">You haven't applied to any jobs yet.</p>
                <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] border-2 border-[#191A23] transition-colors" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    Find Jobs Now
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection