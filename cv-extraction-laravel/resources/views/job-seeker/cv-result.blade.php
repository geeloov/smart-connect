@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">CV Upload Result</div>

                <div class="card-body">
                    <div class="alert alert-success">
                        Your CV was uploaded successfully!
                    </div>

                    <h4>File Details</h4>
                    <table class="table">
                        <tr>
                            <th>Filename:</th>
                            <td>{{ $filename }}</td>
                        </tr>
                        <tr>
                            <th>Size:</th>
                            <td>{{ number_format($filesize / 1024, 2) }} KB</td>
                        </tr>
                        <tr>
                            <th>Uploaded:</th>
                            <td>{{ $uploadTime }}</td>
                        </tr>
                    </table>

                    <h4>Extracted Information (Demo)</h4>
                    <table class="table">
                        <tr>
                            <th>Name:</th>
                            <td>{{ $dummyData['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $dummyData['email'] }}</td>
                        </tr>
                        <tr>
                            <th>Skills:</th>
                            <td>{{ implode(', ', $dummyData['skills']) }}</td>
                        </tr>
                    </table>

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