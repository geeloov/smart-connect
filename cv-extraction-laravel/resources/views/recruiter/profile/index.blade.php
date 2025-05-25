@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="flex items-start gap-4">
                <div class="bg-[#191A23] p-3.5 rounded-xl" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#191A23] tracking-tight">Recruiter Profile</h1>
                    <p class="mt-1 text-[#191A23]/70">Manage your profile information and settings</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 rounded-2xl p-5 flex items-start bg-[#B9FF66]/20 border-2 border-[#B9FF66]/60" style="box-shadow: 0px 3px 0px 0 #86c934;" role="alert">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-base text-[#191A23]">{{ session('success') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-[#B9FF66]/20 rounded-lg p-1.5 text-[#191A23]/80 hover:bg-[#B9FF66]/40 focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#B9FF66]/20 focus:ring-[#86c934]">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="px-6 py-5 border-b border-[#191A23]/30 bg-[#191A23]">
                <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                    <svg class="w-5 h-5 mr-2.5 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Personal Information
                </h2>
            </div>
            <div class="p-8">
                <form action="{{ route('recruiter.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-2">
                        <div class="col-span-1 md:col-span-2 flex items-center">
                            <div class="mr-6">
                                <div class="relative h-24 w-24 rounded-full overflow-hidden bg-[#191A23]/5 border border-[#191A23]/20">
                                    @if(auth()->user()->profile_photo_path)
                                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center bg-[#191A23]/10 text-[#191A23]/50">
                                            <svg class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <label for="profile_photo" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Profile Photo</label>
                                <input type="file" id="profile_photo" name="profile_photo" 
                                    class="block w-full text-sm text-[#191A23]/80 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#191A23] file:text-[#B9FF66] hover:file:bg-[#191A23]/90 file:transition-colors file:duration-200 focus:outline-none focus:ring-2 focus:ring-[#B9FF66]/50 focus:border-[#191A23]">
                                <p class="mt-1.5 text-xs text-[#191A23]/60">JPG, PNG or GIF up to 2MB. Recommended: Square aspect ratio.</p>
                            </div>
                        </div>
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Email</label>
                            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}"
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ auth()->user()->company_name }}"
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label for="company_bio" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Company Bio</label>
                            <textarea name="company_bio" id="company_bio" rows="4" 
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">{{ auth()->user()->company_bio }}</textarea>
                            @error('company_bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="col-span-1 md:col-span-2 flex justify-end pt-2">
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#86c934] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Password Update Section -->
        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="px-6 py-5 border-b border-[#191A23]/30 bg-[#191A23]">
                <h2 class="text-lg font-semibold text-[#B9FF66] flex items-center">
                    <svg class="w-5 h-5 mr-2.5 text-[#B9FF66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Update Password
                </h2>
            </div>
            <div class="p-8">
                <form action="{{ route('recruiter.profile.update-password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-3">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Current Password</label>
                            <input type="password" name="current_password" id="current_password" required
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">New Password</label>
                            <input type="password" name="password" id="password" required
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                        </div>
                        
                        <div class="col-span-1 md:col-span-3 flex justify-end pt-2">
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#86c934] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 