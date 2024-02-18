@extends('master')
    @section('title','All Subjects')
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Subjects</strong>
            </div>

                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">semester name</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <th scope="row">{{$subject->id}}</th>
                            <td>{{$subject->name}}</td>
                            <td>{{$subject->semester->name}}</td>

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
                    {{ $subjects->links('pagination::bootstrap-4') }}
                </div>
                <div class="d-flex justify-content-center">
                    Page {{ $subjects->currentPage() }} of {{ $subjects->lastPage() }}
                </div>
            </div>
        </div>
    </div>
@endsection
