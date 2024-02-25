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
        @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->name }}</td>
                <td>
                    <form action="{{ route('semesters.destroy', $semester) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $semesters->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $semesters->currentPage() }} of {{ $semesters->lastPage() }}
    </div>
@endsection
