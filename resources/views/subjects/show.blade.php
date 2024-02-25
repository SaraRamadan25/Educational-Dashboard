@extends('master')

@section('content')
    <h1>Subject: {{ $subject->name }}</h1>

    <div>
        <h2>Semester: {{ $subject->semesters->name }}</h2>
    </div>

    <a href="{{ route('subjects.index') }}">Back to Subjects</a>
@endsection
