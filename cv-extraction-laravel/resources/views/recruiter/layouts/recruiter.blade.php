@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="{{ isset($fullWidthLayout) && $fullWidthLayout ? '' : 'max-w-7xl mx-auto' }} px-2 sm:px-4 lg:px-6 py-10">
        <!-- Layout with Sidebar -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            @include('recruiter.partials.sidebar')
            
            <!-- Main Content -->
            <div class="w-full md:flex-1 md:min-w-0">
                @yield('recruiter-content')
            </div>
        </div>
    </div>
</div>
@endsection 