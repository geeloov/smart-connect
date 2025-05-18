@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-8">
            <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Positions
            </a>
        </div>

        <!-- Header Section -->
        <div class="mb-10 flex items-center space-x-4">
            <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-3 rounded-xl shadow-lg">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create Job Position</h1>
                <p class="text-gray-600 mt-1">Provide details about the job position you want to post</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <form action="{{ route('recruiter.job-positions.store') }}" method="POST" class="p-8 space-y-10">
                @csrf
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-xl shadow-sm" role="alert">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-bold">Validation Error</span>
                    </div>
                    <ul class="list-disc list-inside mt-2 text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="e.g. Senior Software Engineer">
                    </div>
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="e.g. Acme Inc.">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="e.g. New York, NY or Remote">
                    </div>
                    <div>
                        <label for="job_type" class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                        <select name="job_type" id="job_type" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                            <option value="">Select Job Type</option>
                            <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-2">Salary Range (optional)</label>
                        <input type="text" name="salary_range" id="salary_range" value="{{ old('salary_range') }}"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="e.g. $80,000 - $100,000 per year">
                    </div>
                </div>

                <!-- Description & Requirements -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="Describe the job role, responsibilities, and requirements">{{ old('description') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">Provide a detailed description of the job, including day-to-day responsibilities.</p>
                    </div>
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements (optional)</label>
                        <textarea name="requirements" id="requirements" rows="6"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="List specific requirements or qualifications">{{ old('requirements') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">These will be used for CV matching along with the job description.</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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