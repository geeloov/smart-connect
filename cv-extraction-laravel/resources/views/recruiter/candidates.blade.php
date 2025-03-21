@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-dark">Candidate Database</h1>
        <a href="{{ route('recruiter.dashboard') }}" class="text-dark hover:text-[#B9FF66] transition-colors flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search candidates..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#B9FF66] focus:border-[#B9FF66] focus:outline-none">
                    <option value="">All Skills</option>
                    <option value="javascript">JavaScript</option>
                    <option value="python">Python</option>
                    <option value="java">Java</option>
                    <option value="php">PHP</option>
                </select>
            </div>
            <a href="{{ route('recruiter.cv-extraction') }}" class="inline-block bg-[#B9FF66] text-dark font-medium py-2 px-4 rounded-lg hover:bg-[#a7e85c] transition-colors duration-200">
                Add New Candidate
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Skills
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Experience
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Education
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Added
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Sample candidate data - will be replaced with real data -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#B9FF66] rounded-full flex items-center justify-center">
                                    <span class="text-dark font-bold">JD</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-dark">John Doe</div>
                                    <div class="text-sm text-gray-500">john.doe@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">JavaScript</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">React</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Node.js</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-dark">5 years</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-dark">Bachelor's in Computer Science</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            2 days ago
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-dark hover:text-[#B9FF66] transition-colors">View</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#B9FF66] rounded-full flex items-center justify-center">
                                    <span class="text-dark font-bold">JS</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-dark">Jane Smith</div>
                                    <div class="text-sm text-gray-500">jane.smith@example.com</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Python</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Django</span>
                                <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">SQL</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-dark">3 years</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-dark">Master's in Data Science</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            1 week ago
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-dark hover:text-[#B9FF66] transition-colors">View</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">2</span> candidates
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded-lg bg-white text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-3 py-1 border border-gray-300 rounded-lg bg-white text-gray-500 hover:bg-gray-50 disabled:opacity-50" disabled>
                    Next
                </button>
            </div>
        </div>
    </div>
</div>
@endsection 