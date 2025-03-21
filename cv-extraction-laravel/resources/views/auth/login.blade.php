@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8 relative overflow-hidden" style="min-height: calc(100vh - 160px);">
    <!-- Background Circles - Constrained to parent container -->
    <div class="absolute top-0 left-0 w-[300px] h-[300px] bg-[#B9FF66]/10 rounded-full -translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[350px] h-[350px] bg-[#B9FF66]/10 rounded-full translate-x-1/4 translate-y-1/4 pointer-events-none"></div>
    
    <div class="max-w-md w-full bg-white rounded-2xl border-2 border-[#191A23] transform transition-all duration-300 hover:-translate-y-1 z-10 my-8" style="box-shadow: 0px 8px 0px 0 #191a23;">
        <div class="px-6 sm:px-8 pt-8 pb-4">
            <div class="text-center mb-8">
                <div class="inline-block px-5 py-3 rounded-[10px] bg-[#B9FF66] mb-4 transform transition-all duration-300 hover:scale-[1.02] shadow-md" style="box-shadow: 0px 4px 0px 0 #191a23;">
                    <h2 class="text-2xl font-bold text-dark">Sign In</h2>
                </div>
                <p class="text-gray-600 mt-2">Welcome back to <span class="text-[#B9FF66] font-semibold">Smart</span> <span class="font-semibold">Connect</span></p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-dark mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none transition-colors"
                            placeholder="your@email.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-dark mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember" class="h-4 w-4 text-[#B9FF66] focus:ring-[#B9FF66] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-sm font-medium text-[#191A23] hover:text-[#B9FF66] transition-colors">Forgot password?</a>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border-2 border-[#191A23] rounded-xl text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66] transition-all duration-200 font-semibold transform hover:-translate-y-1" style="box-shadow: 0px 4px 0px 0 #191a23;">
                        Sign In
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-gray-50 px-6 sm:px-8 py-6 border-t-2 border-gray-100">
            <p class="text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#191A23] font-semibold hover:text-[#B9FF66] transition-colors">
                    Sign Up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection 