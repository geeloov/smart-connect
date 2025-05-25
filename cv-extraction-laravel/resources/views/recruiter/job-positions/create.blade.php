@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="py-12"> 
    <!-- Back Navigation -->
    <div class="mb-8">
        <a href="{{ route('recruiter.job-positions.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-white text-sm font-medium rounded-xl text-[#191A23]/80 hover:text-[#191A23] border border-[#191A23]/50 hover:border-[#191A23] transition-all duration-200 transform hover:-translate-y-px" 
           style="box-shadow: 0px 2px 0px 0 #191a23;">
            <svg class="w-4 h-4 mr-2 text-[#191A23]/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Job Positions
        </a>
    </div>

    <!-- Header Section -->
    <div class="mb-10 bg-white rounded-2xl border border-[#191A23] p-6 flex items-start gap-4" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="p-3 bg-[#191A23] rounded-xl flex-shrink-0" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
            <svg class="h-6 w-6 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </div>
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23]">Create Job Position</h1>
            <p class="text-[#191A23]/70 text-sm mt-1">Provide details about the job position you want to post</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <form action="{{ route('recruiter.job-positions.store') }}" method="POST" class="p-8 space-y-10">
            @csrf
            @if($errors->any())
            <div class="bg-red-500/10 border-2 border-red-500/50 rounded-2xl p-5 flex items-start mb-8" style="box-shadow: 0px 3px 0px 0 #ef4444;" role="alert">
                <svg class="h-6 w-6 text-red-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-3 flex-1">
                    <p class="text-base font-semibold text-red-700">Validation Errors</p>
                    <ul class="list-disc list-inside mt-2 text-sm text-red-700">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.closest('[role=\'alert\']').remove()" class="ml-auto text-red-700/70 hover:text-red-700 p-1 rounded-md hover:bg-red-500/10 flex-shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            @endif

            <!-- Basic Information -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-[#191A23] border-b border-[#191A23]/20 pb-3 mb-6">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="e.g. Senior Software Engineer">
                    </div>
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="e.g. Acme Inc.">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="e.g. New York, NY or Remote">
                    </div>
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Type</label>
                        <select name="job_type" id="job_type" required
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]">
                            <option value="">Select Job Type</option>
                            <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="salary_range" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Salary Range (optional)</label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="e.g. $80,000 - $100,000 per year">
                    </div>
                </div>
            </div>

            <!-- Description & Requirements -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-[#191A23] border-b border-[#191A23]/20 pb-3 mb-6">Description & Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Job Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="Describe the job role, responsibilities, and requirements">{{ old('description') }}</textarea>
                        <p class="mt-1.5 text-xs text-[#191A23]/60">Provide a detailed description of the job, including day-to-day responsibilities.</p>
                    </div>
                    <div class="md:col-span-2">
                        <label for="requirements" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Requirements (optional)</label>
                        <textarea name="requirements" id="requirements" rows="6"
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 text-base focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23]"
                            placeholder="List specific requirements or qualifications (e.g., skills, experience, education)">{{ old('requirements') }}</textarea>
                        <p class="mt-1.5 text-xs text-[#191A23]/60">These will be used for CV matching along with the job description. List each requirement on a new line or separated by commas.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-6 border-t border-[#191A23]/10 mt-8">
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" 
                        style="box-shadow: 0px 4px 0px 0 #191a23;">
                    <svg class="h-5 w-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Job Position
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 