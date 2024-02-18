@extends('master')

@section('content')
    <div class="container">
        <h1>Statistics</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Statistic</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Number of years</td>
                <td>{{ $yearCount }}</td>
            </tr>
            <tr>
                <td>Number of semesters</td>
                <td>{{ $semesterCount }}</td>
            </tr>
            <tr>
                <td>Number of subjects</td>
                <td>{{ $subjects }}</td>
            </tr>
            </tbody>
        </table>

        <h2>Semesters in each year</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Year</th>
                <th>Number of Semesters</th>
            </tr>
            </thead>
            <tbody>
            @foreach($semesters_in_year as $year)
                <tr>
                    <td>{{ $year->name }}</td>
                    <td>{{ $year->semesters_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h2>Subjects in each year</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Year</th>
                <th>Number of Subjects</th>
            </tr>
            </thead>
            <tbody>
            @foreach($years_with_subjects as $year)
                <tr>
                    <td>{{ $year->name }}</td>
                    <td>{{ $year->subjects_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h2>Academic Years that have Exams</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Year</th>
            </tr>
            </thead>
            <tbody>
            @foreach($years_with_exams as $year)
                <tr>
                    <td>{{ $year->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
