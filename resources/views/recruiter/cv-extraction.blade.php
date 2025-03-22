<!-- Display job matching results section -->
@if($jobMatching)
    <div class="mt-5">
        <h3>Job Matching Results</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Match Score: {{ $jobMatching['match_score'] ?? 50 }}%</h4>
                    <span class="badge {{ ($jobMatching['is_perfect_match'] ?? false) ? 'bg-success' : 'bg-secondary' }}">
                        {{ ($jobMatching['is_perfect_match'] ?? false) ? 'Perfect Match' : 'Not a Perfect Match' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                @if($matchingError)
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle"></i> {{ $matchingError }}
                    </div>
                @endif
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Selected Job Position:</strong> {{ $jobPosition->title ?? 'N/A' }}</p>
                        <p><strong>Company:</strong> {{ $jobPosition->company_name ?? 'N/A' }}</p>
                        <p><strong>Job Type:</strong> {{ $jobPosition->job_type ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Location:</strong> {{ $jobPosition->location ?? 'N/A' }}</p>
                        @if(isset($jobPosition->salary_range))
                            <p><strong>Salary Range:</strong> {{ $jobPosition->salary_range }}</p>
                        @endif
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Match Analysis:</h5>
                    <p>{{ $jobMatching['reasoning'] ?? 'No analysis available' }}</p>
                </div>
                
                <!-- Display skills analysis -->
                <h5>Skills Analysis:</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">Matched Skills</h6>
                            </div>
                            <div class="card-body">
                                @if(!empty($jobMatching['skills_analysis']['matched_skills'] ?? []))
                                    <ul class="list-group">
                                        @foreach($jobMatching['skills_analysis']['matched_skills'] as $skill)
                                            <li class="list-group-item">
                                                <i class="fas fa-check text-success"></i> {{ $skill }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No matched skills found</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-header bg-danger text-white">
                                <h6 class="mb-0">Missing Skills</h6>
                            </div>
                            <div class="card-body">
                                @if(!empty($jobMatching['skills_analysis']['missing_skills'] ?? []))
                                    <ul class="list-group">
                                        @foreach($jobMatching['skills_analysis']['missing_skills'] as $skill)
                                            <li class="list-group-item">
                                                <i class="fas fa-times text-danger"></i> {{ $skill }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No missing skills identified</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif 