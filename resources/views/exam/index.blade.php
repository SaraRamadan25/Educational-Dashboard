@extends('master')
@section('title', 'All Exams')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">

                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Exams</strong>
                <a href="{{ route('exams.trashed') }}" class="btn btn-secondary float-right">View Trashed Exams</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Exam Date</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr>
                            <th scope="row">{{$exam->id}}</th>
                            <td>{{$exam->name}}</td>
                            <td>{{$exam->date}}</td>
                            <td>{{$exam->subject->name}}</td>
                            <td>
                                <a href="{{ route('exams.edit', $exam) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('exams.destroy', $exam) }}" method="POST" style="display: inline-block;">
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

@endsection
