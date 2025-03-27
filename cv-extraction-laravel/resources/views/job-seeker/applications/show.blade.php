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
        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
            <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-50">
                    <circle cx="150" cy="150" r="150" fill="currentColor"/>
                    <circle cx="150" cy="150" r="120" fill="white"/>
                    <circle cx="150" cy="150" r="100" fill="currentColor"/>
                    <circle cx="150" cy="150" r="80" fill="white"/>
                    <circle cx="150" cy="150" r="60" fill="currentColor"/>
                </svg>
            </div>
            
            <div class="relative z-10">
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
                        <div class="mt-4 sm:mt-0 bg-white bg-opacity-10 rounded-lg p-3 text-center">
                            <div class="font-medium text-white text-sm mb-1">Compatibility Score</div>
                            <div class="flex items-center justify-center">
                                <div class="relative h-16 w-16">
                                    <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 100 100">
                                        <circle class="text-white text-opacity-20" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8" />
                                        <circle
                                            class="{{ $jobApplication->compatibility_score >= 70 ? 'text-green-400' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-300' : 'text-red-400') }}"
                                            cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8"
                                            stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283"
                                            stroke-linecap="round"
                                        />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-white text-xl font-bold">{{ $jobApplication->compatibility_score }}%</span>
                                    </div>
                                </div>
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
        </div>

        {{-- CV Extracted Data Section --}}
        @php
            $cvData = null;
            if ($jobApplication->cv_data) {
                if (is_string($jobApplication->cv_data)) {
                    try {
                        $cvData = json_decode($jobApplication->cv_data, true);
                    } catch (\Exception $e) {
                        $cvData = null;
                    }
                } else {
                    $cvData = $jobApplication->cv_data;
                }
            }
        @endphp

        @if($cvData)
        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
            <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block opacity-30">
                <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-blue-50">
                    <circle cx="150" cy="150" r="150" fill="currentColor"/>
                    <circle cx="150" cy="150" r="120" fill="white"/>
                    <circle cx="150" cy="150" r="100" fill="currentColor"/>
                </svg>
            </div>
            
            <div class="relative z-10">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-600">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Your CV Information
                            </h2>
                            <p class="text-blue-100 text-sm mt-1">Extracted data from your resume</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-blue-800">
                            Resume Data
                        </span>
                    </div>
                </div>

                <div class="px-6 py-5">
                    
                    {{-- Personal Information --}}
                    @if(isset($cvData['name']) || isset($cvData['email']) || isset($cvData['phone']) || isset($cvData['location']) || isset($cvData['address']) || isset($cvData['summary']) || isset($cvData['profile']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                        </div>
                        
                        <div class="bg-gradient-to-br from-white to-blue-50 rounded-lg p-5 border border-blue-100 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if(isset($cvData['name']))
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500 mb-1">Name</span>
                                    <span class="text-md text-gray-900 font-medium">{{ $cvData['name'] }}</span>
                                </div>
                                @endif
                                
                                @if(isset($cvData['email']))
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500 mb-1">Email</span>
                                    <a href="mailto:{{ $cvData['email'] }}" class="text-md text-blue-600 hover:text-blue-800 transition">{{ $cvData['email'] }}</a>
                                </div>
                                @endif
                                
                                @if(isset($cvData['phone']))
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500 mb-1">Phone</span>
                                    <span class="text-md text-gray-900">{{ $cvData['phone'] }}</span>
                                </div>
                                @endif
                                
                                @if(isset($cvData['location']) || isset($cvData['address']))
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-500 mb-1">Location</span>
                                    <span class="text-md text-gray-900">{{ $cvData['location'] ?? $cvData['address'] ?? '' }}</span>
                                </div>
                                @endif
                            </div>
                            
                            @if(isset($cvData['summary']) || isset($cvData['profile']))
                            <div class="mt-6">
                                <span class="text-sm font-medium text-gray-500 mb-1 block">Professional Summary</span>
                                <p class="text-gray-800 mt-2 bg-white p-4 rounded-lg border border-blue-100 leading-relaxed">
                                    {{ $cvData['summary'] ?? $cvData['profile'] ?? '' }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    {{-- Skills Section --}}
                    @if(isset($cvData['skills']) && !empty($cvData['skills']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Skills</h3>
                        </div>
                        
                        <div class="bg-gradient-to-br from-white to-indigo-50 rounded-lg p-5 border border-indigo-100 shadow-sm">
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach((is_array($cvData['skills']) ? $cvData['skills'] : [$cvData['skills']]) as $skill)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200 shadow-sm">
                                        {{ is_array($skill) ? ($skill['name'] ?? $skill[0] ?? '') : $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Work Experience --}}
                    @if(isset($cvData['work_experience']) || isset($cvData['experience']) || isset($cvData['employment_history']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Work Experience</h3>
                        </div>
                        
                        @php
                            $experiences = $cvData['work_experience'] ?? $cvData['experience'] ?? $cvData['employment_history'] ?? [];
                            if (!is_array($experiences)) {
                                $experiences = [$experiences];
                            }
                        @endphp
                        
                        <div class="space-y-5">
                            @foreach($experiences as $experience)
                                <div class="bg-gradient-to-br from-white to-purple-50 rounded-lg p-5 border border-purple-100 shadow-sm hover:shadow-md transition-shadow">
                                    @if(is_array($experience))
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-lg">
                                                    {{ $experience['title'] ?? $experience['position'] ?? $experience['job_title'] ?? 'Position' }}
                                                </h4>
                                                <p class="text-sm text-purple-700 font-medium">
                                                    {{ $experience['company'] ?? $experience['employer'] ?? $experience['organization'] ?? 'Company' }}
                                                </p>
                                            </div>
                                            <div class="mt-2 md:mt-0 bg-white px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-purple-100 inline-flex items-center shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $experience['date'] ?? ($experience['start_date'] ?? '') . ' - ' . ($experience['end_date'] ?? 'Present') }}
                                            </div>
                                        </div>
                                        @if(isset($experience['description']) || isset($experience['responsibilities']))
                                            <p class="mt-3 text-sm text-gray-700 whitespace-pre-line bg-white p-4 rounded-lg border border-purple-100 leading-relaxed">
                                                {{ $experience['description'] ?? $experience['responsibilities'] ?? '' }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-700">{{ $experience }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Education --}}
                    @if(isset($cvData['education']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2 bg-green-100 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Education</h3>
                        </div>
                        
                        @php
                            $educations = $cvData['education'];
                            if (!is_array($educations)) {
                                $educations = [$educations];
                            }
                        @endphp
                        
                        <div class="space-y-5">
                            @foreach($educations as $education)
                                <div class="bg-gradient-to-br from-white to-green-50 rounded-lg p-5 border border-green-100 shadow-sm hover:shadow-md transition-shadow">
                                    @if(is_array($education))
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-lg">
                                                    {{ $education['degree'] ?? $education['qualification'] ?? 'Degree' }}
                                                </h4>
                                                <p class="text-sm text-green-700 font-medium">
                                                    {{ $education['institution'] ?? $education['school'] ?? $education['university'] ?? 'Institution' }}
                                                </p>
                                            </div>
                                            <div class="mt-2 md:mt-0 bg-white px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-green-100 inline-flex items-center shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $education['date'] ?? ($education['start_date'] ?? '') . ' - ' . ($education['end_date'] ?? '') }}
                                            </div>
                                        </div>
                                        @if(isset($education['description']))
                                            <p class="mt-3 text-sm text-gray-700 bg-white p-4 rounded-lg border border-green-100 leading-relaxed">
                                                {{ $education['description'] }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-700">{{ $education }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    {{-- Additional Sections --}}
                    @foreach($cvData as $key => $value)
                        @if(!in_array($key, ['name', 'email', 'phone', 'location', 'address', 'summary', 'profile', 'skills', 'work_experience', 'experience', 'employment_history', 'education', 'cv_data', 'error']) && !empty($value))
                            <div class="mb-8">
                                <div class="flex items-center mb-4">
                                    <div class="p-2 bg-gray-100 rounded-lg mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ ucwords(str_replace('_', ' ', $key)) }}</h3>
                                </div>
                                
                                <div class="bg-gradient-to-br from-white to-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                                    @if(is_array($value))
                                        <div class="space-y-3">
                                            @foreach($value as $item)
                                                @if(is_array($item) || is_object($item))
                                                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-sm transition-shadow">
                                                        @foreach($item as $itemKey => $itemValue)
                                                            @if(!is_array($itemValue) && !is_object($itemValue))
                                                                <div class="mb-2">
                                                                    <span class="text-sm font-medium text-gray-500">{{ ucwords(str_replace('_', ' ', $itemKey)) }}:</span>
                                                                    <span class="text-sm text-gray-900 ml-1">{{ $itemValue }}</span>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="text-sm text-gray-700 py-2 px-3 bg-white rounded-lg border border-gray-100">{{ $item }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-700 p-4 bg-white rounded-lg border border-gray-100">{{ $value }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif

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

<!-- Script for transitions and animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add fade-in animation to sections
        const sections = document.querySelectorAll('.bg-white.rounded-2xl');
        sections.forEach((section, index) => {
            section.classList.add('opacity-0');
            setTimeout(() => {
                section.classList.add('transition-opacity', 'duration-500');
                section.classList.remove('opacity-0');
            }, 100 * (index + 1));
        });
        
        // Add hover effects to cards
        const cards = document.querySelectorAll('.rounded-lg.border');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-md');
                this.classList.add('border-indigo-200');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-md');
                this.classList.remove('border-indigo-200');
            });
        });
    });
</script>
@endsection 