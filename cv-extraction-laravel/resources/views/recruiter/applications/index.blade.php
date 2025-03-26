@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
                    <div class="flex items-start gap-4">
                        <!-- Icon -->
                        <div class="hidden sm:block flex-shrink-0">
                            <div class="p-3 bg-green-500 rounded-xl shadow-md h-16 w-16 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Applications Management
                                </span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Job Applications</h1>
                            <p class="mt-2 text-lg text-gray-600">Manage and track all applications for your job positions</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center mt-4 md:mt-0 bg-white py-1 px-2 rounded-lg relative z-20">
                        <a href="{{ route('recruiter.job-positions.create') }}" class="inline-flex items-center px-5 py-2.5 border-2 border-green-600 text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            Post New Job
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm" role="alert">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="border-b border-gray-200 bg-gradient-to-r from-green-50 to-white px-6 py-4">
                <h3 class="text-base font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter Applications
                </h3>
            </div>
            <div class="px-6 py-4">
                <form action="{{ route('recruiter.applications.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="job_position" class="block text-sm font-medium text-gray-700 mb-1">
                                Job Position
                            </label>
                            <select name="job_position" id="job_position" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 text-sm">
                                <option value="">All Positions</option>
                                @foreach($jobPositions as $position)
                                    <option value="{{ $position->id }}" {{ request('job_position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 text-sm">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">
                                Sort By
                            </label>
                            <select name="sort" id="sort" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 text-sm">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="highest_score" {{ request('sort') == 'highest_score' ? 'selected' : '' }}>Highest Score</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Applications List -->
        @if(count($applications) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Applicant
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Applied
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Match
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($applications as $application)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-green-600 text-white rounded-full flex items-center justify-center">
                                                {{ strtoupper(substr($application->jobSeeker->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $application->jobSeeker->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->jobSeeker->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('recruiter.job-positions.show', $application->jobPosition) }}" class="text-green-600 hover:text-green-900">
                                            <div class="text-sm font-medium">{{ $application->jobPosition->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $application->jobPosition->company_name }}</div>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $application->created_at->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $application->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'reviewed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'shortlisted' => 'bg-green-100 text-green-800 border-green-200',
                                                'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                                'hired' => 'bg-purple-100 text-purple-800 border-purple-200',
                                            ];
                                            $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        <span class="inline-block {{ $statusColor }} px-2.5 py-1 rounded-full text-xs border font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            // Extract match score from compatibility_analysis
                                            $matchScore = null;
                                            if ($application->compatibility_analysis) {
                                                $compData = json_decode($application->compatibility_analysis, true);
                                                $matchScore = $compData['match_score'] ?? null;
                                            }
                                        @endphp
                                        
                                        @if($matchScore !== null)
                                            <div class="flex items-center">
                                                <div class="relative w-16 h-4 bg-gray-200 rounded-full mr-2 overflow-hidden">
                                                    <div class="absolute top-0 left-0 h-full rounded-full 
                                                        @if($matchScore >= 80) bg-green-500
                                                        @elseif($matchScore >= 60) bg-blue-500
                                                        @elseif($matchScore >= 40) bg-yellow-500
                                                        @else bg-red-500
                                                        @endif
                                                    " style="width: {{ $matchScore }}%"></div>
                                                </div>
                                                <span class="text-sm font-medium 
                                                    @if($matchScore >= 80) text-green-700
                                                    @elseif($matchScore >= 60) text-blue-700
                                                    @elseif($matchScore >= 40) text-yellow-700
                                                    @else text-red-700
                                                    @endif
                                                ">{{ $matchScore }}%</span>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500">
                                                Not analyzed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('recruiter.applications.show', $application) }}" class="inline-flex items-center px-3 py-1.5 border border-green-600 text-xs font-medium rounded-lg text-green-600 bg-white hover:bg-green-600 hover:text-white transition-colors">
                                            View Application
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-6 flex justify-center">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mb-6">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Applications Found</h3>
                <p class="text-gray-500 mb-6 max-w-md">Try changing your filters or check back later for new applications to your job positions.</p>
                <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center px-4 py-2 border-2 border-green-600 shadow-md text-sm font-semibold rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    Manage Job Positions
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 