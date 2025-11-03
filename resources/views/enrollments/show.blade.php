@extends('layout')
@section('content')
    <div class="card">
        <div class="card-header">Enrollment Page </div>
        <div class="card-body">
            <h5 class="card-title">Enrollments No: {{ $enrollments->enroll_no }}</h5>
            <p class="card-text">Batch Id: {{ $enrollments->batch->name }}</p>
            <p class="card-text">Student ID: {{ $enrollments->student->name }}</p>
            <p class="card-text">Join Date: {{ $enrollments->join_date }}</p>
            <p class="card-text">Fee: {{ $enrollments->fee }}</p>
        </div>
    </div>
@endsection
