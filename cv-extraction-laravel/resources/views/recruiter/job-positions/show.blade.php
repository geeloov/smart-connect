@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-green-600 opacity-10 rounded-2xl"></div>
            <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden">
                <!-- Header Background Pattern -->
                <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block z-0">
                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-green-50">
                        <circle cx="150" cy="150" r="150" fill="currentColor"/>
                        <circle cx="150" cy="150" r="120" fill="white"/>
                        <circle cx="150" cy="150" r="100" fill="currentColor"/>
                        <circle cx="150" cy="150" r="80" fill="white"/>
                        <circle cx="150" cy="150" r="60" fill="currentColor"/>
                    </svg>
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
                    <div class="flex items-start gap-4">
                        <!-- Company Logo/Icon -->
                        <div class="hidden sm:block flex-shrink-0">
                            <div class="p-3 bg-green-500 rounded-xl shadow-md h-16 w-16 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                            </div>
                        </div>
                        
                        <!-- Job Title and Company -->
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Job Details
                                </span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $jobPosition->title }}</h1>
                            <p class="text-lg text-gray-600 mt-1">{{ $jobPosition->company_name }}</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3 mt-4 md:mt-0 bg-white py-1 px-2 rounded-lg relative z-20">
                        <a href="{{ route('recruiter.job-positions.edit', $jobPosition) }}" class="inline-flex items-center px-5 py-2.5 border-2 border-gray-400 text-sm font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Edit
                    </a>
                    </div>
                </div>
            </div>
            </div>

                <!-- Info Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col items-center">
                    <div class="p-3 rounded-xl bg-green-600 text-white mb-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Company</h3>
                            <p class="mt-1 text-lg font-bold text-gray-900">{{ $jobPosition->company_name }}</p>
                        </div>
                    </div>

            <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-amber-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col items-center">
                    <div class="p-3 rounded-xl bg-amber-500 text-white mb-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Location</h3>
                            <p class="mt-1 text-lg font-bold text-gray-900">{{ $jobPosition->location }}</p>
                        </div>
                    </div>

            <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col items-center">
                    <div class="p-3 rounded-xl bg-blue-600 text-white mb-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Job Type</h3>
                            @php
                                $jobTypeColor = '';
                                $jobTypeBg = '';
                                $jobType = strtolower($jobPosition->job_type);
                                
                                if (strpos($jobType, 'full-time') !== false || strpos($jobType, 'fulltime') !== false) {
                                    $jobTypeColor = 'text-green-700';
                            $jobTypeBg = 'bg-green-100 border-green-200';
                                } elseif (strpos($jobType, 'part-time') !== false || strpos($jobType, 'parttime') !== false) {
                                    $jobTypeColor = 'text-blue-700';
                            $jobTypeBg = 'bg-blue-100 border-blue-200';
                                } elseif (strpos($jobType, 'contract') !== false) {
                                    $jobTypeColor = 'text-purple-700';
                            $jobTypeBg = 'bg-purple-100 border-purple-200';
                                } elseif (strpos($jobType, 'freelance') !== false) {
                                    $jobTypeColor = 'text-orange-700';
                            $jobTypeBg = 'bg-orange-100 border-orange-200';
                                } elseif (strpos($jobType, 'intern') !== false) {
                                    $jobTypeColor = 'text-teal-700';
                            $jobTypeBg = 'bg-teal-100 border-teal-200';
                                } elseif (strpos($jobType, 'remote') !== false) {
                                    $jobTypeColor = 'text-indigo-700';
                            $jobTypeBg = 'bg-indigo-100 border-indigo-200';
                                } else {
                                    $jobTypeColor = 'text-gray-700';
                            $jobTypeBg = 'bg-gray-100 border-gray-200';
                                }
                            @endphp
                            <div class="mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $jobTypeBg }} {{ $jobTypeColor }} border">
                                    {{ $jobPosition->job_type }}
                                </span>
                            </div>
                        </div>
                    </div>

            <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl shadow-sm border border-purple-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col items-center">
                    <div class="p-3 rounded-xl bg-purple-600 text-white mb-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Applications</h3>
                            <p class="mt-1 text-lg font-bold text-gray-900">{{ $applications->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    @if($jobPosition->salary_range)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                            <h3 class="text-base font-medium text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Salary Range
                            </h3>
                        </div>
                <div class="px-6 py-4">
                            <p class="text-lg font-medium text-gray-900">{{ $jobPosition->salary_range }}</p>
                        </div>
                    </div>
                    @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                            <h3 class="text-base font-medium text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Posted
                            </h3>
                        </div>
                <div class="px-6 py-4">
                            <p class="text-lg font-medium text-gray-900">{{ $jobPosition->created_at->format('F d, Y') }}</p>
                            <p class="text-sm text-gray-500">({{ $jobPosition->created_at->diffForHumans() }})</p>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                        <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Job Description
                        </h3>
                    </div>
                    <div class="px-6 py-4">
                <div class="p-4 rounded-lg prose max-w-none">
                    <div id="job-description-short" class="whitespace-pre-line">
                        {{ Str::limit(strip_tags($jobPosition->description), 300) }}
                    </div>
                    <div id="job-description-full" class="whitespace-pre-line hidden">
                            {!! nl2br(e($jobPosition->description)) !!}
                    </div>
                    <button 
                        id="toggle-description" 
                        type="button" 
                        class="mt-3 inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors"
                    >
                        <span id="toggle-text">See More</span>
                        <svg id="toggle-icon-down" class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg id="toggle-icon-up" class="w-4 h-4 ml-2 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </button>
                </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                @if($jobPosition->requirements)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                        <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Requirements
                        </h3>
                    </div>
                    <div class="px-6 py-4">
                <div class="p-4 rounded-lg prose max-w-none">
                    <div id="requirements-short" class="whitespace-pre-line">
                        {{ Str::limit(strip_tags($jobPosition->requirements), 200) }}
                    </div>
                    <div id="requirements-full" class="whitespace-pre-line hidden">
                            {!! nl2br(e($jobPosition->requirements)) !!}
                    </div>
                    <button 
                        id="toggle-requirements" 
                        type="button" 
                        class="mt-3 inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors"
                    >
                        <span id="toggle-req-text">See More</span>
                        <svg id="toggle-req-icon-down" class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg id="toggle-req-icon-up" class="w-4 h-4 ml-2 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                            </svg>
                        </button>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Applications Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Applications ({{ $applications->count() }})
                </h3>
                @if($applications->count() > 0)
                <a href="{{ route('recruiter.applications.index', ['job_position_id' => $jobPosition->id]) }}" class="inline-flex items-center px-3 py-1.5 border border-green-600 text-xs font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View All Applications
                </a>
                @endif
            </div>
            <div class="px-6 py-4">
                @if($applications->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($applications->take(4) as $application)
                            <div class="border border-gray-200 rounded-lg p-4 hover:border-green-200 hover:shadow-sm transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $application->jobSeeker->name }}</h4>
                                        <p class="text-sm text-gray-600">Applied {{ $application->created_at->diffForHumans() }}</p>
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
                                <div class="mt-3 flex justify-end">
                                    <a href="{{ route('recruiter.applications.show', $application) }}" class="inline-flex items-center px-3 py-1 border border-green-600 text-xs font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Application
                                    </a>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    @if($applications->count() > 4)
                        <div class="mt-4 text-center">
                            <a href="{{ route('recruiter.applications.index', ['job_position_id' => $jobPosition->id]) }}" class="inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-lg text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                                View All {{ $applications->count() }} Applications
                            </a>
                        </div>
                    @endif
                @else
                    <div class="py-8 flex flex-col items-center justify-center text-center px-4">
                        <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No Applications Yet</h3>
                        <p class="text-gray-500 max-w-md">No job seekers have applied to this position yet. Check back later or consider promoting this job posting.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Positions
            </a>
            <form action="{{ route('recruiter.job-positions.destroy', $jobPosition) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job position? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Position
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for toggle functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Job Description Toggle
        const toggleBtn = document.getElementById('toggle-description');
        const shortDesc = document.getElementById('job-description-short');
        const fullDesc = document.getElementById('job-description-full');
        const toggleText = document.getElementById('toggle-text');
        const toggleIconDown = document.getElementById('toggle-icon-down');
        const toggleIconUp = document.getElementById('toggle-icon-up');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                shortDesc.classList.toggle('hidden');
                fullDesc.classList.toggle('hidden');
                toggleIconDown.classList.toggle('hidden');
                toggleIconUp.classList.toggle('hidden');
                
                if (toggleText.textContent === 'See More') {
                    toggleText.textContent = 'See Less';
                } else {
                    toggleText.textContent = 'See More';
                }
            });
        }

        // Requirements Toggle
        const toggleReqBtn = document.getElementById('toggle-requirements');
        const shortReq = document.getElementById('requirements-short');
        const fullReq = document.getElementById('requirements-full');
        const toggleReqText = document.getElementById('toggle-req-text');
        const toggleReqIconDown = document.getElementById('toggle-req-icon-down');
        const toggleReqIconUp = document.getElementById('toggle-req-icon-up');

        if (toggleReqBtn) {
            toggleReqBtn.addEventListener('click', function() {
                shortReq.classList.toggle('hidden');
                fullReq.classList.toggle('hidden');
                toggleReqIconDown.classList.toggle('hidden');
                toggleReqIconUp.classList.toggle('hidden');
                
                if (toggleReqText.textContent === 'See More') {
                    toggleReqText.textContent = 'See Less';
                } else {
                    toggleReqText.textContent = 'See More';
                }
            });
        }
    });
</script>
@endsection 