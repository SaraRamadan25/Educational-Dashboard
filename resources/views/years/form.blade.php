@extends('master')
@section('content')

    <h1>{{ $year ? 'Edit Year' : 'Create Year' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $year ? route('years.update', $year) : route('years.store') }}" method="POST">
        @csrf
        @if($year)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Year Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $year ? $year->name : '') }}">

        </div>

        <button type="submit" class="btn btn-primary">{{ $year ? 'Update' : 'Create' }}</button>
    </form>
@endsection
