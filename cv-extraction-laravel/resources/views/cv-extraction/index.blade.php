@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CV Extraction Tool</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cv-extraction.extract') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="cv_file">Upload CV (PDF only)</label>
                            <input type="file" class="form-control @error('cv_file') is-invalid @enderror" id="cv_file" name="cv_file" required>
                            @error('cv_file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="job_description">Job Description</label>
                            <textarea class="form-control @error('job_description') is-invalid @enderror" id="job_description" name="job_description" rows="5" required></textarea>
                            @error('job_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Extract

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 