@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Details
            </a>
        </div>

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
                
                <div class="flex flex-col md:flex-row md:items-start gap-8 relative z-10">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        <div class="p-4 bg-green-600 rounded-xl shadow-md w-20 h-20 flex items-center justify-center">
                            <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 w-fit">
                                Edit Position
                            </span>
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $jobPosition->title }}</h1>
                            <p class="mt-2 text-lg text-gray-600">{{ $jobPosition->company_name }} • {{ $jobPosition->location }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('recruiter.job-positions.update', $jobPosition) }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-xl shadow-sm" role="alert">
                    <p class="font-bold">Validation Error</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
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
                
                <div class="mb-8">
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
                    <p class="mt-1 text-xs text-gray-500">Leave blank if you prefer not to disclose</p>
                </div>
                
                <!-- Description Section -->
                <div class="space-y-8">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Job Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="6" 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('description') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            required>{{ old('description', $jobPosition->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Provide a detailed description of the job role, responsibilities, and expectations</p>
                    </div>
                    
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">
                            Requirements
                        </label>
                        <textarea id="requirements" name="requirements" rows="5" 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('requirements') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                            placeholder="List the skills, experience, and qualifications needed">{{ old('requirements', $jobPosition->requirements) }}</textarea>
                        @error('requirements')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Specify skills, qualifications, education, and experience required for the position</p>
                    </div>
                </div>
                
                <div class="mt-8 mb-8 p-4 bg-green-50 rounded-lg border border-green-100">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" 
                                {{ old('is_active', $jobPosition->is_active) ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-gray-700">Active</label>
                            <p class="text-gray-600">Job position will be visible to job seekers when active</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-5 py-2.5 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Update Job Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 