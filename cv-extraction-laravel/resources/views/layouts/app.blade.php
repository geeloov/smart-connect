<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Connect') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favico/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favico/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favico/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favico/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favico/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('favico/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('favico/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Styles -->
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #F5F5F5;
        }
        .text-dark {
            color: #191A23;
        }
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #B9FF66;
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .nav-link.active::after {
            width: 100%;
        }
        .nav-link.active {
            color: #191A23;
            font-weight: 500;
        }
        .logo-animate {
            transition: transform 0.3s ease;
        }
        .logo-animate:hover {
            transform: scale(1.05);
        }
        .navbar-transparent {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        }
        .nav-glass-button {
            background-color: rgba(185, 255, 102, 0.9);
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }
        .nav-glass-button:hover {
            background-color: rgba(185, 255, 102, 1);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="navbar-transparent sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="text-xl font-bold text-dark logo-animate flex items-center">
                                <img src="{{ asset('images/svg/site-logo.png') }}" alt="Smart Connect" class="h-[120px]">
                            </a>
                        </div>
                        <div class="hidden sm:ml-8 sm:flex sm:space-x-6">
                            <a href="{{ route('home') }}" class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                Home
                            </a>
                            @guest
                                <a href="{{ route('job-seeker.dashboard') }}" class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium {{ request()->routeIs('job-seeker.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                    Job Seekers
                                </a>
                                <a href="{{ route('recruiter.dashboard') }}" class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium {{ request()->routeIs('recruiter.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                    Recruiters
                                </a>
                            @else
                                @if(Auth::user()->hasRole('recruiter'))
                                    <a href="{{ route('recruiter.dashboard') }}" class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium {{ request()->routeIs('recruiter.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                        Dashboard
                                    </a>
                                @elseif(Auth::user()->hasRole('job_seeker'))
                                    <a href="{{ route('job-seeker.dashboard') }}" class="nav-link inline-flex items-center px-3 py-2 text-sm font-medium {{ request()->routeIs('job-seeker.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                        Dashboard
                                    </a>
                                @endif
                            @endguest
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @guest
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg text-dark nav-glass-button">
                                Sign In
                            </a>
                        @else
                            @if(Auth::user()->hasRole('recruiter'))
                                @livewire('recruiter-notifications')
                            @elseif(Auth::user()->hasRole('job_seeker'))
                                @livewire('job-seeker-notifications')
                            @endif
                            
                            <div class="ml-3 relative flex items-center">
                                <div class="relative">
                                    <button type="button" class="flex items-center space-x-2 focus:outline-none" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <div class="flex-shrink-0 h-8 w-8 bg-[#B9FF66] rounded-full flex items-center justify-center shadow-sm">
                                            <span class="text-dark font-bold text-xs">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                        <span class="ml-2 text-sm font-medium text-dark">{{ Auth::user()->name }}</span>
                                        <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    
                                    <!-- Dropdown menu -->
                                    <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" id="user-menu-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                        <!-- Profile link -->
                                        <a href="{{ Auth::user()->isRecruiter() ? route('recruiter.profile') : route('job-seeker.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>Profile</span>
                                            </div>
                                        </a>
                                        
                                        <!-- Logout form -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    </svg>
                                                    <span>Sign Out</span>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                    <div class="flex items-center sm:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="hidden sm:hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1 bg-white bg-opacity-90 backdrop-blur-sm">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 mx-2 rounded-md {{ request()->routeIs('home') ? 'bg-[#B9FF66]/20 text-dark font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} text-base">
                        Home
                    </a>
                    @guest
                        <a href="{{ route('job-seeker.dashboard') }}" class="block pl-3 pr-4 py-2 mx-2 rounded-md {{ request()->routeIs('job-seeker.*') ? 'bg-[#B9FF66]/20 text-dark font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} text-base">
                            Job Seekers
                        </a>
                        <a href="{{ route('recruiter.dashboard') }}" class="block pl-3 pr-4 py-2 mx-2 rounded-md {{ request()->routeIs('recruiter.*') ? 'bg-[#B9FF66]/20 text-dark font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} text-base">
                            Recruiters
                        </a>
                    @else
                        @if(Auth::user()->hasRole('recruiter'))
                            <a href="{{ route('recruiter.dashboard') }}" class="block pl-3 pr-4 py-2 mx-2 rounded-md {{ request()->routeIs('recruiter.*') ? 'bg-[#B9FF66]/20 text-dark font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} text-base">
                                Dashboard
                            </a>
                        @elseif(Auth::user()->hasRole('job_seeker'))
                            <a href="{{ route('job-seeker.dashboard') }}" class="block pl-3 pr-4 py-2 mx-2 rounded-md {{ request()->routeIs('job-seeker.*') ? 'bg-[#B9FF66]/20 text-dark font-medium' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-800' }} text-base">
                                Dashboard
                            </a>
                        @endif
                    @endguest
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200 bg-white bg-opacity-90 backdrop-blur-sm">
                    <div class="flex items-center px-4">
                        @guest
                            <a href="{{ route('login') }}" class="block text-center w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                Sign In
                            </a>
                        @else
                            <div class="flex-shrink-0 h-8 w-8 bg-[#B9FF66] rounded-full flex items-center justify-center mr-3">
                                <span class="text-dark font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-dark">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        @endguest
                    </div>
                    
                    @auth
                    <div class="mt-3 space-y-1 px-2">
                        <a href="{{ Auth::user()->isRecruiter() ? route('recruiter.profile') : route('job-seeker.profile') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-dark hover:bg-[#B9FF66]/20 transition">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-dark hover:bg-[#B9FF66]/20 transition">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </div>
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @if (session('success'))
                <div class="bg-[#d4ffab] border-l-4 border-[#B9FF66] text-dark p-4 mb-4 container mx-auto mt-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 container mx-auto mt-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white mt-12 py-8 border-t border-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between">
                    <div class="max-w-md mb-6 md:mb-0">
                        <h3 class="text-lg font-semibold text-dark mb-4">
                            <img src="{{ asset('images/svg/site-logo.png') }}" alt="Smart Connect" class="h-[100px]">
                        </h3>
                        <p class="text-gray-500 text-sm mb-4">
                            Revolutionizing the way recruiters and job seekers connect through AI-powered CV analysis.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-dark mb-4">Contact</h4>
                        <ul class="space-y-2">
                            <li class="text-gray-500 text-sm">Email: info@smartconnect.com</li>
                            <li class="text-gray-500 text-sm">Phone: +389 77 123 456</li>
                            <li class="text-gray-500 text-sm">Address: 123 Skopje</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 pt-4 border-t border-gray-200">
                    <p class="text-gray-500 text-sm text-center">&copy; {{ date('Y') }} Smart Connect. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
                    // Toggle the menu button icons
                    const openIcon = mobileMenuButton.querySelector('.block');
                    const closeIcon = mobileMenuButton.querySelector('.hidden');
                    
                    if (openIcon && closeIcon) {
                        openIcon.classList.toggle('block');
                        openIcon.classList.toggle('hidden');
                        closeIcon.classList.toggle('block');
                        closeIcon.classList.toggle('hidden');
                    }
                });
            }
            
            // User dropdown toggle
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');
            
            if (userMenuButton && userMenuDropdown) {
                userMenuButton.addEventListener('click', function() {
                    userMenuDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                        userMenuDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    
    <!-- Livewire Scripts -->
    @livewireScripts
    
    @stack('scripts')
</body>
</html> 