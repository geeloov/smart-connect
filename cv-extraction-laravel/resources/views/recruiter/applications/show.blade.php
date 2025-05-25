@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div>
    <!-- Back Navigation -->
    <div class="mb-8">
        <a href="{{ route('recruiter.applications.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-white text-sm font-medium rounded-xl text-[#191A23]/80 hover:text-[#191A23] border border-[#191A23]/50 hover:border-[#191A23] transition-all duration-200 transform hover:-translate-y-px" 
           style="box-shadow: 0px 2px 0px 0 #191a23;">
            <svg class="w-4 h-4 mr-1.5 text-[#191A23]/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Applications
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="mb-8 bg-[#B9FF66]/20 border-2 border-[#B9FF66]/60 rounded-2xl p-5 flex items-center" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
        <svg class="h-6 w-6 text-[#191A23] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="ml-4 text-base text-[#191A23] flex-1">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="ml-auto text-[#191A23]/70 hover:text-[#191A23] p-1 rounded-md hover:bg-[#191A23]/10">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif
    @if(session('error'))
    <div class="mb-8 bg-red-500/10 border-2 border-red-500/50 rounded-2xl p-5 flex items-center" style="box-shadow: 0px 3px 0px 0 #ef4444;">
        <svg class="h-6 w-6 text-red-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="ml-4 text-base text-red-700 flex-1">{{ session('error') }}</p>
        <button onclick="this.parentElement.remove()" class="ml-auto text-red-700/70 hover:text-red-700 p-1 rounded-md hover:bg-red-500/10">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Header Card -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 bg-white rounded-2xl border border-[#191A23] p-6" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 mb-2">
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23] truncate">{{ $jobApplication->jobPosition->title }}</h1>
                    <span class="inline-flex items-center mt-1 sm:mt-0 px-3 py-1 rounded-lg text-sm font-medium bg-[#191A23]/10 text-[#191A23] border border-[#191A23]/20 whitespace-nowrap" style="box-shadow: 0px 1px 0px 0 #191a23;">{{ $jobApplication->jobPosition->company_name ?? 'Your Company' }}</span>
                </div>
                <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-[#191A23]/70 mb-3">
                    <span>{{ $jobApplication->jobPosition->location ?? 'Remote' }}</span>
                    <span class="text-[#191A23]/40">•</span>
                    <span>Applied {{ $jobApplication->created_at->format('M d, Y') }} ({{ $jobApplication->created_at->diffForHumans() }})</span>
                </div>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    @php
                        $statusBase = 'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border';
                        // Using the same status colors as defined on the index page for consistency
                        $statusColors = [
                            'pending'     => 'bg-yellow-500/20 text-yellow-700 border-yellow-700/50',
                            'in_review'   => 'bg-blue-500/20 text-blue-700 border-blue-700/50', // Assuming 'in_review' is a valid status like 'reviewing'
                            'shortlisted' => 'bg-[#B9FF66]/30 text-[#191A23] border-[#191A23]/50 style="box-shadow: 0px 1px 0px 0 #191a23;"',
                            'interviewed' => 'bg-purple-500/20 text-purple-700 border-purple-700/50',
                            'offered'     => 'bg-pink-500/20 text-pink-700 border-pink-700/50',
                            'hired'       => 'bg-teal-500/20 text-teal-700 border-teal-700/50 style="box-shadow: 0px 1px 0px 0 #191a23;"',
                            'rejected'    => 'bg-red-500/20 text-red-700 border-red-700/50',
                            'accepted'    => 'bg-green-500/20 text-green-700 border-green-700/50 style="box-shadow: 0px 1px 0px 0 #191a23;"', // Added for 'accepted' if different from hired
                        ];
                        $currentStatus = $jobApplication->status;
                        // Handle cases like 'in_review' if the key in $statusColors is 'reviewing'
                        if ($currentStatus === 'in_review' && !isset($statusColors['in_review']) && isset($statusColors['reviewing'])) {
                            $currentStatus = 'reviewing';
                        }
                        $currentStatusClass = $statusColors[$currentStatus] ?? 'bg-gray-500/20 text-gray-700 border-gray-700/50';
                    @endphp
                    <span class="{{ $statusBase }} {{ $currentStatusClass }}">
                        {{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}
                    </span>
                    @if($jobApplication->compatibility_score)
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/50" style="box-shadow: 0px 1px 0px 0 #191a23;">
                        Match: {{ $jobApplication->compatibility_score }}%
                    </span>
                    @endif
                </div>
            </div>
            <div class="flex flex-col gap-3 mt-4 md:mt-0 md:min-w-[220px]">
                <a href="{{ route('recruiter.job-positions.show', $jobApplication->jobPosition) }}" 
                    class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-[#191A23] text-white rounded-xl border-2 border-[#191A23] hover:bg-[#33343E] transition-all duration-200 text-sm font-medium transform hover:-translate-y-px" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                    <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    View Job Position
                </a>
                @if($jobApplication->cv_filename)
                <a href="{{ asset('storage/cvs/' . $jobApplication->cv_filename) }}" target="_blank" 
                    class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-[#B9FF66] text-[#191A23] rounded-xl border-2 border-[#191A23] hover:bg-[#a7e85c] transition-all duration-200 text-sm font-medium transform hover:-translate-y-px" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg class="h-4 w-4 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    View Original CV
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Candidate Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-14 w-14 rounded-xl flex items-center justify-center text-2xl font-bold text-[#191A23] bg-[#B9FF66] border border-[#191A23]/50 flex-shrink-0" style="box-shadow: 0px 3px 0px 0 #191a23;">
                        {{ strtoupper(substr($jobApplication->jobSeeker->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-[#191A23]">{{ $jobApplication->jobSeeker->name }}</h2>
                        <p class="text-sm text-[#191A23]/70">{{ $jobApplication->jobSeeker->email }}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-[#191A23]/70 mb-6">
                    <span>Applied: {{ $jobApplication->created_at->format('M d, Y') }}</span>
                    <span>Status: <span class="font-semibold text-[#191A23]">{{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}</span></span>
                </div>
                
                @if($jobApplication->cover_letter)
                <div class="bg-[#191A23]/5 rounded-xl border border-[#191A23]/10 p-5">
                    <h3 class="text-lg font-semibold text-[#191A23] mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#191A23]/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Cover Letter
                    </h3>
                    <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                        {!! nl2br(e($jobApplication->cover_letter)) !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Application Status Update -->
            <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST" class="bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
                @csrf
                @method('PATCH')
                <h3 class="text-lg font-semibold text-[#191A23] mb-6 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-[#191A23]/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Update Application Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-medium text-[#191A23]/80 mb-1">Status</label>
                        <select id="status" name="status" 
                            class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base">
                            <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_review" {{ $jobApplication->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                            <option value="shortlisted" {{ $jobApplication->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="interviewed" {{ $jobApplication->status == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                            <option value="offered" {{ $jobApplication->status == 'offered' ? 'selected' : '' }}>Offered</option>
                            <option value="hired" {{ $jobApplication->status == 'hired' ? 'selected' : '' }}>Hired</option>
                            <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" 
                            class="w-full inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            Update Status
                        </button>
                    </div>
                </div>
                <div>
                    <label for="recruiter_notes" class="block text-sm font-medium text-[#191A23]/80 mb-1">Feedback to Candidate (Optional)</label>
                    <textarea id="recruiter_notes" name="recruiter_notes" rows="4"
                        class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base" 
                        placeholder="Add notes or feedback for the candidate...">{{ $jobApplication->recruiter_notes }}</textarea>
                </div>
            </form>

            <!-- Application Details Card -->
            <div class="bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <h3 class="text-lg font-semibold text-[#191A23] flex items-center mb-6">
                    <svg class="h-5 w-5 mr-2 text-[#191A23]/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Application Details
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-3 border-b border-[#191A23]/20">
                        <span class="text-sm font-medium text-[#191A23]/70">Application ID</span>
                        <span class="text-sm text-[#191A23] font-medium">#{{ $jobApplication->id }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#191A23]/20">
                        <span class="text-sm font-medium text-[#191A23]/70">Submitted</span>
                        <span class="text-sm text-[#191A23] font-medium">{{ $jobApplication->created_at->format('M d, Y, g:i a') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#191A23]/20">
                        <span class="text-sm font-medium text-[#191A23]/70">CV Filename</span>
                        <span class="text-sm text-[#191A23] font-medium max-w-[180px] truncate">{{ $jobApplication->cv_filename ?? 'N/A'}}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#191A23]/20">
                        <span class="text-sm font-medium text-[#191A23]/70">Position</span>
                        <span class="text-sm text-[#191A23] font-medium">{{ $jobApplication->jobPosition->title }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm font-medium text-[#191A23]/70">Company</span>
                        <span class="text-sm text-[#191A23] font-medium">{{ $jobApplication->jobPosition->company_name ?? 'Your Company' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compatibility Score Card -->
        @if($jobApplication->compatibility_score)
        <div class="md:col-span-1 h-full">
            <div class="bg-white rounded-2xl border border-[#191A23] p-6 flex flex-col items-center justify-center h-full" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="relative h-36 w-36 mb-4">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle class="text-[#191A23]/10" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10" />
                        <circle
                            class="{{ $jobApplication->compatibility_score >= 70 ? 'text-[#B9FF66]' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-400' : 'text-red-500') }}"
                            cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10"
                            stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283"
                            stroke-linecap="round"
                            style="filter: drop-shadow(0px 0px 5px currentColor ); transition: stroke-dasharray 0.5s ease-in-out;"
                        />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="{{ $jobApplication->compatibility_score >= 70 ? 'text-[#191A23]' : ($jobApplication->compatibility_score >= 40 ? 'text-yellow-600' : 'text-red-600') }} text-3xl font-bold">{{ $jobApplication->compatibility_score }}%</span>
                    </div>
                </div>
                <h4 class="font-semibold text-lg text-[#191A23] text-center">
                    {{ $jobApplication->compatibility_score >= 70 ? 'Strong Match' : ($jobApplication->compatibility_score >= 40 ? 'Good Potential' : 'Low Match') }}
                </h4>
                <p class="text-[#191A23]/70 text-sm mt-1 text-center">Based on skills, experience, and education requirements</p>
            </div>
        </div>
        @endif
    </div>

    <!-- CV Data Section (if available) -->
    @if(isset($cvData) && $cvData)
    <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23]">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                <div>
                    <h2 class="text-xl font-bold text-[#B9FF66] flex items-center">
                        <svg class="h-6 w-6 mr-2 text-[#B9FF66] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Candidate CV Information
                    </h2>
                    <p class="text-white/70 text-sm mt-1 sm:ml-8">Detailed extracted data from candidate's resume</p>
                </div>
                <span class="inline-flex items-center self-start sm:self-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23] whitespace-nowrap" style="box-shadow: 0px 1px 0px 0 #191a23;">
                    Resume Data
                </span>
            </div>
        </div>
        <div class="px-6 py-8">
            {{-- Personal Information --}}
            @if(isset($cvData['name']) || isset($cvData['email']) || isset($cvData['phone']) || isset($cvData['location']) || isset($cvData['address']) || isset($cvData['summary']) || isset($cvData['profile']))
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                        <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#191A23]">Personal Information</h3>
                </div>
                <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        @if(isset($cvData['name']))
                        <div>
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Full Name</span>
                            <p class="text-sm text-[#191A23]">{{ $cvData['name'] }}</p>
                        </div>
                        @endif
                        @if(isset($cvData['email']))
                        <div>
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Email Address</span>
                            <p class="text-sm text-[#191A23]">{{ $cvData['email'] }}</p>
                        </div>
                        @endif
                        @if(isset($cvData['phone']))
                        <div>
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Phone Number</span>
                            <p class="text-sm text-[#191A23]">{{ $cvData['phone'] }}</p>
                        </div>
                        @endif
                        @if(isset($cvData['location']))
                        <div>
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Location</span>
                            <p class="text-sm text-[#191A23]">{{ $cvData['location'] }}</p>
                        </div>
                        @endif
                        @if(isset($cvData['address']))
                        <div class="md:col-span-2">
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-0.5">Full Address</span>
                            <p class="text-sm text-[#191A23]">{{ $cvData['address'] }}</p>
                        </div>
                        @endif
                        @if(isset($cvData['summary']) || isset($cvData['profile']))
                        <div class="md:col-span-2">
                            <span class="text-sm font-medium text-[#191A23]/70 block mb-1">Summary / Profile</span>
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($cvData['summary'] ?? $cvData['profile'] ?? '')) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Work Experience --}}
            @if(isset($cvData['experience']) && is_array($cvData['experience']) && count($cvData['experience']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                        <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0010 15c-2.796 0-5.487-.46-8-1.308z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#191A23]">Work Experience</h3>
                </div>
                <div class="space-y-6">
                    @foreach($cvData['experience'] as $exp)
                    <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                        <h4 class="text-md font-semibold text-[#191A23]">{{ $exp['title'] ?? 'N/A' }}</h4>
                        <p class="text-sm text-[#191A23]/80">{{ $exp['company'] ?? 'N/A' }} | {{ $exp['location'] ?? 'N/A' }}</p>
                        <p class="text-xs text-[#191A23]/60 mb-2">{{ $exp['dates'] ?? ($exp['start_date'] ?? '' && ($exp['end_date'] ?? '') ? ' - ' : '') . ($exp['end_date'] ?? '') }}</p>
                        @if(isset($exp['description']))
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($exp['description'])) !!}
                            </div>
                        @endif
                        @if(isset($exp['responsibilities']) && is_array($exp['responsibilities']) && count($exp['responsibilities']) > 0)
                            <ul class="mt-2 list-disc list-inside space-y-1 marker:text-[#191A23]/50">
                                @foreach($exp['responsibilities'] as $responsibility)
                                    <li class="text-sm text-[#191A23]/80">{{ $responsibility }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Education --}}
            @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                        <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.056 0l4.252 1.693a1 1 0 00.882 0l4.252-1.693a.999.999 0 01.056 0l2.646-1.057a1 1 0 000-1.84l-7-3zM3.01 9.515L3 10a1 1 0 00.883.993L4 11h12a1 1 0 00.993-.883L17 10a1 1 0 00-.883-.993L16.01 9H3.99zM5 13h10v1h-2v2h-1v-2H8v2H7v-2H5v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#191A23]">Education</h3>
                </div>
                <div class="space-y-6">
                    @foreach($cvData['education'] as $edu)
                    <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                        <h4 class="text-md font-semibold text-[#191A23]">{{ $edu['degree'] ?? ($edu['study_program'] ?? 'N/A') }}</h4>
                        <p class="text-sm text-[#191A23]/80">{{ $edu['institution'] ?? ($edu['school'] ?? 'N/A') }} | {{ $edu['location'] ?? 'N/A' }}</p>
                        <p class="text-xs text-[#191A23]/60 mb-2">{{ $edu['dates'] ?? ($edu['start_date'] ?? '' && ($edu['start_date'] ?? '') && ($edu['end_date'] ?? '') ? ' - ' : '') . ($edu['end_date'] ?? '') }}</p>
                        @if(isset($edu['description']))
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($edu['description'])) !!}
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Skills --}}
            @if(isset($cvData['skills']) && (is_array($cvData['skills']) && count($cvData['skills']) > 0) || is_string($cvData['skills']))
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                        <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v1.993l4.753 4.753a1 1 0 01-1.414 1.414L13 7.828V12a1 1 0 11-2 0V7.828l-2.339 2.34a1 1 0 01-1.414-1.414L11.007 4V2a1 1 0 01.293-.707zM6 8a2 2 0 100-4 2 2 0 000 4zm0 6a2 2 0 100-4 2 2 0 000 4zm10-6a2 2 0 100-4 2 2 0 000 4zM7 14a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm5-5a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm5 5a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#191A23]">Skills</h3>
                </div>
                <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                    @if(is_array($cvData['skills']))
                    <div class="flex flex-wrap gap-2">
                        @foreach($cvData['skills'] as $skill)
                            <span class="px-3 py-1.5 rounded-lg text-sm font-medium bg-[#191A23]/10 text-[#191A23] border border-[#191A23]/20">{{ $skill }}</span>
                        @endforeach
                    </div>
                    @elseif(is_string($cvData['skills']))
                        <p class="text-sm text-[#191A23]">{{ $cvData['skills'] }}</p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Other Sections: Projects, Certifications, Languages, References will follow similar structure --}}
            {{-- Projects --}}
            @if(isset($cvData['projects']) && is_array($cvData['projects']) && count($cvData['projects']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="p-2.5 bg-[#191A23]/10 rounded-xl mr-3 flex-shrink-0">
                        <svg class="h-5 w-5 text-[#191A23]/70" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#191A23]">Projects</h3>
                </div>
                <div class="space-y-6">
                    @foreach($cvData['projects'] as $project)
                    <div class="bg-white rounded-xl p-5 border border-[#191A23]/20">
                        <h4 class="text-md font-semibold text-[#191A23]">{{ $project['name'] ?? ($project['title'] ?? 'N/A') }}</h4>
                        @if(isset($project['dates'])) <p class="text-xs text-[#191A23]/60 mb-2">{{ $project['dates'] }}</p> @endif
                        @if(isset($project['description']))
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($project['description'])) !!}
                            </div>
                        @endif
                        @if(isset($project['link']) || isset($project['url']))
                            <a href="{{ $project['link'] ?? $project['url'] }}" target="_blank" class="mt-2 inline-flex items-center text-sm text-[#B9FF66] hover:text-[#a1e048] font-semibold">
                                View Project 
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add similar blocks for Certifications, Languages, References etc. --}}
            {{-- adapting icons and field names as necessary --}}
        </div>
    </div>
    @endif
</div>
@endsection 