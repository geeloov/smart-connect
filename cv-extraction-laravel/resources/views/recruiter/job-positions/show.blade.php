@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white rounded-2xl shadow-lg border border-green-100 p-6">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-4">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 truncate">{{ $jobPosition->title }}</h1>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                            {{ $jobPosition->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-2 text-sm text-gray-500 mt-2">
                        <span>{{ $jobPosition->company_name }}</span>
                        <span>•</span>
                        <span>{{ $jobPosition->location }}</span>
                        @if($jobPosition->job_type)
                        <span>•</span>
                        <span class="font-medium text-green-700">{{ $jobPosition->job_type }}</span>
                        @endif
                        @if($jobPosition->salary_range)
                        <span>•</span>
                        <span class="font-medium text-gray-700">{{ $jobPosition->salary_range }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('recruiter.job-positions.edit', $jobPosition) }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('recruiter.job-positions.destroy', $jobPosition) }}" method="POST" 
                        onsubmit="return confirm('Are you sure you want to delete this job position? This action cannot be undone.');" 
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Description & Requirements -->
            <div class="md:col-span-2 space-y-8">
                <!-- Description Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-green-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-green-100 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Job Description</h3>
                    </div>
                    <div class="px-6 py-5">
                        @if($jobPosition->description)
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($jobPosition->description)) !!}
                            </div>
                        @else
                            <p class="text-gray-500 italic">No description provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-blue-100 flex items-center">
                         <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Requirements</h3>
                    </div>
                    <div class="px-6 py-5">
                        @if($jobPosition->requirements)
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br(e($jobPosition->requirements)) !!}
                            </div>
                        @else
                            <p class="text-gray-500 italic">No requirements provided.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Overview & Applications -->
            <div class="md:col-span-1 space-y-8">
                <!-- Overview Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center">
                         <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Overview</h3>
                    </div>
                    <div class="p-6 space-y-4 text-sm text-gray-700">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Posted on: <span class="font-medium">{{ $jobPosition->created_at->format('F d, Y') }} ({{ $jobPosition->created_at->diffForHumans() }})</span></span>
                        </div>
                        
                        @if($jobPosition->job_type)
                        <div class="flex items-center">
                             <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Job Type: <span class="font-medium">{{ $jobPosition->job_type }}</span></span>
                        </div>
                        @endif

                         @if($jobPosition->salary_range)
                        <div class="flex items-center">
                             <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Salary: <span class="font-medium">{{ $jobPosition->salary_range }}</span></span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Applications Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-purple-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-purple-100 flex items-center">
                         <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Applications</h3>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-4xl font-bold text-purple-600 mb-2">{{ $applications->count() }}</p>
                        <p class="text-sm text-gray-600">Total Applications Received</p>
                        @if($applications->count() > 0)
                            <a href="{{ route('recruiter.applications.index', ['job_position_id' => $jobPosition->id]) }}" 
                                class="mt-4 inline-flex items-center px-4 py-2 border border-purple-600 text-sm font-medium rounded-xl text-purple-600 bg-white hover:bg-purple-600 hover:text-white transition-colors">
                                View All Applications
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 