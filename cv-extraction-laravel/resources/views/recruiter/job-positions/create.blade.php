@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center text-gray-600 hover:text-[#B9FF66] transition-colors">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Positions
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#B9FF66] px-6 py-4">
                <h1 class="text-2xl font-bold text-dark flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Job Position
                </h1>
            </div>

            <form action="{{ route('recruiter.job-positions.store') }}" method="POST" class="p-6">
                @csrf
                
                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                    <p class="font-bold">Validation Error</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm" 
                            placeholder="e.g. Senior Software Engineer">
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm" 
                            placeholder="e.g. Acme Inc.">
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm" 
                            placeholder="e.g. New York, NY or Remote">
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                        <select name="job_type" id="job_type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm">
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
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm" 
                            placeholder="e.g. $80,000 - $100,000 per year">
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm"
                            placeholder="Describe the job role, responsibilities, and requirements">{{ old('description') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Provide a detailed description of the job, including day-to-day responsibilities.</p>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements (optional)</label>
                        <textarea name="requirements" id="requirements" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring-[#B9FF66] sm:text-sm"
                            placeholder="List specific requirements or qualifications">{{ old('requirements') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">These will be used for CV matching along with the job description.</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-8">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors">
                        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Job Position
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 