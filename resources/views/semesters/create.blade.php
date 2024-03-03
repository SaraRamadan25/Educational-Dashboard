@extends('master')
@section('content')

    <h1>Create New Semester</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('semesters.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="year">Year</label>
            <select name="year_id" id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">Semester Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
