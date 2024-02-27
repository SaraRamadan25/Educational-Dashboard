@extends('master')
@section('title', 'All Questions')

@section('content')
    <div id="success-message" class="alert alert-success" style="display: none;"></div>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Questions</strong>
                <a href="{{ route('questions.trashed') }}" class="btn btn-secondary float-right">View Trash</a>
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
                            <td>{{ $question->subject ? $question->subject->name : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('questions.form', $question) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('questions.destroy', $question) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        let successMessage = sessionStorage.getItem('success');

        if (successMessage) {
            $('#success-message').text(successMessage).show();
            sessionStorage.removeItem('success');
        } else {
            $('#success-message').hide();
        }
    });
</script>
