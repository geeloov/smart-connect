@if(isset($matchingData['error']))
    <div class="alert alert-warning">
        {{ $matchingData['reasoning'] }}
    </div>
@endif

<div class="skills-analysis">
    <h3>Skills Analysis:</h3>
    <div class="matched-skills">
        <h4>Matched Skills:</h4>
        @if(!empty($matchingData['skills_analysis']['matched_skills']))
            <ul>
                @foreach($matchingData['skills_analysis']['matched_skills'] as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        @else
            <p>No matched skills available</p>
        @endif
    </div>
    
    <div class="missing-skills">
        <h4>Missing Skills:</h4>
        @if(!empty($matchingData['skills_analysis']['missing_skills']))
            <ul>
                @foreach($matchingData['skills_analysis']['missing_skills'] as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        @else
            <p>No missing skills data available</p>
        @endif
    </div>
</div> 