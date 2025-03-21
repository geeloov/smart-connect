@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">CV Extraction Results</div>

                <div class="card-body">
                    <div class="alert alert-success">
                        Your CV was processed successfully!
                    </div>

                    @if(isset($cvData))
                    <h4>Extracted Information</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <!-- Personal Information -->
                            <tr>
                                <th>Name:</th>
                                <td>{{ $cvData['name'] ?? 'Not found' }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $cvData['email'] ?? 'Not found' }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $cvData['phone'] ?? 'Not found' }}</td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td>{{ $cvData['address'] ?? $cvData['location'] ?? 'Not found' }}</td>
                            </tr>

                            <!-- Skills (array) -->
                            <tr>
                                <th>Skills:</th>
                                <td>
                                    @if(isset($cvData['skills']) && is_array($cvData['skills']))
                                        <ul class="list-unstyled">
                                            @foreach($cvData['skills'] as $skill)
                                                <li>{{ is_string($skill) ? $skill : json_encode($skill) }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Not found
                                    @endif
                                </td>
                            </tr>

                            <!-- Education (array) -->
                            <tr>
                                <th>Education:</th>
                                <td>
                                    @if(isset($cvData['education']) && is_array($cvData['education']))
                                        <ul class="list-unstyled">
                                            @foreach($cvData['education'] as $edu)
                                                <li>{{ is_string($edu) ? $edu : json_encode($edu) }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Not found
                                    @endif
                                </td>
                            </tr>

                            <!-- Work Experience (array) -->
                            <tr>
                                <th>Work Experience:</th>
                                <td>
                                    @if(isset($cvData['work_experience']) && is_array($cvData['work_experience']))
                                        <ul class="list-unstyled">
                                            @foreach($cvData['work_experience'] as $exp)
                                                <li>
                                                    @if(is_string($exp))
                                                        {{ $exp }}
                                                    @elseif(is_array($exp))
                                                        <strong>{{ $exp['company'] ?? $exp['position'] ?? 'Job' }}</strong>
                                                        @if(isset($exp['position'])) - {{ $exp['position'] }} @endif
                                                        @if(isset($exp['duration'])) ({{ $exp['duration'] }}) @endif
                                                        @if(isset($exp['description'])) <p>{{ $exp['description'] }}</p> @endif
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Not found
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    @if(isset($jobMatching))
                    <h4 class="mt-4">Job Matching Results</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Match Score:</th>
                                <td>{{ $jobMatching['score'] ?? 'N/A' }}%</td>
                            </tr>
                            @if(isset($jobMatching['matching_skills']) && is_array($jobMatching['matching_skills']))
                            <tr>
                                <th>Matching Skills:</th>
                                <td>
                                    <ul class="list-unstyled">
                                        @foreach($jobMatching['matching_skills'] as $skill)
                                            <li>{{ is_string($skill) ? $skill : json_encode($skill) }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('job-seeker.cv-upload') }}" class="btn btn-primary">
                            Upload Another CV
                        </a>
                        <a href="{{ route('job-seeker.dashboard') }}" class="btn btn-secondary">
                            Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 