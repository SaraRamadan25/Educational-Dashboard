@extends('master')

@section('content')
    <h1>Create New Year</h1>

    <form action="{{ route('years.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Year Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
