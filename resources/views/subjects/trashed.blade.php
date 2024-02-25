@extends('master')
@section('content')
    <h1>Deleted Subjects</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Subjects Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td>
                    <form action="{{ route('subjects.restore', $subject) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
