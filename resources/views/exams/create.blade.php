@extends('master')
@section('content')

    <h1>Create Exam</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="exam_form" action="{{ route('exams.store') }}" method="POST">
        @csrf

        <!-- Rest of the form fields -->
        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="subject_id">Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Exam date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
        </div>

        <div class="form-group">
            <label>Select Questions</label>
            <div id="question_list">
                <div class="select-question">
                    <select name="selected_questions[]" class="form-control">
                        <option value="">Select Question</option>
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="button" id="add-question" class="btn btn-secondary">+</button>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#add-question').click(function() {
            let newQuestionSelect = `
                <div class="select-question">
                    <select name="selected_questions[]" class="form-control">
                        <option value="">Select Question</option>
                        @foreach($questions as $question)
            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
            </select>
        </div>
`;

            $('#question_list').append(newQuestionSelect);
        });
    });
</script>
