@extends('master')
@section('content')

    <h1>Create Year</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('years.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Year Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
