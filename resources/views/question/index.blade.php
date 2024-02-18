@extends('master')
@section('title', 'All Questions')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Questions</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Question</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <th scope="row">{{$question->id}}</th>
                            <td>{{$question->question}}</td>
                            <td>{{$question->subject->name}}</td>
                            <td>
                                <a href="{{ route('questions.create', ['subject' => $question->subject->name]) }}" class="btn btn-primary">Add Question</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {{ $questions->links('pagination::bootstrap-4') }}
                </div>
                <div class="d-flex justify-content-center">
                    Page {{ $questions->currentPage() }} of {{ $questions->lastPage() }}
                </div>
            </div>
        </div>
    </div>
@endsection
