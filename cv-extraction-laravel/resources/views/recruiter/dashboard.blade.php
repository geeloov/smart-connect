@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-dark mb-6">Recruiter Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Job Positions</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $totalJobPositions }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Active Job Positions</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $activeJobPositions }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-light rounded-xl shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-[#B9FF66] bg-opacity-20 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Applications</p>
                    <h3 class="text-2xl font-bold text-dark">{{ $totalApplications }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('recruiter.job-positions.create') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">Post New Job</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Create a new job position</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('recruiter.cv-extraction') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">Extract CV</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Process a CV with AI</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('recruiter.applications.index') }}" class="bg-light rounded-xl shadow-sm p-6 hover:bg-[#B9FF66] transition-colors group">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-white mr-4 group-hover:bg-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-dark">View Applications</h3>
                    <p class="text-gray-500 text-sm group-hover:text-dark transition-colors">Manage candidate applications</p>
                </div>
            </div>
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Recent Job Positions -->
        <div class="bg-light rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-dark">Recent Job Positions</h2>
                <a href="{{ route('recruiter.job-positions.index') }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($recentJobPositions as $jobPosition)
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-dark">{{ $jobPosition->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $jobPosition->company_name }} • {{ $jobPosition->location }}</p>
                        </div>
                        <div>
                            @if($jobPosition->is_active)
                            <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Active</span>
                            @else
                            <span class="inline-block bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Inactive</span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Posted {{ $jobPosition->created_at->diffForHumans() }}</span>
                        <a href="{{ route('recruiter.job-positions.show', $jobPosition) }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <p class="text-gray-500">No job positions yet. <a href="{{ route('recruiter.job-positions.create') }}" class="text-[#B9FF66] hover:underline">Create your first job position</a>.</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Recent Applications -->
        <div class="bg-light rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-dark">Recent Applications</h2>
                <a href="{{ route('recruiter.applications.index') }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                    View All
                </a>
            </div>
            
            <div class="divide-y divide-gray-200">
                @forelse($recentApplications as $application)
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-medium text-dark">{{ $application->jobSeeker->name }}</h3>
                            <p class="text-sm text-gray-500">Applied for: {{ $application->jobPosition->title }}</p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'reviewed' => 'bg-blue-100 text-blue-800',
                                    'shortlisted' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    'hired' => 'bg-purple-100 text-purple-800',
                                ];
                                $statusColor = $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-block {{ $statusColor }} text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-xs text-gray-500">Applied {{ $application->created_at->diffForHumans() }}</span>
                        <a href="{{ route('recruiter.applications.show', $application) }}" class="text-dark hover:text-[#B9FF66] transition-colors text-sm font-medium">
                            View Application
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center">
                    <p class="text-gray-500">No applications yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 