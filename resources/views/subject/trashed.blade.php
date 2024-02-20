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
        @foreach($trashedSubjects as $subject)
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

    <div class="d-flex justify-content-center">
        {{ $trashedSubjects->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $trashedSubjects->currentPage() }} of {{ $trashedSubjects->lastPage() }}
    </div>
@endsection
