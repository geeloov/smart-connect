<!-- Modern Sidebar -->
<div class="w-full md:w-64 flex-shrink-0">
    <div class="bg-white rounded-2xl border border-[#191A23] overflow-hidden sticky top-6" style="box-shadow: 0px 5px 0px 0 #191a23;">
        <!-- Sidebar Header -->
        <div class="px-6 py-5 border-b border-[#B9FF66]/50 bg-[#191A23]">
            <h2 class="text-lg font-bold text-[#B9FF66] flex items-center">
                <svg class="w-5 h-5 mr-3 text-[#B9FF66]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Menu
            </h2>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('job-seeker.dashboard') }}" 
               class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('job-seeker.dashboard') ? 'bg-[#B9FF66] text-[#191A23] font-semibold border border-[#191A23]/50 style="box-shadow: 0px 2px 0px 0px #191A23;"' : 'text-[#191A23]/70 hover:bg-[#191A23]/5 hover:text-[#191A23]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('job-seeker.dashboard') ? 'text-[#191A23]' : 'text-[#191A23]/50 group-hover:text-[#191A23]/70' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.dashboard') ? 'font-semibold' : 'group-hover:text-[#191A23]' }}">Dashboard</span>
            </a>

            <!-- Browse Jobs -->
            <a href="{{ route('job-seeker.jobs.available') }}" 
               class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('job-seeker.jobs.*') ? 'bg-[#B9FF66] text-[#191A23] font-semibold border border-[#191A23]/50 style="box-shadow: 0px 2px 0px 0px #191A23;"' : 'text-[#191A23]/70 hover:bg-[#191A23]/5 hover:text-[#191A23]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('job-seeker.jobs.*') ? 'text-[#191A23]' : 'text-[#191A23]/50 group-hover:text-[#191A23]/70' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.jobs.*') ? 'font-semibold' : 'group-hover:text-[#191A23]' }}">Browse Jobs</span>
            </a>

            <!-- My Applications -->
            <a href="{{ route('job-seeker.applications.index') }}" 
               class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('job-seeker.applications.*') ? 'bg-[#B9FF66] text-[#191A23] font-semibold border border-[#191A23]/50 style="box-shadow: 0px 2px 0px 0px #191A23;"' : 'text-[#191A23]/70 hover:bg-[#191A23]/5 hover:text-[#191A23]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('job-seeker.applications.*') ? 'text-[#191A23]' : 'text-[#191A23]/50 group-hover:text-[#191A23]/70' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.applications.*') ? 'font-semibold' : 'group-hover:text-[#191A23]' }}">My Applications</span>
            </a>

            <!-- CV Upload -->
            <a href="{{ route('job-seeker.cv-upload') }}" 
               class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('job-seeker.cv-upload') ? 'bg-[#B9FF66] text-[#191A23] font-semibold border border-[#191A23]/50 style="box-shadow: 0px 2px 0px 0px #191A23;"' : 'text-[#191A23]/70 hover:bg-[#191A23]/5 hover:text-[#191A23]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('job-seeker.cv-upload') ? 'text-[#191A23]' : 'text-[#191A23]/50 group-hover:text-[#191A23]/70' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.cv-upload') ? 'font-semibold' : 'group-hover:text-[#191A23]' }}">CV Upload</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('job-seeker.profile') }}" 
               class="group flex items-center px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('job-seeker.profile') ? 'bg-[#B9FF66] text-[#191A23] font-semibold border border-[#191A23]/50 style="box-shadow: 0px 2px 0px 0px #191A23;"' : 'text-[#191A23]/70 hover:bg-[#191A23]/5 hover:text-[#191A23]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('job-seeker.profile') ? 'text-[#191A23]' : 'text-[#191A23]/50 group-hover:text-[#191A23]/70' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.profile') ? 'font-semibold' : 'group-hover:text-[#191A23]' }}">Profile</span>
            </a>
        </nav>
    </div>
</div> 