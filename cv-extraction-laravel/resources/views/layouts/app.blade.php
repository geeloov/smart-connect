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
    
    <!-- Alpine.js x-cloak style to prevent flickering -->
    <style>
        [x-cloak] { display: none !important; }
    </style>

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
        
        /* Modern Navbar Styles */
        .navbar-modern {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .navbar-modern:hover {
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .navbar-container {
            max-width: 1400px;
            padding: 0 2rem;
        }
        
        /* Logo Animation */
        .logo-animate {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .logo-animate:hover {
            transform: scale(1.05);
            filter: brightness(1.05);
        }
        
        /* Navigation Links */
        .nav-item {
            position: relative;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            margin: 0 0.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            letter-spacing: 0.01em;
            padding: 0.75rem 0.75rem;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            z-index: 1;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #B9FF66 0%, #A0E85C 100%);
            border-radius: 3px;
            opacity: 0;
            transform: translateX(-50%);
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: -1;
        }
        
        .nav-link:hover {
            color: #191A23;
            transform: translateY(-1px);
        }
        
        .nav-link:hover::before {
            width: 70%;
            opacity: 1;
        }
        
        .nav-link.active {
            color: #191A23;
            font-weight: 600;
        }
        
        .nav-link.active::before {
            width: 70%;
            opacity: 1;
        }
        
        /* Central Navigation */
        .central-nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Sign In Button */
        .nav-button {
            background: linear-gradient(135deg, #B9FF66 0%, #A0E85C 100%);
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            color: #191A23;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 12px rgba(185, 255, 102, 0.25);
            border: 2px solid transparent;
        }
        
        .nav-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(185, 255, 102, 0.35);
            background: linear-gradient(135deg, #C5FF7A 0%, #B0F56C 100%);
        }
        
        .nav-button:active {
            transform: translateY(0);
        }
        
        /* User Menu */
        .user-avatar {
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid transparent;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
            border-color: rgba(185, 255, 102, 0.5);
        }
        
        .user-dropdown {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(229, 231, 235, 0.5);
            overflow: hidden;
            transform-origin: top right;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform: scale(0.95);
            opacity: 0;
            pointer-events: none;
        }
        
        .user-dropdown.active {
            transform: scale(1);
            opacity: 1;
            pointer-events: auto;
        }
        
        .dropdown-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .dropdown-item:hover {
            background-color: rgba(185, 255, 102, 0.1);
            border-left-color: #B9FF66;
        }
        
        /* Mobile Menu */
        .mobile-menu-container {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 0;
        }
        
        .mobile-menu-container.active {
            max-height: 500px;
        }
        
        .mobile-menu-button {
            border-radius: 8px;
            transition: all 0.35s ease;
        }
        
        .mobile-menu-button:hover {
            background-color: rgba(185, 255, 102, 0.15);
        }
        
        .mobile-nav-item {
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            margin: 0.35rem 0;
        }
        
        .mobile-nav-item:hover, .mobile-nav-item.active {
            background-color: rgba(185, 255, 102, 0.15);
            border-left-color: #B9FF66;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .central-nav {
                display: none;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50">
        <!-- Modern Navigation -->
        <nav class="navbar-modern sticky top-0 z-50">
            <div class="navbar-container mx-auto">
                <div class="flex justify-between items-center h-20 relative">
                    <!-- Logo Section -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="font-bold text-dark logo-animate flex items-center">
                            <img src="{{ asset('images/svg/site-logo.png') }}" alt="Smart Connect" class="h-[100px]">
                        </a>
                    </div>
                    
                    <!-- Central Navigation Links -->
                    <div class="central-nav">
                        <div class="flex items-center space-x-1">
                            <div class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link text-sm tracking-wide {{ request()->routeIs('home') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                    Home
                                </a>
                            </div>
                            
                            @guest
                                <div class="nav-item">
                                    <a href="{{ route('job-seeker.dashboard') }}" class="nav-link text-sm tracking-wide {{ request()->routeIs('job-seeker.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                        Job Seekers
                                    </a>
                                </div>
                                <div class="nav-item">
                                    <a href="{{ route('recruiter.dashboard') }}" class="nav-link text-sm tracking-wide {{ request()->routeIs('recruiter.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                        Recruiters
                                    </a>
                                </div>
                            @else
                                @if(Auth::user()->hasRole('recruiter'))
                                    <div class="nav-item">
                                        <a href="{{ route('recruiter.dashboard') }}" class="nav-link text-sm tracking-wide {{ request()->routeIs('recruiter.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                            Dashboard
                                        </a>
                                    </div>
                                @elseif(Auth::user()->hasRole('job_seeker'))
                                    <div class="nav-item">
                                        <a href="{{ route('job-seeker.dashboard') }}" class="nav-link text-sm tracking-wide {{ request()->routeIs('job-seeker.*') ? 'active' : 'text-gray-700 hover:text-dark' }}">
                                            Dashboard
                                        </a>
                                    </div>
                                @endif
                            @endguest
                        </div>
                    </div>
                    
                    <!-- Right Section: User Actions -->
                    <div class="flex items-center">
                        @guest
                            <a href="{{ route('login') }}" class="nav-button flex items-center">
                                <span>Sign In</span>
                            </a>
                        @else
                            <div class="hidden md:flex items-center mr-4">
                                @if(Auth::user()->hasRole('recruiter'))
                                    @livewire('recruiter-notifications')
                                @elseif(Auth::user()->hasRole('job_seeker'))
                                    @livewire('job-seeker-notifications')
                                @endif
                            </div>
                            
                            <div class="relative">
                                <button type="button" class="flex items-center space-x-2 focus:outline-none group" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <div class="user-avatar flex-shrink-0 h-9 w-9 bg-[#B9FF66] rounded-full flex items-center justify-center">
                                        <span class="text-dark font-bold text-xs">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="ml-2 text-sm font-medium text-dark hidden md:block">{{ Auth::user()->name }}</span>
                                    <svg class="h-4 w-4 text-gray-500 transition-transform duration-300 group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <!-- User Dropdown Menu -->
                                <div class="user-dropdown absolute right-0 mt-3 w-56 bg-white rounded-xl py-2 focus:outline-none" id="user-menu-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <!-- Profile link -->
                                    <a href="{{ Auth::user()->isRecruiter() ? route('recruiter.profile') : route('job-seeker.profile') }}" class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-dark" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Profile</span>
                                    </a>
                                    
                                    <!-- Logout form -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item flex items-center w-full text-left px-4 py-3 text-sm text-gray-700 hover:text-dark" role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center lg:hidden ml-4">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Container -->
            <div class="mobile-menu-container lg:hidden" id="mobile-menu">
                <div class="px-4 pt-3 pb-4">
                    <a href="{{ route('home') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('home') ? 'active bg-[#B9FF66]/15 font-medium' : 'text-gray-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Home
                    </a>
                    
                    @guest
                        <a href="{{ route('job-seeker.dashboard') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('job-seeker.*') ? 'active bg-[#B9FF66]/15 font-medium' : 'text-gray-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Job Seekers
                        </a>
                        <a href="{{ route('recruiter.dashboard') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('recruiter.*') ? 'active bg-[#B9FF66]/15 font-medium' : 'text-gray-600' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Recruiters
                        </a>
                    @else
                        @if(Auth::user()->hasRole('recruiter'))
                            <a href="{{ route('recruiter.dashboard') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('recruiter.*') ? 'active bg-[#B9FF66]/15 font-medium' : 'text-gray-600' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                                Dashboard
                            </a>
                        @elseif(Auth::user()->hasRole('job_seeker'))
                            <a href="{{ route('job-seeker.dashboard') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('job-seeker.*') ? 'active bg-[#B9FF66]/15 font-medium' : 'text-gray-600' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                </svg>
                                Dashboard
                            </a>
                        @endif
                    @endguest
                </div>
                
                <div class="border-t border-gray-200 pt-4 pb-5 px-4">
                    <div class="flex items-center">
                        @guest
                            <a href="{{ route('login') }}" class="block text-center w-full px-4 py-3 text-sm font-medium rounded-lg shadow-sm text-dark bg-[#B9FF66] hover:bg-[#a7e85c]">
                                Sign In
                            </a>
                        @else
                            <div class="flex-shrink-0 h-10 w-10 bg-[#B9FF66] rounded-full flex items-center justify-center mr-3">
                                <span class="text-dark font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-dark">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        @endguest
                    </div>
                    
                    @auth
                    <div class="mt-5 space-y-1">
                        <a href="{{ Auth::user()->isRecruiter() ? route('recruiter.profile') : route('job-seeker.profile') }}" class="mobile-nav-item flex items-center px-4 py-3 rounded-lg text-sm text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="mobile-nav-item flex items-center w-full text-left px-4 py-3 rounded-lg text-sm text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Sign Out
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle with animation
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                    
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
            
            // User dropdown toggle with animation
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');
            
            if (userMenuButton && userMenuDropdown) {
                userMenuButton.addEventListener('click', function() {
                    userMenuDropdown.classList.toggle('active');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                        userMenuDropdown.classList.remove('active');
                    }
                });
            }
            
            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 10) {
                        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.08)';
                        navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
                    } else {
                        navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.03)';
                        navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
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