@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Background Circles -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-100/10 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-100/10 rounded-full translate-x-1/3 translate-y-1/3 pointer-events-none"></div>
        
        <!-- Page Header -->
        <div class="mb-10 relative">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                        CV Analysis
                    </span>
                    <h1 class="mt-3 text-3xl font-bold text-gray-900">CV Analysis Tool</h1>
                    <p class="mt-2 text-gray-600 max-w-3xl">Extract information from your CV and match it to job requirements</p>
                </div>
            </div>
        </div>
        
        <!-- Upload Form Card -->
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
                
                <!-- Form Content -->
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Upload Your CV</h2>
                            <p class="mt-2 text-gray-600">Upload your CV to extract skills, experience, and match with job requirements</p>
                        </div>
                        <div class="hidden md:flex h-16 w-16 rounded-xl bg-indigo-600 text-white flex-shrink-0 items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- CV Upload Form -->
                    <form method="POST" action="{{ route('job-seeker.cv-upload.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-2">Upload your CV (PDF)</label>
                                
                                <!-- File Upload - Initial State -->
                                <div id="upload-initial" class="relative border-2 border-gray-300 border-dashed rounded-xl py-12 px-6 transition hover:border-indigo-500 focus-within:border-indigo-500 group bg-gray-50">
                                    <input type="file" name="cv_file" id="cv_file" 
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                        required>
                                    <div class="text-center">
                                        <svg class="mx-auto h-20 w-20 text-gray-400 group-hover:text-indigo-500 transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-4 text-base text-gray-600 group-hover:text-indigo-600 transition-colors duration-300">
                                            <span class="font-medium text-indigo-600">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="mt-2 text-sm text-gray-500">PDF format only (max 10MB)</p>
                                    </div>
                                </div>
                                
                                <!-- File Upload - File Selected State -->
                                <div id="upload-selected" class="hidden relative border-2 border-indigo-500 rounded-xl py-6 px-6 bg-indigo-50">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 h-14 w-14 bg-indigo-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-8 w-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h4 class="text-base font-medium text-indigo-800" id="selected-filename">filename.pdf</h4>
                                            <p class="mt-1 text-sm text-indigo-600" id="selected-filesize">Size: 0KB</p>
                                            <div class="mt-3">
                                                <button type="button" id="change-file-btn" class="inline-flex items-center px-3 py-2 border border-indigo-300 shadow-sm text-sm font-medium rounded-lg text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                                    Change file
                                                </button>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <svg class="h-6 w-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                @error('cv_file')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="pt-4">
                                <label for="job_description" class="block text-sm font-medium text-gray-700 mb-2">Job Description (Optional)</label>
                                <div class="relative rounded-xl shadow-sm focus-within:ring-1 focus-within:ring-indigo-500 focus-within:border-indigo-500">
                                    <textarea name="job_description" id="job_description" 
                                        class="block w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 resize-none shadow-sm bg-white"
                                        placeholder="Paste job description to match your CV against specific requirements..."
                                        rows="6">{{ old('job_description') }}</textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 italic">
                                    Providing a job description will help match your CV to specific requirements and calculate a match score.
                                </p>
                            </div>
                        </div>
                        
                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Extract CV Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- CV Extraction Results -->
        @if(isset($cvData))
        <div class="relative my-12">
            <div class="absolute inset-0 bg-green-600 opacity-10 rounded-2xl"></div>
            <div class="relative z-10 bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-green-600 to-teal-600 px-6 py-5">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        CV Analysis Results
                    </h2>
                    <p class="text-green-100 text-sm mt-1">Information extracted from your CV</p>
                </div>
                
                <!-- Content Section -->
                <div class="p-6 lg:p-8">
                    <!-- Tabs Navigation -->
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                            <button id="tab-formatted" class="tab-btn py-3 border-b-2 font-medium text-indigo-600 border-indigo-500">
                                Formatted View
                            </button>
                            <button id="tab-raw" class="tab-btn py-3 border-b-2 font-medium text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 transition-colors">
                                Raw JSON
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Formatted View Content -->
                    <div id="formatted-view" class="space-y-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <tbody class="divide-y divide-gray-200">
                                    <!-- Personal Information -->
                                    @if(isset($cvData['name']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 bg-gray-50 rounded-l-lg">Name:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">{{ $cvData['name'] }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($cvData['email']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3">Email:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700">{{ $cvData['email'] }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($cvData['phone']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 bg-gray-50 rounded-l-lg">Phone:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">{{ $cvData['phone'] }}</td>
                                    </tr>
                                    @endif
                                    
                                    @if(isset($cvData['address']) || isset($cvData['location']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3">Location:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700">{{ $cvData['address'] ?? $cvData['location'] ?? 'Not specified' }}</td>
                                    </tr>
                                    @endif
                                    
                                    <!-- Skills -->
                                    @if(isset($cvData['skills']) && is_array($cvData['skills']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top bg-gray-50 rounded-l-lg">Skills:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($cvData['skills'] as $skill)
                                                    @if(is_string($skill))
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                            {{ $skill }}
                                                        </span>
                                                    @elseif(is_array($skill))
                                                        @if(isset($skill['name']))
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                                {{ $skill['name'] }}
                                                                @if(isset($skill['level']))
                                                                    <span class="ml-1 text-indigo-600">({{ $skill['level'] }})</span>
                                                                @endif
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                                {{ implode(', ', array_filter($skill)) }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                    <!-- Education -->
                                    @if(isset($cvData['education']) && is_array($cvData['education']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top">Education:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700">
                                            <div class="space-y-4">
                                                @foreach($cvData['education'] as $edu)
                                                    @if(is_string($edu))
                                                        <div class="pb-2 border-b border-gray-100">{{ $edu }}</div>
                                                    @elseif(is_array($edu))
                                                        <div class="pb-3 border-b border-gray-100">
                                                            @if(isset($edu['institution']))
                                                                <div class="font-medium text-gray-900">{{ $edu['institution'] }}</div>
                                                            @endif
                                                            
                                                            <div>
                                                                @if(isset($edu['degree']))
                                                                    {{ $edu['degree'] }}
                                                                @endif
                                                                
                                                                @if(isset($edu['field']))
                                                                    - {{ $edu['field'] }}
                                                                @endif
                                                            </div>
                                                            
                                                            @if(isset($edu['year']) || isset($edu['graduation_year']))
                                                                <div class="text-gray-500 text-xs mt-1">
                                                                    {{ $edu['year'] ?? $edu['graduation_year'] ?? '' }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                    <!-- Work Experience -->
                                    @if(isset($cvData['work_experience']) && is_array($cvData['work_experience']))
                                    <tr>
                                        <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top bg-gray-50 rounded-l-lg">Work Experience:</th>
                                        <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">
                                            <div class="space-y-6">
                                                @foreach($cvData['work_experience'] as $exp)
                                                    @if(is_string($exp))
                                                        <div class="pb-4 border-b border-gray-200">{{ $exp }}</div>
                                                    @elseif(is_array($exp))
                                                        <div class="pb-4 border-b border-gray-200 hover:bg-gray-50 transition duration-150 p-2 rounded-lg">
                                                            <div class="font-medium text-gray-900">
                                                                @if(isset($exp['company']))
                                                                    {{ $exp['company'] }}
                                                                @elseif(isset($exp['employer']))
                                                                    {{ $exp['employer'] }}
                                                                @elseif(isset($exp['organization']))
                                                                    {{ $exp['organization'] }}
                                                                @endif
                                                                
                                                                @if(isset($exp['position']) || isset($exp['title']) || isset($exp['role']))
                                                                    - {{ $exp['position'] ?? $exp['title'] ?? $exp['role'] }}
                                                                @endif
                                                            </div>
                                                            
                                                            @if(isset($exp['duration']) || isset($exp['start_date']) || isset($exp['end_date']))
                                                                <div class="text-gray-500 text-xs mt-1">
                                                                    @if(isset($exp['duration']))
                                                                        {{ $exp['duration'] }}
                                                                    @elseif(isset($exp['start_date']) || isset($exp['end_date']))
                                                                        {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['end_date'] ?? 'Present' }}
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            
                                                            @if(isset($exp['description']) || isset($exp['responsibilities']))
                                                                <p class="mt-2 text-gray-700">
                                                                    {{ $exp['description'] ?? $exp['responsibilities'] }}
                                                                </p>
                                                            @endif
                                                            
                                                            @if(isset($exp['achievements']) && is_array($exp['achievements']))
                                                                <div class="mt-2 pl-4 border-l-2 border-green-300">
                                                                    <div class="text-xs font-medium text-gray-900 mb-1">Achievements:</div>
                                                                    <ul class="list-disc pl-5 text-sm text-gray-700">
                                                                        @foreach($exp['achievements'] as $achievement)
                                                                            <li>{{ $achievement }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Raw JSON View -->
                    <div id="raw-json" class="mt-6 hidden">
                        <pre id="json-display" class="bg-gray-50 p-6 rounded-xl overflow-x-auto text-xs h-96 text-gray-800 border border-gray-200">{{ json_encode($cvData, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    
                    <!-- Job Matching Results -->
                    @if(isset($jobMatching))
                    <div class="mt-8 rounded-xl bg-indigo-50 p-8 border border-indigo-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Job Matching Results
                        </h3>
                        
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                            <div class="p-6 border-b border-gray-100">
                                @if(isset($jobMatching['score']))
                                <div class="flex items-center">
                                    <div class="w-1/3 text-sm font-medium text-gray-900">Match Score:</div>
                                    <div class="w-2/3">
                                        <div class="flex items-center">
                                            <div class="mr-4 text-xl font-bold 
                                                @if($jobMatching['score'] >= 80) text-green-600
                                                @elseif($jobMatching['score'] >= 60) text-blue-600
                                                @elseif($jobMatching['score'] >= 40) text-yellow-600
                                                @else text-red-600 @endif">
                                                {{ $jobMatching['score'] }}%
                                            </div>
                                            <div class="w-full max-w-xs bg-gray-200 rounded-full h-2.5">
                                                <div class="h-2.5 rounded-full 
                                                    @if($jobMatching['score'] >= 80) bg-green-600
                                                    @elseif($jobMatching['score'] >= 60) bg-blue-600
                                                    @elseif($jobMatching['score'] >= 40) bg-yellow-600
                                                    @else bg-red-600 @endif" 
                                                    style="width: {{ $jobMatching['score'] }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            @if(isset($jobMatching['matching_skills']) && is_array($jobMatching['matching_skills']))
                            <div class="p-6">
                                <div class="flex items-start">
                                    <div class="w-1/3 text-sm font-medium text-gray-900">Matching Skills:</div>
                                    <div class="w-2/3">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($jobMatching['matching_skills'] as $skill)
                                                @if(is_string($skill))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $skill }}
                                                    </span>
                                                @elseif(is_array($skill) && isset($skill['name']))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $skill['name'] }}
                                                    </span>
                                                @elseif(is_array($skill))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ implode(', ', array_filter($skill)) }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="mt-8 flex justify-center">
                        <a href="{{ route('job-seeker.cv-upload') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-md text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                            Upload Another CV
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add JavaScript for handling file upload state and tab switching -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('cv_file');
        const initialUploadDiv = document.getElementById('upload-initial');
        const selectedUploadDiv = document.getElementById('upload-selected');
        const selectedFilename = document.getElementById('selected-filename');
        const selectedFilesize = document.getElementById('selected-filesize');
        const changeFileBtn = document.getElementById('change-file-btn');
        
        // Tab switching functionality
        const tabFormatted = document.getElementById('tab-formatted');
        const tabRaw = document.getElementById('tab-raw');
        const formattedView = document.getElementById('formatted-view');
        const rawJson = document.getElementById('raw-json');
        
        if (tabFormatted && tabRaw) {
            tabFormatted.addEventListener('click', function() {
                formattedView.classList.remove('hidden');
                rawJson.classList.add('hidden');
                tabFormatted.classList.add('text-indigo-600', 'border-indigo-500');
                tabFormatted.classList.remove('text-gray-500', 'border-transparent');
                tabRaw.classList.add('text-gray-500', 'border-transparent');
                tabRaw.classList.remove('text-indigo-600', 'border-indigo-500');
            });
            
            tabRaw.addEventListener('click', function() {
                formattedView.classList.add('hidden');
                rawJson.classList.remove('hidden');
                tabRaw.classList.add('text-indigo-600', 'border-indigo-500');
                tabRaw.classList.remove('text-gray-500', 'border-transparent');
                tabFormatted.classList.add('text-gray-500', 'border-transparent');
                tabFormatted.classList.remove('text-indigo-600', 'border-indigo-500');
            });
        }
        
        // Function to format bytes to KB, MB
        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }
        
        // Handle file selection
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    // Update the selected file info
                    selectedFilename.textContent = file.name;
                    selectedFilesize.textContent = 'Size: ' + formatFileSize(file.size);
                    
                    // Show the selected state
                    initialUploadDiv.classList.add('hidden');
                    selectedUploadDiv.classList.remove('hidden');
                } else {
                    // Show the initial state if no file selected
                    initialUploadDiv.classList.remove('hidden');
                    selectedUploadDiv.classList.add('hidden');
                }
            });
        }
        
        // Handle "Change file" button click
        if (changeFileBtn) {
            changeFileBtn.addEventListener('click', function() {
                // Reset the file input
                fileInput.value = '';
                // Show the initial state
                initialUploadDiv.classList.remove('hidden');
                selectedUploadDiv.classList.add('hidden');
                // Trigger file input click
                setTimeout(() => {
                    fileInput.click();
                }, 100);
            });
        }
    });
</script>
@endsection