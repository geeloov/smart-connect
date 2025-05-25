@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl border border-[#191A23] p-6 flex flex-col md:flex-row md:items-start md:justify-between gap-4" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-1.5">
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23] truncate">{{ $jobPosition->title }}</h1>
                        <span class="px-3 py-1 rounded-lg text-xs font-medium border whitespace-nowrap
                            {{ $jobPosition->is_active ? 'bg-[#B9FF66]/30 text-[#191A23] border-[#191A23]/50' : 'bg-[#191A23]/10 text-[#191A23]/70 border-[#191A23]/20' }}"
                            @if($jobPosition->is_active) style="box-shadow: 0px 1px 0px 0 #191a23;" @endif>
                            {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-[#191A23]/70">
                        <span>{{ $jobPosition->company_name }}</span>
                        <span class="text-[#191A23]/40">•</span>
                        <span>{{ $jobPosition->location }}</span>
                    </div>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                        class="inline-flex items-center justify-center w-full md:w-auto px-4 py-2.5 bg-white text-[#191A23]/80 hover:text-[#191A23] rounded-xl border-2 border-[#191A23]/50 hover:border-[#191A23] transition-all duration-200 text-sm font-medium transform hover:-translate-y-px" 
                        style="box-shadow: 0px 3px 0px 0 #191a23;">
                        <svg class="w-4 h-4 mr-2 text-[#191A23]/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Job Details
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <form action="{{ route('recruiter.job-positions.update', $jobPosition) }}" method="POST" class="p-8 space-y-10">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                <div class="bg-red-500/10 border-2 border-red-500/50 rounded-2xl p-5 flex items-start mb-8" style="box-shadow: 0px 3px 0px 0 #ef4444;" role="alert">
                    <svg class="h-6 w-6 text-red-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="ml-3 flex-1">
                        <p class="text-base font-semibold text-red-700">Validation Errors</p>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button onclick="this.closest('[role=\'alert\']').remove()" class="ml-auto text-red-700/70 hover:text-red-700 p-1 rounded-md hover:bg-red-500/10 flex-shrink-0">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                @endif

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-[#191A23] border-b border-[#191A23]/20 pb-3 mb-6 flex items-center">
                        <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        <div>
                            <label for="title" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $jobPosition->title) }}" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                required>
                        </div>
                        
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Company Name</label>
                            <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $jobPosition->company_name) }}" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                required>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $jobPosition->location) }}" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                required>
                        </div>
                        
                        <div>
                            <label for="job_type" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Type</label>
                            <select id="job_type" name="job_type" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                required>
                                <option value="" {{ old('job_type', $jobPosition->job_type) == '' ? 'selected' : '' }} disabled>Select Job Type</option>
                                <option value="full-time" {{ old('job_type', strtolower($jobPosition->job_type)) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ old('job_type', strtolower($jobPosition->job_type)) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="contract" {{ old('job_type', strtolower($jobPosition->job_type)) == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="freelance" {{ old('job_type', strtolower($jobPosition->job_type)) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="internship" {{ old('job_type', strtolower($jobPosition->job_type)) == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Compensation Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-[#191A23] border-b border-[#191A23]/20 pb-3 mb-6 flex items-center">
                        <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Compensation
                    </h3>
                    <div class="md:max-w-md">
                        <label for="salary_range" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Salary Range (optional)</label>
                        <input type="text" id="salary_range" name="salary_range" value="{{ old('salary_range', $jobPosition->salary_range) }}" 
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                            placeholder="e.g. $80,000 - $100,000 per year">
                        <p class="mt-1.5 text-xs text-[#191A23]/60">Leave blank if you prefer not to disclose the salary range.</p>
                    </div>
                </div>
                
                <!-- Job Details Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-[#191A23] border-b border-[#191A23]/20 pb-3 mb-6 flex items-center">
                        <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Job Details
                    </h3>
                    <div class="space-y-5">
                        <div>
                            <label for="description" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Description</label>
                            <textarea id="description" name="description" rows="6" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                required>{{ old('description', $jobPosition->description) }}</textarea>
                            <p class="mt-1.5 text-xs text-[#191A23]/60">Provide a detailed description of the role, responsibilities, and company culture.</p>
                        </div>
                        
                        <div>
                            <label for="requirements" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Requirements (optional)</label>
                            <textarea id="requirements" name="requirements" rows="6" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]" 
                                placeholder="List specific skills, experience, and qualifications needed">{{ old('requirements', $jobPosition->requirements) }}</textarea>
                            <p class="mt-1.5 text-xs text-[#191A23]/60">List each requirement on a new line or separated by commas. This will be used for CV matching.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Status Section -->
                <div class="mt-8 p-6 bg-[#B9FF66]/20 rounded-2xl border-2 border-[#B9FF66]/60" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                class="h-5 w-5 p-1 text-[#B9FF66] bg-white border border-[#191A23]/50 rounded-md focus:ring-2 focus:ring-offset-0 focus:ring-[#B9FF66]/70 checked:bg-[#B9FF66] checked:border-[#191A23]/50 appearance-none" 
                                {{ old('is_active', $jobPosition->is_active) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-[#191A23]">Active Job Position</label>
                            <p class="text-[#191A23]/70">When checked, this job position will be visible and applicants can apply.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 border-t border-[#191A23]/10 mt-10">
                    <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                        class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 text-sm font-medium rounded-xl text-[#191A23]/80 hover:text-[#191A23] hover:bg-[#191A23]/5 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" 
                        style="box-shadow: 0px 4px 0px 0 #191a23;">
                        <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Job Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 