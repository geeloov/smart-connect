@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 py-10">
        <!-- Layout with Sidebar -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            @include('job-seeker.partials.sidebar')
            
            <!-- Main Content -->
            <div class="w-full md:w-5/6">
                @yield('job-seeker-content')
            </div>
        </div>
    </div>
</div>
@endsection 