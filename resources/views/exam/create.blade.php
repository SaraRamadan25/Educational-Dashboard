@extends('master')

@section('content')
    <h1>Create New Exam</h1>

    <form action="{{ route('exams.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="date">Exam Date</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <select name="subject_id" id="subject" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="questions">Questions</label>
            <select name="questions[]" id="questions" class="form-control" multiple>
                @foreach($questions as $question)
                    <option value="{{ $question->id }}">{{ $question->question }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
