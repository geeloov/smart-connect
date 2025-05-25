@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="relative mb-6">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                                    CV Analysis Tool
                                </span>
                                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Manage & Analyze Your CVs</h1>
                                <p class="mt-2 text-lg text-[#191A23]/80">Upload, analyze, and manage your CVs to effectively match with job opportunities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-[#B9FF66]/30 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm text-[#191A23] font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="mb-6 p-4 bg-[#FF4D4D]/20 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-[#FF4D4D]" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm text-[#FF4D4D] font-medium">{{ session('error') }}</p>
            </div>
        </div>
        @endif
        
        <!-- Upload Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="border-b border-[#191A23]/30 px-6 py-4">
                <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Upload Your CV
                </h2>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('job-seeker.cv-upload.store') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <label for="cv_file" class="block text-sm font-medium text-[#191A23]">Upload CV (PDF format)</label>
                                <span class="text-xs text-[#191A23]/70">Max: 10MB</span>
                            </div>
                            
                            <!-- File Upload - Initial State -->
                            <div id="upload-initial" class="relative border-2 border-[#191A23]/50 border-dashed rounded-xl py-12 px-6 transition hover:border-[#191A23] hover:bg-[#191A23]/5 group">
                                <input type="file" name="cv_file" id="cv_file" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                    required>
                                <div class="text-center">
                                    <svg class="mx-auto h-20 w-20 text-[#191A23]/70 group-hover:text-[#191A23] transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-4 text-base text-[#191A23]/90">
                                        <span class="font-medium text-[#191A23] group-hover:text-[#B9FF66] transition-colors duration-300">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="mt-2 text-sm text-[#191A23]/70">PDF format only (max 10MB)</p>
                                </div>
                            </div>
                            
                            <!-- File Upload - File Selected State -->
                            <div id="upload-selected" class="hidden relative border-2 border-[#191A23] rounded-xl py-6 px-6 bg-[#191A23]/5">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-14 w-14 bg-[#B9FF66]/40 rounded-lg flex items-center justify-center">
                                        <svg class="h-8 w-8 text-[#191A23]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-base font-medium text-[#191A23]" id="selected-filename">filename.pdf</h4>
                                        <p class="mt-1 text-sm text-[#191A23]/80" id="selected-filesize">Size: 0KB</p>
                                        <div class="mt-3">
                                            <button type="button" id="change-file-btn" class="inline-flex items-center px-3 py-2 border border-[#191A23]/50 text-sm font-medium rounded-xl text-[#191A23] bg-transparent hover:bg-[#191A23]/5 hover:border-[#191A23] transition-all duration-200">
                                                Change file
                                            </button>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <svg class="h-6 w-6 text-[#B9FF66]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            @error('cv_file')
                                <p class="text-[#FF4D4D] text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="pt-4">
                            <label for="job_description" class="block text-sm font-medium text-[#191A23] mb-2">Job Description (Optional)</label>
                            <div class="relative rounded-xl shadow-sm">
                                <textarea name="job_description" id="job_description" 
                                    class="block w-full px-4 py-3 rounded-xl border border-[#191A23]/50 focus:ring-[#191A23]/50 focus:border-[#191A23] resize-none shadow-sm bg-white text-[#191A23] placeholder:text-[#191A23]/60"
                                    placeholder="Paste job description to match your CV against specific requirements..."
                                    rows="6">{{ old('job_description') }}</textarea>
                            </div>
                            <p class="mt-2 text-sm text-[#191A23]/70 italic">
                                Providing a job description will help match your CV to specific requirements and calculate a match score.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Upload and Analyze CV
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- CV Extraction Results -->
        @if(isset($cvData))
        <div class="bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <!-- Header Section -->
            <div class="bg-[#191A23] px-6 py-5">
                <h2 class="text-xl font-semibold text-[#B9FF66] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    CV Analysis Results
                </h2>
                <p class="text-[#B9FF66]/80 text-sm mt-1">Information extracted from your CV</p>
            </div>
            
            <!-- Content Section -->
            <div class="p-6 lg:p-8">
                <!-- Tabs Navigation -->
                <div class="border-b border-[#191A23]/30 mb-6">
                    <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                        <button id="tab-formatted" class="tab-btn py-3 border-b-2 font-medium text-[#191A23] border-[#191A23]">
                            Formatted View
                        </button>
                        <button id="tab-raw" class="tab-btn py-3 border-b-2 font-medium text-[#191A23]/70 border-transparent hover:text-[#191A23] hover:border-[#191A23]/70 transition-colors">
                            Raw JSON
                        </button>
                    </nav>
                </div>
                
                <!-- Formatted View Content -->
                <div id="formatted-view" class="space-y-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <tbody class="divide-y divide-[#191A23]/20">
                                <!-- Personal Information -->
                                @if(isset($cvData['name']))
                                <tr>
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3 bg-[#191A23]/5 rounded-l-lg">Name:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90 bg-[#191A23]/5 rounded-r-lg">{{ $cvData['name'] }}</td>
                                </tr>
                                @endif
                                
                                @if(isset($cvData['email']))
                                <tr>
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3">Email:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90">{{ $cvData['email'] }}</td>
                                </tr>
                                @endif
                                
                                @if(isset($cvData['phone']))
                                <tr>
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3 bg-[#191A23]/5 rounded-l-lg">Phone:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90 bg-[#191A23]/5 rounded-r-lg">{{ $cvData['phone'] }}</td>
                                </tr>
                                @endif
                                
                                @if(isset($cvData['address']) || isset($cvData['location']))
                                <tr>
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3">Location:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90">{{ $cvData['address'] ?? $cvData['location'] ?? 'Not specified' }}</td>
                                </tr>
                                @endif
                                
                                <!-- Skills -->
                                @if(isset($cvData['skills']) && is_array($cvData['skills']))
                                <tr>
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3 align-top bg-[#191A23]/5 rounded-l-lg">Skills:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90 bg-[#191A23]/5 rounded-r-lg">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($cvData['skills'] as $skill)
                                                @if(is_string($skill))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                                        {{ $skill }}
                                                    </span>
                                                @elseif(is_array($skill))
                                                    @if(isset($skill['name']))
                                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                                            {{ $skill['name'] }}
                                                            @if(isset($skill['level']))
                                                                <span class="ml-1 text-[#191A23]/80">({{ $skill['level'] }})</span>
                                                            @endif
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
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
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3 align-top">Education:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90">
                                        <div class="space-y-4">
                                            @foreach($cvData['education'] as $edu)
                                                @if(is_string($edu))
                                                    <div class="pb-2 border-b border-[#191A23]/10">{{ $edu }}</div>
                                                @elseif(is_array($edu))
                                                    <div class="pb-3 border-b border-[#191A23]/10">
                                                        @if(isset($edu['institution']))
                                                            <div class="font-medium text-[#191A23]">{{ $edu['institution'] }}</div>
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
                                                            <div class="text-[#191A23]/70 text-xs mt-1">
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
                                    <th class="py-4 px-4 text-left text-sm font-medium text-[#191A23] w-1/3 align-top bg-[#191A23]/5 rounded-l-lg">Work Experience:</th>
                                    <td class="py-4 px-4 text-sm text-[#191A23]/90 bg-[#191A23]/5 rounded-r-lg">
                                        <div class="space-y-6">
                                            @foreach($cvData['work_experience'] as $exp)
                                                @if(is_string($exp))
                                                    <div class="pb-4 border-b border-[#191A23]/20">{{ $exp }}</div>
                                                @elseif(is_array($exp))
                                                    <div class="pb-4 border-b border-[#191A23]/20 hover:bg-[#191A23]/10 transition duration-150 p-2 rounded-lg">
                                                        <div class="font-medium text-[#191A23]">
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
                                                            <div class="text-[#191A23]/70 text-xs mt-1">
                                                                @if(isset($exp['duration']))
                                                                    {{ $exp['duration'] }}
                                                                @elseif(isset($exp['start_date']) || isset($exp['end_date']))
                                                                    {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['end_date'] ?? 'Present' }}
                                                                @endif
                                                            </div>
                                                        @endif
                                                        
                                                        @if(isset($exp['description']) || isset($exp['responsibilities']))
                                                            <p class="mt-2 text-[#191A23]/90">
                                                                {{ $exp['description'] ?? $exp['responsibilities'] }}
                                                            </p>
                                                        @endif
                                                        
                                                        @if(isset($exp['achievements']) && is_array($exp['achievements']))
                                                            <div class="mt-2 pl-4 border-l-2 border-[#191A23]/30">
                                                                <div class="text-xs font-medium text-[#191A23] mb-1">Achievements:</div>
                                                                <ul class="list-disc pl-5 text-sm text-[#191A23]/90">
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
                    <pre id="json-display" class="bg-[#191A23]/5 p-6 rounded-xl overflow-x-auto text-xs h-96 text-[#191A23]/90 border border-[#191A23]/30">{{ json_encode($cvData, JSON_PRETTY_PRINT) }}</pre>
                </div>
                
                <!-- Job Matching Results -->
                @if(isset($jobMatching))
                <div class="mt-8 bg-white rounded-2xl border-2 border-[#191A23] p-6 lg:p-8 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <h3 class="text-lg font-semibold text-[#191A23] mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Job Matching Results
                    </h3>
                    
                    <div class="space-y-6">
                        @if(isset($jobMatching['score']))
                        <div class="border-b border-[#191A23]/20 pb-6">
                            <div class="flex items-center">
                                <div class="w-1/3 text-sm font-medium text-[#191A23]">Match Score:</div>
                                <div class="w-2/3">
                                    <div class="flex items-center">
                                        <div class="mr-4 text-xl font-bold text-[#191A23]">
                                            {{ $jobMatching['score'] }}%
                                        </div>
                                        <div class="w-full bg-[#191A23]/20 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full 
                                                @if($jobMatching['score'] >= 80) bg-green-500
                                                @elseif($jobMatching['score'] >= 60) bg-blue-500
                                                @elseif($jobMatching['score'] >= 40) bg-yellow-500
                                                @else bg-red-500 @endif" 
                                                style="width: {{ $jobMatching['score'] }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($jobMatching['matching_skills']) && is_array($jobMatching['matching_skills']) && count($jobMatching['matching_skills']) > 0)
                        <div>
                            <div class="flex items-start">
                                <div class="w-1/3 text-sm font-medium text-[#191A23]">Matching Skills:</div>
                                <div class="w-2/3">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($jobMatching['matching_skills'] as $skill)
                                            @if(is_string($skill))
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                                    {{ $skill }}
                                                </span>
                                            @elseif(is_array($skill) && isset($skill['name']))
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                                    {{ $skill['name'] }}
                                                </span>
                                            @elseif(is_array($skill))
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
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
                    <a href="{{ route('job-seeker.cv-upload') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-semibold rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                        <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Upload Another CV
                    </a>
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