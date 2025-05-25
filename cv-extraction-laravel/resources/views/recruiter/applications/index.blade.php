@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Updated Header Section -->
        <div class="relative mb-8">
            <div class="relative z-10 p-6 sm:p-8 md:p-10 lg:p-12 bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
                <!-- Header Background Pattern -->
                <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                    <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#B9FF66]/20">
                        <circle cx="150" cy="150" r="150" fill="currentColor"/>
                        <circle cx="150" cy="150" r="120" fill="white"/>
                        <circle cx="150" cy="150" r="100" fill="currentColor"/>
                        <circle cx="150" cy="150" r="80" fill="white"/>
                        <circle cx="150" cy="150" r="60" fill="currentColor"/>
                    </svg>
                </div>

                <div class="relative z-20 flex flex-col md:flex-row md:items-start gap-8">
                    <div class="flex-shrink-0">
                        <!-- Updated Icon for Applications -->
                        <div class="p-4 bg-[#B9FF66] rounded-2xl w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /> 
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <!-- No button on the right for this header -->
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Applications</h1>
                            <p class="mt-2 text-lg text-[#191A23]/80">Review and manage candidate applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 bg-[#B9FF66]/20 border-2 border-[#B9FF66]/60 rounded-2xl p-5 flex items-center" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                <svg class="h-6 w-6 text-[#191A23] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="ml-4 text-base text-[#191A23]">{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="ml-auto text-[#191A23]/70 hover:text-[#191A23]">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-2xl p-6 mb-8 border border-[#191A23]" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <form action="{{ route('recruiter.applications.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="flex-1 w-full sm:w-auto">
                    <input type="text" 
                           name="search" 
                           placeholder="Search by applicant name or email..." 
                           value="{{ request('search') }}" 
                           class="w-full px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base">
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <select name="job_position" 
                            class="w-full sm:min-w-[180px] px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base">
                        <option value="">All Positions</option>
                        @foreach($jobPositions as $jobPosition)
                            <option value="{{ $jobPosition->id }}" {{ request('job_position') == $jobPosition->id ? 'selected' : '' }}>
                                {{ $jobPosition->title }}
                            </option>
                        @endforeach
                    </select>
                    <select name="status" 
                            class="w-full sm:min-w-[180px] px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base">
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
                            class="w-full sm:w-auto px-8 py-3 bg-[#191A23] text-[#FFFFFF] rounded-xl border-2 border-[#191A23] hover:bg-[#33343E] transition-all duration-200 text-base font-medium transform hover:-translate-y-0.5 min-w-[120px]" style="box-shadow: 0px 4px 0px 0 #B9FF66;">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        @if($applications->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-12 text-center border border-[#191A23]" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="w-20 h-20 bg-[#191A23]/5 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="h-10 w-10 text-[#191A23]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#191A23] mb-3">No Applications Found</h3>
                <p class="text-base text-[#191A23]/70 mb-8">No applications match your current filter criteria, or no applications have been submitted yet.</p>
                <a href="{{ route('recruiter.job-positions.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    View Job Positions
                </a>
            </div>
        @else
            <!-- Applications Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($applications as $application)
                    <div class="bg-white rounded-2xl overflow-hidden border border-[#191A23] transition-all duration-200" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <!-- Left: Profile Initial & Info -->
                                <div class="flex items-start gap-4 min-w-0">
                                    <div class="h-12 w-12 rounded-lg flex items-center justify-center text-lg font-semibold text-[#191A23] bg-[#B9FF66] border border-[#191A23]/50 flex-shrink-0" style="box-shadow: 0px 2px 0px 0 #191a23;">
                                        {{ strtoupper(substr($application->user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="text-lg font-semibold text-[#191A23] truncate">{{ $application->user->name }}</span>
                                        <span class="text-sm text-[#191A23]/70 truncate">{{ $application->user->email }}</span>
                                        <span class="flex items-center text-sm text-[#191A23]/80 mt-2">
                                            <svg class="h-4 w-4 mr-1.5 text-[#191A23]/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="truncate">{{ $application->jobPosition->title }}</span>
                                        </span>
                                        <span class="flex items-center text-sm text-[#191A23]/80 mt-1">
                                            <svg class="h-4 w-4 mr-1.5 text-[#191A23]/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>Applied {{ $application->created_at->format('M d, Y') }}</span>
                                        </span>
                                    </div>
                                </div>
                                <!-- Right: Status and Flags -->
                                <div class="flex flex-col items-end gap-2 min-w-fit flex-shrink-0">
                                    @php
                                        $statusBase = 'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border whitespace-nowrap';
                                        $statusColors = [
                                            'pending'     => 'bg-yellow-500/20 text-yellow-700 border-yellow-700/50',
                                            'reviewing'   => 'bg-blue-500/20 text-blue-700 border-blue-700/50',
                                            'shortlisted' => 'bg-[#B9FF66]/30 text-[#191A23] border-[#191A23]/50 style="box-shadow: 0px 1px 0px 0 #191a23;"',
                                            'interviewed' => 'bg-purple-500/20 text-purple-700 border-purple-700/50',
                                            'offered'     => 'bg-pink-500/20 text-pink-700 border-pink-700/50',
                                            'hired'       => 'bg-teal-500/20 text-teal-700 border-teal-700/50 style="box-shadow: 0px 1px 0px 0 #191a23;"',
                                            'rejected'    => 'bg-red-500/20 text-red-700 border-red-700/50',
                                        ];
                                        $currentStatusClass = $statusColors[$application->status] ?? 'bg-gray-500/20 text-gray-700 border-gray-700/50';
                                    @endphp
                                    <span class="{{ $statusBase }} {{ $currentStatusClass }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                    
                                    @if(isset($application->is_referred) && $application->is_referred)
                                        <span class="px-2 py-0.5 rounded-md text-xs font-medium border bg-sky-500/20 text-sky-700 border-sky-700/50">Referral</span>
                                    @endif
                                    @if(isset($application->is_top_pick) && $application->is_top_pick)
                                        <span class="px-2 py-0.5 rounded-md text-xs font-medium border bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/40">Top Pick</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Bottom: Actions -->
                        <div class="flex border-t border-[#191A23]/20">
                            <a href="{{ route('recruiter.applications.show', $application) }}" 
                               class="flex-1 flex items-center justify-center gap-2 py-3 px-3 text-sm font-medium text-[#191A23]/80 hover:text-[#191A23] hover:bg-[#191A23]/10 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Application
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