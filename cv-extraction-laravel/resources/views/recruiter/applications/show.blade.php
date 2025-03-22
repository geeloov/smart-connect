@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-8">
    <div class="mb-6">
        <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center text-gray-600 hover:text-[#B9FF66] transition-colors">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Applications
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-[#B9FF66] px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-dark flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Application Details
            </h1>
            <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST" class="flex items-center space-x-2">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-md border-gray-300 text-sm focus:border-[#B9FF66] focus:ring-[#B9FF66]">
                    <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_review" {{ $jobApplication->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                    <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-dark bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors">
                    Update Status
                </button>
            </form>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Applicant
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobSeeker->name }}</p>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobSeeker->email }}</p>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Position
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->jobPosition->title }}</p>
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-medium text-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Applied On
                        </h2>
                        <p class="text-gray-600">{{ $jobApplication->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            
            @if($jobApplication->cv_data)
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-4">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                    </svg>
                    Extracted CV Data
                </h2>
                
                @php
                    $cvData = is_array($jobApplication->cv_data) 
                        ? $jobApplication->cv_data 
                        : json_decode($jobApplication->cv_data, true);
                @endphp
                
                <div class="space-y-4">
                    @if(isset($cvData['personal_info']))
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Personal Information</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                                @foreach($cvData['personal_info'] as $key => $value)
                                    <div class="md:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}</dt>
                                        <dd class="mt-1 text-gray-900">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['summary']) && !empty($cvData['summary']))
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Summary</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                            <p class="text-gray-700">{{ $cvData['summary'] }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['skills']) && count($cvData['skills']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Skills</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @foreach($cvData['skills'] as $skill)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#d4ffab] text-dark">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['experience']) && count($cvData['experience']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Work Experience</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200">
                            @foreach($cvData['experience'] as $experience)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="mb-1 font-medium">{{ $experience['title'] ?? 'Position' }}</div>
                                    <div class="text-sm text-gray-600">{{ $experience['company'] ?? 'Company' }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $experience['date_range'] ?? 'Date range not specified' }}</div>
                                    @if(isset($experience['location']))
                                        <div class="text-xs text-gray-500 mt-1">{{ $experience['location'] }}</div>
                                    @endif
                                    <div class="mt-2 text-sm">{{ $experience['description'] ?? 'No description available' }}</div>
                                    @if(isset($experience['technologies']) && is_array($experience['technologies']) && count($experience['technologies']) > 0)
                                        <div class="mt-3">
                                            <div class="text-xs font-medium text-gray-500 mb-1">Technologies/Tools Used:</div>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($experience['technologies'] as $tech)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($experience['achievements']) && is_array($experience['achievements']) && count($experience['achievements']) > 0)
                                        <div class="mt-3">
                                            <div class="text-xs font-medium text-gray-500 mb-1">Key Achievements:</div>
                                            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                                                @foreach($experience['achievements'] as $achievement)
                                                    <li>{{ $achievement }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['education']) && count($cvData['education']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Education</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200">
                            @foreach($cvData['education'] as $education)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="mb-1 font-medium">{{ $education['degree'] ?? 'Degree' }}</div>
                                    <div class="text-sm text-gray-600">{{ $education['institution'] ?? 'Institution' }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $education['date_range'] ?? 'Date range not specified' }}</div>
                                    @if(isset($education['location']))
                                        <div class="text-xs text-gray-500 mt-1">{{ $education['location'] }}</div>
                                    @endif
                                    @if(isset($education['gpa']) && !empty($education['gpa']))
                                        <div class="text-xs text-gray-600 mt-1">GPA: {{ $education['gpa'] }}</div>
                                    @endif
                                    @if(isset($education['description']) && !empty($education['description']))
                                        <div class="mt-2 text-sm text-gray-700">{{ $education['description'] }}</div>
                                    @endif
                                    @if(isset($education['courses']) && is_array($education['courses']) && count($education['courses']) > 0)
                                        <div class="mt-2">
                                            <div class="text-xs font-medium text-gray-500 mb-1">Relevant Courses:</div>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($education['courses'] as $course)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $course }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['certifications']) && count($cvData['certifications']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Certifications</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200">
                            @foreach($cvData['certifications'] as $certification)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="mb-1 font-medium">{{ $certification['name'] ?? 'Certification' }}</div>
                                    @if(isset($certification['issuer']))
                                        <div class="text-sm text-gray-600">{{ $certification['issuer'] }}</div>
                                    @endif
                                    @if(isset($certification['date']) || isset($certification['date_range']))
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $certification['date'] ?? $certification['date_range'] ?? 'Date not specified' }}
                                        </div>
                                    @endif
                                    @if(isset($certification['description']))
                                        <div class="mt-2 text-sm">{{ $certification['description'] }}</div>
                                    @endif
                                    @if(isset($certification['credential_id']))
                                        <div class="text-xs text-gray-600 mt-1">Credential ID: {{ $certification['credential_id'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['projects']) && count($cvData['projects']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Projects</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200">
                            @foreach($cvData['projects'] as $project)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="mb-1 font-medium">{{ $project['name'] ?? 'Project' }}</div>
                                    @if(isset($project['date_range']) || isset($project['date']))
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $project['date_range'] ?? $project['date'] ?? 'Date not specified' }}
                                        </div>
                                    @endif
                                    @if(isset($project['description']))
                                        <div class="mt-2 text-sm">{{ $project['description'] }}</div>
                                    @endif
                                    @if(isset($project['technologies']) && is_array($project['technologies']) && count($project['technologies']) > 0)
                                        <div class="mt-3">
                                            <div class="text-xs font-medium text-gray-500 mb-1">Technologies Used:</div>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($project['technologies'] as $tech)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($project['url']) && !empty($project['url']))
                                        <div class="mt-2 text-sm">
                                            <a href="{{ $project['url'] }}" target="_blank" class="text-[#B9FF66] hover:underline flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                                View Project
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['languages']) && count($cvData['languages']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Languages</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($cvData['languages'] as $language)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">
                                            @if(is_array($language) && isset($language['name']))
                                                {{ $language['name'] }}
                                            @else
                                                {{ $language }}
                                            @endif
                                        </span>
                                        @if(is_array($language) && isset($language['proficiency']))
                                            <span class="text-sm text-gray-500">{{ $language['proficiency'] }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['references']) && count($cvData['references']) > 0)
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">References</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="border-t border-gray-200">
                            @foreach($cvData['references'] as $reference)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="mb-1 font-medium">{{ $reference['name'] ?? 'Reference Name' }}</div>
                                    @if(isset($reference['title']))
                                        <div class="text-sm text-gray-600">{{ $reference['title'] }}</div>
                                    @endif
                                    @if(isset($reference['company']))
                                        <div class="text-sm text-gray-600">{{ $reference['company'] }}</div>
                                    @endif
                                    @if(isset($reference['email']))
                                        <div class="text-sm text-gray-600 mt-1">
                                            <a href="mailto:{{ $reference['email'] }}" class="text-[#B9FF66] hover:underline">
                                                {{ $reference['email'] }}
                                            </a>
                                        </div>
                                    @endif
                                    @if(isset($reference['phone']))
                                        <div class="text-sm text-gray-600">
                                            <a href="tel:{{ $reference['phone'] }}" class="text-[#B9FF66] hover:underline">
                                                {{ $reference['phone'] }}
                                            </a>
                                        </div>
                                    @endif
                                    @if(isset($reference['relationship']))
                                        <div class="text-sm text-gray-500 mt-1">Relationship: {{ $reference['relationship'] }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['interests']) && !empty($cvData['interests']))
                    <div x-data="{ open: true }" class="border border-gray-200 rounded-lg overflow-hidden">
                        <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                            <span class="font-medium">Interests</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($cvData['interests']))
                                    @foreach($cvData['interests'] as $interest)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            {{ $interest }}
                                        </span>
                                    @endforeach
                                @else
                                    <p class="text-gray-700">{{ $cvData['interests'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($cvData['additional_sections']) && is_array($cvData['additional_sections']))
                        @foreach($cvData['additional_sections'] as $sectionName => $sectionContent)
                            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                                <button @click="open = !open" class="w-full px-4 py-3 bg-gray-50 text-left flex justify-between items-center">
                                    <span class="font-medium">{{ is_numeric($sectionName) ? 'Additional Information' : str_replace('_', ' ', $sectionName) }}</span>
                                    <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" class="px-4 py-3 border-t border-gray-200">
                                    @if(is_array($sectionContent))
                                        @if(isset($sectionContent[0]) && is_array($sectionContent[0]))
                                            @foreach($sectionContent as $item)
                                                <div class="mb-3 pb-3 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0">
                                                    @foreach($item as $key => $value)
                                                        <div class="mb-1">
                                                            <span class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                            <span class="text-gray-700">
                                                                @if(is_array($value))
                                                                    {{ implode(', ', $value) }}
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach($sectionContent as $key => $value)
                                                <div class="mb-1">
                                                    <span class="text-sm font-medium text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}:</span>
                                                    <span class="text-gray-700">
                                                        @if(is_array($value))
                                                            {{ implode(', ', $value) }}
                                                        @else
                                                            {{ $value }}
                                                        @endif
                                                    </span>
                                                </div>
                                            @endforeach
                                        @endif
                                    @else
                                        <p class="text-gray-700">{{ $sectionContent }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif
            
            @if($jobApplication->cover_letter)
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-3">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Cover Letter
                </h2>
                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                    {!! nl2br(e($jobApplication->cover_letter)) !!}
                </div>
            </div>
            @endif
            
            <div class="mb-8">
                <h2 class="text-lg font-medium text-gray-700 flex items-center mb-3">
                    <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Uploaded CV
                </h2>
                <a href="{{ asset('storage/cv_files/' . $jobApplication->cv_filename) }}" class="inline-flex items-center px-4 py-2 border border-[#191A23] rounded-xl shadow-sm text-sm font-medium text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors" target="_blank" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download CV
                </a>
            </div>
            
            <div class="flex justify-between">
                <a href="{{ route('recruiter.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Applications
                </a>
                <a href="{{ route('recruiter.job-positions.show', $jobApplication->jobPosition) }}" class="inline-flex items-center px-4 py-2 border border-[#191A23] rounded-xl shadow-sm text-sm font-medium text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-colors" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Job Position
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 