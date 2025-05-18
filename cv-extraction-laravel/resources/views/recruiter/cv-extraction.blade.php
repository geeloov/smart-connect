@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-3 rounded-xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">CV Analysis Tool</h1>
                    <p class="text-gray-600 mt-1">Upload and analyze candidate CVs with AI-powered extraction</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('matchingError'))
        <div class="mb-6 rounded-lg bg-yellow-50 p-4 border border-yellow-200">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-yellow-800 font-medium">{{ session('matchingError') }}</span>
            </div>
        </div>
        @endif

        @if(isset($success))
        <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-green-800 font-medium">{{ $success }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-red-800 font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Upload Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
                <h2 class="text-xl font-semibold text-white">Upload CV</h2>
                <p class="text-blue-100 text-sm mt-1">Extract information from CV and match it to job requirements</p>
            </div>

            <div class="p-6 lg:p-8">
                <form method="POST" action="{{ route('recruiter.cv-extraction.process') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-2">Upload CV (PDF only)</label>
                        
                        <!-- File Upload Area -->
                        <div class="relative border-2 border-gray-300 border-dashed rounded-xl p-8 transition hover:border-blue-500 focus-within:border-blue-500 group">
                            <input type="file" name="cv_file" id="cv_file" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                required>
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600 group-hover:text-blue-600 transition">
                                    Drag and drop your CV file, or <span class="font-medium text-blue-600">click to browse</span>
                                </p>
                                <p class="mt-1 text-xs text-gray-500">PDF format only (max 10MB)</p>
                            </div>
                        </div>
                        
                        @error('cv_file')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="job_position_id" class="block text-sm font-medium text-gray-700 mb-2">Select Job Position</label>
                        <select id="job_position_id" name="job_position_id" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">-- Select a job position --</option>
                            @foreach($jobPositions ?? [] as $job)
                                <option value="{{ $job->id }}" data-description="{{ $job->description }}">
                                    {{ $job->title }} - {{ Str::limit($job->description, 60) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs text-gray-500 italic">
                            Select one of your job postings to automatically fill the job description field
                        </p>
                    </div>
                    
                    <div>
                        <label for="job_description" class="block text-sm font-medium text-gray-700 mb-2">Job Description (Optional)</label>
                        <textarea name="job_description" id="job_description" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Paste job description to match the CV against specific requirements..."
                            rows="5">{{ old('job_description') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500 italic">
                            Providing a job description will help match the CV to specific requirements and calculate a match score.
                        </p>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" id="extract-cv-btn" class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-md w-full border border-blue-100">
                <div class="flex flex-col items-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-600 mb-4"></div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Processing CV</h3>
                    <p class="text-gray-600 text-center">Please wait while our AI analyzes the document. This might take up to 30 seconds.</p>
                    <p class="text-sm text-blue-500 mt-4">Do not refresh the page.</p>
                </div>
            </div>
        </div>

        <!-- CV Extraction Results -->
        @if(isset($cvData))
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Extracted CV Information
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Detailed data extracted from the candidate's resume</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-blue-800">
                        AI Analysis
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-6">
                    <!-- Personal Information -->
                    @if(isset($cvData['name']) || isset($cvData['email']) || isset($cvData['phone']) || isset($cvData['location']) || isset($cvData['address']))
                    <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl p-6 border border-blue-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if(isset($cvData['name']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Name</span>
                                <span class="text-md text-gray-900 font-medium">{{ $cvData['name'] }}</span>
                            </div>
                            @endif
                            @if(isset($cvData['email']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Email</span>
                                <a href="mailto:{{ $cvData['email'] }}" class="text-md text-blue-600 hover:text-blue-800 transition">{{ $cvData['email'] }}</a>
                            </div>
                            @endif
                            @if(isset($cvData['phone']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Phone</span>
                                <span class="text-md text-gray-900">{{ $cvData['phone'] }}</span>
                            </div>
                            @endif
                            @if(isset($cvData['location']) || isset($cvData['address']))
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500 mb-1">Location</span>
                                <span class="text-md text-gray-900">{{ $cvData['location'] ?? $cvData['address'] ?? '' }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Skills -->
                    @if(isset($cvData['skills']) && is_array($cvData['skills']))
                    <div class="bg-gradient-to-br from-white to-indigo-50 rounded-xl p-6 border border-indigo-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                            Skills
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($cvData['skills'] as $skill)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                    {{ is_array($skill) ? ($skill['name'] ?? $skill[0] ?? '') : $skill }}
                                </span>
                            @endforeach
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
    const form = document.querySelector('form');
    const loadingOverlay = document.getElementById('loading-overlay');
    const extractButton = document.getElementById('extract-cv-btn');

    if (form) {
        form.addEventListener('submit', function() {
            loadingOverlay.classList.remove('hidden');
            extractButton.disabled = true;
        });
    }

    // Handle file input change
    const fileInput = document.getElementById('cv_file');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const uploadArea = document.querySelector('.border-dashed');
                if (uploadArea) {
                    uploadArea.innerHTML = `
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-blue-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-blue-600">${fileName}</span>
                            </p>
                            <p class="mt-1 text-xs text-gray-500">Click to change file</p>
                        </div>
                    `;
                }
            }
        });
    }

    // Handle job position selection
    const jobPositionSelect = document.getElementById('job_position_id');
    const jobDescriptionTextarea = document.getElementById('job_description');
    
    if (jobPositionSelect && jobDescriptionTextarea) {
        jobPositionSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            if (description) {
                jobDescriptionTextarea.value = description;
            }
        });
    }
});
</script>
@endpush
@endsection 