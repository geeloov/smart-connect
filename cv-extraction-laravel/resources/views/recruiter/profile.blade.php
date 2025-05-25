@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="bg-white rounded-2xl border border-[#191A23] p-6 mb-8" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="flex items-center space-x-4">
                <div class="bg-[#191A23] p-3.5 rounded-xl" style="box-shadow: 0px 3px 0px 0 #B9FF66;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-[#191A23]">My Profile</h1>
                    <p class="mt-1 text-[#191A23]/70">Manage your personal and company information</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="mb-8 rounded-2xl p-5 flex items-start bg-[#B9FF66]/20 border-2 border-[#B9FF66]/60" style="box-shadow: 0px 3px 0px 0 #86c934;" role="alert">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-base text-[#191A23]">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-[#B9FF66]/20 rounded-lg p-1.5 text-[#191A23]/80 hover:bg-[#B9FF66]/40 focus:ring-2 focus:ring-offset-2 focus:ring-offset-[#B9FF66]/20 focus:ring-[#86c934]">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-8 rounded-2xl p-5 flex items-start bg-red-500/10 border-2 border-red-500/50" style="box-shadow: 0px 3px 0px 0 #ef4444;" role="alert">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-base text-red-700">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.closest('[role=alert]').remove()" class="inline-flex bg-red-500/10 rounded-lg p-1.5 text-red-600 hover:bg-red-500/20 focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500/10 focus:ring-red-500">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden" style="box-shadow: 0px 5px 0px 0 #191a23;">
            <div class="px-6 py-5 border-b border-[#191A23]/30 bg-[#191A23] flex items-center justify-between">
                <h2 class="text-xl font-bold text-[#B9FF66] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2.5 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Personal & Company Information
                </h2>
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-[#B9FF66] text-[#191A23] border border-[#191A23] whitespace-nowrap" style="box-shadow: 0px 1px 0px 0 #191a23;">
                    Recruiter
                </span>
            </div>
            <div class="p-8">
                <form action="{{ route('recruiter.profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col md:flex-row md:space-x-8 items-start">
                        <!-- Profile Initial -->
                        <div class="flex-shrink-0 mb-8 md:mb-0">
                            <div class="relative">
                                <div class="h-28 w-28 bg-[#191A23]/5 border-2 border-[#191A23]/20 rounded-2xl flex items-center justify-center text-4xl font-bold text-[#191A23]">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        <!-- Basic Info -->
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('name')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('email')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Company Info -->
                    <div class="border-t border-[#191A23]/20 pt-8">
                        <h3 class="text-lg font-semibold text-[#191A23] mb-6 flex items-center">
                            <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Company Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Company Name</label>
                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->recruiterProfile->company_name ?? '') }}" 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('company_name')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="industry" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Industry</label>
                                <input type="text" name="industry" id="industry" value="{{ old('industry', $user->recruiterProfile->industry ?? '') }}" 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('industry')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="website" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Website</label>
                                <input type="text" name="website" id="website" value="{{ old('website', $user->recruiterProfile->website ?? '') }}" 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('website')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="border-t border-[#191A23]/20 pt-8">
                        <h3 class="text-lg font-semibold text-[#191A23] mb-6 flex items-center">
                            <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Contact Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->recruiterProfile->phone ?? '') }}" 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('phone')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="location" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $user->recruiterProfile->location ?? '') }}" 
                                       class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200">
                                @error('location')
                                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- About Company -->
                    <div class="border-t border-[#191A23]/20 pt-8">
                        <h3 class="text-lg font-semibold text-[#191A23] mb-6 flex items-center">
                            <svg class="h-5 w-5 mr-2.5 text-[#191A23]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            About Company
                        </h3>
                        <div>
                            <label for="bio" class="block text-sm font-medium text-[#191A23]/80 mb-1.5">Bio</label>
                            <textarea name="bio" id="bio" rows="4" 
                                      class="block w-full px-4 py-3 bg-white border border-[#191A23]/50 rounded-xl text-[#191A23] placeholder-[#191A23]/60 focus:ring-2 focus:ring-[#B9FF66]/70 focus:border-[#191A23] text-base transition-colors duration-200" 
                                      placeholder="Write a short description about your company...">{{ old('bio', $user->recruiterProfile->bio ?? '') }}</textarea>
                            @error('bio')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-8 flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 border-2 border-[#191A23] text-base font-medium rounded-xl text-[#191A23] bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#86c934] transition-all duration-200 transform hover:-translate-y-0.5" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <svg class="w-5 h-5 mr-2 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection