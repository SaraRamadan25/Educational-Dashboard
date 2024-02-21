@extends('master')
@section('title', 'Academic Semesters')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Academic Semesters</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Semester Name</th>
                        <th scope="col">Semester's Year</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($semesters as $semester)
                        <tr>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->year->name }}</td>
                            <td>
                                <a href="{{ route('semesters.edit', $semester) }}" class="btn btn-primary">Edit</a>

                                <form action="{{ route('semesters.destroy', $semester) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('semesters.trashed') }}" class="btn btn-secondary">View Trashed Semesters</a>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {{ $semesters->links('pagination::bootstrap-4') }}
                </div>
                <div class="d-flex justify-content-center">
                    Page {{ $semesters->currentPage() }} of {{ $semesters->lastPage() }}
                </div>
            </div>
        </div>
    </div>
@endsection
