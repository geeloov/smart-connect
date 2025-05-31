@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-screen p-4 sm:p-6 lg:p-8">
    <!-- Compact Header Section -->
    <div class="mb-6">
        <div class="bg-white rounded-2xl border-2 border-[#191A23] p-4 md:p-6 relative overflow-hidden" style="box-shadow: 0px 6px 0px 0 #191a23;">
            <!-- Background Pattern -->
            <div class="absolute top-0 right-0 -mt-6 -mr-6 opacity-5">
                <svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="75" cy="75" r="75" fill="#191A23"/>
                    <circle cx="75" cy="75" r="60" fill="white"/>
                    <circle cx="75" cy="75" r="45" fill="#191A23"/>
                    <circle cx="75" cy="75" r="30" fill="white"/>
                    <circle cx="75" cy="75" r="15" fill="#191A23"/>
                </svg>
            </div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-[#B9FF66] rounded-xl border-2 border-[#191A23]" style="box-shadow: 0px 3px 0px 0 #191a23;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#191A23]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-[#191A23] tracking-tight">Candidate Pipeline</h1>
                        <p class="text-[#191A23]/70 mt-1 text-sm">Manage your recruitment process with drag & drop</p>
                    </div>
                </div>
                
                <!-- Compact Filter Section -->
                <form method="GET" action="{{ route('recruiter.pipeline.index') }}" id="jobPositionFilterForm" class="flex-shrink-0">
                    <div class="relative">
                        <label class="block text-xs font-semibold text-[#191A23] mb-1">Filter by Position</label>
                        <select name="job_position_id" id="jobPositionFilter"
                                class="block w-full md:w-64 appearance-none rounded-lg border-2 border-[#191A23] bg-white px-3 py-2 pr-10 text-sm font-medium text-[#191A23] focus:border-[#B9FF66] focus:outline-none focus:ring-2 focus:ring-[#B9FF66]/50 transition-all duration-200"
                                style="box-shadow: 0px 3px 0px 0px #191A23;"
                                onchange="document.getElementById('jobPositionFilterForm').submit();">
                            <option value="" class="font-medium">🎯 All Job Positions</option>
                            @foreach($jobPositions as $job)
                                <option value="{{ $job->id }}" {{ $selectedJobPositionId == $job->id ? 'selected' : '' }} class="font-medium">
                                    {{ Str::limit($job->title, 40) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#191A23] mt-5">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Compact Kanban Board -->
    <div id="pipelineBoard" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 items-start">
        @php
            $stageOrder = $stageOrder ?? ['pending', 'in_review', 'interview_scheduled', 'interviewing', 'offer_extended', 'hired', 'rejected', 'withdrawn'];
            $stageUIConfig = [
                'pending' => [
                    'gradient' => 'from-slate-400 to-slate-600',
                    'bg' => 'bg-slate-50',
                    'border' => 'border-slate-200',
                    'emoji' => '⏳'
                ],
                'in_review' => [
                    'gradient' => 'from-blue-400 to-blue-600',
                    'bg' => 'bg-blue-50',
                    'border' => 'border-blue-400',
                    'emoji' => '👀'
                ],
                'interview_scheduled' => [
                    'gradient' => 'from-cyan-400 to-cyan-600',
                    'bg' => 'bg-cyan-50',
                    'border' => 'border-cyan-200',
                    'emoji' => '📅'
                ],
                'interviewing' => [
                    'gradient' => 'from-amber-400 to-amber-600',
                    'bg' => 'bg-amber-50',
                    'border' => 'border-amber-200',
                    'emoji' => '🎤'
                ],
                'offer_extended' => [
                    'gradient' => 'from-purple-400 to-purple-600',
                    'bg' => 'bg-purple-50',
                    'border' => 'border-purple-200',
                    'emoji' => '💼'
                ],
                'hired' => [
                    'gradient' => 'from-emerald-400 to-emerald-600',
                    'bg' => 'bg-emerald-50',
                    'border' => 'border-emerald-200',
                    'emoji' => '🎉'
                ],
                'rejected' => [
                    'gradient' => 'from-red-400 to-red-600',
                    'bg' => 'bg-red-50',
                    'border' => 'border-red-200',
                    'emoji' => '❌'
                ],
                'withdrawn' => [
                    'gradient' => 'from-orange-400 to-orange-600',
                    'bg' => 'bg-orange-50',
                    'border' => 'border-orange-200',
                    'emoji' => '🚪'
                ]
            ];
            $avatarColors = ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8', '#F7DC6F', '#BB8FCE', '#85C1E9'];
        @endphp

        @foreach($stageOrder as $statusKey)
            @php
                $stageName = \App\Models\JobApplication::getStatusLabel($statusKey);
                $applicationsInStage = $applicationsByStage[$statusKey] ?? collect([]);
                $count = count($applicationsInStage);
                $config = $stageUIConfig[$statusKey] ?? $stageUIConfig['pending'];
            @endphp
            
            <div class="kanban-stage-column flex flex-col {{ $config['bg'] }} rounded-xl border-2 {{ $config['border'] }} overflow-hidden transition-all duration-300 hover:shadow-lg" 
                 data-stage-id="{{ $statusKey }}" 
                 data-stage-ui-config="{{ json_encode($config) }}" 
                 style="box-shadow: 0px 3px 0px 0px rgba(0,0,0,0.08);">
                
                <!-- Compact Stage Header -->
                <div class="px-3 py-2 bg-gradient-to-r {{ $config['gradient'] }} text-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10 flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <div class="text-sm">{{ $config['emoji'] }}</div>
                            <div>
                                <h2 class="text-xs font-bold uppercase tracking-wide">{{ $stageName }}</h2>
                                <p class="text-white/80 text-xs">{{ $count }} {{ $count === 1 ? 'candidate' : 'candidates' }}</p>
                            </div>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-full px-2 py-0.5">
                            <span class="text-xs font-bold">{{ $count }}</span>
                        </div>
                    </div>
                </div>

                <!-- Compact Cards Container -->
                <div class="candidate-cards-list p-2 space-y-2 overflow-y-auto flex-grow">
                    @forelse($applicationsInStage as $application)
                        @php
                            $userNameForAvatar = $application->user->name ?? 'Unknown';
                            $initials = collect(explode(' ', $userNameForAvatar))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->join('');
                            $colorIndex = strlen($userNameForAvatar) > 0 ? (ord($userNameForAvatar[0]) % count($avatarColors)) : 0;
                            $avatarBg = $avatarColors[$colorIndex];
                        @endphp
                        
                        <div class="kanban-card bg-white rounded-lg border border-gray-200 hover:border-[#B9FF66] p-2 transition-all duration-300 cursor-grab active:cursor-grabbing group hover:shadow-md hover:-translate-y-0.5 transform"
                             draggable="true" data-application-id="{{ $application->id }}" data-original-stage="{{ $statusKey }}"
                             style="box-shadow: 0px 1px 0px 0px rgba(0,0,0,0.05);">
                            
                            <!-- Compact Card Header -->
                            <div class="flex items-center space-x-2 mb-1.5">
                                <div class="relative">
                                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-xs font-bold shadow-sm border border-white" style="background: linear-gradient(135deg, {{ $avatarBg }}, {{ $avatarBg }}dd);">
                                        {{ $initials }}
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-2 h-2 bg-green-400 rounded-full border border-white"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-semibold text-[#191A23] truncate group-hover:text-[#B9FF66] transition-colors" title="{{ $application->user->name ?? 'Unknown Candidate' }}">
                                        {{ $application->user->name ?? 'Unknown Candidate' }}
                                    </h3>
                                    @if($application->jobPosition)
                                    <p class="text-xs text-gray-600 truncate" title="{{ $application->jobPosition->title }}">
                                        {{ Str::limit($application->jobPosition->title, 20) }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Compact Application Info -->
                            <div class="space-y-1.5 mb-1.5">
                                <div class="flex items-center text-xs text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $application->created_at->diffForHumans() }}
                                </div>

                                @if(!is_null($application->compatibility_score))
                                    @php
                                        $score = round($application->compatibility_score);
                                        $scoreColor = 'bg-red-100 text-red-700 border-red-200';
                                        if ($score >= 80) $scoreColor = 'bg-green-100 text-green-700 border-green-200';
                                        elseif ($score >= 60) $scoreColor = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                                        elseif ($score >= 40) $scoreColor = 'bg-orange-100 text-orange-700 border-orange-200';
                                    @endphp
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium text-gray-600">Match</span>
                                        <div class="flex items-center space-x-1">
                                            <div class="w-10 h-1 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-red-400 via-yellow-400 to-green-400 rounded-full transition-all duration-500" style="width: {{ $score }}%"></div>
                                            </div>
                                            <span class="inline-flex items-center px-1 py-0.5 rounded text-xs font-bold border {{ $scoreColor }}">
                                                {{ $score }}%
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Compact Card Actions -->
                            <div class="border-t border-gray-100 pt-1.5 flex justify-between items-center">
                                <div class="flex items-center space-x-1">
                                    <div class="w-1 h-1 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-xs text-gray-500 font-medium">Active</span>
                                </div>
                                <a href="{{ route('recruiter.applications.show', $application->id) }}" 
                                   class="inline-flex items-center px-2 py-1 bg-[#191A23] text-white text-xs font-semibold rounded hover:bg-[#B9FF66] hover:text-[#191A23] transition-all duration-200 transform hover:scale-105"
                                   style="box-shadow: 0px 1px 0px 0 rgba(0,0,0,0.1);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>
                    @empty
                        <!-- Compact Empty State -->
                        <div class="kanban-card-placeholder-dynamic flex items-center justify-center h-32">
                            <div class="text-center p-4 border border-dashed border-gray-200 rounded-lg bg-white/60 backdrop-blur-sm w-full">
                                <div class="text-lg mb-1">{{ $config['emoji'] }}</div>
                                <svg class="mx-auto h-6 w-6 text-gray-300 mb-1" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <h3 class="text-xs font-semibold text-gray-600 mb-1">No candidates</h3>
                                <p class="text-xs text-gray-500">Drag here to update status</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Include Chatbot Component -->
@include('components.chatbot')

@push('styles')
<style>
    .candidate-cards-list::-webkit-scrollbar {
        width: 4px;
    }
    .candidate-cards-list::-webkit-scrollbar-track {
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }
    .candidate-cards-list::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #B9FF66, #a7e85c);
        border-radius: 10px;
    }
    .candidate-cards-list::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #a7e85c, #96d84b);
    }
/* Dynamic column heights based on content */
    .candidate-cards-list {
        min-height: 120px;
    }
    
    .kanban-stage-column {
        align-self: start;
    }
    
    .kanban-stage-column.drag-over {
        background: linear-gradient(135deg, rgba(185, 255, 102, 0.1), rgba(185, 255, 102, 0.2));
        transform: scale(1.02);
        box-shadow: 0px 8px 0px 0px rgba(185, 255, 102, 0.3), 0 15px 30px rgba(0,0,0,0.1);
/* Ensure border colors are properly applied */
    .kanban-stage-column {
        border-width: 2px !important;
    }
    
    /* Force specific border colors for each stage */
    .kanban-stage-column[data-stage-id="in_review"] {
        border-color: rgb(191 219 254) !important; /* blue-200 */
    }
    
    .kanban-stage-column[data-stage-id="pending"] {
        border-color: rgb(226 232 240) !important; /* slate-200 */
    }
    
    .kanban-stage-column[data-stage-id="interview_scheduled"] {
        border-color: rgb(165 243 252) !important; /* cyan-200 */
    }
    
    .kanban-stage-column[data-stage-id="interviewing"] {
        border-color: rgb(254 215 170) !important; /* amber-200 */
    }
    
    .kanban-stage-column[data-stage-id="offer_extended"] {
        border-color: rgb(221 214 254) !important; /* purple-200 */
    }
    
    .kanban-stage-column[data-stage-id="hired"] {
        border-color: rgb(187 247 208) !important; /* emerald-200 */
    }
    
    .kanban-stage-column[data-stage-id="rejected"] {
        border-color: rgb(254 202 202) !important; /* red-200 */
    }
    
    .kanban-stage-column[data-stage-id="withdrawn"] {
        border-color: rgb(254 215 170) !important; /* orange-200 */
    }
    }
    
    .kanban-card.dragging {
        transform: rotate(3deg) scale(1.05);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        z-index: 1000;
    }
    
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 15px rgba(185, 255, 102, 0.4); }
        50% { box-shadow: 0 0 25px rgba(185, 255, 102, 0.8); }
    }
    
    .pulse-glow {
        animation: pulse-glow 2s infinite;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pipelineBoard = document.getElementById('pipelineBoard');
    let draggedCard = null;
    let originalStageId = null;

    // Enhanced drag start
    pipelineBoard.addEventListener('dragstart', e => {
        if (e.target.classList.contains('kanban-card')) {
            draggedCard = e.target;
            originalStageId = draggedCard.closest('.kanban-stage-column').dataset.stageId;
            
            setTimeout(() => {
                if (draggedCard) {
                    draggedCard.classList.add('dragging');
                }
            }, 0);

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', draggedCard.dataset.applicationId);
        }
    });

    // Enhanced drag end
    pipelineBoard.addEventListener('dragend', e => {
        if (draggedCard) {
            draggedCard.classList.remove('dragging');
            draggedCard = null;
            originalStageId = null;
        }
        // Remove all column highlights
        document.querySelectorAll('.kanban-stage-column').forEach(col => {
            col.classList.remove('drag-over');
        });
    });

    // Enhanced drag over
    pipelineBoard.addEventListener('dragover', e => {
        e.preventDefault();
        const targetColumn = e.target.closest('.kanban-stage-column');
        if (targetColumn && draggedCard) {
            // Remove highlight from other columns
            document.querySelectorAll('.kanban-stage-column').forEach(col => {
                if (col !== targetColumn) {
                    col.classList.remove('drag-over');
                }
            });
            // Add highlight to current column
            targetColumn.classList.add('drag-over');
        }
    });

    // Enhanced drag leave
    pipelineBoard.addEventListener('dragleave', e => {
        const targetColumn = e.target.closest('.kanban-stage-column');
        const relatedTargetColumn = e.relatedTarget ? e.relatedTarget.closest('.kanban-stage-column') : null;

        if (targetColumn && targetColumn !== relatedTargetColumn) {
            targetColumn.classList.remove('drag-over');
        }
    });

    // Enhanced drop
    pipelineBoard.addEventListener('drop', e => {
        e.preventDefault();
        if (!draggedCard) return;

        const targetColumnElement = e.target.closest('.kanban-stage-column');
        targetColumnElement.classList.remove('drag-over');

        if (targetColumnElement) {
            const newStageId = targetColumnElement.dataset.stageId;
            const applicationId = draggedCard.dataset.applicationId;

            if (newStageId && newStageId !== originalStageId) {
                const targetCardList = targetColumnElement.querySelector('.candidate-cards-list');
                targetCardList.appendChild(draggedCard);

                // Update UI immediately
                updateCardCounts();
                draggedCard.dataset.originalStage = newStageId;

                // Show success animation
                draggedCard.classList.add('pulse-glow');
                setTimeout(() => {
                    draggedCard.classList.remove('pulse-glow');
                }, 2000);

                // AJAX call to update backend
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const updateUrl = `/recruiter/applications/${applicationId}/update-stage`;

                fetch(updateUrl, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ new_status: newStageId })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { 
                            throw new Error(err.message || `Server error: ${response.status}`); 
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Stage update successful:', data.message);
                    // Show success notification
                    showNotification('Candidate moved successfully!', 'success');
                })
                .catch(error => {
                    console.error('Error updating stage:', error);
                    // Revert the card
                    const originalColumnElement = pipelineBoard.querySelector(`.kanban-stage-column[data-stage-id="${originalStageId}"]`);
                    if (originalColumnElement) {
                        const originalCardList = originalColumnElement.querySelector('.candidate-cards-list');
                        originalCardList.appendChild(draggedCard);
                        draggedCard.dataset.originalStage = originalStageId;
                    }
                    updateCardCounts();
                    showNotification('Error moving candidate: ' + error.message, 'error');
                });
            }
        }
    });

    function updateCardCounts() {
        document.querySelectorAll('.kanban-stage-column').forEach(column => {
            const cardList = column.querySelector('.candidate-cards-list');
            const cards = cardList.querySelectorAll('.kanban-card');
            const count = cards.length;
            
            // Update header count
            const countElement = column.querySelector('.bg-white\\/20 span');
            if (countElement) {
                countElement.textContent = count;
            }
            
            // Update subtitle
            const subtitleElement = column.querySelector('.text-white\\/80');
            if (subtitleElement) {
                subtitleElement.textContent = `${count} ${count === 1 ? 'candidate' : 'candidates'}`;
            }
        });
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg text-white font-semibold transform transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        }`;
        notification.style.boxShadow = '0px 2px 0px 0 rgba(0,0,0,0.2)';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Initial setup
    updateCardCounts();
});
</script>
@endpush
@endsection