@extends('master')
@section('content')

    <h1>Edit Subject</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Subject Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject->name) }}">

        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <select name="year_id" id="year" class="form-control">
                @foreach($years as $year)
                    <option value="{{ $year->id }}" {{ ($subject->year->id ?? '') == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
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
                    <option value="{{ $semester->id }}" {{ ($subject->semester->id ?? '') == $semester->id ? 'selected' : '' }}>{{ $semester->name }}</option>
                @endforeach
            </select>
            @error('semester_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
