@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="flex items-center space-x-4 flex-1">
                <div class="bg-[#191A23] p-3.5 rounded-xl" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23]">CV Analysis Tool</h1>
                    <p class="text-[#191A23]/70 mt-1">Upload and analyze candidate CVs with AI-powered extraction</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('matchingError'))
        <div class="mb-8 rounded-2xl p-5 flex items-start bg-yellow-400/10 border-2 border-yellow-400/50" style="box-shadow: 0px 3px 0px 0 #facc15;" role="alert">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-base text-yellow-700">{{ session('matchingError') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-yellow-400/10 rounded-lg p-1.5 text-yellow-600 hover:bg-yellow-400/20 focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-400/10 focus:ring-yellow-500"><span class="sr-only">Dismiss</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path></svg></button>
                </div>
            </div>
        </div>
        @endif

        @if(isset($success) || session('success'))
        <div class="mb-8 rounded-2xl p-5 flex items-start bg-[#B9FF66]/20 border-2 border-[#B9FF66]/60" style="box-shadow: 0px 3px 0px 0 #86c934;" role="alert">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-base text-[#191A23]">{{ $success ?? session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                     <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-[#B9FF66]/20 rounded-lg p-1.5 text-[#191A23]/80 hover:bg-[#B9FF66]/40 focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#B9FF66]/20 focus:ring-[#86c934]"><span class="sr-only">Dismiss</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path></svg></button>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-8 rounded-2xl p-5 flex items-start bg-red-500/10 border-2 border-red-500/50" style="box-shadow: 0px 3px 0px 0 #ef4444;" role="alert">
            <div class="flex-shrink-0">
                 <svg class="h-6 w-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-base text-red-700">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-red-500/10 rounded-lg p-1.5 text-red-600 hover:bg-red-500/20 focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500/10 focus:ring-red-500"><span class="sr-only">Dismiss</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path></svg></button>
                </div>
            </div>
        </div>
        @endif

        <!-- Upload Form Card -->
        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="bg-[#191A23] px-6 py-5">
                <h2 class="text-xl font-semibold text-[#B9FF66]">Upload CV</h2>
                <p class="text-white/70 text-sm mt-1">Extract information from CV and match it to job requirements</p>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route("recruiter.cv-extraction.process") }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="cv_file" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Upload CV (PDF only)</label>
                        
                        <!-- File Upload Area -->
                        <div class="group relative border-2 border-[#191A23]/30 border-dashed rounded-xl p-8 transition-all duration-200 hover:border-[#191A23]/50 hover:bg-[#191A23]/5 focus-within:border-[#191A23]/70">
                            <input type="file" name="cv_file" id="cv_file" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                required>
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-[#191A23]/40 group-hover:text-[#191A23]/60 transition-colors duration-200" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-2 text-sm text-[#191A23]/70 group-hover:text-[#191A23] transition-colors duration-200">
                                    Drag and drop your CV file, or <span class="font-semibold text-[#191A23]">click to browse</span>
                                </p>
                                <p class="mt-1 text-xs text-[#191A23]/60">PDF format only (max 10MB)</p>
                            </div>
                        </div>
                        
                        @error('cv_file')
                            <p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="job_position_id" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Select Job Position</label>
                        <select id="job_position_id" name="job_position_id" 
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            <option value="">-- Select a job position --</option>
                            @foreach($jobPositions ?? [] as $job)
                                <option value="{{ $job->id }}" data-description="{{ $job->description }}">
                                    {{ $job->title }} - {{ Str::limit($job->description, 60) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1.5 text-xs text-[#191A23]/60 italic">
                            Select one of your job postings to automatically fill the job description field
                        </p>
                    </div>
                    
                    <div>
                        <label for="job_description" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Description (Optional)</label>
                        <textarea name="job_description" id="job_description" 
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200"
                            placeholder="Paste job description to match the CV against specific requirements..."
                            rows="5">{{ old('job_description') }}</textarea>
                        <p class="mt-1.5 text-xs text-[#191A23]/60 italic">
                            Providing a job description will help match the CV to specific requirements and calculate a match score.
                        </p>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" id="extract-cv-btn" class="w-full flex justify-center items-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#86c934] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Extract CV Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div id="loading-overlay" class="fixed inset-0 bg-white/40 backdrop-blur-sm flex items-center justify-center z-[9999] hidden">
            <div class="bg-white p-8 rounded-2xl border border-[#191A23] max-w-md w-full" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="flex flex-col items-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-[#191A23] border-t-[#B9FF66] mb-6"></div>
                    <h3 class="text-xl font-semibold text-[#191A23] mb-2">Processing CV</h3>
                    <p class="text-[#191A23]/70 text-center">Please wait while our AI analyzes the document. This might take up to 30 seconds.</p>
                    <p class="text-sm text-[#B9FF66] font-medium mt-4">Do not refresh the page.</p>
                </div>
            </div>
        </div>

        <!-- CV Extraction Results -->
        @if(isset($cvData))
        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23]">
                <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                    <div>
                        <h2 class="text-xl font-bold text-[#B9FF66] flex items-center">
                            <svg class="h-6 w-6 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Extracted CV Information
                        </h2>
                        <p class="text-white/70 text-sm mt-1 sm:ml-8">Detailed data extracted from the candidate's resume</p>
                    </div>
                    <span class="inline-flex items-center self-start sm:self-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23] whitespace-nowrap" style="box-shadow: 0px 1px 0px 0 #191a23;">
                        AI Analysis
                    </span>
                </div>
            </div>

            <div class="px-6 py-8">
                <div class="space-y-8">
                    <!-- Personal Information -->
                    @if(isset($cvData['name']) || isset($cvData['email']) || isset($cvData['phone']) || isset($cvData['location']) || isset($cvData['address']) || isset($cvData['summary']) || isset($cvData['profile']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                                <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#191A23]">Personal Information</h3>
                        </div>
                        <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                @if(isset($cvData['name']))
                                <div>
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Full Name</span>
                                    <p class="text-sm text-[#191A23]">{{ $cvData['name'] }}</p>
                                </div>
                                @endif
                                @if(isset($cvData['email']))
                                <div>
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Email Address</span>
                                    <a href="mailto:{{ $cvData['email'] }}" class="text-sm text-[#B9FF66] hover:text-[#a1e048]">{{ $cvData['email'] }}</a>
                                </div>
                                @endif
                                @if(isset($cvData['phone']))
                                <div>
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Phone Number</span>
                                    <p class="text-sm text-[#191A23]">{{ $cvData['phone'] }}</p>
                                </div>
                                @endif
                                @if(isset($cvData['location']))
                                <div>
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Location</span>
                                    <p class="text-sm text-[#191A23]">{{ $cvData['location'] }}</p>
                                </div>
                                @endif
                                @if(isset($cvData['address']))
                                <div class="md:col-span-2">
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Full Address</span>
                                    <p class="text-sm text-[#191A23]">{{ $cvData['address'] }}</p>
                                </div>
                                @endif
                                @if(isset($cvData['summary']) || isset($cvData['profile']))
                                <div class="md:col-span-2">
                                    <span class="text-sm font-medium text-[#191A23]/70 block mb-1">Summary / Profile</span>
                                    <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                        {!! nl2br(e($cvData['summary'] ?? $cvData['profile'] ?? '')) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Skills -->
                    @if(isset($cvData['skills']) && (is_array($cvData['skills']) && count($cvData['skills']) > 0) || is_string($cvData['skills']))
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                                <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v1.993l4.753 4.753a1 1 0 01-1.414 1.414L13 7.828V12a1 1 0 11-2 0V7.828l-2.339 2.34a1 1 0 01-1.414-1.414L11.007 4V2a1 1 0 01.293-.707zM6 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm10-6a2 2 0 100-4 2 2 0 000 4zM7 14a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm5-5a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm5 5a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-[#191A23]">Skills</h3>
                        </div>
                        <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                            @if(is_array($cvData['skills']))
                            <div class="flex flex-wrap gap-2">
                                @foreach($cvData['skills'] as $skill)
                                    <span class="px-3 py-1.5 rounded-lg text-sm font-medium bg-[#191A23]/10 text-[#191A23] border border-[#191A23]/20">{{ is_array($skill) ? ($skill['name'] ?? $skill[0] ?? '') : $skill }}</span>
                                @endforeach
                            </div>
                            @elseif(is_string($cvData['skills']))
                                <p class="text-sm text-[#191A23]">{{ $cvData['skills'] }}</p>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Work Experience -->
                    @if(isset($cvData['work_experience']) && is_array($cvData['work_experience']))
                    <div class="bg-gradient-to-br from-white to-purple-50 rounded-xl p-6 border border-purple-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                            </svg>
                            Work Experience
                        </h3>
                        <div class="space-y-6">
                            @foreach($cvData['work_experience'] as $exp)
                                @if(is_array($exp))
                                <div class="bg-white rounded-lg p-4 border border-purple-100">
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-lg">
                                                {{ $exp['title'] ?? $exp['position'] ?? $exp['job_title'] ?? 'Position' }}
                                            </h4>
                                            <p class="text-sm text-purple-700 font-medium">
                                                {{ $exp['company'] ?? $exp['employer'] ?? $exp['organization'] ?? 'Company' }}
                                            </p>
                                        </div>
                                        @if(isset($exp['date']) || isset($exp['duration']) || (isset($exp['start_date']) && isset($exp['end_date'])))
                                        <div class="mt-2 md:mt-0 bg-purple-50 px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-purple-100">
                                            {{ $exp['date'] ?? $exp['duration'] ?? ($exp['start_date'] ?? '') . ' - ' . ($exp['end_date'] ?? 'Present') }}
                                        </div>
                                        @endif
                                    </div>
                                    @if(isset($exp['description']))
                                        <p class="mt-3 text-sm text-gray-700 bg-white p-4 rounded-lg border border-purple-100">
                                            {{ $exp['description'] }}
                                        </p>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Education -->
                    @if(isset($cvData['education']) && is_array($cvData['education']))
                    <div class="bg-gradient-to-br from-white to-green-50 rounded-xl p-6 border border-green-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            Education
                        </h3>
                        <div class="space-y-4">
                            @foreach($cvData['education'] as $edu)
                                @if(is_array($edu))
                                <div class="bg-white rounded-lg p-4 border border-green-100">
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900 text-lg">
                                                {{ $edu['degree'] ?? $edu['qualification'] ?? 'Degree' }}
                                            </h4>
                                            <p class="text-sm text-green-700 font-medium">
                                                {{ $edu['institution'] ?? $edu['school'] ?? $edu['university'] ?? 'Institution' }}
                                            </p>
                                            @if(isset($edu['field_of_study']))
                                            <p class="text-sm text-gray-600">{{ $edu['field_of_study'] }}</p>
                                            @endif
                                        </div>
                                        @if(isset($edu['date']) || (isset($edu['start_date']) && isset($edu['end_date'])))
                                        <div class="mt-2 md:mt-0 bg-green-50 px-3 py-1 rounded-full text-xs text-gray-600 font-medium border border-green-100">
                                            {{ $edu['date'] ?? ($edu['start_date'] ?? '') . ' - ' . ($edu['end_date'] ?? '') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Job Matching Results -->
        @if(isset($jobMatching) && isset($jobMatching['success']) && $jobMatching['success'] === true)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-green-600 to-emerald-600">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Job Matching Results
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Analysis of candidate's fit for the selected position</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-green-800">
                        Match Score: {{ $jobMatching['match_score'] ?? 'N/A' }}%
                    </span>
                </div>
            </div>

            <div class="p-6">
                @if(isset($jobMatching['reasoning']) && !empty($jobMatching['reasoning']))
                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-700 mb-2">Analysis</h4>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <p class="text-sm text-gray-600">{{ $jobMatching['reasoning'] }}</p>
                    </div>
                </div>
                @endif

                @if(isset($jobMatching['skills_analysis']))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Matched Skills -->
                    <div class="bg-gradient-to-br from-white to-green-50 rounded-xl p-6 border border-green-100">
                        <h4 class="text-md font-medium text-gray-700 mb-4">Matched Skills</h4>
                        @if(isset($jobMatching['skills_analysis']['matched_skills']) && count($jobMatching['skills_analysis']['matched_skills']) > 0)
                        <div class="space-y-2">
                            @foreach($jobMatching['skills_analysis']['matched_skills'] as $skill)
                            <div class="flex items-center bg-white p-2 rounded-lg border border-green-100">
                                <svg class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-600">{{ $skill }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-gray-500">No matched skills found.</p>
                        @endif
                    </div>

                    <!-- Missing Skills -->
                    <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl p-6 border border-amber-100">
                        <h4 class="text-md font-medium text-gray-700 mb-4">Missing Skills</h4>
                        @if(isset($jobMatching['skills_analysis']['missing_skills']) && count($jobMatching['skills_analysis']['missing_skills']) > 0)
                        <div class="space-y-2">
                            @foreach($jobMatching['skills_analysis']['missing_skills'] as $skill)
                            <div class="flex items-center bg-white p-2 rounded-lg border border-amber-100">
                                <svg class="h-5 w-5 text-amber-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-gray-600">{{ $skill }}</span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-sm text-gray-500">No missing skills identified.</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script for file name display
        const cvFileInput = document.getElementById('cv_file');
        // Get the div that holds the icon and the text paragraphs
        const dropzoneContentDiv = document.querySelector('.group .text-center'); 
        const originalDropzoneContentHTML = dropzoneContentDiv ? dropzoneContentDiv.innerHTML : '';

        if (cvFileInput && dropzoneContentDiv) {
            cvFileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0] ? e.target.files[0].name : null;
                if (fileName) {
                    const newIconHTML = `
                        <svg class="mx-auto h-12 w-12 text-[#B9FF66]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>`;
                    const newFileNameHTML = `<p class="mt-2 text-sm text-[#191A23]/70 group-hover:text-[#191A23] transition-colors duration-200"><span class="font-semibold text-[#191A23]">${fileName}</span></p>`;
                    const newSubTextHTML = `<p class="mt-1 text-xs text-[#191A23]/60">File selected. Click dropzone to change.</p>`;
                    
                    dropzoneContentDiv.innerHTML = newIconHTML + newFileNameHTML + newSubTextHTML;
                } else {
                    // Restore original content
                    if(originalDropzoneContentHTML) dropzoneContentDiv.innerHTML = originalDropzoneContentHTML;
                }
            });
        }

        // Script for auto-filling job description
        const jobPositionSelect = document.getElementById('job_position_id');
        const jobDescriptionTextarea = document.getElementById('job_description');

        if (jobPositionSelect && jobDescriptionTextarea) {
            jobPositionSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const description = selectedOption.getAttribute('data-description');
                jobDescriptionTextarea.value = description ? description : ''; // Set to empty if no description
            });

            // Trigger change on load if a job position is already selected (e.g. from old() or session)
            if (jobPositionSelect.value && jobPositionSelect.options[jobPositionSelect.selectedIndex] && jobPositionSelect.options[jobPositionSelect.selectedIndex].getAttribute('data-description')) {
                const event = new Event('change');
                jobPositionSelect.dispatchEvent(event);
            }
        }

        // Loading overlay for form submission
        const form = document.querySelector('form[action="{{ route("recruiter.cv-extraction.process") }}"]');
        const loadingOverlay = document.getElementById('loading-overlay');
        const extractButton = document.getElementById('extract-cv-btn');

        if (form && loadingOverlay && extractButton) {
            form.addEventListener('submit', function(event) {
                // Basic check if file is selected (client-side, Laravel handles robust validation)
                if (cvFileInput.files.length === 0) {
                    // console.warn('No CV file selected.'); 
                    // Let Laravel handle 'required' validation unless specific UX is needed to stop earlier
                }
                
                // Basic check if job position is selected
                const currentJobPositionSelect = document.getElementById('job_position_id'); // re-fetch in case DOM changed
                if (currentJobPositionSelect && currentJobPositionSelect.value === '') {
                     // console.warn('No job position selected.');
                     // Let Laravel handle 'required' validation
                }

                loadingOverlay.classList.remove('hidden');
                extractButton.disabled = true;
                extractButton.classList.add('opacity-50', 'cursor-not-allowed');
                extractButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#191A23]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;
            });
        }
    });
</script>
@endpush

@endsection 