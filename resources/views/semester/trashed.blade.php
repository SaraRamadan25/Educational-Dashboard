@extends('master')
@section('content')
    <h1>Deleted Semesters</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Semesters Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trashedSemesters as $semester)
            <tr>
                <td>{{ $semester->name }}</td>
                <td>
                    <form action="{{ route('semester.restore', $semester) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trashedSemesters->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $trashedSemesters->currentPage() }} of {{ $trashedSemesters->lastPage() }}
    </div>
@endsection
