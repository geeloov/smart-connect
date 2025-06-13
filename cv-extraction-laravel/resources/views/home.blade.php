@extends('layouts.app')

@section('content')
<style>
.aspect-w-16 {
  position: relative;
  padding-bottom: calc(var(--tw-aspect-h) / var(--tw-aspect-w) * 100%);
  --tw-aspect-w: 16;
}
.aspect-h-12 {
  --tw-aspect-h: 12;
}
.aspect-w-16 > * {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}
</style>

<div class="bg-[#F3F3F3] min-h-screen">
    <!-- Hero Section -->
    <section class="py-12 relative overflow-hidden">
        <!-- Background elements - standardized (unchanged) -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <!-- Hero Content Container -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative">
            <!-- Decorative Elements - More Subtle -->
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-[#B9FF66]/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-[#B9FF66]/10 rounded-full blur-3xl"></div>
            
            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <!-- Left Content Column -->
                <div class="md:col-span-6 order-2 md:order-1 z-10">
                    <!-- Badge - More Compact -->
                    <div class="inline-flex items-center mb-4 px-3 py-1.5 bg-[#B9FF66]/20 rounded-full">
                        <svg class="w-3.5 h-3.5 mr-1.5 text-[#191A23]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7L12 3L4 7V17L12 21L20 17V7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12L12 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12L20 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 12L4 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-sm font-medium tracking-wide text-[#191A23]">AI-Powered Technology</span>
                    </div>
                    
                    <!-- Main Heading - More Compact -->
                    <div class="relative mb-5">
                        <div class="relative w-4/5 bg-[#B9FF66] rounded-xl px-5 py-4 sm:px-6 shadow-md" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#191A23] leading-tight">
                                Transform CV <br class="hidden sm:block">analysis with <span class="underline decoration-[#191A23] decoration-2 underline-offset-2">AI</span>
                            </h1>
                        </div>
                    </div>
                    
                    <!-- Description - More Concise -->
                    <div class="mb-6">
                        <p class="text-[#191A23] text-base sm:text-lg font-light mb-1.5 leading-relaxed max-w-md">
                            Our <span class="font-medium">AI-powered CV extraction tool</span> helps recruiters and job seekers analyze resumes efficiently.
                        </p>
                        <p class="text-[#191A23]/80 text-sm sm:text-base mb-0 max-w-md leading-relaxed">
                            Extract structured data and match candidates to job descriptions with precision.
                        </p>
                    </div>
                    
                    <!-- Action Buttons - More Compact -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                        <!-- Primary CTA Button -->
                        <a href="{{ route('cv-extraction.index') }}" class="group relative inline-flex items-center justify-center bg-[#B9FF66] text-[#191A23] font-semibold py-2.5 px-5 rounded-lg border-2 border-[#191A23] transition-all duration-300 transform hover:-translate-y-1 active:translate-y-0" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <span class="relative flex items-center text-sm">
                                <span class="mr-1.5">Try CV Extraction Tool</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </a>
                        
                        <!-- Secondary Action Button -->
                        <a href="#features" class="group relative inline-flex items-center justify-center bg-white text-[#191A23] font-semibold py-2.5 px-5 rounded-lg border-2 border-[#191A23] transition-all duration-300 transform hover:-translate-y-1 active:translate-y-0" style="box-shadow: 0px 3px 0px 0 #191a23;">
                            <span class="absolute -inset-0 rounded-lg bg-gradient-to-r from-white via-[#B9FF66]/10 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-sm"></span>
                            <span class="relative flex items-center text-sm">
                                <span class="mr-1.5">Learn More</span>
                                <svg class="w-4 h-4 transform transition-transform duration-300 group-hover:rotate-45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4V20M12 4L6 10M12 4L18 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                    
                    <!-- Stats Indicators - More Subtle -->
                    <div class="flex items-center mt-6 space-x-5">
                        <div class="flex items-center">
                            <div class="text-xl font-bold text-[#191A23]">99%</div>
                            <div class="ml-1.5 text-xs text-[#191A23]/70">Accuracy Rate</div>
                        </div>
                        <div class="w-px h-8 bg-[#191A23]/10"></div>
                        <div class="flex items-center">
                            <div class="text-xl font-bold text-[#191A23]">5</div>
                            <div class="ml-1.5 text-xs text-[#191A23]/70">CVs Processed</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Image Column - More Compact -->
                <div class="md:col-span-6 order-1 md:order-2 relative z-10">
                    <!-- Background Glow Effect - More Subtle -->
                    <div class="absolute -z-10 w-full h-full bg-gradient-to-tr from-[#B9FF66]/20 via-[#B9FF66]/5 to-transparent rounded-full blur-2xl opacity-60 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 animate-pulse-slow"></div>
                    
                    <!-- Main Image Container - More Compact -->
                    <div class="relative group transform transition-all duration-500 hover:-translate-y-1">
                        <!-- Main Image Frame -->
                        <div class="relative border-2 border-[#191A23] rounded-xl overflow-hidden bg-white" style="box-shadow: 0px 6px 0px 0 #191a23;">
                            <!-- Progress Bar -->
                            <div class="absolute top-0 left-0 right-0 h-0.5 z-10">
                                <div class="h-full bg-[#B9FF66] w-0 group-hover:w-full transition-all duration-1500 ease-out"></div>
                            </div>
                            
                            <!-- Image Content -->
                            <div class="p-5 pb-3">
                                <div class="aspect-w-16 aspect-h-12">
                                    <img src="{{ asset('images/svg/cv-extraction-illustration.svg') }}" alt="CV Extraction Illustration" class="w-full max-w-md mx-auto object-contain transform transition-transform duration-700 group-hover:scale-105">
                                </div>
                                
                                <!-- Interactive Elements - Minimalist -->
                                <div class="mt-2 p-2 bg-[#F9F9F9] rounded-md border border-[#191A23]/10 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="flex items-center">
                                        <div class="w-1.5 h-1.5 bg-[#B9FF66] rounded-full mr-1.5"></div>
                                        <div class="text-xs font-medium text-[#191A23]/70">Processing CV data...</div>
                                        <div class="ml-auto text-xs font-mono text-[#191A23]/50">72%</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Badge - Smaller -->
                            <div class="absolute top-0 right-0 bg-[#B9FF66] border-l-2 border-b-2 border-[#191A23] rounded-bl-lg px-3 py-1.5 transform transition-transform duration-300 group-hover:scale-105 origin-top-right">
                                <span class="text-xs font-bold text-[#191A23] flex items-center">
                                    <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 16V12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    AI Powered
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Animation Styles - Simplified -->
        <style>
            @keyframes pulse-slow {
                0%, 100% { opacity: 0.5; transform: scale(1); }
                50% { opacity: 0.7; transform: scale(1.03); }
            }
            .animate-pulse-slow {
                animation: pulse-slow 4s infinite;
            }
            
            @keyframes gradient-x {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .animate-gradient-x {
                background-size: 200% 100%;
                animation: gradient-x 15s ease infinite;
            }
        </style>
    </section>

    <!-- Trusted By Section -->
    <section class="py-12 relative overflow-hidden">
        <!-- Background elements - standardized -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-center text-lg font-medium text-[#191A23] mb-8">Trusted by professionals from</h3>
            
            <style>
                @keyframes slide-left {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                
                .animate-slide-left {
                    animation: slide-left 25s linear infinite;
                }
                
                .group:hover .group-hover\:animation-pause {
                    animation-play-state: paused;
                }
            </style>
            
            <div class="relative group overflow-hidden whitespace-nowrap py-8 [mask-image:_linear-gradient(to_right,_transparent_0,_white_100px,white_calc(100%-100px),_transparent_100%)]">
                <div class="animate-slide-left group-hover:animation-pause inline-block w-max">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                </div>
                
                <!-- Duplicate for seamless looping -->
                <div class="animate-slide-left group-hover:animation-pause inline-block w-max">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://brainster.co/wp-content/uploads/2021/08/Brainster.co_.png" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpsc-Qyo7jAHw0BTJohnizRBDcBvZnsxdfew&s" alt="Company Logo" class="mx-10 inline-block h-[90px] opacity-80 hover:opacity-100 transition-all">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section - Modern & Futuristic Design -->
    <section id="features" class="py-12 relative">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header with Animated Gradient -->
            <div class="mb-16 text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center mb-3 px-4 py-1.5 bg-[#B9FF66]/20 border border-[#B9FF66] rounded-full">
                    <span class="text-sm font-semibold text-[#191A23] uppercase tracking-wider">Powerful Features</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#191A23] via-[#303140] to-[#191A23] animate-gradient-x">
                    Advanced AI Tools
                </h2>
                <p class="text-[#191A23]/80 text-lg md:text-xl leading-relaxed">
                    Our intelligent CV extraction system uses cutting-edge AI to transform how you analyze resumes,
                    making recruitment smarter, faster, and more effective.
                </p>
            </div>

            <!-- Features Grid with Hover Effects and Modern Card Design -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1: Data Extraction -->
                <div class="group relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/30 hover:shadow-lg transition-all duration-500">
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-[28px] p-8 h-full flex flex-col hover:bg-gradient-to-b hover:from-white hover:to-white/90 border border-[#191A23]/10 transition-all duration-300">
                        <!-- Icon with animated background -->
                        <div class="absolute -right-3 -top-3 w-20 h-20">
                            <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-white rounded-2xl border border-[#191A23] shadow-md flex items-center justify-center rotate-6 group-hover:rotate-0 transition-all duration-300" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <img src="{{ asset('images/svg/data-extraction-ilustration.svg') }}" alt="Data Extraction" class="w-10 h-10 object-contain">
                            </div>
                        </div>
                        
                        <!-- Feature number - Enhanced Visibility -->
                        <div class="text-7xl font-extrabold text-[#191A23]/20 group-hover:text-[#B9FF66]/50 mb-6 transition-colors duration-300 relative">
                            <span class="absolute -inset-1 blur-sm bg-gradient-to-r from-[#B9FF66]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl"></span>
                            <span class="relative">01</span>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-[#191A23] mb-4 group-hover:text-[#191A23] transition-colors">Data Extraction</h3>
                        <p class="text-[#191A23]/70 mb-6 group-hover:text-[#191A23]/80 transition-colors">
                            Extract personal details, education, work experience, skills, and more from any PDF resume with state-of-the-art accuracy.
                        </p>
                        
                        <!-- Feature highlights -->
                        <div class="space-y-3 mb-6 mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Highly accurate parsing</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Supports multiple formats</span>
                            </div>
                        </div>
                        
                        <!-- Learn more link with animated arrow -->
                        <a href="#" class="flex items-center text-[#191A23] font-medium group/link">
                            <span>Learn more</span>
                            <span class="ml-2 inline-block group-hover/link:translate-x-1 transition-transform duration-200">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Feature 2: AI Analysis -->
                <div class="group relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/30 hover:shadow-lg transition-all duration-500">
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-[28px] p-8 h-full flex flex-col hover:bg-gradient-to-b hover:from-white hover:to-white/90 border border-[#191A23]/10 transition-all duration-300">
                        <!-- Icon with animated background -->
                        <div class="absolute -right-3 -top-3 w-20 h-20">
                            <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-white rounded-2xl border border-[#191A23] shadow-md flex items-center justify-center rotate-6 group-hover:rotate-0 transition-all duration-300" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <img src="{{ asset('images/svg/ai-analysis-ilustration.svg') }}" alt="AI Analysis" class="w-10 h-10 object-contain">
                            </div>
                        </div>
                        
                        <!-- Feature number - Enhanced Visibility -->
                        <div class="text-7xl font-extrabold text-[#191A23]/20 group-hover:text-[#B9FF66]/50 mb-6 transition-colors duration-300 relative">
                            <span class="absolute -inset-1 blur-sm bg-gradient-to-r from-[#B9FF66]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl"></span>
                            <span class="relative">02</span>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-[#191A23] mb-4 group-hover:text-[#191A23] transition-colors">AI Analysis</h3>
                        <p class="text-[#191A23]/70 mb-6 group-hover:text-[#191A23]/80 transition-colors">
                            Our sophisticated AI algorithms understand context and extract meaningful information from even the most complex CV formats.
                        </p>
                        
                        <!-- Feature highlights -->
                        <div class="space-y-3 mb-6 mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Contextual understanding</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Multi-language support</span>
                            </div>
                        </div>
                        
                        <!-- Learn more link with animated arrow -->
                        <a href="#" class="flex items-center text-[#191A23] font-medium group/link">
                            <span>Learn more</span>
                            <span class="ml-2 inline-block group-hover/link:translate-x-1 transition-transform duration-200">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Feature 3: Job Matching -->
                <div class="group relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/30 hover:shadow-lg transition-all duration-500">
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-[28px] p-8 h-full flex flex-col hover:bg-gradient-to-b hover:from-white hover:to-white/90 border border-[#191A23]/10 transition-all duration-300">
                        <!-- Icon with animated background -->
                        <div class="absolute -right-3 -top-3 w-20 h-20">
                            <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                            <div class="relative w-16 h-16 bg-white rounded-2xl border border-[#191A23] shadow-md flex items-center justify-center rotate-6 group-hover:rotate-0 transition-all duration-300" style="box-shadow: 0px 3px 0px 0 #191a23;">
                                <img src="{{ asset('images/svg/job-matching-ilustration.svg') }}" alt="Job Matching" class="w-10 h-10 object-contain">
                            </div>
                        </div>
                        
                        <!-- Feature number - Enhanced Visibility -->
                        <div class="text-7xl font-extrabold text-[#191A23]/20 group-hover:text-[#B9FF66]/50 mb-6 transition-colors duration-300 relative">
                            <span class="absolute -inset-1 blur-sm bg-gradient-to-r from-[#B9FF66]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl"></span>
                            <span class="relative">03</span>
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-2xl font-bold text-[#191A23] mb-4 group-hover:text-[#191A23] transition-colors">Job Matching</h3>
                        <p class="text-[#191A23]/70 mb-6 group-hover:text-[#191A23]/80 transition-colors">
                            Automatically match candidate resumes to job descriptions with precision scoring and comprehensive analysis.
                        </p>
                        
                        <!-- Feature highlights -->
                        <div class="space-y-3 mb-6 mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Detailed compatibility scores</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full bg-[#B9FF66] flex-shrink-0 flex items-center justify-center border border-[#191A23]/10">
                                    <svg class="w-2.5 h-2.5 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-sm text-[#191A23]/70">Skills gap analysis</span>
                            </div>
                        </div>
                        
                        <!-- Learn more link with animated arrow -->
                        <a href="#" class="flex items-center text-[#191A23] font-medium group/link">
                            <span>Learn more</span>
                            <span class="ml-2 inline-block group-hover/link:translate-x-1 transition-transform duration-200">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Additional Animation CSS -->
            <style>
                @keyframes gradient-x {
                    0% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                    100% { background-position: 0% 50%; }
                }
                .animate-gradient-x {
                    background-size: 200% 100%;
                    animation: gradient-x 15s ease infinite;
                }
            </style>
        </div>
    </section>

    <!-- How It Works Section - Modern & Futuristic Design -->
    <section id="how-it-works" class="py-12 relative overflow-hidden">
        <!-- Background elements - standardized -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="mb-20 text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center mb-3 px-4 py-1.5 bg-[#B9FF66]/20 border border-[#B9FF66] rounded-full">
                    <span class="text-sm font-semibold text-[#191A23] uppercase tracking-wider">Simple Process</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#191A23] via-[#303140] to-[#191A23] animate-gradient-x">
                    How It Works
                </h2>
                <p class="text-[#191A23]/80 text-lg md:text-xl leading-relaxed">
                    Extract structured data from resumes in just three simple steps with our advanced AI technology
                </p>
            </div>

            <!-- Steps with connecting lines -->
            <div class="relative">
                <!-- Desktop connecting lines (hidden on mobile) -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-[#B9FF66]/0 via-[#B9FF66] to-[#B9FF66]/0 transform -translate-y-1/2 z-0"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 relative z-10">
                    <!-- Step 1 -->
                    <div class="group relative">
                        <!-- Number indicator with pulsing effect -->
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 md:translate-x-0 md:left-auto md:right-10 z-20">
                            <div class="relative">
                                <div class="absolute inset-0 rounded-full bg-[#B9FF66] blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-500 animate-pulse"></div>
                                <div class="relative w-16 h-16 rounded-full bg-white border-2 border-[#191A23] flex items-center justify-center shadow-xl">
                                    <span class="text-2xl font-bold text-[#191A23]">01</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card -->
                        <div class="relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/10 group-hover:shadow-lg transition-all duration-500 transform group-hover:translate-y-[-0.5rem]">
                            <div class="bg-white rounded-[28px] p-8 pt-10 h-full border border-[#191A23]/10 backdrop-blur-sm">
                                <h3 class="text-2xl font-bold text-[#191A23] mb-3">Upload CV</h3>
                                <p class="text-[#191A23]/70 mb-5 group-hover:text-[#191A23]/80 transition-colors">
                                    Upload a PDF resume and optionally include a job description for matching and analysis.
                                </p>
                                
                                <!-- Visual element -->
                                <div class="flex justify-center mb-5 mt-8">
                                    <div class="w-20 h-20 rounded-xl bg-[#F9F9F9] border border-dashed border-[#191A23]/30 flex items-center justify-center group-hover:border-[#B9FF66] transition-colors duration-300">
                                        <svg class="w-10 h-10 text-[#191A23]/40 group-hover:text-[#191A23]/60 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="group relative">
                        <!-- Number indicator with pulsing effect -->
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 md:translate-x-0 md:left-auto md:right-10 z-20">
                            <div class="relative">
                                <div class="absolute inset-0 rounded-full bg-[#B9FF66] blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-500 animate-pulse"></div>
                                <div class="relative w-16 h-16 rounded-full bg-white border-2 border-[#191A23] flex items-center justify-center shadow-xl">
                                    <span class="text-2xl font-bold text-[#191A23]">02</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card -->
                        <div class="relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/10 group-hover:shadow-lg transition-all duration-500 transform group-hover:translate-y-[-0.5rem]">
                            <div class="bg-white rounded-[28px] p-8 pt-10 h-full border border-[#191A23]/10 backdrop-blur-sm">
                                <h3 class="text-2xl font-bold text-[#191A23] mb-3">AI Processing</h3>
                                <p class="text-[#191A23]/70 mb-5 group-hover:text-[#191A23]/80 transition-colors">
                                    Our AI analyzes the document, extracts key information, and structures the data intelligently.
                                </p>
                                
                                <!-- Visual element with animation -->
                                <div class="flex justify-center mb-5 mt-8">
                                    <div class="relative w-20 h-20 rounded-xl bg-[#F9F9F9] border border-[#191A23]/30 flex items-center justify-center overflow-hidden group-hover:border-[#B9FF66] transition-colors duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#B9FF66]/10 to-[#B9FF66]/20 animate-scan"></div>
                                        <svg class="w-10 h-10 text-[#191A23]/40 group-hover:text-[#191A23]/60 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="group relative">
                        <!-- Number indicator with pulsing effect -->
                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 md:translate-x-0 md:left-auto md:right-10 z-20">
                            <div class="relative">
                                <div class="absolute inset-0 rounded-full bg-[#B9FF66] blur-md opacity-50 group-hover:opacity-70 transition-opacity duration-500 animate-pulse"></div>
                                <div class="relative w-16 h-16 rounded-full bg-white border-2 border-[#191A23] flex items-center justify-center shadow-xl">
                                    <span class="text-2xl font-bold text-[#191A23]">03</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card -->
                        <div class="relative p-1 rounded-3xl bg-gradient-to-br from-[#B9FF66] via-[#B9FF66]/50 to-[#B9FF66]/10 group-hover:shadow-lg transition-all duration-500 transform group-hover:translate-y-[-0.5rem]">
                            <div class="bg-white rounded-[28px] p-8 pt-10 h-full border border-[#191A23]/10 backdrop-blur-sm">
                                <h3 class="text-2xl font-bold text-[#191A23] mb-3">View Results</h3>
                                <p class="text-[#191A23]/70 mb-5 group-hover:text-[#191A23]/80 transition-colors">
                                    Review extracted data in a structured format with comprehensive job matching analysis.
                                </p>
                                
                                <!-- Visual element with sparkle effect -->
                                <div class="flex justify-center mb-5 mt-8">
                                    <div class="relative w-20 h-20 rounded-xl bg-[#F9F9F9] border border-[#191A23]/30 flex items-center justify-center group-hover:border-[#B9FF66] transition-colors duration-300">
                                        <div class="absolute top-0 right-0 w-4 h-4 bg-[#B9FF66] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 animate-ping"></div>
                                        <svg class="w-10 h-10 text-[#191A23]/40 group-hover:text-[#191A23]/60 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile step arrows (visible only on mobile) -->
                <div class="flex flex-col items-center md:hidden">
                    <div class="w-0.5 h-8 bg-[#B9FF66] my-2"></div>
                    <div class="w-0.5 h-8 bg-[#B9FF66] my-2"></div>
                </div>
            </div>
            
            <!-- Additional Animation CSS -->
            <style>
                @keyframes scan {
                    0% { transform: translateY(-100%); }
                    100% { transform: translateY(100%); }
                }
                .animate-scan {
                    animation: scan 2s linear infinite;
                }
                
                @keyframes ping {
                    0% { transform: scale(1); opacity: 1; }
                    75%, 100% { transform: scale(2); opacity: 0; }
                }
                .animate-ping {
                    animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
                }
            </style>
        </div>
    </section>

    <!-- Use Cases Section - Modern & Futuristic Design -->
    <section id="use-cases" class="py-12 relative">
        <!-- Background elements - standardized -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="mb-16 md:mb-24 text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center mb-3 px-4 py-1.5 bg-[#B9FF66]/20 border border-[#B9FF66] rounded-full">
                    <span class="text-sm font-semibold text-[#191A23] uppercase tracking-wider">Perfect For</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#191A23] via-[#303140] to-[#191A23] animate-gradient-x">
                    Use Cases
                </h2>
                <p class="text-[#191A23]/80 text-lg md:text-xl leading-relaxed">
                    Our intelligent system is designed for professionals who need powerful CV analysis tools
                </p>
            </div>

            <!-- Use Cases Cards - Interactive & Modern -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-stretch">
                <!-- Use Case 1: Recruiters & HR Teams -->
                <div class="group relative">
                    <!-- Background glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-[#B9FF66]/30 to-transparent opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-700 rounded-3xl"></div>
                    
                    <!-- Card Container -->
                    <div class="relative bg-gradient-to-br p-1 from-white via-[#B9FF66]/30 to-white rounded-3xl transition-all duration-500 group-hover:shadow-lg h-full">
                        <div class="bg-white rounded-[28px] p-8 border border-[#191A23]/10 h-full flex flex-col">
                            <!-- Header with icon -->
                            <div class="flex items-start justify-between mb-8">
                                <div>
                                    <div class="text-sm text-[#191A23]/60 uppercase tracking-wider mb-2 font-medium">For</div>
                                    <h3 class="text-2xl font-bold text-[#191A23] relative">
                                        Recruiters & HR Teams
                                        <span class="absolute bottom-0 left-0 w-12 h-0.5 bg-[#B9FF66] group-hover:w-full transition-all duration-500"></span>
                                    </h3>
                                </div>
                                
                                <!-- Animated Icon -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                    <div class="relative w-16 h-16 bg-white rounded-xl border border-[#191A23]/20 flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-300 transform group-hover:rotate-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature points with modern styling -->
                            <div class="space-y-5 flex-1">
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">High-Volume Processing</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Process hundreds of applications quickly with AI-powered parsing</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">Automated Matching</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Match candidates to job requirements with precision scoring</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">Standardized Profiles</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Create uniform candidate profiles for consistent evaluation</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Footer -->
                            <div class="mt-8 pt-6 border-t border-[#191A23]/10">
                                <a href="{{ route('register') }}" class="inline-flex items-center text-[#191A23] font-medium group/link">
                                    <span>Create Recruiter Account</span>
                                    <span class="ml-2 inline-block group-hover/link:translate-x-1 transition-transform duration-200">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Use Case 2: Job Seekers -->
                <div class="group relative">
                    <!-- Background glow effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-[#B9FF66]/30 to-transparent opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-700 rounded-3xl"></div>
                    
                    <!-- Card Container -->
                    <div class="relative bg-gradient-to-br p-1 from-white via-[#B9FF66]/30 to-white rounded-3xl transition-all duration-500 group-hover:shadow-lg h-full">
                        <div class="bg-white rounded-[28px] p-8 border border-[#191A23]/10 h-full flex flex-col">
                            <!-- Header with icon -->
                            <div class="flex items-start justify-between mb-8">
                                <div>
                                    <div class="text-sm text-[#191A23]/60 uppercase tracking-wider mb-2 font-medium">For</div>
                                    <h3 class="text-2xl font-bold text-[#191A23] relative">
                                        Job Seekers
                                        <span class="absolute bottom-0 left-0 w-12 h-0.5 bg-[#B9FF66] group-hover:w-full transition-all duration-500"></span>
                                    </h3>
                                </div>
                                
                                <!-- Animated Icon -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-md opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                    <div class="relative w-16 h-16 bg-white rounded-xl border border-[#191A23]/20 flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-300 transform group-hover:rotate-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature points with modern styling -->
                            <div class="space-y-5 flex-1">
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">Job Compatibility</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Analyze your resume's compatibility with specific job postings</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">Skills Gap Analysis</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Identify missing skills and qualifications for target positions</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start p-4 rounded-xl transition-all duration-300 hover:bg-[#F9F9F9] group-hover:translate-x-1">
                                    <div class="mr-4 flex-shrink-0">
                                        <div class="w-8 h-8 bg-[#B9FF66]/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#191A23]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[#191A23] font-medium">Resume Enhancement</h4>
                                        <p class="text-[#191A23]/70 text-sm mt-1">Get tailored insights on improving your resume's effectiveness</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Footer -->
                            <div class="mt-8 pt-6 border-t border-[#191A23]/10">
                                <a href="{{ route('register') }}" class="inline-flex items-center text-[#191A23] font-medium group/link">
                                    <span>Create Job Seeker Account</span>
                                    <span class="ml-2 inline-block group-hover/link:translate-x-1 transition-transform duration-200">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Testimonials Section Placeholder -->
    <section id="testimonials" class="py-12 relative">
        <!-- Background elements - standardized -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="mb-16 text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center justify-center mb-3 px-4 py-1.5 bg-[#B9FF66]/20 border border-[#B9FF66] rounded-full">
                    <span class="text-sm font-semibold text-[#191A23] uppercase tracking-wider">User Feedback</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#191A23] via-[#303140] to-[#191A23] animate-gradient-x">
                    What Our Users Say
                </h2>
                <p class="text-[#191A23]/80 text-lg md:text-xl leading-relaxed">
                    Hear from professionals who have transformed their workflow with Smart Connect.
                </p>
            </div>

            <!-- Testimonial Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial Card 1 (Placeholder) -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-8 border border-[#191A23]/10 shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://t3.ftcdn.net/jpg/02/99/04/20/360_F_299042079_vGBD7wIlSeNl7vOevWHiL93G4koMM967.jpg" alt="Ethan K." class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-[#191A23]">Ethan K.</h4>
                            <p class="text-sm text-[#191A23]/70">Computer Science Student</p>
                        </div>
                    </div>
                    <p class="text-[#191A23]/80 italic">"As a student, finding relevant internships felt overwhelming. Smart Connect's AI helped me quickly identify opportunities that matched my skills and academic projects. The CV analysis feature gave me great insights too!"</p>
                </div>

                <!-- Testimonial Card 2 (Placeholder) -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-8 border border-[#191A23]/10 shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://t4.ftcdn.net/jpg/03/83/25/83/360_F_383258331_D8imaEMl8Q3lf7EKU2Pi78Cn0R7KkW9o.jpg" alt="Olivia B." class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-[#191A23]">Olivia B.</h4>
                            <p class="text-sm text-[#191A23]/70">Aspiring Full-Stack Developer</p>
                        </div>
                    </div>
                    <p class="text-[#191A23]/80 italic">"Smart Connect's ability to parse my technical skills from my CV and match them to job descriptions is impressive. It highlighted roles I wouldn't have found otherwise. A huge time saver in my job search."</p>
                </div>

                <!-- Testimonial Card 3 (Placeholder) -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-8 border border-[#191A23]/10 shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://plus.unsplash.com/premium_photo-1689977968861-9c91dbb16049?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8c21pbGluZyUyMHBlcnNvbnxlbnwwfHwwfHx8MA%3D%3D" alt="Liam S." class="w-12 h-12 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-semibold text-[#191A23]">Liam S.</h4>
                            <p class="text-sm text-[#191A23]/70">Talent Acquisition Specialist</p>
                        </div>
                    </div>
                    <p class="text-[#191A23]/80 italic">"We process a high volume of CVs, and Smart Connect has streamlined our initial screening significantly. The AI-driven data extraction is accurate and helps us create standardized candidate profiles much faster."</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Ready to Transform Section -->
    <section class="py-12 relative">
        <!-- Background elements - standardized with "Advanced AI Tools" section -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Modern CTA Card -->
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 bg-white/90 backdrop-blur-sm p-8 md:p-12 rounded-3xl border-2 border-[#191A23] shadow-[0_8px_0_0_#191A23]">
                    <!-- Left side with icon and title -->
                    <div class="w-full md:w-7/12 text-center md:text-left">
                        <!-- Icon in a highlighted circle -->
                        <div class="inline-flex mb-6 relative">
                            <div class="absolute inset-0 bg-[#B9FF66] rounded-full blur-md opacity-30"></div>
                            <div class="relative size-20 bg-[#B9FF66] rounded-full flex items-center justify-center border-2 border-[#191A23] shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Heading with gradient text to match other sections -->
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-[#191A23] via-[#303140] to-[#191A23] animate-gradient-x">
                            Ready to Transform?
                        </h2>
                        
                        <p class="text-[#191A23]/80 mb-8 md:mb-0 text-lg leading-relaxed">
                            Try our AI-powered CV extraction tool now and experience the difference in recruitment efficiency and candidate matching
                        </p>
                    </div>
                    
                    <!-- Right side with prominent CTA button -->
                    <div class="w-full md:w-5/12 flex justify-center md:justify-end">
                        <div class="relative group">
                            <!-- Button with clear boundaries -->
                            <a href="{{ route('cv-extraction.index') }}" class="inline-flex items-center justify-center bg-[#B9FF66] text-[#191A23] font-bold py-5 px-8 rounded-xl border-2 border-[#191A23] transition-all duration-200 transform hover:-translate-y-1 text-lg shadow-[0_5px_0_0_#191A23] hover:shadow-[0_3px_0_0_#191A23] active:shadow-none active:translate-y-1">
                                <span>Get Started Now</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer Section -->
    <section class="py-12 relative">
        <!-- Background elements - standardized with same pattern as other sections -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMxOTFBMjMiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDM0djZoNnYtNmgtNnptMi0yaDEwdjEwSDM4VjMyem0tMTYgMTZ2NmgxMHYtMTBoLTR2NGgtNnptMi0yaDZ2LTZoLTZ2NnptMzQtMzRoLTZ2NGg2di00em0yLTJoLTEwdjEwaDEwVjEwek0xMCAzNHY2aDZWMzRoLTZ6bTItMmgxMHYxMEgxMlYzMnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-16">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/svg/site-logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        </div>
                        <span class="text-xl font-bold text-[#191A23]">Smart Connect</span>
                    </div>
                    <p class="text-[#191A23]/70 text-sm mb-6">
                        Transforming the way recruiters and job seekers analyze and match CVs using advanced AI technology.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <ul class="space-y-3">
                        <li>
                            <a href="#features" class="text-[#191A23]/70 hover:text-[#191A23] text-sm transition-colors duration-200 flex items-center">
                                <span class="w-1.5 h-1.5 bg-[#B9FF66] rounded-full mr-2"></span>
                                Features
                            </a>
                        </li>
                        <li>
                            <a href="#how-it-works" class="text-[#191A23]/70 hover:text-[#191A23] text-sm transition-colors duration-200 flex items-center">
                                <span class="w-1.5 h-1.5 bg-[#B9FF66] rounded-full mr-2"></span>
                                How It Works
                            </a>
                        </li>
                        <li>
                            <a href="#use-cases" class="text-[#191A23]/70 hover:text-[#191A23] text-sm transition-colors duration-200 flex items-center">
                                <span class="w-1.5 h-1.5 bg-[#B9FF66] rounded-full mr-2"></span>
                                Use Cases
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact & Newsletter -->
                <div>
                    <div class="mb-6">
                        <p class="text-[#191A23]/70 text-sm mb-1">Email</p>
                        <a href="mailto:info@smartconnect.com" class="text-[#191A23] text-sm font-medium">info@smartconnect.com</a>
                    </div>
                    <div class="mb-6">
                        <p class="text-[#191A23]/70 text-sm mb-1">Phone</p>
                        <a href="tel:+38977123456" class="text-[#191A23] text-sm font-medium">+389 77 123 456</a>
                    </div>
                    <div>
                        <p class="text-[#191A23]/70 text-sm mb-4">Subscribe to our newsletter for the latest updates and features.</p>
                        <div class="flex items-center">
                            <input type="email" placeholder="Your email address" class="w-full px-4 py-2.5 bg-white border border-[#191A23]/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B9FF66] text-sm">
                            <button class="ml-2 bg-[#B9FF66] text-[#191A23] rounded-lg px-4 py-2.5 text-sm font-medium whitespace-nowrap">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="flex justify-start items-center gap-4 mt-10 mb-10">
                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center border border-[#191A23]/10 hover:bg-[#F9F9F9] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#191A23]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/>
                    </svg>
                </a>
                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center border border-[#191A23]/10 hover:bg-[#F9F9F9] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#191A23]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center border border-[#191A23]/10 hover:bg-[#F9F9F9] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#191A23]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                    </svg>
                </a>
                <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center border border-[#191A23]/10 hover:bg-[#F9F9F9] transition-colors duration-200">
                    <svg class="w-5 h-5 text-[#191A23]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.44a2.56 2.56 0 0 0-1.766 1.778C2 8.76 2 12 2 12s0 3.239.437 4.797c.24.85.97 1.536 1.767 1.763 1.568.434 7.831.44 7.831.44s6.265.007 7.831-.44a2.51 2.51 0 0 0 1.767-1.763C22 15.239 22 12 22 12s0-3.239-.437-4.797z"></path>
                        <path d="M9.998 15.505l5.205-3.505-5.205-3.505v7.01z" fill="white"></path>
                    </svg>
                </a>
            </div>

            <!-- Copyright and Extra Links -->
            <div class="flex flex-col md:flex-row justify-between items-center pt-6 border-t border-[#191A23]/5">
                <p class="text-[#191A23]/60 text-sm">
                    &copy; {{ date('Y') }} Smart Connect. All rights reserved.
                </p>
                <div class="flex flex-wrap gap-6 mt-4 md:mt-0">
                    <a href="#" class="text-[#191A23]/60 hover:text-[#191A23] text-sm transition-colors duration-200">
                        Privacy Policy
                    </a>
                    <a href="#" class="text-[#191A23]/60 hover:text-[#191A23] text-sm transition-colors duration-200">
                        Terms of Service
                    </a>
                    <a href="#" class="text-[#191A23]/60 hover:text-[#191A23] text-sm transition-colors duration-200">
                        Cookie Policy
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Chatbot Component -->
@include('components.chatbot')

@endsection