@extends('master')
@section('title', 'Academic Semesters')

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <!-- Add any content if needed -->
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <!-- Add any content if needed -->
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
                <strong class="card-title">Academic Semesters</strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Semester Name</th>
                        <th scope="col">Semester's Year</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($semesters as $semester)
                        <tr>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->year->name }}</td>
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
                    {{ $semesters->links('pagination::bootstrap-4') }}
                </div>
                <div class="d-flex justify-content-center">
                    Page {{ $semesters->currentPage() }} of {{ $semesters->lastPage() }}
                </div>
            </div>
        </div>
    </div>
@endsection
