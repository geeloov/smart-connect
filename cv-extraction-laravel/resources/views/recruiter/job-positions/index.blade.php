@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Job Positions</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage your job listings</p>
                </div>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Position
                </a>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
            <form action="{{ route('recruiter.job-positions.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           placeholder="Search jobs..." 
                           value="{{ request('search') }}" 
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="flex gap-4">
                    <select name="job_type" 
                            class="px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">All Types</option>
                        <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Freelance" {{ request('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    <select name="status" 
                            class="px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        @if($jobPositions->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Job Positions Yet</h3>
                <p class="text-gray-500 mb-6">Create your first job position to start receiving applications.</p>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700">
                    Create Job Position
                </a>
            </div>
        @else
            <!-- Job Positions Grid -->
            <div class="flex flex-wrap gap-8">
                @foreach($jobPositions as $jobPosition)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 flex flex-col gap-4 hover:shadow-xl transition-shadow w-96 m-0 overflow-hidden">
                        <!-- Top: Title, Company, Status -->
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex flex-col min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 truncate max-w-xs">{{ $jobPosition->title }}</h3>
                                <span class="text-xs text-gray-500 mt-1 truncate">{{ $jobPosition->company_name }}</span>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                                {{ $jobPosition->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <!-- Meta Info -->
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $jobPosition->location }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $jobPosition->job_type }}</span>
                            </div>
                        </div>
                        <!-- Applications & Actions -->
                        <div class="flex flex-col gap-2 pt-4 border-t border-gray-100 mt-2">
                            <div class="flex items-center gap-1 text-sm text-gray-500" title="Applications">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $jobPosition->applications->count() }} Applications</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('recruiter.job-positions.edit', $jobPosition) }}" 
                                   class="flex items-center gap-1 px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 text-xs font-medium transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('recruiter.job-positions.toggle-active', $jobPosition) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="flex items-center gap-1 px-3 py-2 bg-yellow-50 text-yellow-700 rounded-lg hover:bg-yellow-100 text-xs font-medium transition-colors" title="{{ $jobPosition->is_active ? 'Archive' : 'Activate' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                        {{ $jobPosition->is_active ? 'Archive' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('recruiter.job-positions.destroy', $jobPosition) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job position?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 px-3 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 text-xs font-medium transition-colors" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-8">
                {{ $jobPositions->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 