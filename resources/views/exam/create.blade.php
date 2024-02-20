@extends('master')

@section('content')
    <h1>Create New Exam</h1>

    <form action="{{ route('exams.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <!-- Add other form fields as needed -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
