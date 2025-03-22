@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <!-- Header -->
            <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl md:text-2xl font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Application Details
                </h1>
                <span class="px-3 py-1 inline-flex text-sm font-medium rounded-lg
                    @if($jobApplication->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($jobApplication->status == 'in_review') bg-blue-100 text-blue-800
                    @elseif($jobApplication->status == 'accepted') bg-green-100 text-green-800
                    @elseif($jobApplication->status == 'rejected') bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}
                </span>
            </div>
            
            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Job Details Panel -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm h-full">
                        <div class="border-b border-gray-200 px-4 py-3">
                            <h2 class="font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Job Details
                            </h2>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-indigo-600 mb-1">{{ $jobApplication->jobPosition->title }}</h3>
                            <h4 class="text-gray-500 mb-4">{{ $jobApplication->jobPosition->company_name }}</h4>
                            
                            <div class="mb-2 flex items-center">
                                <div class="bg-indigo-100 p-1.5 rounded-lg mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700">{{ $jobApplication->jobPosition->location }}</span>
                            </div>
                            
                            <div class="mb-2 flex items-center">
                                <div class="bg-indigo-100 p-1.5 rounded-lg mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700">{{ $jobApplication->jobPosition->job_type }}</span>
                            </div>
                            
                            <div class="mb-4 flex items-center">
                                <div class="bg-indigo-100 p-1.5 rounded-lg mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700">Applied on {{ $jobApplication->created_at->format('F d, Y') }}</span>
                            </div>
                            
                            <a href="{{ route('job-seeker.jobs.details', $jobApplication->jobPosition) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Job Details
                            </a>
                        </div>
                    </div>
                    
                    <!-- Skills Matching Panel -->
                    @if($jobApplication->compatibility_analysis)
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6">
                        <div class="border-b border-gray-200 px-4 py-3">
                            <h2 class="font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Job Match Analysis
                            </h2>
                        </div>
                        <div class="p-6">
                            @php
                                $compData = json_decode($jobApplication->compatibility_analysis, true);
                                $matchScore = $compData['match_score'] ?? 0;
                                $reasoning = $compData['reasoning'] ?? 'No detailed analysis available.';
                                
                                // Get skills analysis data
                                $matchedSkills = [];
                                $missingSkills = [];
                                
                                if (isset($compData['skills_analysis'])) {
                                    $matchedSkills = $compData['skills_analysis']['matched_skills'] ?? [];
                                    $missingSkills = $compData['skills_analysis']['missing_skills'] ?? [];
                                }
                                
                                // Set score color
                                $scoreColor = '';
                                $scoreTextColor = '';
                                $scoreMessage = '';
                                
                                if ($matchScore >= 80) {
                                    $scoreColor = 'bg-green-500';
                                    $scoreTextColor = 'text-green-600';
                                    $scoreMessage = 'Excellent match for this position!';
                                    $scoreMessageBg = 'bg-green-50 text-green-800';
                                } elseif ($matchScore >= 60) {
                                    $scoreColor = 'bg-blue-500';
                                    $scoreTextColor = 'text-blue-600';
                                    $scoreMessage = 'Good match for this position';
                                    $scoreMessageBg = 'bg-blue-50 text-blue-800';
                                } elseif ($matchScore >= 40) {
                                    $scoreColor = 'bg-yellow-500';
                                    $scoreTextColor = 'text-yellow-600';
                                    $scoreMessage = 'Partial match for this position';
                                    $scoreMessageBg = 'bg-yellow-50 text-yellow-800';
                                } else {
                                    $scoreColor = 'bg-red-500';
                                    $scoreTextColor = 'text-red-600';
                                    $scoreMessage = 'Low match for this position';
                                    $scoreMessageBg = 'bg-red-50 text-red-800';
                                }
                            @endphp
                            
                            <!-- Match Score -->
                            <div class="mb-8">
                                <h3 class="font-medium text-gray-900 mb-3">Match Score</h3>
                                <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                    <div class="h-4 rounded-full {{ $scoreColor }}" style="width: {{ $matchScore }}%"></div>
                                </div>
                                
                                <div class="flex justify-center items-center mb-4">
                                    <span class="text-2xl font-bold {{ $scoreTextColor }}">
                                        {{ $matchScore }}%
                                    </span>
                                </div>
                                
                                <div class="text-center mb-3">
                                    <div class="{{ $scoreMessageBg }} p-3 rounded-lg flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            @if($matchScore >= 80)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            @elseif($matchScore >= 60)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @elseif($matchScore >= 40)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @endif
                                        </svg>
                                        {{ $scoreMessage }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Reasoning -->
                            <div class="mb-6">
                                <h3 class="font-medium text-gray-900 mb-3">Analysis</h3>
                                <div class="bg-gray-50 rounded-lg p-4 text-gray-700">
                                    {{ $reasoning }}
                                </div>
                            </div>
                            
                            <!-- Skills -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-green-600 font-medium flex items-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Matched Skills
                                    </h3>
                                    @if(count($matchedSkills) > 0)
                                        <ul class="space-y-2">
                                            @foreach($matchedSkills as $skill)
                                                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                                    <span class="text-gray-700">{{ $skill }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 italic">No skills matched.</p>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-red-600 font-medium flex items-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Missing Skills
                                    </h3>
                                    @if(count($missingSkills) > 0)
                                        <ul class="space-y-2">
                                            @foreach($missingSkills as $skill)
                                                <li class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                                    <span class="text-gray-700">{{ $skill }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 italic">No missing skills identified.</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Experience and Education Analysis -->
                            @if(isset($compData['experience_analysis']) || isset($compData['education_analysis']))
                            <div class="mt-6 pt-6 border-t border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Experience Analysis -->
                                @if(isset($compData['experience_analysis']))
                                <div>
                                    <h3 class="font-medium text-gray-900 mb-3">Experience Analysis</h3>
                                    <ul class="space-y-2">
                                        <li class="flex items-start p-3 bg-gray-50 rounded-lg">
                                            <div class="mr-3 mt-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-gray-700"><span class="font-medium">Years of Experience:</span> {{ $compData['experience_analysis']['years_of_relevant_experience'] ?? 'Not specified' }}</p>
                                                <p class="text-gray-700 mt-1">
                                                    <span class="font-medium">Meets Requirements:</span> 
                                                    @if(isset($compData['experience_analysis']['has_required_experience']))
                                                        @if($compData['experience_analysis']['has_required_experience'])
                                                            <span class="text-green-600">Yes</span>
                                                        @else
                                                            <span class="text-red-600">No</span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-500">Not specified</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                
                                <!-- Education Analysis -->
                                @if(isset($compData['education_analysis']))
                                <div>
                                    <h3 class="font-medium text-gray-900 mb-3">Education Analysis</h3>
                                    <ul class="space-y-2">
                                        <li class="flex items-start p-3 bg-gray-50 rounded-lg">
                                            <div class="mr-3 mt-0.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-medium">Meets Requirements:</span> 
                                                    @if(isset($compData['education_analysis']['meets_education_requirements']))
                                                        @if($compData['education_analysis']['meets_education_requirements'])
                                                            <span class="text-green-600">Yes</span>
                                                        @else
                                                            <span class="text-red-600">No</span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-500">Not specified</span>
                                                    @endif
                                                </p>
                                                
                                                @if(isset($compData['education_analysis']['relevant_degrees']) && count($compData['education_analysis']['relevant_degrees']) > 0)
                                                    <p class="text-gray-700 mt-1"><span class="font-medium">Relevant Degrees:</span></p>
                                                    <ul class="mt-1 ml-4 text-gray-600 list-disc">
                                                        @foreach($compData['education_analysis']['relevant_degrees'] as $degree)
                                                            <li>{{ $degree }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Cover Letter Panel -->
                @if($jobApplication->cover_letter)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6">
                    <div class="border-b border-gray-200 px-4 py-3">
                        <h2 class="font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Cover Letter
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-50 rounded-lg p-4 text-gray-700 whitespace-pre-line">
                            {{ $jobApplication->cover_letter }}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Uploaded CV Panel -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm mb-6">
                    <div class="border-b border-gray-200 px-4 py-3">
                        <h2 class="font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Uploaded CV
                        </h2>
                    </div>
                    <div class="p-6">
                        <a href="{{ asset('storage/cv_files/' . $jobApplication->cv_filename) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download CV
                        </a>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-between gap-4 mt-8">
                    <a href="{{ route('job-seeker.applications.index') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Applications
                    </a>
                    <a href="{{ route('job-seeker.jobs.details', $jobApplication->jobPosition) }}" class="flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        View Job Position
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 