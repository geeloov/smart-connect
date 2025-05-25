@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="relative">
        <div class="relative z-10 p-6 sm:p-8 md:p-10 bg-white rounded-2xl border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
            <div class="absolute top-0 right-0 -mt-12 -mr-12 hidden lg:block">
                <svg width="240" height="240" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[#B9FF66]/20">
                    <circle cx="150" cy="150" r="150" fill="currentColor"/>
                    <circle cx="150" cy="150" r="120" fill="white"/>
                    <circle cx="150" cy="150" r="100" fill="currentColor"/>
                    <circle cx="150" cy="150" r="80" fill="white"/>
                    <circle cx="150" cy="150" r="60" fill="currentColor"/>
                </svg>
            </div>
            <div class="relative z-20 flex flex-col md:flex-row md:items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="p-3 bg-[#B9FF66] rounded-xl w-16 h-16 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23] mb-2" style="box-shadow: 0px 2px 0px 0 #191a23;">
                        Application Detail
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">{{ $jobApplication->jobPosition->title }}</h1>
                    <p class="mt-2 text-md text-[#191A23]/80">
                        <span class="font-medium">Company:</span> {{ $jobApplication->jobPosition->company_name }} 
                        <span class="text-[#191A23]/50 mx-1">•</span> 
                        <span class="font-medium">Location:</span> {{ $jobApplication->jobPosition->location }}
                    </p>
                    <p class="mt-1 text-md text-[#191A23]/80">
                        <span class="font-medium">Status:</span> 
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $jobApplication->getStatusBadgeClass() }}">
                            {{ $jobApplication->getFormattedStatus() }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="p-4 bg-[#B9FF66]/30 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="ml-3 text-sm font-medium text-[#191A23]">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="p-4 bg-[#FF4D4D]/20 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-[#FF4D4D]" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <p class="ml-3 text-sm font-medium text-[#FF4D4D]">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Main Application Info Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column / Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Application & Company Details Card -->
            <div class="bg-white rounded-2xl shadow-sm border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="px-6 py-4 border-b-2 border-[#191A23]/30 bg-[#191A23]">
                    <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Application Overview
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-md font-semibold text-[#191A23] mb-2">Application Details</h3>
                            <div class="space-y-2 text-sm">
                                <p><strong class="text-[#191A23]/80">Applied on:</strong> {{ $jobApplication->created_at->format('F j, Y') }}</p>
                                <p><strong class="text-[#191A23]/80">CV Used:</strong> <span class="truncate">{{ $jobApplication->cv_filename ?: 'N/A' }}</span></p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-md font-semibold text-[#191A23] mb-2">Company & Role</h3>
                            <div class="space-y-2 text-sm">
                                <p><strong class="text-[#191A23]/80">Position:</strong> {{ $jobApplication->jobPosition->title }}</p>
                                <p><strong class="text-[#191A23]/80">Company:</strong> {{ $jobApplication->jobPosition->company_name }}</p>
                                <p><strong class="text-[#191A23]/80">Location:</strong> {{ $jobApplication->jobPosition->location }}</p>
                            </div>
                        </div>
                    </div>
                    @if($jobApplication->compatibility_score)
                    <div class="pt-6 border-t-2 border-[#191A23]/10">
                        <h3 class="text-md font-semibold text-[#191A23] mb-3">Compatibility Score</h3>
                        <div class="flex items-center gap-3 bg-[#B9FF66]/20 rounded-xl p-4 border border-[#191A23]/30">
                            <div class="relative h-20 w-20">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <circle class="text-[#191A23]/20" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10" />
                                    <circle class="text-[#B9FF66]" cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="10" stroke-dasharray="{{ $jobApplication->compatibility_score * 2.83 }} 283" stroke-linecap="round" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-[#191A23]">{{ $jobApplication->compatibility_score }}%</span>
                                </div>
                            </div>
                            <p class="text-sm text-[#191A23]/90">This score indicates how well your CV matches the job requirements based on our analysis.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @if($jobApplication->cover_letter)
            <div class="bg-white rounded-2xl shadow-sm border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="px-6 py-4 border-b-2 border-[#191A23]/30 bg-[#191A23]">
                    <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Cover Letter
                    </h2>
                </div>
                <div class="p-6 prose prose-sm max-w-none text-[#191A23]">
                    {{ $jobApplication->cover_letter }}
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="px-6 py-4 border-b-2 border-[#191A23]/30 bg-[#191A23]">
                    <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Job Description
                    </h2>
                </div>
                <div class="p-6 prose prose-sm max-w-none text-[#191A23]">
                    {!! nl2br(e($jobApplication->jobPosition->description)) !!}
                </div>
            </div>
        </div>

        <!-- Right Column / Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            @if($jobApplication->recruiter_notes)
            <div class="bg-white rounded-2xl shadow-sm border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="px-6 py-4 border-b-2 border-[#191A23]/30 bg-[#191A23]">
                    <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        Recruiter Feedback
                    </h2>
                </div>
                <div class="p-6 text-sm text-[#191A23]/90 bg-[#B9FF66]/10">
                    {{ $jobApplication->recruiter_notes }}
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border-2 border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="px-6 py-4 border-b-2 border-[#191A23]/30 bg-[#191A23]">
                    <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Application Timeline
                    </h2>
                </div>
                <div class="p-6">
                    @php
                        $statuses = [
                            'pending' => ['label' => 'Application Submitted', 'order' => 1, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                            'in_review' => ['label' => 'In Review', 'order' => 2, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 5L9 7l-5 5" />'], // Example, adjust icon
                            'interview_scheduled' => ['label' => 'Interview Scheduled', 'order' => 3, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                            'interviewing' => ['label' => 'Interviewing', 'order' => 4, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />'],
                            'offer_extended' => ['label' => 'Offer Extended', 'order' => 5, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2M5 19V7m14 12v-2m-3-10l-4 4m0 0l-4-4m4 4V3" />'],
                            'offer_accepted' => ['label' => 'Offer Accepted', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 19m7-9V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h8" />'],
                            'hired' => ['label' => 'Hired', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                            'accepted' => ['label' => 'Accepted', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'], // Consolidate with hired or offer_accepted
                            'rejected' => ['label' => 'Application Outcome', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />'], // Generic outcome
                            'offer_declined' => ['label' => 'Offer Declined', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                            'withdrawn' => ['label' => 'Application Withdrawn', 'order' => 6, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'],
                            // Add other relevant stages from JobApplication model
                        ];
                        
                        $currentStatusKey = $jobApplication->status;
                        $currentOrder = $statuses[$currentStatusKey]['order'] ?? 0;
                        $passedCurrent = false;
                    @endphp
                    
                    <ol class="relative border-l-2 border-[#191A23]/20 ml-1">
                        @foreach($statuses as $key => $statusInfo)
                            @if($key === 'pending' || $key === $currentStatusKey || ($statuses[$currentStatusKey]['order'] ?? 0) >= $statusInfo['order'] || $statusInfo['order'] <= 1)
                            @php
                                $isCurrent = ($key === $currentStatusKey);
                                $isCompleted = (!$isCurrent && ($statusInfo['order'] < $currentOrder || ($key === 'pending' && $currentOrder > 0) ) );
                                if ($isCurrent) $passedCurrent = true;
                                $isFuture = (!$isCurrent && !$isCompleted && $passedCurrent);
                            @endphp
                            <li class="mb-6 ml-6">
                                <span class="absolute flex items-center justify-center w-6 h-6 rounded-full -left-3 border-2 border-[#191A23] {{ $isCompleted || $isCurrent ? 'bg-[#B9FF66]' : 'bg-gray-200' }}">
                                    <svg class="w-3 h-3 {{ $isCompleted || $isCurrent ? 'text-[#191A23]' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">{!! $statusInfo['icon'] !!}</svg>
                                </span>
                                <h4 class="text-md font-semibold {{ $isCompleted || $isCurrent ? 'text-[#191A23]' : 'text-gray-500' }}">{{ $statusInfo['label'] }}</h4>
                                @if($isCurrent)
                                    <time class="block mb-2 text-xs font-normal leading-none text-[#191A23]/70">Current Stage</time>
                                    @if ($key === 'pending' && $jobApplication->created_at)
                                        <p class="text-xs text-[#191A23]/70">Submitted on {{ $jobApplication->created_at->format('M d, Y') }}</p>
                                    @endif
                                @elseif($isCompleted && $key === 'pending' && $jobApplication->created_at)
                                     <time class="block text-xs font-normal leading-none text-[#191A23]/70">{{ $jobApplication->created_at->format('M d, Y') }}</time>
                                @endif
                                <!-- You might add more specific date logic if you have timestamps for each stage change -->
                            </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-center mt-10">
        <a href="{{ route('job-seeker.applications.index') }}" 
           class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] rounded-xl text-base font-medium text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to My Applications
        </a>
    </div>
</div>
@endsection 