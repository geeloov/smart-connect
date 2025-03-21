@if(!$hasApplied)
    <a href="{{ route('job-seeker.applications.create', $jobPosition) }}" class="btn btn-primary">
        Apply Now
    </a>
@else
    <button class="btn btn-secondary" disabled>Already Applied</button>
@endif 