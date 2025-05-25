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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                            Your Applications
                        </span>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">My Job Applications</h1>
                        <p class="mt-2 text-lg text-[#191A23]/80">Track the status of all your job applications in one place</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div class="mb-6 p-4 bg-[#B9FF66]/20 border border-[#191A23]/30 rounded-lg">
    <div class="flex items-center">
        <svg class="h-5 w-5 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <p class="ml-3 text-sm text-[#191A23]">{{ session('success') }}</p>
    </div>
</div>
@endif

<!-- Applications List -->
@if(count($applications) > 0)
<div class="bg-white rounded-2xl border border-[#191A23] shadow-sm overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-6 border-b border-[#191A23]/30 pb-4">
            <svg class="w-6 h-6 text-[#191A23]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <h2 class="text-xl font-semibold text-[#191A23]">Application History</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#191A23]/30">
                        <th class="pb-6 text-left w-[22%]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#191A23]" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm font-semibold text-[#191A23]/80">POSITION</span>
                            </div>
                        </th>
                        <th class="pb-6 text-left w-[22%]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#191A23]" viewBox="0 0 24 24" fill="none">
                                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm font-semibold text-[#191A23]/80">COMPANY</span>
                            </div>
                        </th>
                        <th class="pb-6 text-left w-[15%]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#191A23]" viewBox="0 0 24 24" fill="none">
                                    <path d="M8 7V5c0-1.10457.89543-2 2-2h4c1.1046 0 2 .89543 2 2v2h4c1.1046 0 2 .89543 2 2v10c0 1.1046-.8954 2-2 2H4c-1.10457 0-2-.8954-2-2V9c0-1.10457.89543-2 2-2h4zm4-2c-.5523 0-1 .44772-1 1v1h2V6c0-.55228-.4477-1-1-1z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm font-semibold text-[#191A23]/80">APPLIED ON</span>
                            </div>
                        </th>
                        <th class="pb-6 text-left w-[12%]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#191A23]" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm font-semibold text-[#191A23]/80">STATUS</span>
                            </div>
                        </th>
                        <th class="pb-6 text-left w-[12%]">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#191A23]" viewBox="0 0 24 24" fill="none">
                                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm font-semibold text-[#191A23]/80">MATCH</span>
                            </div>
                        </th>
                        <th class="pb-6 text-right w-[17%]">
                            <span class="text-sm font-semibold text-[#191A23]/80">ACTIONS</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#191A23]/20">
                    @foreach($applications as $application)
                    <tr class="group hover:bg-[#B9FF66]/10">
                        <td class="py-6">
                            <a href="{{ route('job-seeker.jobs.details', $application->jobPosition) }}" 
                               class="text-[#191A23] hover:text-[#B9FF66] font-medium transition-colors line-clamp-1">
                                {{ $application->jobPosition->title }}
                            </a>
                        </td>
                        <td class="py-6">
                            <div class="text-[#191A23]/80 line-clamp-1">
                                {{ $application->jobPosition->company_name }}
                            </div>
                        </td>
                        <td class="py-6">
                            <div class="text-[#191A23]/80">
                                {{ $application->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td class="py-6">
                            @php
                                $statusBaseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium border';
                                $statusColors = [
                                    'pending' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                    'in_review' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                    'reviewed' => 'bg-[#B9FF66]/20 text-[#191A23] border-[#191A23]/30',
                                    'shortlisted' => 'bg-[#B9FF66] text-[#191A23] border-[#191A23]',
                                    'rejected' => 'bg-red-100 text-red-700 border-red-300',
                                    'hired' => 'bg-[#B9FF66] text-[#191A23] border-[#191A23]',
                                ];
                                
                                $statusShadow = (
                                    $application->status === 'shortlisted' || $application->status === 'hired'
                                    ? 'box-shadow: 0px 1px 0px 0 #191a23;' 
                                    : ''
                                );

                                $statusLabels = [
                                    'pending' => 'Pending',
                                    'in_review' => 'In Review',
                                    'reviewed' => 'Reviewed',
                                    'shortlisted' => 'Shortlisted',
                                    'rejected' => 'Rejected',
                                    'hired' => 'Hired'
                                ];
                                
                                $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                $statusLabel = $statusLabels[$application->status] ?? ucfirst($application->status);
                            @endphp
                            <span class="{{ $statusBaseClasses }} {{ $statusColor }}" style="{{ $statusShadow }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="py-6">
                            @if($application->compatibility_score)
                                <div class="flex items-center gap-2">
                                    <div class="w-16 h-1.5 bg-[#191A23]/20 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#B9FF66] rounded-full" style="width: {{ $application->compatibility_score }}%"></div>
                                    </div>
                                    <span class="text-sm text-[#191A23]/80">{{ $application->compatibility_score }}%</span>
                                </div>
                            @else
                                <span class="text-sm text-[#191A23]/60 italic">Not assessed</span>
                            @endif
                        </td>
                        <td class="py-6 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('job-seeker.applications.show', $application) }}" 
                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-[#191A23] hover:text-[#B9FF66] transition-colors rounded-lg border border-transparent hover:border-[#191A23]/50">
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    View
                                </a>
                                
                                <a href="{{ route('job-seeker.jobs.details', $application->jobPosition) }}" 
                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-[#191A23] rounded-lg text-sm font-medium text-[#191A23] bg-transparent hover:bg-[#B9FF66] hover:border-[#B9FF66] transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none">
                                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Job Details
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<!-- Empty State -->
<div class="bg-white rounded-2xl border border-[#191A23] shadow-sm p-8 text-center overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
    <div class="max-w-md mx-auto">
        <div class="inline-block p-4 rounded-full bg-[#191A23]/10 mb-4">
            <svg class="w-16 h-16 mx-auto text-[#191A23] mb-4" viewBox="0 0 24 24" fill="none">
                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#191A23] mb-2">No applications yet</h3>
        <p class="text-[#191A23]/70 mb-6">Start exploring job opportunities that match your skills and experience</p>
        <a href="{{ route('job-seeker.jobs.available') }}" 
           class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Browse Available Jobs
        </a>
    </div>
</div>
@endif
@endsection 