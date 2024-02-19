@extends('master')

@section('content')
    <h1>Edit Year</h1>

    <form action="{{ route('years.update', $year) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Year Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $year->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
