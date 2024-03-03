@extends('master')
@section('content')

    <h1>Create Subject</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <select name="year_id" id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                @endforeach
            </select>
            @error('year_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select name="semester_id" id="semester" class="form-control">
                @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
            @error('semester_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                var yearId = $(this).val();
                if (yearId) {
                    $.ajax({
                        url: '/get-semesters/'+yearId,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#semester').empty();
                            $.each(data, function(key, value) {
                                $('#semester').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#semester').empty();
                }
            });
        });
    </script>
@endsection
