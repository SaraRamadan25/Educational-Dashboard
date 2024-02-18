@extends('master')
@section('title', 'Add Question')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Add Question</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('questions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <input type="text" name="question" id="question" class="form-control" placeholder="Enter your question here">
                        <label for="subject_id">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answers">Answers:</label>
                        @for($i = 0; $i < 4; $i++)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_correct" id="is_correct{{ $i }}" value="{{ $i }}">
                                <label class="form-check-label" for="is_correct{{ $i }}">
                                    Correct Answer
                                </label>
                            </div>
                            <input type="text" class="form-control" name="answers[]" id="answer{{ $i }}" placeholder="Answer {{ $i + 1 }}">
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
