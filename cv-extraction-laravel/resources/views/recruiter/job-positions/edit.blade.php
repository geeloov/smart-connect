@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white rounded-2xl shadow-lg border border-green-100 p-6">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 truncate">{{ $jobPosition->title }}</h1>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                            {{ $jobPosition->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-gray-500 mt-2">
                        <span>{{ $jobPosition->company_name }}</span>
                        <span>•</span>
                        <span>{{ $jobPosition->location }}</span>
                    </div>
                </div>
                <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Job Details
                </a>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('recruiter.job-positions.update', $jobPosition) }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-xl shadow-sm" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Basic Information Section -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                Job Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $jobPosition->title) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('title') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Company Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $jobPosition->company_name) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('company_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                                Location <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="location" name="location" value="{{ old('location', $jobPosition->location) }}" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('location') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                required>
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">
                                Job Type <span class="text-red-500">*</span>
                            </label>
                            <select id="job_type" name="job_type" 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('job_type') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                required>
                                <option value="Full-time" {{ old('job_type', $jobPosition->job_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('job_type', $jobPosition->job_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('job_type', $jobPosition->job_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Freelance" {{ old('job_type', $jobPosition->job_type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Internship" {{ old('job_type', $jobPosition->job_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('job_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Compensation Section -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Compensation</h2>
                    <div class="max-w-md">
                        <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-1">
                            Salary Range
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="text" id="salary_range" name="salary_range" value="{{ old('salary_range', $jobPosition->salary_range) }}" 
                                class="pl-7 w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('salary_range') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                placeholder="e.g. 50,000 - 70,000">
                        </div>
                        @error('salary_range')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Leave blank if you prefer not to disclose the salary range</p>
                    </div>
                </div>
                
                <!-- Job Details Section -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Job Details</h2>
                        <div class="space-y-6">
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Job Description <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="6" 
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('description') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                        required>{{ old('description', $jobPosition->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Provide a detailed description of the role, including:
                                </p>
                                <ul class="mt-1 text-sm text-gray-500 list-disc list-inside">
                                    <li>Key responsibilities and daily tasks</li>
                                    <li>Team structure and reporting relationships</li>
                                    <li>Growth opportunities and career path</li>
                                </ul>
                            </div>
                            
                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">
                                    Requirements
                                </label>
                                <div class="mt-1">
                                    <textarea id="requirements" name="requirements" rows="5" 
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('requirements') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                        placeholder="List the skills, experience, and qualifications needed">{{ old('requirements', $jobPosition->requirements) }}</textarea>
                                    @error('requirements')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Specify the following requirements:
                                </p>
                                <ul class="mt-1 text-sm text-gray-500 list-disc list-inside">
                                    <li>Required skills and technical expertise</li>
                                    <li>Education and certifications</li>
                                    <li>Years of experience</li>
                                    <li>Soft skills and personality traits</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Status Section -->
                <div class="mt-8 mb-8 p-6 bg-green-50 rounded-xl border border-green-100">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" 
                                {{ old('is_active', $jobPosition->is_active) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="is_active" class="text-sm font-medium text-gray-900">Active</label>
                            <p class="text-sm text-gray-600">Make this job position visible to job seekers</p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-5 py-2.5 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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