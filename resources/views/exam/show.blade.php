@extends('master')

@section('content')
    <h1>{{ $exam->name }}</h1>

    @foreach($exam->questions as $question)
        <p>{{ $question->question }}</p>
    @endforeach
@endsection
