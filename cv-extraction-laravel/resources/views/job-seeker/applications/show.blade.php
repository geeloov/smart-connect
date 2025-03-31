@extends('layouts.app')

@section('content')
<div class="py-10 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="mb-8 flex justify-between items-center">
            <div>
                <div class="flex items-center">
                    <a href="{{ route('job-seeker.applications.index') }}" class="mr-2 flex items-center text-indigo-600 hover:text-indigo-700">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        Application Details
                    </span>
                </div>
                <h1 class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight">{{ $jobApplication->jobPosition->title }}</h1>
            </div>
            
            <div>
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $jobApplication->getStatusBadgeClass() }}">
                    {{ $jobApplication->getFormattedStatus() }}
                </span>
            </div>
        </div>

        {{-- Success / Error Message --}}
        @if (session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-md bg-red-50 p-4 mb-6 border border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Application Card --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-600">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $jobApplication->jobPosition->title }}</h2>
                        <div class="flex items-center text-indigo-100 text-sm mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $jobApplication->jobPosition->company_name }}
                            <span class="mx-2">•</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $jobApplication->jobPosition->location }}
                        </div>
                    </div>
                    
                    @if($jobApplication->compatibility_score)
                    <div class="mt-4 sm:mt-0 bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                        <div class="font-medium text-gray-700 text-sm mb-2">Match Score</div>
                        <div class="flex items-center justify-center">
                            <div class="relative h-20 w-20">
                                <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 100 100">
                                    <circle class="text-gray-200" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10" />
                                    <circle
                                        class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-500' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-400' : 'text-red-500') }}"
                                        cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10"
                                        stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283"
                                        stroke-linecap="round"
                                        style="transition: stroke-dasharray 1s ease;"
                                    />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-gray-800 text-2xl font-bold">{{ $jobApplication->compatibility_score }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs text-center mt-2 text-gray-500">
                            {{ $jobApplication->compatibility_score >= 70 ? 'Strong match' : ($jobApplication->compatibility_score >= 40 ? 'Good match' : 'Basic match') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="px-6 py-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Application Details
                        </h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Application Date</span>
                                    <span class="text-sm text-gray-900">{{ $jobApplication->created_at->format('F j, Y, g:i a') }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">CV Filename</span>
                                    <span class="text-sm text-gray-900 max-w-xs truncate">{{ $jobApplication->cv_filename }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Status</span>
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $jobApplication->getStatusBadgeClass() }}">
                                        {{ $jobApplication->getFormattedStatus() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Company Information
                        </h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Position</span>
                                    <span class="text-sm text-gray-900">{{ $jobApplication->jobPosition->title }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Company</span>
                                    <span class="text-sm text-gray-900">{{ $jobApplication->jobPosition->company_name }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500">Location</span>
                                    <span class="text-sm text-gray-900">{{ $jobApplication->jobPosition->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                @if($jobApplication->recruiter_notes)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        Recruiter Feedback
                    </h3>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-gray-800">
                        {{ $jobApplication->recruiter_notes }}
                    </div>
                </div>
                @endif
                
                @if($jobApplication->cover_letter)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Cover Letter
                    </h3>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 text-sm text-gray-800 whitespace-pre-line">
                        {{ $jobApplication->cover_letter }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Job Description -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Job Description
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="prose max-w-none">
                    {!! nl2br(e($jobApplication->jobPosition->description)) !!}
                </div>
            </div>
        </div>

        <!-- Application Status Timeline -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-white">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Application Status
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="relative">
                    @php
                        $statuses = [
                            'pending' => ['label' => 'Application Submitted', 'order' => 1],
                            'in_review' => ['label' => 'In Review', 'order' => 2],
                            'accepted' => ['label' => 'Accepted', 'order' => 3],
                            'rejected' => ['label' => 'Rejected', 'order' => 3]
                        ];
                        
                        $currentStatus = $jobApplication->status;
                        $currentOrder = $statuses[$currentStatus]['order'] ?? 0;
                    @endphp
                    
                    <div class="ml-6 border-l-2 border-gray-200 pb-6 pl-6 space-y-6">
                        <!-- Submitted -->
                        <div class="relative">
                            <div class="absolute -left-9 flex items-center justify-center w-6 h-6 rounded-full bg-green-500 ring-8 ring-white">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Application Submitted</h4>
                                <p class="text-sm text-gray-600">{{ $jobApplication->created_at->format('F j, Y, g:i a') }}</p>
                            </div>
                        </div>
                        
                        <!-- In Review -->
                        <div class="relative">
                            <div class="absolute -left-9 flex items-center justify-center w-6 h-6 rounded-full {{ $currentOrder >= 2 ? 'bg-blue-500' : 'bg-gray-300' }} ring-8 ring-white">
                                @if($currentOrder >= 2)
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold {{ $currentOrder >= 2 ? 'text-gray-900' : 'text-gray-500' }}">In Review</h4>
                                <p class="text-sm {{ $currentOrder >= 2 ? 'text-gray-600' : 'text-gray-400' }}">Your application is being reviewed by the hiring team</p>
                            </div>
                        </div>
                        
                        <!-- Final Status -->
                        <div class="relative">
                            <div class="absolute -left-9 flex items-center justify-center w-6 h-6 rounded-full {{ $currentOrder >= 3 ? ($currentStatus == 'accepted' ? 'bg-green-500' : 'bg-red-500') : 'bg-gray-300' }} ring-8 ring-white">
                                @if($currentOrder >= 3)
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold {{ $currentOrder >= 3 ? 'text-gray-900' : 'text-gray-500' }}">
                                    {{ $currentStatus == 'accepted' ? 'Application Accepted' : ($currentStatus == 'rejected' ? 'Application Rejected' : 'Decision Pending') }}
                                </h4>
                                <p class="text-sm {{ $currentOrder >= 3 ? 'text-gray-600' : 'text-gray-400' }}">
                                    {{ $currentStatus == 'accepted' ? 'Congratulations! Your application has been accepted.' : 
                                       ($currentStatus == 'rejected' ? 'Thank you for your interest in this position.' : 
                                       'The final decision on your application is pending') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('job-seeker.applications.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150 transform hover:scale-[1.02]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Applications
            </a>
        </div>
    </div>
</div>
@endsection 