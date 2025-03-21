@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-dark">Job Matching</h1>
        <a href="{{ route('recruiter.dashboard') }}" class="text-dark hover:text-[#B9FF66] transition-colors flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Job Description Input -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-dark mb-4">Job Description</h2>
                
                <form id="job-matching-form">
                    <div class="mb-4">
                        <label for="job-title" class="block text-sm font-medium text-gray-700 mb-1">Job Title</label>
                        <input type="text" id="job-title" name="job_title" class="shadow-sm focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g. Senior Frontend Developer">
                    </div>
                    
                    <div class="mb-4">
                        <label for="job-description" class="block text-sm font-medium text-gray-700 mb-1">Job Description</label>
                        <textarea id="job-description" name="job_description" rows="10" class="shadow-sm focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Paste your job description here..."></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Required Skills</label>
                        <div class="flex flex-wrap gap-2" id="skills-container">
                            <span class="px-3 py-1 text-sm rounded-full bg-[#B9FF66]/20 text-dark flex items-center">
                                JavaScript
                                <button type="button" class="ml-1 text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                            <span class="px-3 py-1 text-sm rounded-full bg-[#B9FF66]/20 text-dark flex items-center">
                                React
                                <button type="button" class="ml-1 text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                            <div class="relative">
                                <input type="text" id="new-skill" class="px-3 py-1 text-sm rounded-full border border-gray-300 focus:ring-[#B9FF66] focus:border-[#B9FF66]" placeholder="Add skill...">
                                <button type="button" id="add-skill" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="experience-level" class="block text-sm font-medium text-gray-700 mb-1">Experience Level</label>
                        <select id="experience-level" name="experience_level" class="shadow-sm focus:ring-[#B9FF66] focus:border-[#B9FF66] block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select experience level</option>
                            <option value="entry">Entry Level (0-2 years)</option>
                            <option value="mid">Mid Level (3-5 years)</option>
                            <option value="senior">Senior Level (5+ years)</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                            Find Matching Candidates
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Matching Results -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-dark">Matching Candidates</h2>
                        <p class="text-gray-500">Based on job requirements</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Sort by:</span>
                            <select class="rounded-md border-gray-300 shadow-sm focus:border-[#B9FF66] focus:ring focus:ring-[#B9FF66] focus:ring-opacity-50 text-sm">
                                <option>Match Score</option>
                                <option>Experience</option>
                                <option>Recently Added</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Candidates List -->
                <div class="space-y-6" id="candidates-list">
                    <!-- Candidate 1 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-[#B9FF66] rounded-full flex items-center justify-center mr-4">
                                        <span class="text-dark font-bold text-xl">JD</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-dark">John Doe</h3>
                                        <p class="text-gray-500 text-sm">Senior Frontend Developer • 5 years experience</p>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-2">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">JavaScript</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">React</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">TypeScript</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Redux</span>
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
                                <div class="mt-3 flex space-x-2">
                                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        View Profile
                                    </a>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        Contact
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-[#B9FF66] rounded-full flex items-center justify-center mr-4">
                                        <span class="text-dark font-bold text-xl">JS</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-dark">Jane Smith</h3>
                                        <p class="text-gray-500 text-sm">Frontend Developer • 3 years experience</p>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-2">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">JavaScript</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">React</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">CSS</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">HTML</span>
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
                                <div class="mt-3 flex space-x-2">
                                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        View Profile
                                    </a>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        Contact
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 bg-[#B9FF66] rounded-full flex items-center justify-center mr-4">
                                        <span class="text-dark font-bold text-xl">RJ</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-dark">Robert Johnson</h3>
                                        <p class="text-gray-500 text-sm">UI Developer • 2 years experience</p>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-2">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">JavaScript</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">HTML</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">CSS</span>
                                        <span class="px-2 py-1 text-xs rounded-full bg-[#B9FF66]/20 text-dark">Figma</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 flex flex-col items-end">
                                <div class="flex items-center mb-2">
                                    <span class="text-sm font-medium text-dark mr-2">Match Score:</span>
                                    <span class="text-sm font-bold text-yellow-600">65%</span>
                                </div>
                                <div class="w-full md:w-32 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 65%"></div>
                                </div>
                                <span class="mt-1 text-xs text-yellow-600">Fair Match</span>
                                <div class="mt-3 flex space-x-2">
                                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-dark bg-[#B9FF66] hover:bg-[#a7e85c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        View Profile
                                    </a>
                                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B9FF66]">
                                        Contact
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State (hidden by default) -->
                <div id="empty-state" class="hidden py-12 flex flex-col items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">No matching candidates found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your job requirements or add more candidates to your database.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addSkillBtn = document.getElementById('add-skill');
        const newSkillInput = document.getElementById('new-skill');
        const skillsContainer = document.getElementById('skills-container');
        const jobMatchingForm = document.getElementById('job-matching-form');
        const candidatesList = document.getElementById('candidates-list');
        const emptyState = document.getElementById('empty-state');

        // Add new skill
        addSkillBtn.addEventListener('click', function() {
            const skillText = newSkillInput.value.trim();
            if (skillText) {
                const skillElement = document.createElement('span');
                skillElement.className = 'px-3 py-1 text-sm rounded-full bg-[#B9FF66]/20 text-dark flex items-center';
                skillElement.innerHTML = `
                    ${skillText}
                    <button type="button" class="ml-1 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                
                // Insert before the input
                skillsContainer.insertBefore(skillElement, newSkillInput.parentNode);
                
                // Add event listener to remove button
                const removeBtn = skillElement.querySelector('button');
                removeBtn.addEventListener('click', function() {
                    skillElement.remove();
                });
                
                // Clear input
                newSkillInput.value = '';
            }
        });

        // Allow pressing Enter to add skill
        newSkillInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addSkillBtn.click();
            }
        });

        // Add event listeners to existing skill remove buttons
        document.querySelectorAll('#skills-container > span button').forEach(button => {
            button.addEventListener('click', function() {
                this.parentNode.remove();
            });
        });

        // Form submission
        jobMatchingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // In a real application, this would send the form data to the server
            // For demo purposes, we'll just toggle between the candidates list and empty state
            
            const jobTitle = document.getElementById('job-title').value.trim();
            const jobDescription = document.getElementById('job-description').value.trim();
            
            if (jobTitle && jobDescription) {
                // Show candidates list
                candidatesList.classList.remove('hidden');
                emptyState.classList.add('hidden');
            } else {
                // Show empty state
                candidatesList.classList.add('hidden');
                emptyState.classList.remove('hidden');
            }
        });
    });
</script>
@endpush
@endsection 