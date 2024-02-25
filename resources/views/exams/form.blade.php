@extends('master')
@section('content')

    <h1>{{ isset($exam) ? 'Edit Exam' : 'Create Exam' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="exam_form" action="{{ isset($exam) ? route('exams.update', $exam) : route('exams.store') }}" method="POST">
        @csrf
        @isset($exam)
            @method('PUT')
        @endisset

        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', isset($exam) ? $exam->name : '') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ isset($exam) && $exam->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
            @error('subject_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date">Exam date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', isset($exam) ? $exam->date : '') }}">
            @error('date')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Select Questions</label>
            <div id="question_list">
                @foreach($questions as $question)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="selected_questions[]" value="{{ $question->id }}"
                                   @if(isset($exam) && in_array($question->id, $exam->questions->pluck('id')->toArray())) checked @endif>
                            {{ $question->question }}
                        </label>
                    </div>
                @endforeach
                    <button type="submit" class="btn btn-primary">{{ isset($exam) ? 'Update' : 'Create' }}</button>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    {{ $questions->links('pagination::bootstrap-4') }}
                                </div>
                                <div class="d-flex justify-content-center">
                                    Page {{ $questions->currentPage() }} of {{ $questions->lastPage() }}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>

@endsection
