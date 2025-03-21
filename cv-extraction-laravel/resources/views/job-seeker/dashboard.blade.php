@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-dark mb-6">Job Seeker Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Applications</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $totalApplications }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Pending Applications</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $pendingApplications }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Shortlisted</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $shortlistedApplications }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('job-seeker.jobs.available') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">Browse Jobs</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Find new job opportunities</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('job-seeker.cv-upload') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">Upload CV</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Update your CV profile</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('job-seeker.applications.index') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">My Applications</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Track your job applications</p>
                </div>
            </div>
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recent Job Listings -->
        <div class="bg-light rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-dark">Recent Job Listings</h2>
                <a href="{{ route('job-seeker.jobs.available') }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($recentJobs as $job)
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-dark">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $job->company_name }} • {{ $job->location }}</p>
                        </div>
                        <div>
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $job->job_type }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</span>
                        <a href="{{ route('job-seeker.jobs.details', $job) }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <p class="text-gray-500">No job listings available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Applications -->
        <div class="bg-light rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-dark">My Recent Applications</h2>
                <a href="{{ route('job-seeker.applications.index') }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($recentApplications as $application)
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-dark">{{ $application->jobPosition->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $application->jobPosition->company_name }}</p>
                        </div>
                        <div>
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
                            <span class="inline-block {{ $statusColor }} text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Applied {{ $application->created_at->diffForHumans() }}</span>
                        <a href="{{ route('job-seeker.applications.show', $application) }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                            View Application
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <p class="text-gray-500">You haven't applied to any jobs yet. <a href="{{ route('job-seeker.jobs.available') }}" class="text-[#B9FF66] hover:underline">Browse available jobs</a>.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection