@extends('master')
@section('content')
    <h1>Edit Semester</h1>

    <form action="{{ route('semesters.update', $semester) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Semester Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $semester->name }}">
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <select name="year_id" id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}" {{ $semester->year->id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
