@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<!-- Header Section -->
<div class="relative mb-6">
    {{-- <div class="absolute inset-0 bg-[#B9FF66]/10 rounded-2xl"></div> --}}
    <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
        <!-- Header Background Pattern -->
        <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#B9FF66]/10">
                <circle cx="150" cy="150" r="150" fill="currentColor"/>
                <circle cx="150" cy="150" r="120" fill="white"/>
                <circle cx="150" cy="150" r="100" fill="currentColor"/>
                <circle cx="150" cy="150" r="80" fill="white"/>
                <circle cx="150" cy="150" r="60" fill="currentColor"/>
            </svg>
        </div>

        <div class="flex flex-col md:flex-row md:items-start gap-8">
            <div class="flex-shrink-0">
                <div class="p-4 bg-[#B9FF66] rounded-2xl shadow-sm w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                            Job Search
                        </span>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Available Positions</h1>
                        <p class="mt-2 text-lg text-[#191A23]/80">Find the perfect job match for your skills and experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Panel -->
<div class="mb-8 bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
    <div class="border-b border-[#191A23]/30 px-6 py-4">
        <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search Jobs
        </h2>
    </div>
    
    <div class="p-6">
        <form action="{{ route('job-seeker.jobs.available') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="keyword" class="block text-sm font-medium text-[#191A23]/90 mb-1">Keywords</label>
                <div class="mt-1 relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#191A23]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </div>
                    <input type="text" name="keyword" id="keyword" class="focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full pl-10 pr-3 py-2 sm:text-sm border border-[#191A23]/50 rounded-xl bg-white text-[#191A23] placeholder-[#191A23]/60" placeholder="Job title, skills, or keywords" value="{{ request('keyword') }}">
                </div>
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-[#191A23]/90 mb-1">Location</label>
                <div class="mt-1 relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#191A23]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <input type="text" name="location" id="location" class="focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full pl-10 pr-3 py-2 sm:text-sm border border-[#191A23]/50 rounded-xl bg-white text-[#191A23] placeholder-[#191A23]/60" placeholder="City, state, or remote" value="{{ request('location') }}">
                </div>
            </div>
            
            <div>
                <label for="job_type" class="block text-sm font-medium text-[#191A23]/90 mb-1">Job Type</label>
                <select id="job_type" name="job_type" class="focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full py-2 px-3 sm:text-sm border border-[#191A23]/50 rounded-xl bg-white text-[#191A23]">
                    <option value="">All Job Types</option>
                    <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    <option value="Temporary" {{ request('job_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                    <option value="Remote" {{ request('job_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                </select>
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-2.5 border-2 border-[#191A23] text-sm font-medium rounded-xl shadow-sm text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search Jobs
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Job Listings -->
@if(count($jobPositions) > 0)
<div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
    <div class="border-b border-[#191A23]/30 px-6 py-4 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Job Opportunities
        </h2>
        <span class="text-sm font-medium text-[#191A23] rounded-lg bg-[#B9FF66]/20 px-3 py-1 border border-[#191A23]/30">
            {{ $jobPositions->total() }} {{ Str::plural('job', $jobPositions->total()) }} found
        </span>
    </div>
    
    <div class="divide-y divide-[#191A23]/20">
        @foreach($jobPositions as $jobPosition)
            <div class="p-6 hover:bg-[#B9FF66]/10 transition-colors">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="font-medium text-lg text-[#191A23]">
                            <a href="{{ route('job-seeker.jobs.details', $jobPosition) }}" class="hover:text-[#B9FF66] transition-colors">
                                {{ $jobPosition->title }}
                            </a>
                        </h3>
                        <div class="flex items-center text-[#191A23]/80 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>{{ $jobPosition->company_name }}</span>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mt-3">
                            <div class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $jobPosition->location }}
                            </div>
                            
                            <div class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $jobPosition->job_type }}
                            </div>
                            
                            @if($jobPosition->salary_range)
                            <div class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#B9FF66]/20 text-[#191A23] border border-[#191A23]/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $jobPosition->salary_range }}
                            </div>
                            @endif
                        </div>
                        
                        <p class="mt-3 text-sm text-[#191A23]/80 line-clamp-2">{{ $jobPosition->description }}</p>
                    </div>
                    
                    <div class="flex flex-col items-stretch md:items-end gap-2 mt-4 md:mt-0">
                        <span class="text-xs text-[#191A23]/70 flex items-center md:justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Posted {{ $jobPosition->created_at->diffForHumans() }}
                        </span>
                        <a href="{{ route('job-seeker.jobs.details', $jobPosition) }}" class="inline-flex items-center justify-center px-4 py-2 border border-[#191A23] rounded-lg text-sm font-medium text-[#191A23] bg-transparent hover:bg-[#B9FF66] hover:border-[#B9FF66] transition-all duration-200">
                            View Details
                        </a>
                        <a href="{{ route('job-seeker.applications.create', $jobPosition) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-[#191A23] rounded-lg text-sm font-medium text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="border-t border-[#191A23]/30 px-6 py-4">
        <div class="pagination-wrapper">
            @if ($jobPositions->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        @if ($jobPositions->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#191A23]/50 bg-white border border-[#191A23]/50 cursor-default rounded-lg">
                                Previous
                            </span>
                        @else
                            <a href="{{ $jobPositions->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-[#191A23] bg-white border border-[#191A23]/50 rounded-lg hover:bg-[#B9FF66]/20 hover:border-[#191A23]/70 focus:outline-none focus:ring ring-[#B9FF66]/30 active:bg-[#B9FF66]/30 transition-all duration-200">
                                Previous
                            </a>
                        @endif

                        @if ($jobPositions->hasMorePages())
                            <a href="{{ $jobPositions->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-[#191A23] bg-white border border-[#191A23]/50 rounded-lg hover:bg-[#B9FF66]/20 hover:border-[#191A23]/70 focus:outline-none focus:ring ring-[#B9FF66]/30 active:bg-[#B9FF66]/30 transition-all duration-200">
                                Next
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-[#191A23]/50 bg-white border border-[#191A23]/50 cursor-default rounded-lg">
                                Next
                            </span>
                        @endif
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-[#191A23]/70 leading-5">
                                Showing
                                <span class="font-medium text-[#191A23]">{{ $jobPositions->firstItem() }}</span>
                                to
                                <span class="font-medium text-[#191A23]">{{ $jobPositions->lastItem() }}</span>
                                of
                                <span class="font-medium text-[#191A23]">{{ $jobPositions->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-lg">
                                {{-- Previous Page Link --}}
                                @if ($jobPositions->onFirstPage())
                                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                        <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#191A23]/50 bg-white border border-[#191A23]/50 cursor-default rounded-l-lg" aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $jobPositions->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-[#191A23] bg-white border border-[#191A23]/50 rounded-l-lg hover:bg-[#B9FF66]/20 hover:border-[#191A23]/70 focus:z-10 focus:outline-none focus:ring ring-[#B9FF66]/30 active:bg-[#B9FF66]/30 transition-all duration-200" aria-label="{{ __('pagination.previous') }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($jobPositions->getUrlRange(1, $jobPositions->lastPage()) as $page => $url)
                                    @if ($page == $jobPositions->currentPage())
                                        <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#191A23] bg-[#B9FF66] border border-[#191A23] cursor-default">{{ $page }}</span>
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-[#191A23] bg-white border border-[#191A23]/50 hover:bg-[#B9FF66]/20 hover:border-[#191A23]/70 focus:z-10 focus:outline-none focus:ring ring-[#B9FF66]/30 active:bg-[#B9FF66]/30 transition-all duration-200">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($jobPositions->hasMorePages())
                                    <a href="{{ $jobPositions->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-[#191A23] bg-white border border-[#191A23]/50 rounded-r-lg hover:bg-[#B9FF66]/20 hover:border-[#191A23]/70 focus:z-10 focus:outline-none focus:ring ring-[#B9FF66]/30 active:bg-[#B9FF66]/30 transition-all duration-200" aria-label="{{ __('pagination.next') }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-[#191A23]/50 bg-white border border-[#191A23]/50 cursor-default rounded-r-lg" aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </nav>
            @endif
        </div>
    </div>
</div>
@else
<!-- No Job Listings Found -->
<div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden p-8 text-center" style="box-shadow: 0px 5px 0px 0 #191a23;">
    <div class="inline-block p-4 rounded-full bg-[#191A23]/10 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 10.5a.5.5 0 11-1 0 .5.5 0 011 0zM14 10.5a.5.5 0 11-1 0 .5.5 0 011 0zM7 14a.5.5 0 100-1 .5.5 0 000 1zM17 14a.5.5 0 100-1 .5.5 0 000 1z" />
        </svg>
    </div>
    <h3 class="text-xl font-semibold text-[#191A23] mb-2">No Jobs Found</h3>
    <p class="text-[#191A23]/70 mb-6">Sorry, there are no jobs matching your current criteria. Try adjusting your search filters or check back later.</p>
    <a href="{{ route('job-seeker.jobs.available') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
        Clear Filters & View All Jobs
    </a>
</div>
@endif

@endsection 