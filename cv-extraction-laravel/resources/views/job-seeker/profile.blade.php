@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<div class="relative mb-12">
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
                <div class="p-4 bg-[#B9FF66] rounded-2xl w-20 h-20 flex items-center justify-center border border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            
            <div class="flex-1">
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]" style="box-shadow: 0px 2px 0px 0 #191a23;">
                    Profile
                </span>
                <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#191A23] tracking-tight">My Profile</h1>
                <p class="mt-2 text-lg text-[#191A23]/80">Manage your personal information and CV documents</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
<div class="mb-6 p-4 bg-[#B9FF66]/30 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
    <div class="flex items-center">
        <svg class="h-5 w-5 text-[#191A23]" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <p class="ml-3 text-sm text-[#191A23]">{{ session('success') }}</p>
    </div>
</div>
@endif

<!-- Error Message -->
@if(session('error'))
<div class="mb-6 p-4 bg-[#FF4D4D]/20 border-2 border-[#191A23] rounded-2xl" style="box-shadow: 0px 5px 0px 0 #191A23;">
    <div class="flex items-center">
        <svg class="h-5 w-5 text-[#FF4D4D]" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <p class="ml-3 text-sm text-[#FF4D4D] font-medium">{{ session('error') }}</p>
    </div>
</div>
@endif

<!-- Profile Content -->
<div class="space-y-6">
    <!-- Personal Information -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="px-6 py-4 border-b border-[#191A23]/30">
            <h2 class="text-lg font-semibold text-[#191A23] flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Personal Information
            </h2>
        </div>
        
        <div class="p-6">
            <form action="{{ route('job-seeker.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#191A23]">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                            class="mt-1 block w-full rounded-md border-2 border-[#191A23]/50 focus:ring-1 focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none sm:text-sm bg-white text-[#191A23] placeholder-[#191A23]/60 px-3 py-2">
                        @error('name')
                            <p class="mt-1 text-sm text-[#FF4D4D]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-[#191A23]">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                            class="mt-1 block w-full rounded-md border-2 border-[#191A23]/50 focus:ring-1 focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none sm:text-sm bg-white text-[#191A23] placeholder-[#191A23]/60 px-3 py-2">
                        @error('email')
                            <p class="mt-1 text-sm text-[#FF4D4D]">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-[#191A23]">Phone Number</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                            class="mt-1 block w-full rounded-md border-2 border-[#191A23]/50 focus:ring-1 focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none sm:text-sm bg-white text-[#191A23] placeholder-[#191A23]/60 px-3 py-2">
                        @error('phone')
                            <p class="mt-1 text-sm text-[#FF4D4D]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-[#191A23]">Address</label>
                    <textarea name="address" id="address" rows="3" 
                        class="mt-1 block w-full rounded-md border-2 border-[#191A23]/50 focus:ring-1 focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none sm:text-sm bg-white text-[#191A23] placeholder-[#191A23]/60 px-3 py-2">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-[#FF4D4D]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] rounded-xl text-base font-medium text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CV Documents -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <div class="px-6 py-4 border-b border-[#191A23]/30">
            <h2 class="text-lg font-semibold text-[#191A23] flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                My CV Documents
            </h2>
        </div>
        
        <div class="p-6">
            <!-- CV Upload Form -->
            <div class="mb-6">
                <form action="{{ route('job-seeker.cv.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="cv_file_input" class="block text-sm font-medium text-[#191A23]">Upload CV (PDF format)</label>
                            <span class="text-xs text-[#191A23]/70">Max: 10MB</span>
                        </div>
                        
                        <div id="cv-upload-area" class="relative group mt-2 border-2 border-dashed border-[#191A23]/50 rounded-xl p-8 text-center hover:border-[#191A23] transition-all cursor-pointer bg-white hover:bg-[#191A23]/5">
                            <div class="mx-auto h-12 w-12 text-[#191A23]/70 group-hover:text-[#191A23] mb-4 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                            </div>
                            <div id="cv-upload-text" class="text-sm text-[#191A23]/90 mb-1">
                                <span class="font-medium text-[#191A23] group-hover:text-[#B9FF66] transition-colors">Click to upload</span> or drag and drop
                            </div>
                            <div class="text-xs text-[#191A23]/70">PDF format only</div>
                            <input type="file" name="cv_file" id="cv_file_input" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                        </div>
                        
                        <p class="mt-4 text-sm text-[#191A23]/70">
                            Your CV will be analyzed to extract your skills, education, and experience.
                        </p>
                        
                        @error('cv_file')
                            <p class="mt-2 text-sm text-[#FF4D4D]">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 4px 0px 0 #191a23;">
                            <svg class="w-5 h-5 mr-2 text-[#191A23]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Upload CV & Analyze
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- CV List -->
            @if($user->cvs && $user->cvs->count() > 0)
                <div class="space-y-4">
                    <h3 class="text-md font-semibold text-[#191A23] mb-3 pt-4 border-t border-[#191A23]/20">Uploaded CVs</h3>
                    @foreach($user->cvs as $cv)
                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#191A23]/50 hover:border-[#191A23] hover:bg-[#191A23]/5 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="p-2 bg-[#B9FF66]/30 rounded-lg border border-[#191A23]/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium text-[#191A23]">{{ $cv->file_name }}</div>
                                    <div class="text-xs text-[#191A23]/70">Uploaded on {{ $cv->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($cv->is_default)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23]">
                                        <svg class="-ml-0.5 mr-1.5 h-4 w-4 text-[#191A23]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Default
                                    </span>
                                @else
                                    <form action="{{ route('job-seeker.cv.set-default', $cv) }}" method="POST" class="flex-shrink-0">
                                        @csrf
                                        <button type="submit" title="Set as Default CV"
                                                class="p-2 text-[#191A23]/70 hover:text-[#191A23] transition-colors duration-150 rounded-md hover:bg-[#B9FF66]/50 transform hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ asset('storage/job_seeker_cvs/' . $cv->file_name) }}" target="_blank" title="View CV" class="p-2 text-[#191A23]/70 hover:text-[#191A23] transition-colors duration-150 rounded-md hover:bg-[#191A23]/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>
                                <form action="{{ route('job-seeker.cv.delete', $cv) }}" method="POST" class="flex-shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:text-red-700 transition-colors duration-150 rounded-md hover:bg-red-500/10 transform hover:scale-105"
                                            onclick="return confirm('Are you sure you want to delete this CV: {{ $cv->file_name }}?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 border-t border-[#191A23]/20 mt-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-[#191A23]/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="mt-4 text-sm text-[#191A23]/70">No CVs uploaded yet.</p>
                    <p class="mt-1 text-xs text-[#191A23]/50">Upload your CV above to get started.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('cv-upload-area');
        const fileInput = document.getElementById('cv_file_input');
        const uploadText = document.getElementById('cv-upload-text');
        
        if (uploadArea && fileInput && uploadText) {
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const fileName = fileInput.files[0].name;
                    uploadText.innerHTML = `<span class="font-medium text-[#B9FF66]">${fileName}</span> <span class="text-xs text-[#191A23]/70">selected</span>`;
                } else {
                    uploadText.innerHTML = `<span class="font-medium text-[#191A23] group-hover:text-[#B9FF66] transition-colors">Click to upload</span> or drag and drop`;
                }
            });
        }
    });
</script>
@endsection 