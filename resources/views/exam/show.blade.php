@extends('master')

@section('title', 'Exam Questions')

@section('content')
    <h1>{{ $exam->name }}</h1>
    <h2>Questions:</h2>
    <ul>
        @foreach($exam->questions as $question)
            <li>{{ $question->question }}</li>
        @endforeach
    </ul>
@endsection
