@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-start gap-4">
                <div class="bg-[#B9FF66] p-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-500">Applications</p>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Applications</h1>
                    <p class="mt-1 text-gray-500">View and manage candidate applications</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-400 p-4 sm:p-5 rounded-lg flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="inline-flex text-green-500 focus:outline-none focus:text-green-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Filter Section -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter Applications
                </h2>
            </div>
            <div class="px-6 py-5">
                <form action="{{ route('recruiter.applications.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </label>
                            <input type="text" name="search" id="search" placeholder="Applicant name..." value="{{ request('search') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="job_position" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Job Position
                            </label>
                            <select name="job_position" id="job_position" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                <option value="">All Positions</option>
                                @foreach($jobPositions as $jobPosition)
                                    <option value="{{ $jobPosition->id }}" {{ request('job_position') == $jobPosition->id ? 'selected' : '' }}>
                                        {{ $jobPosition->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Status
                            </label>
                            <select name="status" id="status" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewing" {{ request('status') == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                                <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                <option value="interviewed" {{ request('status') == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                                <option value="offered" {{ request('status') == 'offered' ? 'selected' : '' }}>Offered</option>
                                <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        @if($applications->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg border border-gray-200 p-12 flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-6">
                    <svg class="h-10 w-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No Applications Found</h3>
                <p class="text-gray-500 mb-6 max-w-md">No applications have been submitted for your job positions yet, or they do not match your filter criteria.</p>
                <a href="{{ route('recruiter.job-positions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Job Positions
                </a>
            </div>
        @else
            <!-- Applications Table -->
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm">
                <div class="min-w-full divide-y divide-gray-200">
                    <div class="bg-gray-50">
                        <div class="grid grid-cols-12 divide-x divide-gray-200">
                            <div class="px-6 py-3 col-span-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</div>
                            <div class="px-6 py-3 col-span-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</div>
                            <div class="px-6 py-3 col-span-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</div>
                            <div class="px-6 py-3 col-span-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</div>
                            <div class="px-6 py-3 col-span-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match Score</div>
                            <div class="px-6 py-3 col-span-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</div>
                        </div>
                    </div>
                    <div class="bg-white divide-y divide-gray-200">
                            @foreach($applications as $application)
                            <div class="grid grid-cols-12 divide-x divide-gray-200 hover:bg-gray-50">
                                <div class="px-6 py-4 col-span-3 flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full bg-gray-200 object-cover" src="{{ $application->user->profile_photo_url }}" alt="{{ $application->user->name }}">
                                            </div>
                                            <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $application->user->name }}</div>
                                        <div class="text-sm text-gray-500 truncate">{{ $application->user->email }}</div>
                                    </div>
                                </div>
                                <div class="px-6 py-4 col-span-2 flex flex-col justify-center">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ $application->jobPosition->title }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $application->jobPosition->job_type }}</div>
                                </div>
                                <div class="px-6 py-4 col-span-1 flex flex-col justify-center">
                                    <div class="text-sm text-gray-500">{{ $application->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="px-6 py-4 col-span-2 flex flex-col justify-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($application->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($application->status == 'reviewing') bg-blue-100 text-blue-800
                                        @elseif($application->status == 'shortlisted') bg-indigo-100 text-indigo-800
                                        @elseif($application->status == 'interviewed') bg-purple-100 text-purple-800
                                        @elseif($application->status == 'offered') bg-pink-100 text-pink-800
                                        @elseif($application->status == 'hired') bg-green-100 text-green-800
                                        @elseif($application->status == 'rejected') bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                                <div class="px-6 py-4 col-span-2 flex flex-col justify-center">
                                    <div class="flex items-center">
                                        <div class="relative w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="absolute top-0 left-0 h-full bg-green-500 rounded-full" style="width: {{ $application->match_score }}%;"></div>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-700 font-medium">{{ $application->match_score }}%</span>
                                    </div>
                                </div>
                                <div class="px-6 py-4 col-span-2 text-right flex justify-end items-center">
                                    <a href="{{ route('recruiter.applications.show', $application) }}" class="text-green-600 hover:text-green-800 mr-3">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" style="display: none;">
                                            <div class="py-1">
                                                <a href="{{ route('recruiter.applications.show', $application) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                    <svg class="mr-3 h-5 w-5 text-green-500 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View Details
                                                </a>
                                                <form action="{{ route('recruiter.applications.update-status', $application) }}" method="POST" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="shortlisted">
                                                    <button type="submit" class="group flex items-center w-full text-left">
                                                        <svg class="mr-3 h-5 w-5 text-green-500 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Shortlist
                                                    </button>
                                                </form>
                                                <form action="{{ route('recruiter.applications.update-status', $application) }}" method="POST" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="group flex items-center w-full text-left">
                                                        <svg class="mr-3 h-5 w-5 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                                </div>
                                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush

@endsection 