<!-- Sidebar -->
<div class="w-full md:w-1/6 mb-6 md:mb-0">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden sticky top-20">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-base font-semibold text-gray-900 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Navigation
            </h2>
        </div>
        <div class="divide-y divide-gray-100">
            <a href="{{ route('job-seeker.dashboard') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.dashboard') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.dashboard') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.dashboard') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Dashboard</span>
            </a>
            <a href="{{ route('job-seeker.jobs.available') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.jobs.*') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.jobs.*') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.jobs.*') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Browse Jobs</span>
            </a>
            <a href="{{ route('job-seeker.applications.index') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.applications.*') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.applications.*') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.applications.*') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">My Applications</span>
            </a>
            <a href="{{ route('job-seeker.cv-upload') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.cv-upload') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.cv-upload') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.cv-upload') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">CV Upload</span>
            </a>
            <a href="{{ route('job-seeker.job-matches') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.job-matches') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.job-matches') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.job-matches') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Job Matches</span>
            </a>
            <a href="{{ route('job-seeker.profile') }}" class="flex items-center p-3 hover:bg-gray-50 {{ request()->routeIs('job-seeker.profile') ? 'bg-indigo-100 border-l-4 border-indigo-600' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 {{ request()->routeIs('job-seeker.profile') ? 'text-indigo-700' : 'text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-sm {{ request()->routeIs('job-seeker.profile') ? 'text-indigo-700 font-medium' : 'text-gray-700' }}">Profile</span>
            </a>
        </div>
    </div>
</div> 