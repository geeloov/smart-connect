@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="relative mb-12">
            <div class="absolute inset-0 bg-indigo-600 opacity-10 rounded-2xl"></div>
            <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl shadow-xl border border-indigo-100 overflow-hidden">
                <!-- Header Background Pattern -->
                <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-50">
                        <circle cx="150" cy="150" r="150" fill="currentColor"/>
                        <circle cx="150" cy="150" r="120" fill="white"/>
                        <circle cx="150" cy="150" r="100" fill="currentColor"/>
                        <circle cx="150" cy="150" r="80" fill="white"/>
                        <circle cx="150" cy="150" r="60" fill="currentColor"/>
                    </svg>
                </div>

                <div class="flex flex-col md:flex-row md:items-start gap-8">
                    <div class="flex-shrink-0">
                        <div class="p-4 bg-indigo-600 rounded-xl shadow-md w-20 h-20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    Dashboard
                                </span>
                                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Welcome Back!</h1>
                                <p class="mt-2 text-lg text-gray-600">Manage your applications and browse new job opportunities</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl shadow-sm border border-indigo-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-600 text-white mr-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Applications</p>
                        <div class="flex items-baseline space-x-1">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $totalApplications }}</h3>
                            <span class="text-sm text-indigo-600 font-medium">applications</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-amber-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-amber-500 text-white mr-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Pending Applications</p>
                        <div class="flex items-baseline space-x-1">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $pendingApplications }}</h3>
                            <span class="text-sm text-amber-600 font-medium">in review</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-green-600 text-white mr-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Shortlisted</p>
                        <div class="flex items-baseline space-x-1">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $shortlistedApplications }}</h3>
                            <span class="text-sm text-green-600 font-medium">positions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('job-seeker.jobs.available') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-200 group">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-700 transition-colors">Browse Jobs</h3>
                        <p class="text-gray-500 text-sm">Find new job opportunities</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('job-seeker.cv-upload') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-200 group">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-700 transition-colors">Upload CV</h3>
                        <p class="text-gray-500 text-sm">Update your CV profile</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('job-seeker.applications.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:border-indigo-200 transition-all duration-200 group">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white mr-4 transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 group-hover:text-indigo-700 transition-colors">My Applications</h3>
                        <p class="text-gray-500 text-sm">Track your job applications</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Recent Job Listings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Recent Job Listings
                    </h2>
                    <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                        View All
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @forelse($recentJobs as $job)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $job->company_name }} • {{ $job->location }}</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                    {{ $job->job_type }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-xs text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Posted {{ $job->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('job-seeker.jobs.details', $job) }}" class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-xs font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-600 hover:text-white transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center">
                        <div class="inline-block p-4 rounded-full bg-indigo-50 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 mb-4">No job listings available at the moment.</p>
                        <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Browse All Jobs
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Recent Applications -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        My Recent Applications
                    </h2>
                    <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                        View All
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                
                <div class="divide-y divide-gray-100">
                    @forelse($recentApplications as $application)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $application->jobPosition->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $application->jobPosition->company_name }}</p>
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
                            <a href="{{ route('job-seeker.applications.show', $application) }}" class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-xs font-medium rounded-lg text-indigo-600 bg-white hover:bg-indigo-600 hover:text-white transition-colors">
                                View Application
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center">
                        <div class="inline-block p-4 rounded-full bg-indigo-50 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-gray-500 mb-4">You haven't applied to any jobs yet.</p>
                        <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Browse Available Jobs
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection