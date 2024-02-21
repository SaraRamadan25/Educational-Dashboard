@extends('master')
@section('content')

    <h1>Deleted Years</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Year Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trashedYears as $year)
            <tr>
                <td>{{ $year->name }}</td>
                <td>
                    <form action="{{ route('years.restore', $year) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $trashedYears->links('pagination::bootstrap-4') }}
    </div>
    <div class="d-flex justify-content-center">
        Page {{ $trashedYears->currentPage() }} of {{ $trashedYears->lastPage() }}
    </div>
@endsection
