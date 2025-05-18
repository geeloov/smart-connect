<!-- Modern Sidebar -->
<div class="w-full md:w-64 mb-6 md:mb-0">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-20 transition-all duration-300 hover:shadow-xl">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-bold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-[#B9FF66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Menu
            </h2>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('recruiter.dashboard') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.dashboard') ? 'bg-[#B9FF66]/10 text-[#191A23] font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('recruiter.dashboard') ? 'text-[#B9FF66]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <!-- Job Positions -->
            <a href="{{ route('recruiter.job-positions.index') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.job-positions.*') ? 'bg-[#B9FF66]/10 text-[#191A23] font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('recruiter.job-positions.*') ? 'text-[#B9FF66]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-sm">Job Positions</span>
            </a>

            <!-- Applications -->
            <a href="{{ route('recruiter.applications.index') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.applications.*') ? 'bg-[#B9FF66]/10 text-[#191A23] font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('recruiter.applications.*') ? 'text-[#B9FF66]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-sm">Applications</span>
            </a>

            <!-- CV Extraction -->
            <a href="{{ route('recruiter.cv-extraction') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.cv-extraction') ? 'bg-[#B9FF66]/10 text-[#191A23] font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('recruiter.cv-extraction') ? 'text-[#B9FF66]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-sm">CV Extraction</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('recruiter.profile') }}" 
               class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.profile') ? 'bg-[#B9FF66]/10 text-[#191A23] font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('recruiter.profile') ? 'text-[#B9FF66]' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-sm">Profile</span>
            </a>
        </nav>
    </div>
</div> 