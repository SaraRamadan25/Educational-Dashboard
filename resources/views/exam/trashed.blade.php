@extends('master')

@section('content')
    <h1>Deleted Exams</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Exam Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trashedExams as $exam)
            <tr>
                <td>{{ $exam->name }}</td>
                <td>
                    <form action="{{ route('exams.restore', $exam) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trashedExams->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $trashedExams->currentPage() }} of {{ $trashedExams->lastPage() }}
    </div>
@endsection
