@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Page Header -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight sm:text-3xl">My Profile</h1>
                    <p class="mt-2 text-sm text-gray-500">Manage your personal information and CV documents</p>
                </div>
                <div class="mt-4 md:mt-0 flex">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Browse Jobs
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Status Message -->
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-md shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-md shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Profile Information Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Personal Information
                    </h2>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Job Seeker
                    </span>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('job-seeker.profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="flex flex-col sm:flex-row sm:space-x-6">
                            <!-- Profile Photo -->
                            <div class="flex-shrink-0 mb-6 sm:mb-0">
                                <div class="relative">
                                    <div class="h-32 w-32 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg overflow-hidden">
                                        <div class="h-full w-full bg-gradient-to-r from-green-600 to-green-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-4xl">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="h-6 w-6 absolute bottom-1 right-1 rounded-full bg-green-100 border-2 border-white flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Basic Info -->
                            <div class="flex-1 space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <div class="mt-1 relative rounded-lg shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}" class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="+1 (555) 987-6543">
                                    </div>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <div class="mt-1 relative rounded-lg shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="text" name="location" id="location" value="{{ old('location', $user->location ?? '') }}" class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="City, Country">
                                    </div>
                                    @error('location')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">About Me</h3>
                            
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea name="bio" id="bio" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="Write a short bio about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="pt-5 border-t border-gray-100 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- CV Management Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        My CV Documents
                    </h2>
                </div>
                
                <div class="p-6">
                    <!-- CV Upload Form -->
                    <form action="{{ route('job-seeker.cv.upload') }}" method="POST" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-5">
                            <div class="mb-4">
                                <div class="flex justify-between items-start">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload CV (PDF format)</label>
                                    <span class="text-xs text-gray-500">Max: 10MB</span>
                                </div>
                                
                                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-500 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex justify-center text-sm text-gray-600">
                                            <label for="cv_file" id="cv_upload_label" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input id="cv_file" name="cv_file" type="file" accept=".pdf" class="sr-only" required>
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF format only</p>
                                        <p id="selected_filename" class="mt-2 text-sm text-gray-600 hidden"></p>
                                    </div>
                                </div>
                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const uploadArea = document.querySelector('.border-2.border-gray-300.border-dashed');
                                        const fileInput = document.getElementById('cv_file');
                                        const filenameDisplay = document.getElementById('selected_filename');
                                        
                                        // Make the entire upload area clickable
                                        if (uploadArea && fileInput) {
                                            uploadArea.addEventListener('click', function() {
                                                fileInput.click();
                                            });
                                        }
                                        
                                        // Display the selected filename
                                        if (fileInput && filenameDisplay) {
                                            fileInput.addEventListener('change', function() {
                                                if (fileInput.files.length > 0) {
                                                    filenameDisplay.textContent = 'Selected file: ' + fileInput.files[0].name;
                                                    filenameDisplay.classList.remove('hidden');
                                                    uploadArea.classList.add('border-green-500');
                                                    uploadArea.classList.add('bg-green-50');
                                                } else {
                                                    filenameDisplay.classList.add('hidden');
                                                    uploadArea.classList.remove('border-green-500');
                                                    uploadArea.classList.remove('bg-green-50');
                                                }
                                            });
                                        }
                                    });
                                </script>
                                
                                <p class="mt-2 text-sm text-gray-500">
                                    Your CV will be analyzed to extract your skills, education, and experience.
                                </p>
                                
                                @error('cv_file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-center">
                                <input id="make_default" name="make_default" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="make_default" class="ml-2 block text-sm text-gray-900">
                                    Set as default CV
                                </label>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Upload CV
                            </button>
                        </div>
                    </form>
                    
                    <!-- Existing CVs List -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Saved CVs</h3>
                        
                        @if($user->cvs && $user->cvs->count() > 0)
                            <div class="border border-gray-200 rounded-lg divide-y divide-gray-200 overflow-hidden">
                                @foreach($user->cvs as $cv)
                                    <div class="p-4 hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <!-- PDF Icon -->
                                                <div class="flex-shrink-0 bg-red-50 p-2 rounded-lg border border-red-100">
                                                    <svg class="h-8 w-8 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                
                                                <!-- CV Details -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate flex items-center">
                                                        {{ $cv->file_name }}
                                                        @if($cv->is_default)
                                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                Default
                                                            </span>
                                                        @endif
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        Uploaded: {{ $cv->created_at->format('M d, Y') }} • {{ round($cv->file_size / 1024, 2) }} KB
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <!-- Action Buttons -->
                                            <div class="flex items-center space-x-2">
                                                @if(!$cv->is_default)
                                                    <form method="POST" action="{{ route('job-seeker.cv.set-default', $cv) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 hover:text-green-700 hover:border-green-300">
                                                            Set as Default
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <a href="{{ route('job-seeker.cv.view', $cv) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </a>
                                                
                                                <form method="POST" action="{{ route('job-seeker.cv.delete', $cv) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-red-700 bg-white hover:bg-red-50 hover:border-red-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        @if($cv->is_default && $cv->processed_at && ($cv->extracted_skills || $cv->extracted_education || $cv->extracted_experience))
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <h4 class="text-sm font-medium text-gray-900 mb-3">Extracted Data:</h4>
                                            
                                            <div class="space-y-4">
                                                @if($cv->extracted_skills)
                                                <div>
                                                    <h5 class="text-xs font-medium text-gray-700 mb-2">Skills:</h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach(is_array($cv->extracted_skills) ? $cv->extracted_skills : json_decode($cv->extracted_skills, true) as $skill)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                {{ is_array($skill) ? $skill['name'] ?? $skill : $skill }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                                
                                                @if($cv->extracted_education)
                                                <div>
                                                    <h5 class="text-xs font-medium text-gray-700 mb-2">Education:</h5>
                                                    <ul class="space-y-1 text-xs text-gray-700">
                                                        @foreach(is_array($cv->extracted_education) ? $cv->extracted_education : json_decode($cv->extracted_education, true) as $education)
                                                            <li class="bg-white p-2 rounded border border-gray-200">
                                                                <p class="font-medium">{{ $education['degree'] ?? '' }} {{ $education['field'] ?? '' }}</p>
                                                                <p>{{ $education['institution'] ?? '' }}</p>
                                                                <p class="text-gray-500">{{ $education['start_date'] ?? '' }} - {{ $education['end_date'] ?? 'Present' }}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                                
                                                @if($cv->extracted_experience)
                                                <div>
                                                    <h5 class="text-xs font-medium text-gray-700 mb-2">Experience:</h5>
                                                    <ul class="space-y-1 text-xs text-gray-700">
                                                        @foreach(is_array($cv->extracted_experience) ? $cv->extracted_experience : json_decode($cv->extracted_experience, true) as $experience)
                                                            <li class="bg-white p-2 rounded border border-gray-200">
                                                                <p class="font-medium">{{ $experience['title'] ?? '' }}</p>
                                                                <p>{{ $experience['company'] ?? '' }}</p>
                                                                <p class="text-gray-500">{{ $experience['start_date'] ?? '' }} - {{ $experience['end_date'] ?? 'Present' }}</p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-200">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No CVs uploaded</h3>
                                <p class="mt-1 text-sm text-gray-500">Upload your first CV to start applying for jobs.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 