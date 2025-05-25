@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Updated Header Section -->
        <div class="relative mb-8"> {{-- Consistent margin --}}
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
                        {{-- Updated Icon for Job Positions --}}
                        <div class="p-4 bg-[#B9FF66] rounded-2xl w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div>
                                {{-- "Welcome Back" badge removed --}}
                                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">Job Positions</h1>
                                <p class="mt-2 text-lg text-[#191A23]/80">Manage your job listings</p>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-auto flex-shrink-0">
                                <a href="{{ route('recruiter.job-positions.create') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                                    <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    New Position
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <form method="GET" action="{{ route('recruiter.job-positions.index') }}">
            <div class="bg-white rounded-2xl p-6 mb-8 border border-[#191A23]" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               placeholder="Search jobs by title, company..." 
                               value="{{ request('search') }}" 
                               class="w-full px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base">
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <select name="job_type" 
                                class="px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base min-w-[160px]">
                            <option value="">All Types</option>
                            <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ request('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        <select name="status" 
                                class="px-4 py-3 rounded-xl bg-white border border-[#191A23]/50 text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base min-w-[160px]">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <button type="submit" 
                                class="px-8 py-3 bg-[#191A23] text-[#FFFFFF] rounded-xl border-2 border-[#191A23] hover:bg-[#33343E] transition-all duration-200 text-base font-medium transform hover:-translate-y-0.5 min-w-[120px]" style="box-shadow: 0px 4px 0px 0 #B9FF66;">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>

        @if($jobPositions->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-12 text-center border border-[#191A23]" style="box-shadow: 0px 5px 0px 0 #191a23;">
                <div class="w-20 h-20 bg-[#191A23]/5 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="h-10 w-10 text-[#191A23]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#191A23] mb-3">No Job Positions Yet</h3>
                <p class="text-base text-[#191A23]/70 mb-8">Create your first job position to start receiving applications.</p>
                <a href="{{ route('recruiter.job-positions.create') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                    <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Job Position
                </a>
            </div>
        @else
            <!-- Job Positions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($jobPositions as $jobPosition)
                    <div class="bg-white rounded-2xl overflow-hidden border border-[#191A23] transition-all duration-200" style="box-shadow: 0px 5px 0px 0 #191a23;">
                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Company Info -->
                            <div class="mb-3">
                                <p class="text-sm text-[#191A23]/70">{{ $jobPosition->company_name }}</p>
                            </div>

                            <!-- Title and Status -->
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-[#191A23]">
                                    {{ $jobPosition->title }}
                                </h3>
                                @php
                                    $statusBaseClass = 'inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border';
                                    $activeClasses = 'bg-[#B9FF66]/30 text-[#191A23] border-[#191A23]/50 style="box-shadow: 0px 1px 0px 0 #191a23;"';
                                    $inactiveClasses = 'bg-gray-500/20 text-gray-700 border-gray-700/50';
                                @endphp
                                <span class="{{ $statusBaseClass }} {{ $jobPosition->is_active ? $activeClasses : $inactiveClasses }}">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $jobPosition->is_active ? 'bg-[#191A23]' : 'bg-gray-600' }}"></span>
                                    {{ $jobPosition->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <!-- Location and Job Type -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-x-6 gap-y-2 mb-4">
                                <div class="flex items-center text-sm text-[#191A23]/80">
                                    <svg class="w-5 h-5 mr-2 text-[#191A23]/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $jobPosition->location }}</span>
                                </div>
                                <div class="flex items-center text-sm text-[#191A23]/80">
                                    <svg class="w-5 h-5 mr-2 text-[#191A23]/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $jobPosition->job_type }}</span>
                                </div>
                            </div>

                            <!-- Applications Count -->
                            <div class="flex items-center text-sm text-[#191A23]/80 mb-4">
                                <svg class="w-5 h-5 mr-2 text-[#191A23]/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $jobPosition->applications->count() }} {{ Str::plural('Application', $jobPosition->applications->count()) }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex border-t border-[#191A23]/20">
                            <a href="{{ route('recruiter.job-positions.edit', $jobPosition) }}" 
                               class="flex-1 flex items-center justify-center gap-2 py-3 px-3 text-sm font-medium text-[#191A23]/80 hover:text-[#191A23] hover:bg-[#191A23]/10 transition-colors duration-200 border-r border-[#191A23]/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('recruiter.job-positions.toggle-active', $jobPosition) }}" method="POST" class="flex-1 contents">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full flex-1 flex items-center justify-center gap-2 py-3 px-3 text-sm font-medium text-[#191A23]/80 hover:text-[#191A23] hover:bg-[#191A23]/10 transition-colors duration-200 border-r border-[#191A23]/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($jobPosition->is_active)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path> {{-- Archive Icon --}}
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-4 0V4m0 0L8 7m4-3l4 3m-4-3V4m0 0H8m4 0h4m-4 0v3"></path> {{-- Activate Icon (simplified upload) --}}
                                        @endif
                                    </svg>
                                    {{ $jobPosition->is_active ? 'Archive' : 'Activate' }}
                                </button>
                            </form>
                            <form id="deleteJobForm_{{ $jobPosition->id }}" action="{{ route('recruiter.job-positions.destroy', $jobPosition) }}" method="POST" class="flex-1 contents">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        data-form-id="deleteJobForm_{{ $jobPosition->id }}"
                                        data-job-title="{{ $jobPosition->title }}"
                                        class="open-delete-modal-btn-index w-full flex-1 flex items-center justify-center gap-2 py-3 px-3 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-500/10 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
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

<!-- Delete Confirmation Modal -->
<div id="deleteJobPositionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9990] flex items-center justify-center p-4 hidden" aria-labelledby="deleteModalTitle" role="dialog" aria-modal="true">
    <div class="bg-white rounded-2xl border border-[#191A23] max-w-md w-full" style="box-shadow: 0px 8px 0px 0 #191a23;">
        <div class="p-6 sm:p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500/10 border-2 border-red-500/20 mb-5">
                <svg class="h-8 w-8 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-[#191A23] mb-2" id="deleteModalTitle">Confirm Deletion</h3>
            <p class="text-sm text-[#191A23]/70 mb-6">
                Are you sure you want to delete the job position: <br class="sm:hidden"/> <strong class="font-semibold text-[#191A23]" id="modalJobTitleToDelete">[Job Title]</strong>?<br/> This action cannot be undone.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button type="button" id="cancelDeleteJobPositionBtn" class="w-full sm:w-auto inline-flex justify-center rounded-xl border-2 border-[#191A23]/50 px-6 py-3 text-sm font-medium text-[#191A23]/80 hover:text-[#191A23] hover:border-[#191A23] bg-white hover:bg-[#191A23]/5 transition-all duration-200" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    Cancel
                </button>
                <button type="button" id="confirmDeleteJobPositionBtn" class="w-full sm:w-auto inline-flex justify-center rounded-xl border-2 border-red-700 bg-red-500 px-6 py-3 text-sm font-medium text-white hover:bg-red-600 transition-all duration-200 transform hover:-translate-y-px" style="box-shadow: 0px 3px 0px 0 #c52020;">
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
        const deleteModal = document.getElementById('deleteJobPositionModal');
        const openDeleteModalBtns = document.querySelectorAll('.open-delete-modal-btn-index');
        const cancelDeleteBtn = document.getElementById('cancelDeleteJobPositionBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteJobPositionBtn');
        const modalJobTitleElement = document.getElementById('modalJobTitleToDelete');

        openDeleteModalBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const formId = this.dataset.formId;
                const jobTitle = this.dataset.jobTitle;
                
                if (modalJobTitleElement) {
                    modalJobTitleElement.textContent = jobTitle;
                }
                
                if (confirmDeleteBtn) {
                    confirmDeleteBtn.dataset.targetFormId = formId;
                }
                
                if (deleteModal) {
                    deleteModal.classList.remove('hidden');
                }
            });
        });

        if (cancelDeleteBtn && deleteModal) {
            cancelDeleteBtn.addEventListener('click', function () {
                deleteModal.classList.add('hidden');
            });
        }

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function () {
                const targetFormId = this.dataset.targetFormId;
                if (targetFormId) {
                    const deleteJobForm = document.getElementById(targetFormId);
                    if (deleteJobForm) {
                        deleteJobForm.submit();
                    }
                }
            });
        }

        if (deleteModal) {
            // Close modal on overlay click
            deleteModal.addEventListener('click', function (event) {
                if (event.target === deleteModal) {
                    deleteModal.classList.add('hidden');
                }
            });

            // Close modal on Escape key
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    deleteModal.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush 