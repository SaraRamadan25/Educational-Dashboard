@extends('master')
@section('content')
    <h1>Deleted Questions</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Question</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trashedQuestions as $question)
            <tr>
                <td>{{ $question->question }}</td>
                <td>
                    <form action="{{ route('questions.restore', $question) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trashedQuestions->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $trashedQuestions->currentPage() }} of {{ $trashedQuestions->lastPage() }}
    </div>
@endsection
