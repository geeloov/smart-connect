@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
    <div class="mb-6">
            <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Applications
        </a>
    </div>

        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-green-600 opacity-10 rounded-2xl"></div>
            <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl shadow-xl border border-green-100 overflow-hidden">
                <!-- Header Background Pattern -->
                <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-green-50">
                        <circle cx="150" cy="150" r="150" fill="currentColor"/>
                        <circle cx="150" cy="150" r="120" fill="white"/>
                        <circle cx="150" cy="150" r="100" fill="currentColor"/>
                        <circle cx="150" cy="150" r="80" fill="white"/>
                        <circle cx="150" cy="150" r="60" fill="currentColor"/>
                    </svg>
                </div>

                <div class="flex flex-col md:flex-row md:items-start gap-8">
                    <div class="flex-shrink-0">
                        <div class="p-4 bg-green-600 rounded-xl shadow-md w-20 h-20 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                Application Details
                                </span>
                                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $jobApplication->jobSeeker->name }}</h1>
                                <p class="mt-2 text-lg text-gray-600">Applying for: {{ $jobApplication->jobPosition->title }}</p>
                            </div>
                            
                            <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                @csrf
                @method('PATCH')
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Application Status</label>
                                    <select id="status" name="status" class="rounded-lg border-gray-300 text-sm focus:border-green-500 focus:ring-green-500 w-full">
                    <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="reviewed" {{ $jobApplication->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="shortlisted" {{ $jobApplication->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                    <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="hired" {{ $jobApplication->status == 'hired' ? 'selected' : '' }}>Hired</option>
                </select>
                                </div>
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition mt-6">
                    Update Status
                </button>
            </form>
        </div>

                        <!-- Status Badge -->
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'reviewed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'shortlisted' => 'bg-green-100 text-green-800 border-green-200',
                                'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                'hired' => 'bg-purple-100 text-purple-800 border-purple-200',
                            ];
                            $statusColor = $statusColors[$jobApplication->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                        @endphp
                        <div class="inline-block {{ $statusColor }} px-3 py-1 rounded-full text-xs border font-medium">
                            {{ ucfirst($jobApplication->status) }}
                    </div>
                    </div>
                </div>
                    </div>
                </div>
                
        <!-- Applicant Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Applicant</h3>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $jobApplication->jobSeeker->name }}</p>
                </div>
                    </div>
                    
            <div class="bg-gradient-to-br from-white to-blue-50 rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Email</h3>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $jobApplication->jobSeeker->email }}</p>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-white to-amber-50 rounded-xl shadow-sm border border-amber-100 p-6 hover:shadow-md transition-all duration-200">
                <div class="flex flex-col">
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Applied On</h3>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $jobApplication->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">({{ $jobApplication->created_at->diffForHumans() }})</p>
                </div>
            </div>
        </div>

        <!-- CV Data and Cover Letter Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Resume Information
                </h3>
            </div>
            
            <div class="px-6 py-4" x-data="{ activeTab: 'formatted' }">
                <!-- Tabs -->
                <div class="flex space-x-4 border-b border-gray-200 mb-6">
                    <button 
                        @click="activeTab = 'formatted'" 
                        :class="{'text-green-600 border-b-2 border-green-600 font-medium': activeTab === 'formatted', 'text-gray-500 hover:text-gray-700': activeTab !== 'formatted'}"
                        class="px-3 py-2 text-sm focus:outline-none transition-colors">
                        Formatted View
                    </button>
                    <button 
                        @click="activeTab = 'rawData'" 
                        :class="{'text-green-600 border-b-2 border-green-600 font-medium': activeTab === 'rawData', 'text-gray-500 hover:text-gray-700': activeTab !== 'rawData'}"
                        class="px-3 py-2 text-sm focus:outline-none transition-colors">
                        Raw Data
                    </button>
                </div>
                
                <!-- No CV Data Message -->
                @if(!$jobApplication->cv_data)
                    <div class="py-8 flex flex-col items-center justify-center text-center px-4">
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">No CV Data Available</h3>
                        <p class="text-gray-500 max-w-md">This application doesn't have any extracted CV data.</p>
                    </div>
                @else
                @php
                    // Process CV data to ensure it's an array
                    $cvData = is_array($jobApplication->cv_data) 
                        ? $jobApplication->cv_data 
                        : json_decode($jobApplication->cv_data, true);
                    
                    // Ensure we have valid data
                    if (!is_array($cvData)) {
                        $cvData = [];
                    }
                @endphp
                
                    <!-- Formatted View Tab -->
                    <div x-show="activeTab === 'formatted'" class="space-y-8">
                        <!-- Personal Information -->
                        <div class="rounded-lg border border-gray-200 overflow-hidden">
                            <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                <h4 class="font-medium text-gray-900">Personal Information</h4>
                            </div>
                            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
                                @if(isset($cvData['personal_info']))
                                    @foreach(['name', 'email', 'phone', 'location', 'linkedin', 'website'] as $field)
                                        @if(isset($cvData['personal_info'][$field]) && !empty($cvData['personal_info'][$field]))
                                            <div>
                                                <p class="text-sm text-gray-500">{{ ucfirst($field) }}</p>
                                                <p class="font-medium">{{ $cvData['personal_info'][$field] }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">No personal information available</p>
                                @endif
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="rounded-lg border border-gray-200 overflow-hidden">
                            <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                <h4 class="font-medium text-gray-900">Skills</h4>
                            </div>
                            <div class="p-4">
                                @if(isset($cvData['skills']) && count($cvData['skills']) > 0)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($cvData['skills'] as $skill)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No skills listed</p>
                                @endif
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="rounded-lg border border-gray-200 overflow-hidden">
                            <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                <h4 class="font-medium text-gray-900">Education</h4>
                            </div>
                            <div class="p-4">
                                @if(isset($cvData['education']) && count($cvData['education']) > 0)
                                    <div class="space-y-6">
                                        @foreach($cvData['education'] as $education)
                                            <div class="pb-6 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                                <h5 class="font-medium text-gray-900">{{ $education['degree'] ?? 'Degree' }}</h5>
                                                <p class="text-gray-700">{{ $education['institution'] ?? 'Institution' }}</p>
                                                @if(isset($education['dates']) && !empty($education['dates']))
                                                    <p class="text-gray-500 text-sm">{{ $education['dates'] }}</p>
                                                @endif
                                                @if(isset($education['description']) && !empty($education['description']))
                                                    <p class="mt-2 text-gray-600">{{ $education['description'] }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No education history available</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Work Experience -->
                        <div class="rounded-lg border border-gray-200 overflow-hidden">
                            <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                                <h4 class="font-medium text-gray-900">Work Experience</h4>
                            </div>
                            <div class="p-4">
                                @if(isset($cvData['work_experience']) && count($cvData['work_experience']) > 0)
                                    <div class="space-y-6">
                                        @foreach($cvData['work_experience'] as $experience)
                                            <div class="group hover:bg-gray-50 p-3 rounded-lg transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                                <h5 class="font-medium text-gray-900">{{ $experience['title'] ?? 'Position' }}</h5>
                                                <p class="text-gray-700">{{ $experience['company'] ?? 'Company' }}</p>
                                                @if(isset($experience['dates']) && !empty($experience['dates']))
                                                    <p class="text-gray-500 text-sm">{{ $experience['dates'] }}</p>
                                                @endif
                                                @if(isset($experience['description']) && !empty($experience['description']))
                                                    <p class="mt-2 text-gray-600">{{ $experience['description'] }}</p>
                                                @endif
                                                @if(isset($experience['achievements']) && is_array($experience['achievements']) && count($experience['achievements']) > 0)
                                                    <div class="mt-3">
                                                        <h6 class="text-sm font-medium text-gray-700 mb-1">Achievements:</h6>
                                                        <ul class="list-disc pl-5 text-gray-600 text-sm space-y-1">
                                                            @foreach($experience['achievements'] as $achievement)
                                                                <li>{{ $achievement }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No work experience available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Raw Data View Tab -->
                    <div x-show="activeTab === 'rawData'" class="bg-gray-50 p-4 rounded-lg">
                        <pre class="text-xs overflow-x-auto text-gray-700">{{ json_encode($cvData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                @endif
            </div>
        </div>

                            <!-- Job Matching Analysis Section -->
                            @if($jobApplication->compatibility_analysis)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4 flex justify-between items-center">
                <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        Job Matching Analysis
                </h3>
            </div>
            <div class="px-6 py-4">
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
                        $scoreMessageBg = 'bg-green-100 text-green-800 border-green-200';
                                        } elseif ($matchScore >= 60) {
                                            $scoreColor = 'bg-blue-500';
                                            $scoreTextColor = 'text-blue-600';
                                            $scoreMessage = 'Good match for this position';
                        $scoreMessageBg = 'bg-blue-100 text-blue-800 border-blue-200';
                                        } elseif ($matchScore >= 40) {
                                            $scoreColor = 'bg-yellow-500';
                                            $scoreTextColor = 'text-yellow-600';
                                            $scoreMessage = 'Partial match for this position';
                        $scoreMessageBg = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                        } else {
                                            $scoreColor = 'bg-red-500';
                                            $scoreTextColor = 'text-red-600';
                                            $scoreMessage = 'Low match for this position';
                        $scoreMessageBg = 'bg-red-100 text-red-800 border-red-200';
                                        }
                                    @endphp
                                    
                                    <!-- Match Score Section -->
                <div class="mb-8">
                    <div class="rounded-xl p-6 text-center bg-gradient-to-br from-white to-gray-50 border border-gray-200 shadow-sm">
                                            <h3 class="text-lg font-medium text-gray-900 mb-4">Match Score</h3>
                        
                        <!-- Circular Progress Indicator -->
                        <div class="relative mx-auto w-32 h-32 mb-4">
                            <svg class="w-full h-full" viewBox="0 0 100 100">
                                <!-- Background Circle -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="45"
                                    fill="none"
                                    stroke="#E5E7EB"
                                    stroke-width="8"
                                />
                                
                                <!-- Progress Circle -->
                                <circle
                                    cx="50"
                                    cy="50"
                                    r="45"
                                    fill="none"
                                    stroke="{{ str_replace('bg-', 'stroke-', $scoreColor) }}"
                                    stroke-width="8"
                                    stroke-dasharray="282.7"
                                    stroke-dashoffset="{{ 282.7 - ($matchScore / 100 * 282.7) }}"
                                    transform="rotate(-90 50 50)"
                                />
                                
                                <!-- Percentage Text -->
                                <text
                                    x="50"
                                    y="50"
                                    text-anchor="middle"
                                    dominant-baseline="middle"
                                    font-size="24"
                                    font-weight="bold"
                                    fill="{{ str_replace('text-', 'fill-', $scoreTextColor) }}"
                                >
                                    {{ $matchScore }}%
                                </text>
                            </svg>
                                            </div>
                                            
                        <div class="inline-block {{ $scoreMessageBg }} px-4 py-2 rounded-lg text-sm font-medium border">
                                                {{ $scoreMessage }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Analysis Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Analysis Summary</h3>
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-lg p-4 text-gray-700 border border-gray-200 shadow-sm">
                                            {{ $reasoning }}
                                        </div>
                                    </div>
                                    
                <!-- Skills Analysis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Matched Skills -->
                    <div class="bg-gradient-to-br from-white to-green-50 rounded-xl shadow-sm border border-green-100 overflow-hidden">
                        <div class="px-4 py-3 bg-green-100 border-b border-green-200">
                            <h3 class="font-medium text-green-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Matched Skills
                                            </h3>
                        </div>
                        <div class="p-4">
                                            @if(count($matchedSkills) > 0)
                                <div class="space-y-2">
                                                        @foreach($matchedSkills as $skill)
                                        <div class="flex items-center p-2 bg-white rounded-lg border border-green-100">
                                            <span class="flex-1 text-gray-700">{{ $skill }}</span>
                                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                        </div>
                                                        @endforeach
                                                </div>
                                            @else
                                <div class="bg-white rounded-lg p-4 text-gray-500 italic text-center border border-gray-100">
                                    No matched skills found.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                    <!-- Missing Skills -->
                    <div class="bg-gradient-to-br from-white to-red-50 rounded-xl shadow-sm border border-red-100 overflow-hidden">
                        <div class="px-4 py-3 bg-red-100 border-b border-red-200">
                            <h3 class="font-medium text-red-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                        </svg>
                                Missing Skills
                            </h3>
                                                        </div>
                        <div class="p-4">
                            @if(count($missingSkills) > 0)
                                <div class="space-y-2">
                                    @foreach($missingSkills as $skill)
                                        <div class="flex items-center p-2 bg-white rounded-lg border border-red-100">
                                            <span class="flex-1 text-gray-700">{{ $skill }}</span>
                                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                        </svg>
                                        </div>
                                        @endforeach
                                </div>
                                                        @else
                                <div class="bg-white rounded-lg p-4 text-gray-500 italic text-center border border-gray-100">
                                    No missing skills found.
                            </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
        <!-- Cover Letter Section (if exists) -->
            @if($jobApplication->cover_letter)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Cover Letter
                </h3>
            </div>
            <div class="px-6 py-4">
                <div class="p-4 rounded-lg prose max-w-none">
                    {!! nl2br(e($jobApplication->cover_letter)) !!}
                </div>
                </div>
            </div>
            @endif
            
        <!-- Action Buttons -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                Back to Applications
            </a>
            
            <a href="{{ route('recruiter.job-positions.show', $jobApplication->jobPosition) }}" class="inline-flex items-center px-4 py-2 border border-green-600 text-sm font-medium rounded-lg text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                    View Job Position
                </a>
        </div>
    </div>
</div>
@endsection 