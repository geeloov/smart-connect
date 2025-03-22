@extends('layouts.recruiter')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4">
                <a href="{{ route('recruiter.applications.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Applications
                </a>
            </div>
            
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Details</h5>
                    <span class="badge {{ $jobApplication->status == 'pending' ? 'bg-warning' : ($jobApplication->status == 'in_review' ? 'bg-info' : ($jobApplication->status == 'accepted' ? 'bg-success' : 'bg-danger')) }}">
                        {{ ucfirst(str_replace('_', ' ', $jobApplication->status)) }}
                    </span>
                </div>
                <div class="card-body">
                    <h5>Job: {{ $jobApplication->jobPosition->title }}</h5>
                    <p class="text-muted">Applied on: {{ $jobApplication->created_at->format('F d, Y') }}</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6>Applicant Information</h6>
                            <p><strong>Name:</strong> {{ $jobApplication->user->name }}</p>
                            <p><strong>Email:</strong> {{ $jobApplication->user->email }}</p>
                            @if($jobApplication->user->candidate)
                                <p><strong>Phone:</strong> {{ $jobApplication->user->candidate->phone ?? 'Not provided' }}</p>
                                <p><strong>Location:</strong> {{ $jobApplication->user->candidate->location ?? 'Not provided' }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>Application Documents</h6>
                            @if($jobApplication->cv_filename)
                                <p>
                                    <strong>CV:</strong> 
                                    <a href="{{ route('recruiter.applications.download-cv', $jobApplication) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Download CV
                                    </a>
                                </p>
                            @endif
                            
                            @if($jobApplication->cover_letter)
                                <div class="mt-3">
                                    <h6>Cover Letter</h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($jobApplication->cover_letter)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CV Data Summary Card -->
            @if($jobApplication->cv_data)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">CV Summary</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $cvData = is_array($jobApplication->cv_data) ? $jobApplication->cv_data : json_decode($jobApplication->cv_data, true);
                        @endphp
                        
                        @if($cvData)
                            <div class="row">
                                <!-- Personal Information -->
                                <div class="col-md-6 mb-4">
                                    <h6>Personal Information</h6>
                                    <p><strong>Name:</strong> {{ $cvData['name'] ?? 'Not found' }}</p>
                                    <p><strong>Email:</strong> {{ $cvData['email'] ?? 'Not found' }}</p>
                                    <p><strong>Phone:</strong> {{ $cvData['phone'] ?? 'Not found' }}</p>
                                    <p><strong>Location:</strong> {{ $cvData['location'] ?? 'Not found' }}</p>
                                </div>
                                
                                <!-- Experience -->
                                <div class="col-md-6 mb-4">
                                    <h6>Experience Summary</h6>
                                    @if(isset($cvData['experience']) && is_array($cvData['experience']) && count($cvData['experience']) > 0)
                                        <ul class="list-group">
                                            @foreach(array_slice($cvData['experience'], 0, 3) as $exp)
                                                <li class="list-group-item">
                                                    <strong>{{ $exp['title'] ?? 'Position' }}</strong> at {{ $exp['company'] ?? 'Company' }}
                                                    @if(isset($exp['dates']))
                                                        <br><small>{{ $exp['dates'] }}</small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                        @if(count($cvData['experience']) > 3)
                                            <p class="mt-2 text-muted">+ {{ count($cvData['experience']) - 3 }} more experiences</p>
                                        @endif
                                    @else
                                        <p>No experience information found in CV</p>
                                    @endif
                                </div>
                                
                                <!-- Education -->
                                <div class="col-md-6 mb-4">
                                    <h6>Education</h6>
                                    @if(isset($cvData['education']) && is_array($cvData['education']) && count($cvData['education']) > 0)
                                        <ul class="list-group">
                                            @foreach($cvData['education'] as $edu)
                                                <li class="list-group-item">
                                                    <strong>{{ $edu['degree'] ?? 'Degree' }}</strong> from {{ $edu['institution'] ?? 'Institution' }}
                                                    @if(isset($edu['dates']))
                                                        <br><small>{{ $edu['dates'] }}</small>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No education information found in CV</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p>Could not parse CV data. Please download the CV to view details.</p>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- Update Status Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Update Application Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('recruiter.applications.update-status', $jobApplication) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_review" {{ $jobApplication->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                                <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="recruiter_notes">Notes</label>
                            <textarea name="recruiter_notes" id="recruiter_notes" rows="3" class="form-control">{{ $jobApplication->recruiter_notes }}</textarea>
                            <small class="text-muted">These notes are private and only visible to recruiters.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 