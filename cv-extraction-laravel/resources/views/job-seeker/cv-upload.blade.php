@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">CV Analysis Tool</h1>
        
        <!-- Upload Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 transition duration-300 hover:shadow-xl">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Upload Your CV</h2>
                <p class="text-blue-100 text-sm mt-1">Extract information from your CV and match it to job requirements</p>
            </div>

            <div class="p-6 lg:p-8">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- CV Upload Form -->
                <form method="POST" action="{{ route('job-seeker.cv-upload.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="cv_file" class="block text-sm font-medium text-gray-700 mb-1">Upload your CV (PDF)</label>
                        
                        <!-- File Upload - Initial State -->
                        <div id="upload-initial" class="relative border-2 border-gray-300 border-dashed rounded-lg p-6 transition hover:border-blue-500 focus-within:border-blue-500 group">
                            <input type="file" name="cv_file" id="cv_file" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50"
                                required>
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H8m36-12h-4a4 4 0 00-4 4v4m0-20v4a4 4 0 004 4h4m-12 4h.01M20 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-600 group-hover:text-blue-600 transition">
                                    Drag and drop your CV file, or <span class="font-medium text-blue-600">click to browse</span>
                                </p>
                                <p class="mt-1 text-xs text-gray-500">PDF format only (max 10MB)</p>
                            </div>
                        </div>
                        
                        <!-- File Upload - File Selected State -->
                        <div id="upload-selected" class="hidden relative border-2 border-blue-500 rounded-lg p-6 bg-blue-50">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="text-sm font-medium text-blue-800" id="selected-filename">filename.pdf</h4>
                                    <p class="mt-1 text-xs text-blue-600" id="selected-filesize">Size: 0KB</p>
                                    <div class="mt-2">
                                        <button type="button" id="change-file-btn" class="inline-flex items-center px-2.5 py-1.5 border border-blue-300 shadow-sm text-xs font-medium rounded text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Change file
                                        </button>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        @error('cv_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="job_description" class="block text-sm font-medium text-gray-700 mb-1">Job Description (Optional)</label>
                        <textarea name="job_description" id="job_description" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Paste job description to match your CV against specific requirements..."
                            rows="5">{{ old('job_description') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500 italic">
                            Providing a job description will help match your CV to specific requirements and calculate a match score.
                        </p>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Extract CV Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- CV Extraction Results -->
        @if(isset($cvData))
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">CV Analysis Results</h2>
                <p class="text-green-100 text-sm mt-1">Information extracted from your CV</p>
            </div>
            
            <div class="p-6 lg:p-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <tbody class="divide-y divide-gray-200">
                            <!-- Personal Information -->
                            @if(isset($cvData['name']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 bg-gray-50 rounded-l-lg">Name:</th>
                                <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">{{ $cvData['name'] }}</td>
                            </tr>
                            @endif
                            
                            @if(isset($cvData['email']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3">Email:</th>
                                <td class="py-4 px-4 text-sm text-gray-700">{{ $cvData['email'] }}</td>
                            </tr>
                            @endif
                            
                            @if(isset($cvData['phone']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 bg-gray-50 rounded-l-lg">Phone:</th>
                                <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">{{ $cvData['phone'] }}</td>
                            </tr>
                            @endif
                            
                            @if(isset($cvData['address']) || isset($cvData['location']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3">Location:</th>
                                <td class="py-4 px-4 text-sm text-gray-700">{{ $cvData['address'] ?? $cvData['location'] ?? 'Not specified' }}</td>
                            </tr>
                            @endif
                            
                            <!-- Skills (array) -->
                            @if(isset($cvData['skills']) && is_array($cvData['skills']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top bg-gray-50 rounded-l-lg">Skills:</th>
                                <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($cvData['skills'] as $skill)
                                            @if(is_string($skill))
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $skill }}
                                                </span>
                                            @elseif(is_array($skill))
                                                @if(isset($skill['name']))
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $skill['name'] }}
                                                        @if(isset($skill['level']))
                                                            <span class="ml-1 text-blue-600">({{ $skill['level'] }})</span>
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ implode(', ', array_filter($skill)) }}
                                                    </span>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endif
                            
                            <!-- Education (array) -->
                            @if(isset($cvData['education']) && is_array($cvData['education']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top">Education:</th>
                                <td class="py-4 px-4 text-sm text-gray-700">
                                    <div class="space-y-4">
                                        @foreach($cvData['education'] as $edu)
                                            @if(is_string($edu))
                                                <div class="pb-2 border-b border-gray-100">{{ $edu }}</div>
                                            @elseif(is_array($edu))
                                                <div class="pb-2 border-b border-gray-100">
                                                    @if(isset($edu['institution']))
                                                        <div class="font-medium text-gray-900">{{ $edu['institution'] }}</div>
                                                    @endif
                                                    
                                                    <div>
                                                        @if(isset($edu['degree']))
                                                            {{ $edu['degree'] }}
                                                        @endif
                                                        
                                                        @if(isset($edu['field']))
                                                            - {{ $edu['field'] }}
                                                        @endif
                                                    </div>
                                                    
                                                    @if(isset($edu['year']) || isset($edu['graduation_year']))
                                                        <div class="text-gray-500 text-xs mt-1">
                                                            {{ $edu['year'] ?? $edu['graduation_year'] ?? '' }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endif
                            
                            <!-- Work Experience (array) -->
                            @if(isset($cvData['work_experience']) && is_array($cvData['work_experience']))
                            <tr>
                                <th class="py-4 px-4 text-left text-sm font-medium text-gray-900 w-1/3 align-top bg-gray-50 rounded-l-lg">Work Experience:</th>
                                <td class="py-4 px-4 text-sm text-gray-700 bg-gray-50 rounded-r-lg">
                                    <div class="space-y-6">
                                        @foreach($cvData['work_experience'] as $exp)
                                            @if(is_string($exp))
                                                <div class="pb-4 border-b border-gray-200">{{ $exp }}</div>
                                            @elseif(is_array($exp))
                                                <div class="pb-4 border-b border-gray-200">
                                                    <div class="font-medium text-gray-900">
                                                        @if(isset($exp['company']))
                                                            {{ $exp['company'] }}
                                                        @elseif(isset($exp['employer']))
                                                            {{ $exp['employer'] }}
                                                        @elseif(isset($exp['organization']))
                                                            {{ $exp['organization'] }}
                                                        @endif
                                                        
                                                        @if(isset($exp['position']) || isset($exp['title']) || isset($exp['role']))
                                                            - {{ $exp['position'] ?? $exp['title'] ?? $exp['role'] }}
                                                        @endif
                                                    </div>
                                                    
                                                    @if(isset($exp['duration']) || isset($exp['start_date']) || isset($exp['end_date']))
                                                        <div class="text-gray-500 text-xs mt-1">
                                                            @if(isset($exp['duration']))
                                                                {{ $exp['duration'] }}
                                                            @elseif(isset($exp['start_date']) || isset($exp['end_date']))
                                                                {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['end_date'] ?? 'Present' }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                    @if(isset($exp['description']) || isset($exp['responsibilities']))
                                                        <p class="mt-2 text-gray-700">
                                                            {{ $exp['description'] ?? $exp['responsibilities'] }}
                                                        </p>
                                                    @endif
                                                    
                                                    @if(isset($exp['achievements']) && is_array($exp['achievements']))
                                                        <div class="mt-2 pl-4 border-l-2 border-green-300">
                                                            <div class="text-xs font-medium text-gray-900 mb-1">Achievements:</div>
                                                            <ul class="list-disc pl-5 text-sm text-gray-700">
                                                                @foreach($exp['achievements'] as $achievement)
                                                                    <li>{{ $achievement }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <!-- Job Matching Results -->
                @if(isset($jobMatching))
                <div class="mt-8 rounded-xl bg-blue-50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Job Matching Results
                    </h3>
                    
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-4 border-b border-gray-100">
                            @if(isset($jobMatching['score']))
                            <div class="flex items-center">
                                <div class="w-1/3 text-sm font-medium text-gray-900">Match Score:</div>
                                <div class="w-2/3">
                                    <div class="flex items-center">
                                        <div class="mr-4 text-xl font-bold 
                                            @if($jobMatching['score'] >= 80) text-green-600
                                            @elseif($jobMatching['score'] >= 60) text-blue-600
                                            @elseif($jobMatching['score'] >= 40) text-yellow-600
                                            @else text-red-600 @endif">
                                            {{ $jobMatching['score'] }}%
                                        </div>
                                        <div class="w-full max-w-xs bg-gray-200 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full 
                                                @if($jobMatching['score'] >= 80) bg-green-600
                                                @elseif($jobMatching['score'] >= 60) bg-blue-600
                                                @elseif($jobMatching['score'] >= 40) bg-yellow-600
                                                @else bg-red-600 @endif" 
                                                style="width: {{ $jobMatching['score'] }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        @if(isset($jobMatching['matching_skills']) && is_array($jobMatching['matching_skills']))
                        <div class="p-4">
                            <div class="flex items-start">
                                <div class="w-1/3 text-sm font-medium text-gray-900">Matching Skills:</div>
                                <div class="w-2/3">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($jobMatching['matching_skills'] as $skill)
                                            @if(is_string($skill))
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $skill }}
                                                </span>
                                            @elseif(is_array($skill) && isset($skill['name']))
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $skill['name'] }}
                                                </span>
                                            @elseif(is_array($skill))
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ implode(', ', array_filter($skill)) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('job-seeker.cv-upload') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Upload Another CV
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add JavaScript for handling file upload state -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('cv_file');
        const initialUploadDiv = document.getElementById('upload-initial');
        const selectedUploadDiv = document.getElementById('upload-selected');
        const selectedFilename = document.getElementById('selected-filename');
        const selectedFilesize = document.getElementById('selected-filesize');
        const changeFileBtn = document.getElementById('change-file-btn');
        
        // Function to format bytes to KB, MB
        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }
        
        // Handle file selection
        fileInput.addEventListener('change', function(e) {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                // Update the selected file info
                selectedFilename.textContent = file.name;
                selectedFilesize.textContent = 'Size: ' + formatFileSize(file.size);
                
                // Show the selected state
                initialUploadDiv.classList.add('hidden');
                selectedUploadDiv.classList.remove('hidden');
            } else {
                // Show the initial state if no file selected
                initialUploadDiv.classList.remove('hidden');
                selectedUploadDiv.classList.add('hidden');
            }
        });
        
        // Handle "Change file" button click
        changeFileBtn.addEventListener('click', function() {
            // Reset the file input
            fileInput.value = '';
            // Show the initial state
            initialUploadDiv.classList.remove('hidden');
            selectedUploadDiv.classList.add('hidden');
            // Trigger file input click
            setTimeout(() => {
                fileInput.click();
            }, 100);
        });
    });
</script>
@endsection