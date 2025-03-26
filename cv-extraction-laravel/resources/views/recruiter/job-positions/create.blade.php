@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Positions
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 w-fit">
                                New Position
                            </span>
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Create Job Position</h1>
                            <p class="mt-2 text-lg text-gray-600">Provide details about the job position you want to post</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('recruiter.job-positions.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf
                
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
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" 
                            placeholder="e.g. Senior Software Engineer">
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" 
                            placeholder="e.g. Acme Inc.">
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" 
                            placeholder="e.g. New York, NY or Remote">
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                        <select name="job_type" id="job_type" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            <option value="">Select Job Type</option>
                            <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>

                    <!-- Salary Range -->
                    <div class="md:col-span-2">
                        <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-1">Salary Range (optional)</label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" 
                            placeholder="e.g. $80,000 - $100,000 per year">
                    </div>
                </div>

                <!-- Description Section -->
                <div class="space-y-8">
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                            placeholder="Describe the job role, responsibilities, and requirements">{{ old('description') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Provide a detailed description of the job, including day-to-day responsibilities.</p>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements (optional)</label>
                        <textarea name="requirements" id="requirements" rows="4"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm"
                            placeholder="List specific requirements or qualifications">{{ old('requirements') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">These will be used for CV matching along with the job description.</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        Create Job Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 