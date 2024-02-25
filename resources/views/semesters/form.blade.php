@extends('master')
@section('content')

    <h1>{{ $semester ? 'Edit Semester' : 'Create New Semester' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $semester ? route('semesters.update', $semester) : route('semesters.store') }}" method="POST">
        @csrf
        @if($semester)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="year">Year</label>
            <select name="year_id" id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}" {{ $semester && $semester->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                @endforeach
            </select>
            @error('year_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Semester Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $semester ? $semester->name : '') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $semester ? 'Update' : 'Submit' }}</button>
    </form>
@endsection
