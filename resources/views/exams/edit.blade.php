@extends('master')
@section('content')

    <h1>Edit Exam</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="exam_form" action="{{ route('exams.update', $exam) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Rest of the form fields -->
        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $exam->name) }}">
        </div>

        <div class="form-group">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $exam->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Exam date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $exam->date) }}">
        </div>

        <div class="form-group">
            <label>Select Questions</label>
            <div id="question_list">
                @foreach($questions as $question)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="selected_questions[]" value="{{ $question->id }}"
                                   @if(in_array($question->id, $exam->questions->pluck('id')->toArray())) checked @endif>
                            {{ $question->question }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
