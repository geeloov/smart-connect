@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 bg-white rounded-2xl border border-[#191A23] p-6" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-2">
                        <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23] truncate">{{ $jobPosition->title }}</h1>
                        <span class="px-3 py-1 rounded-lg text-xs font-semibold whitespace-nowrap
                            {{ $jobPosition->is_active ? 'bg-[#B9FF66]/30 text-[#191A23] border border-[#191A23]/50 style=\"box-shadow: 0px 1px 0px 0 #191a23;\"' : 'bg-gray-500/20 text-gray-700 border border-gray-700/50' }}">
                            {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-x-3 gap-y-1 text-sm text-[#191A23]/70 mt-1">
                        <span>{{ $jobPosition->company_name }}</span>
                        <span class="text-[#191A23]/40">•</span>
                        <span>{{ $jobPosition->location }}</span>
                        @if($jobPosition->job_type)
                        <span class="text-[#191A23]/40">•</span>
                        <span class="font-medium text-[#191A23]">{{ $jobPosition->job_type }}</span>
                        @endif
                        @if($jobPosition->salary_range)
                        <span class="text-[#191A23]/40">•</span>
                        <span class="font-medium text-[#191A23]">{{ $jobPosition->salary_range }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-4 sm:mt-0 flex-shrink-0">
                    <a href="{{ route('recruiter.job-positions.edit', $jobPosition) }}" 
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-white text-[#191A23] rounded-xl border-2 border-[#191A23] hover:bg-[#191A23]/5 transition-all duration-200 text-sm font-medium transform hover:-translate-y-px whitespace-nowrap" style="box-shadow: 0px 3px 0px 0 #191a23;">
                        <svg class="w-4 h-4 mr-2 text-[#191A23]/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form id="deleteJobForm" action="{{ route('recruiter.job-positions.destroy', $jobPosition) }}" method="POST" class="inline-block w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="openDeleteModalBtn" 
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-red-500 text-white rounded-xl border-2 border-red-700 hover:bg-red-600 transition-all duration-200 text-sm font-medium transform hover:-translate-y-px whitespace-nowrap" style="box-shadow: 0px 3px 0px 0 #dc2626;">
                            <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23] flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-[#B9FF66]">Job Description</h3>
                    </div>
                    <div class="px-6 py-8">
                        @if($jobPosition->description)
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($jobPosition->description)) !!}
                            </div>
                        @else
                            <p class="text-[#191A23]/60 italic">No description provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23] flex items-center">
                         <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16L2 12l4-4" />
                        </svg>
                        <h3 class="text-lg font-semibold text-[#B9FF66]">Requirements</h3>
                    </div>
                    <div class="px-6 py-8">
                        @if($jobPosition->requirements)
                            <div class="prose prose-sm max-w-none text-[#191A23]/80 leading-relaxed">
                                {!! nl2br(e($jobPosition->requirements)) !!}
                            </div>
                        @else
                            <p class="text-[#191A23]/60 italic">No requirements provided.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Overview & Applications -->
            <div class="md:col-span-1 space-y-8">
                <!-- Overview Card -->
                <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23] flex items-center">
                         <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-[#B9FF66]">Overview</h3>
                    </div>
                    <div class="p-6 space-y-4 text-sm text-[#191A23]/80">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-[#191A23]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Posted on: <span class="font-semibold text-[#191A23]">{{ $jobPosition->created_at->format('F d, Y') }} ({{ $jobPosition->created_at->diffForHumans() }})</span></span>
                        </div>
                        
                        @if($jobPosition->job_type)
                        <div class="flex items-center">
                             <svg class="w-5 h-5 mr-3 text-[#191A23]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Job Type: <span class="font-semibold text-[#191A23]">{{ $jobPosition->job_type }}</span></span>
                        </div>
                        @endif

                         @if($jobPosition->salary_range)
                        <div class="flex items-center">
                             <svg class="w-5 h-5 mr-3 text-[#191A23]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Salary: <span class="font-semibold text-[#191A23]">{{ $jobPosition->salary_range }}</span></span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Applications Card -->
                <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
                    <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23] flex items-center">
                         <svg class="w-5 h-5 mr-2 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-[#B9FF66]">Applications</h3>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-4xl font-bold text-[#191A23] mb-2">{{ $applications->count() }}</p>
                        <p class="text-sm text-[#191A23]/70">Total Applications Received</p>
                        @if($applications->count() > 0)
                            <a href="{{ route('recruiter.applications.index', ['job_position_id' => $jobPosition->id]) }}" 
                                class="mt-4 inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                                View All Applications
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9990] flex items-center justify-center p-4 hidden" aria-labelledby="deleteModalTitle" role="dialog" aria-modal="true">
    <div class="bg-white rounded-2xl border border-[#191A23] max-w-md w-full" style="box-shadow: 0px 8px 0px 0 #191a23;">
        <div class="p-6 sm:p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500/10 border-2 border-red-500/20 mb-5">
                <svg class="h-8 w-8 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#191A23] mb-2" id="deleteModalTitle">Confirm Deletion</h3>
            <p class="text-sm text-[#191A23]/70 mb-6">
                Are you sure you want to delete the job position: <br class="sm:hidden"/> <strong class="font-semibold text-[#191A23]">{{ $jobPosition->title }}</strong>?<br/> This action cannot be undone.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button type="button" id="cancelDeleteBtn" class="w-full sm:w-auto inline-flex justify-center rounded-xl border-2 border-[#191A23]/50 px-6 py-3 text-sm font-medium text-[#191A23]/80 hover:text-[#191A23] hover:border-[#191A23] bg-white hover:bg-[#191A23]/5 transition-all duration-200" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    Cancel
                </button>
                <button type="button" id="confirmDeleteBtn" class="w-full sm:w-auto inline-flex justify-center rounded-xl border-2 border-red-700 bg-red-500 px-6 py-3 text-sm font-medium text-white hover:bg-red-600 transition-all duration-200 transform hover:-translate-y-px" style="box-shadow: 0px 3px 0px 0 #c52020;">
                    Yes, Delete Job
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('deleteConfirmationModal');
        const openDeleteModalBtn = document.getElementById('openDeleteModalBtn');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteJobForm = document.getElementById('deleteJobForm');

        if (openDeleteModalBtn) {
            openDeleteModalBtn.addEventListener('click', function () {
                deleteModal.classList.remove('hidden');
            });
        }

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', function () {
                deleteModal.classList.add('hidden');
            });
        }

        if (confirmDeleteBtn && deleteJobForm) {
            confirmDeleteBtn.addEventListener('click', function () {
                deleteJobForm.submit();
            });
        }

        // Close modal on overlay click
        if (deleteModal) {
            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                deleteModal.classList.add('hidden');
            }
        });
    });
</script>
@endpush 