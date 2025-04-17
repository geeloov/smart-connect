@extends('job-seeker.layouts.job-seeker')

@section('job-seeker-content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-dark">Job Matches</h1>
        <a href="{{ route('job-seeker.dashboard') }}" class="text-dark hover:text-[#B9FF66] transition-colors flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-dark">Your Job Matches</h2>
                <p class="text-gray-500">Based on your CV and preferences</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Filter by:</span>
                    <select class="rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50 text-sm">
                        <option>All Matches</option>
                        <option>Strong Matches (80%+)</option>
                        <option>Good Matches (60-79%)</option>
                        <option>Fair Matches (40-59%)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Job Matches List -->
        <div class="space-y-6">
            <!-- Job Match 1 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark">Senior Frontend Developer</h3>
                                <p class="text-gray-500 text-sm">TechCorp Inc. • Remote</p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-2">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">JavaScript</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">React</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">TypeScript</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Redux</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-end">
                        <div class="flex items-center mb-2">
                            <span class="text-sm font-medium text-dark mr-2">Match Score:</span>
                            <span class="text-sm font-bold text-green-600">92%</span>
                        </div>
                        <div class="w-full md:w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
                        </div>
                        <span class="mt-1 text-xs text-green-600">Strong Match</span>
                        <a href="#" class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Match 2 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark">Full Stack Developer</h3>
                                <p class="text-gray-500 text-sm">InnovateSoft • New York, NY</p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-2">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">JavaScript</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Node.js</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">MongoDB</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Express</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-end">
                        <div class="flex items-center mb-2">
                            <span class="text-sm font-medium text-dark mr-2">Match Score:</span>
                            <span class="text-sm font-bold text-blue-600">78%</span>
                        </div>
                        <div class="w-full md:w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                        </div>
                        <span class="mt-1 text-xs text-blue-600">Good Match</span>
                        <a href="#" class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Job Match 3 -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark">UI/UX Developer</h3>
                                <p class="text-gray-500 text-sm">DesignHub • San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-2">
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">HTML/CSS</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">JavaScript</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Figma</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">UI Design</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-end">
                        <div class="flex items-center mb-2">
                            <span class="text-sm font-medium text-dark mr-2">Match Score:</span>
                            <span class="text-sm font-bold text-yellow-600">55%</span>
                        </div>
                        <div class="w-full md:w-32 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 55%"></div>
                        </div>
                        <span class="mt-1 text-xs text-yellow-600">Fair Match</span>
                        <a href="#" class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> results
                    </p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" aria-current="page" class="z-10 bg-[#B9FF66] border-[#B9FF66] text-dark relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            1
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            2
                        </a>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            3
                        </a>
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                            ...
                        </span>
                        <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                            4
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Match Insights -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Match Insights</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">JavaScript</span>
                        <span class="text-sm text-gray-500">92% match</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 92%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">React</span>
                        <span class="text-sm text-gray-500">85% match</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">Node.js</span>
                        <span class="text-sm text-gray-500">78% match</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 78%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm font-medium text-gray-700">UI/UX Design</span>
                        <span class="text-sm text-gray-500">55% match</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 55%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Recommended Skills</h3>
            <p class="text-sm text-gray-600 mb-4">Improve your match scores by developing these skills:</p>
            <ul class="space-y-2">
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-gray-700">TypeScript</span>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-gray-700">Redux</span>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-gray-700">GraphQL</span>
                </li>
                <li class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#B9FF66] mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm text-gray-700">Docker</span>
                </li>
            </ul>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="#" class="text-sm font-medium text-[#B9FF66] hover:text-[#a7e85c]">View skill development resources →</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-dark mb-4">Job Market Trends</h3>
            <p class="text-sm text-gray-600 mb-4">Based on your profile and current market demand:</p>
            <div class="space-y-4">
                <div>
                    <h4 class="font-medium text-dark text-sm">Most In-Demand Skills</h4>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">React</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">TypeScript</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Node.js</span>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-dark text-sm">Emerging Technologies</h4>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">Web3</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">AI/ML</span>
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">AR/VR</span>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-dark text-sm">Salary Range</h4>
                    <p class="text-sm text-gray-600 mt-1">$85,000 - $120,000 based on your experience</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="#" class="text-sm font-medium text-[#B9FF66] hover:text-[#a7e85c]">View full market report →</a>
            </div>
        </div>
    </div>
</div>
@endsection 