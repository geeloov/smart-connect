@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Applications</h1>
                    <p class="mt-1 text-sm text-gray-500">Review and manage candidate applications</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center">
                <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
            <form action="{{ route('recruiter.applications.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           placeholder="Search applicants..." 
                           value="{{ request('search') }}" 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="flex gap-4">
                    <select name="job_position" 
                            class="px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">All Positions</option>
                        @foreach($jobPositions as $jobPosition)
                            <option value="{{ $jobPosition->id }}" {{ request('job_position') == $jobPosition->id ? 'selected' : '' }}>
                                {{ $jobPosition->title }}
                            </option>
                        @endforeach
                    </select>
                    <select name="status" 
                            class="px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewing" {{ request('status') == 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                        <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                        <option value="interviewed" {{ request('status') == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                        <option value="offered" {{ request('status') == 'offered' ? 'selected' : '' }}>Offered</option>
                        <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        @if($applications->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Applications Found</h3>
                <p class="text-gray-500 mb-6">No applications match your current filter criteria.</p>
                <a href="{{ route('recruiter.job-positions.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700">
                    View Job Positions
                </a>
            </div>
        @else
            <!-- Applications Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                @foreach($applications as $application)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 flex flex-col justify-between max-w-xl min-w-[350px] w-full mx-auto">
                        <div class="flex items-center justify-between gap-4">
                            <!-- Left: Profile Initial -->
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="h-12 w-12 rounded-full flex items-center justify-center text-lg font-bold text-white" style="background: #22d3ee;">
                                    {{ strtoupper(substr($application->user->name, 0, 1)) }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-base font-semibold text-gray-900 truncate">{{ $application->user->name }}</span>
                                    <span class="text-xs text-gray-500 truncate">{{ $application->user->email }}</span>
                                    <span class="flex items-center text-gray-700 text-sm mt-1">
                                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="truncate">{{ $application->jobPosition->title }}</span>
                                    </span>
                                    <span class="flex items-center text-gray-500 text-xs mt-1">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>Applied {{ $application->created_at->format('M d, Y') }}</span>
                                    </span>
                                </div>
                            </div>
                            <!-- Right: Status and Flags -->
                            <div class="flex flex-col items-end gap-2 min-w-fit">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
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
                                @if(isset($application->is_referred) && $application->is_referred)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 mt-1">Referral</span>
                                @endif
                                @if(isset($application->is_top_pick) && $application->is_top_pick)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 mt-1">Top Pick</span>
                                @endif
                            </div>
                        </div>
                        <!-- Bottom: Actions -->
                        <div class="flex justify-end pt-4 border-t border-gray-100 mt-2">
                            <a href="{{ route('recruiter.applications.show', $application) }}" class="flex items-center gap-1 px-4 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 