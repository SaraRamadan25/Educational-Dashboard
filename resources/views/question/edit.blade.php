@extends('master')
@section('title', 'Edit Question')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Edit Question</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('questions.update', $question) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="question">Question:</label>
                        <input type="text" name="question" id="question" class="form-control" value="{{ $question->question }}">
                        <label for="subject_id">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $question->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
