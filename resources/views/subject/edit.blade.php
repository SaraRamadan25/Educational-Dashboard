@extends('master')

@section('content')
    <h1>Edit Subject</h1>

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}">
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester_id" id="semester" class="form-control">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $semester->id == $subject->semester_id ? 'selected' : '' }}>{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
