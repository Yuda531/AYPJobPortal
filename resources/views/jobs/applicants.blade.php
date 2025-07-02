@extends('layouts.app2')

@section('content')
    <div class="container vh-100 py-4">
        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to
            Job</a>
        @if (Auth::user()->role === 'employer' && Auth::user()->employer->id === $job->employer_id)
            <a href="{{ route('jobs.export_applicants_excel', $job->id) }}" class="btn btn-success mb-3">
                <i class="fas fa-file-excel"></i> Export to Excel
            </a>
        @endif
        <h2>Applicants for: {{ $job->title }}</h2>
        <div class="card">
            <div class="card-body">
                @if ($applications->isEmpty())
                    <div class="alert alert-info">No applicants yet.</div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Applied At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $app)
                                <tr>
                                    <td>{{ $app->jobSeeker->user->name ?? '-' }}</td>
                                    <td>{{ $app->jobSeeker->user->email ?? '-' }}</td>
                                    <td>{{ $app->created_at->copy()->setTimezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                    </td>
                                    <td>
                                        <a href="{{ route('jobs.applicant_detail', $app->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
