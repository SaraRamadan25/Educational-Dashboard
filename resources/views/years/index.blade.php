@extends('master')
@section('title', 'Academic Years')

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
                <strong class="card-title">Academic Years</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Year Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($years as $year)
                        <tr>
                            <td>{{ $year->name }}</td>
                            <td>
                                <a href="{{ route('years.edit', $year) }}" class="btn btn-primary">Edit</a>

                                <form action="{{ route('years.destroy', $year) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <a href="{{ route('years.trashed', ['trashed' => true]) }}" class="btn btn-secondary">View Trashed Years</a>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {{ $years->links('pagination::bootstrap-4') }}
                </div>
                <div class="d-flex justify-content-center">
                    Page {{ $years->currentPage() }} of {{ $years->lastPage() }}
                </div>
            </div>
        </div>
    </div>

@endsection
