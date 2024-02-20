@extends('master')

@section('content')
    <h1>Edit Exam</h1>

    <form action="{{ route('exams.update', $year) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $exam->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
