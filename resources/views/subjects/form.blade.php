@extends('master')
@section('content')

    <h1>{{ $subject ? 'Edit Subject' : 'Create Subject' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $subject ? route('subjects.update', $subject) : route('subjects.store') }}" method="POST">
        @csrf
        @if($subject)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject ? $subject->name : '') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester_id" id="semester" class="form-control">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $subject && $subject->semesters && $subject->semesters->id == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>                @endforeach
            </select>
            @error('semester_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $subject ? 'Update' : 'Create' }}</button>
    </form>
@endsection
