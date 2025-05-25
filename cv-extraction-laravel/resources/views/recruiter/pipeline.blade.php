@extends('recruiter.layouts.recruiter')

@section('recruiter-content')
<div class="min-h-[calc(100vh-120px)] bg-gradient-to-br from-slate-50 via-gray-100 to-slate-200 p-4 sm:p-6 lg:p-8">
    <!-- Header: Title & Filters -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-[#191A23] tracking-tight">Candidate Pipeline</h1>
            <p class="text-sm text-[#191A23]/70 mt-1">Drag and drop candidates to update their application stage.</p>
        </div>
        
        <form method="GET" action="{{ route('recruiter.pipeline.index') }}" id="jobPositionFilterForm" class="flex-shrink-0">
            <div class="relative">
                <select name="job_position_id" id="jobPositionFilter"
                        class="block w-full md:w-72 appearance-none rounded-xl border-2 border-[#191A23] bg-white px-4 py-2.5 pr-10 text-sm font-medium text-[#191A23] placeholder-gray-400 focus:border-[#B9FF66] focus:outline-none focus:ring-2 focus:ring-[#B9FF66]/50 transition-all duration-150"
                        style="box-shadow: 0px 3px 0px 0px #191A23;"
                        onchange="document.getElementById('jobPositionFilterForm').submit();">
                    <option value="" class="font-medium">All Job Positions</option>
                    @foreach($jobPositions as $job)
                        <option value="{{ $job->id }}" {{ $selectedJobPositionId == $job->id ? 'selected' : '' }} class="font-medium">
                            {{ Str::limit($job->title, 50) }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#191A23]/70">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.29a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </form>
    </div>

    <!-- Kanban Board - Vertical Stages, Vertical Cards within Stages -->
    <div id="pipelineBoard" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
        @php
            $stageOrder = $stageOrder ?? ['pending', 'in_review', 'interview_scheduled', 'interviewing', 'offer_extended', 'hired', 'rejected', 'withdrawn'];
            $stageUIConfig = [
                'pending' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />', 'color' => 'bg-slate-500', 'textColor' => 'text-slate-500', 'borderColor' => 'border-slate-500'],
                'in_review' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6A.75.75 0 012.25 5.25v-.75m0 S.C.424 6 6.375 6 11.25V12m0 0V15M12 15V12m0 0V9"></path><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5a8.25 8.25 0 1015 0H4.5z" />', 'color' => 'bg-sky-500', 'textColor' => 'text-sky-500', 'borderColor' => 'border-sky-500'],
                'interview_scheduled' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-3.75h.008v.008H12v-.008z" />', 'color' => 'bg-cyan-500', 'textColor' => 'text-cyan-500', 'borderColor' => 'border-cyan-500'],
                'interviewing' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />', 'color' => 'bg-amber-500', 'textColor' => 'text-amber-500', 'borderColor' => 'border-amber-500'],
                'offer_extended' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />', 'color' => 'bg-purple-500', 'textColor' => 'text-purple-500', 'borderColor' => 'border-purple-500'],
                'hired' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />', 'color' => 'bg-emerald-500', 'textColor' => 'text-emerald-500', 'borderColor' => 'border-emerald-500'],
                'accepted' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />', 'color' => 'bg-green-500', 'textColor' => 'text-green-500', 'borderColor' => 'border-green-500'],
                'rejected' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />', 'color' => 'bg-rose-500', 'textColor' => 'text-rose-500', 'borderColor' => 'border-rose-500'],
                'withdrawn' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />', 'color' => 'bg-orange-500', 'textColor' => 'text-orange-500', 'borderColor' => 'border-orange-500'],
                'default' => ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />', 'color' => 'bg-gray-500', 'textColor' => 'text-gray-500', 'borderColor' => 'border-gray-500']
            ];
            $avatarColors = ['#FFC107', '#4CAF50', '#2196F3', '#9C27B0', '#E91E63', '#00BCD4', '#FF5722', '#795548', '#607D8B', '#FF9800', '#8BC34A', '#03A9F4', '#673AB7', '#F44336', '#009688'];
        @endphp

        @foreach($stageOrder as $statusKey)
            @php
                $stageName = \App\Models\JobApplication::getStatusLabel($statusKey);
                $applicationsInStage = $applicationsByStage[$statusKey] ?? collect([]);
                $count = count($applicationsInStage);
                $config = $stageUIConfig[$statusKey] ?? $stageUIConfig['default'];
            @endphp
            <div class="kanban-stage-column flex flex-col bg-white rounded-2xl border-2 border-[#191A23]/10 overflow-hidden min-h-[300px]" 
                 data-stage-id="{{ $statusKey }}" 
                 data-stage-ui-config="{{ json_encode($config) }}" 
                 style="box-shadow: 0px 5px 0px 0px rgba(25,26,35,0.08);">
                <!-- Stage Column Header -->
                <div class="px-4 py-3.5 border-b-2 {{ $config['borderColor'] }} flex justify-between items-center bg-white/80 backdrop-blur-sm sticky top-0 z-10">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2.5 {{ $config['textColor'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                           {!! $config['icon'] !!}
                        </svg>
                        <h2 class="text-sm font-bold text-[#191A23] uppercase tracking-wider">{{ $stageName }}</h2>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $config['color'] }} bg-opacity-20 {{ $config['textColor'] }}">
                        {{ $count }}
                    </span>
                </div>

                <!-- Candidate Cards Container (Vertically Scrollable) -->
                <div class="candidate-cards-list p-3 space-y-3 overflow-y-auto flex-grow scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-slate-100 scrollbar-thumb-rounded-full" style="max-height: calc(100vh - 280px);">
                    @foreach($applicationsInStage as $application)
                        @php
                            $userNameForAvatar = $application->user->name ?? 'U';
                            $firstLetter = strtoupper(substr($userNameForAvatar, 0, 1));
                            $colorIndex = strlen($userNameForAvatar) > 0 ? (ord($firstLetter) % count($avatarColors)) : 0;
                            $avatarBg = $avatarColors[$colorIndex];
                        @endphp
                        <div class="kanban-card bg-white rounded-xl border-2 border-[#191A23]/10 hover:border-[#B9FF66]/80 p-3 transition-all duration-150 cursor-grab active:cursor-grabbing relative group transform hover:shadow-lg hover:-translate-y-px"
                             draggable="true" data-application-id="{{ $application->id }}" data-original-stage="{{ $statusKey }}"
                             style="box-shadow: 0px 2px 0px 0px rgba(25, 26, 35, 0.05);">
                            
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-sm font-bold flex-shrink-0 border-2 border-white shadow" style="background-color: {{ $avatarBg }};">
                                    {{ $firstLetter }}
                                </div>
                                <div class="ml-2.5 min-w-0">
                                    <h3 class="text-xs font-semibold text-[#191A23] leading-tight truncate" title="{{ $application->user->name ?? 'N/A Candidate' }}">
                                        {{ $application->user->name ?? 'N/A Candidate' }}
                                    </h3>
                                    @if($application->jobPosition)
                                    <p class="text-[10px] text-[#191A23]/60 truncate" title="{{ $application->jobPosition->title }}">
                                        {{ Str::limit($application->jobPosition->title, 25) }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="text-[10px] text-[#191A23]/50 mb-2">
                                Applied: <span class="font-medium">{{ $application->created_at->format('d M Y') }}</span>
                            </p>

                            @if(!is_null($application->compatibility_score))
                                @php
                                    $score = round($application->compatibility_score);
                                    $scoreBgColor = 'bg-rose-100/80'; $scoreTextColor = 'text-rose-600';
                                    if ($score >= 75) { $scoreBgColor = 'bg-emerald-100/80'; $scoreTextColor = 'text-emerald-600'; }
                                    elseif ($score >= 50) { $scoreBgColor = 'bg-amber-100/80'; $scoreTextColor = 'text-amber-600'; }
                                @endphp
                            <div class="mb-2.5">
                                <span class="text-[9px] font-bold {{ $scoreBgColor }} {{ $scoreTextColor }} px-1.5 py-0.5 rounded-md inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 mr-1 opacity-80" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    Match: {{ $score }}%
                                </span>
                            </div>
                            @endif
                            
                            <div class="border-t-2 border-[#191A23]/5 pt-2 mt-2 flex items-center justify-end">
                                <a href="{{ route('recruiter.applications.show', $application->id) }}" title="View Application Details"
                                   class="text-[10px] text-[#191A23]/70 hover:text-[#B9FF66] font-semibold hover:bg-[#191A23] px-2 py-1 rounded-md transition-all duration-150">
                                   Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .candidate-cards-list::-webkit-scrollbar {
        width: 5px;
    }
    .candidate-cards-list::-webkit-scrollbar-track {
        background-color: rgba(25, 26, 35, 0.03);
        border-radius: 10px;
    }
    .candidate-cards-list::-webkit-scrollbar-thumb {
        background-color: rgba(25, 26, 35, 0.15);
        border-radius: 10px;
    }
    .candidate-cards-list::-webkit-scrollbar-thumb:hover {
        background-color: rgba(25, 26, 35, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pipelineBoard = document.getElementById('pipelineBoard');
    let draggedCard = null;
    let originalStageId = null;

    pipelineBoard.addEventListener('dragstart', e => {
        if (e.target.classList.contains('kanban-card')) {
            draggedCard = e.target;
            originalStageId = draggedCard.closest('.kanban-stage-column').dataset.stageId;
            
            // Add a slight delay to allow the browser to capture the drag image
            // before applying opacity, otherwise the drag image might be transparent.
            setTimeout(() => {
                if (draggedCard) { // Check if still dragging this card
                    draggedCard.classList.add('opacity-50', 'shadow-2xl', 'rotate-1');
                }
            }, 0);

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', draggedCard.dataset.applicationId);
        }
    });

    pipelineBoard.addEventListener('dragend', e => {
        if (draggedCard) {
            draggedCard.classList.remove('opacity-50', 'shadow-2xl', 'rotate-1');
            draggedCard = null;
            originalStageId = null;
        }
        // Remove any column highlights
        document.querySelectorAll('.kanban-stage-column.bg-\\[\\#B9FF66\\]\\/20').forEach(col => {
            col.classList.remove('bg-[#B9FF66]/20');
        });
    });

    pipelineBoard.addEventListener('dragover', e => {
        e.preventDefault(); // Necessary to allow dropping
        const targetColumn = e.target.closest('.kanban-stage-column');
        if (targetColumn && draggedCard) {
            // Remove highlight from other columns
            document.querySelectorAll('.kanban-stage-column.bg-\\[\\#B9FF66\\]\\/20').forEach(col => {
                if (col !== targetColumn) {
                    col.classList.remove('bg-[#B9FF66]/20');
                }
            });
            // Add highlight to current column
            if (!targetColumn.classList.contains('bg-\\[\\#B9FF66\\]\\/20')) {
                 targetColumn.classList.add('bg-[#B9FF66]/20');
            }
        }
    });

    pipelineBoard.addEventListener('dragleave', e => {
        const targetColumn = e.target.closest('.kanban-stage-column');
        const relatedTargetColumn = e.relatedTarget ? e.relatedTarget.closest('.kanban-stage-column') : null;

        // Only remove highlight if leaving the column entirely, not just moving between elements within it
        if (targetColumn && targetColumn !== relatedTargetColumn) {
            targetColumn.classList.remove('bg-[#B9FF66]/20');
        }
    });

    pipelineBoard.addEventListener('drop', e => {
        e.preventDefault();
        if (!draggedCard) return;

        const targetColumnElement = e.target.closest('.kanban-stage-column');
        targetColumnElement.classList.remove('bg-[#B9FF66]/20'); // Remove highlight on drop

        if (targetColumnElement) {
            const newStageId = targetColumnElement.dataset.stageId;
            const applicationId = draggedCard.dataset.applicationId;

            if (newStageId && newStageId !== originalStageId) {
                const targetCardList = targetColumnElement.querySelector('.candidate-cards-list');
                
                // Find the placeholder in the target list
                const placeholder = targetCardList.querySelector('.kanban-card-placeholder-dynamic');
                if (placeholder) {
                    targetCardList.insertBefore(draggedCard, placeholder); // Insert before placeholder
                } else {
                    targetCardList.appendChild(draggedCard); // Or append if no placeholder (should not happen if logic is correct)
                }

                // Update UI immediately for responsiveness
                updateCardCounts();
                draggedCard.dataset.originalStage = newStageId; // Update card's stage marker

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
                    // Optionally, display a success notification
                })
                .catch(error => {
                    console.error('Error updating stage:', error);
                    // Revert the card to the original column visually
                    const originalColumnElement = pipelineBoard.querySelector(`.kanban-stage-column[data-stage-id="${originalStageId}"]`);
                    if (originalColumnElement) {
                        const originalCardList = originalColumnElement.querySelector('.candidate-cards-list');
                        const originalPlaceholder = originalCardList.querySelector('.kanban-card-placeholder-dynamic');
                        if (originalPlaceholder) {
                             originalCardList.insertBefore(draggedCard, originalPlaceholder);
                        } else {
                            originalCardList.appendChild(draggedCard);
                        }
                        draggedCard.dataset.originalStage = originalStageId; // Revert card's stage marker
                    }
                    updateCardCounts(); // Update counts after reverting
                    alert('Error updating stage: ' + error.message + '. Reverting change.');
                });
            }
        }
        // Clean up in dragend
    });

    function updateCardCounts() {
        document.querySelectorAll('.kanban-stage-column').forEach(column => {
            const cardList = column.querySelector('.candidate-cards-list');
            const cards = cardList.querySelectorAll('.kanban-card');
            const count = cards.length;
            
            const countElement = column.querySelector('.flex.justify-between.items-center .text-xs.font-semibold');
            if (countElement) {
                countElement.textContent = count;
            }

            const placeholder = column.querySelector('.kanban-card-placeholder-dynamic');
            if (placeholder) {
                placeholder.style.display = count === 0 ? 'flex' : 'none';
            }
        });
    }
    
    // Initial setup for placeholders
    document.querySelectorAll('.kanban-stage-column').forEach(column => {
        const cardList = column.querySelector('.candidate-cards-list');
        const cards = cardList.querySelectorAll('.kanban-card');
        const count = cards.length;
        let placeholder = column.querySelector('.kanban-card-placeholder-dynamic');

        if (!placeholder) { // Create placeholder if it doesn't exist
            // const stageConfigRaw = JSON.parse(column.dataset.stageUiConfig || '{}'); // No longer needed for icon
            // const iconSvg = stageConfigRaw.icon || '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />';
            const genericEmptyIconSvg = '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />'; // Generic document icon

            placeholder = document.createElement('div');
            placeholder.className = 'kanban-card-placeholder-dynamic flex items-center justify-center w-full h-full'; 
            placeholder.style.display = count === 0 ? 'flex' : 'none';
            placeholder.innerHTML = `
                <div class="text-center p-6 border-2 border-dashed border-[#191A23]/10 rounded-xl bg-white/60">
                    <svg class="mx-auto h-10 w-10 text-[#191A23]/20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                         ${genericEmptyIconSvg}
                    </svg>
                    <p class="mt-3 text-xs font-semibold text-[#191A23]/60">No applications here.</p>
                </div>
            `;
            cardList.appendChild(placeholder);
        }
    });
    updateCardCounts(); // Initial call
});
</script>
@endpush
@endsection 