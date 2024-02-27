@extends('master')
@section('title', isset($question) ? 'Edit Question' : 'Add Question')

<div id="error-messages" class="alert alert-danger" style="display: none;"></div>
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ isset($question) ? 'Edit Question' : 'Add Question' }}</strong>
            </div>
            <div class="card-body">
                <form id="question-form" action="{{ isset($question) ? route('questions.update', $question->id) : route('questions.store') }}" method="POST">
                    @csrf
                    @if(isset($question))
                        @method('PUT')
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="question">Question:</label>
                        <input type="text" name="question" id="question" class="form-control" placeholder="Enter your question here" value="{{ isset($question) ? $question->question : '' }}">
                        <label for="subject_id">Subject:</label>
                        <select name="subject_id" id="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ isset($question) && $question->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answers">Answers:</label>
                        <div id="answers-container">
                            @if(isset($question))
                                @foreach($question->answers as $key => $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_correct" id="is_correct{{ $key }}" value="{{ $key }}" {{ $answer->is_correct ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_correct{{ $key }}">
                                            Correct Answer
                                        </label>
                                    </div>
                                    <input type="text" class="form-control" name="answers[]" id="answer{{ $key }}" placeholder="Answer {{ $key + 1 }}" value="{{ $answer->answer }}">
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add-answer" class="btn btn-secondary">Add Answer</button>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($question) ? 'Update' : 'Submit' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        let answerCount = {{ isset($question) ? count($question->answers) : 0 }};

        $('#add-answer').click(function() {
            let newAnswerField = `
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_correct" id="is_correct${answerCount}" value="${answerCount}">
            <label class="form-check-label" for="is_correct${answerCount}">
                Correct Answer
            </label>
        </div>
        <input type="text" class="form-control" name="answers[]" id="answer${answerCount}" placeholder="Answer ${answerCount + 1}">
    `;

            $('#answers-container').append(newAnswerField);
            answerCount++;
        });

        $('#question-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    window.location.href = "{{ route('questions.index') }}";
                    sessionStorage.setItem('success', 'Question added successfully.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    let response = JSON.parse(jqXHR.responseText);

                    $('#error-messages').empty().hide();

                    $.each(response.errors, function(key, value) {
                        $('#error-messages').append('<p>' + value + '</p>');
                    });

                    $('#error-messages').show();
                }
            });
        });
    });
</script>


