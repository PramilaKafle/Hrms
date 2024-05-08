@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Report</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Report Generation</li>
    </ol>
    <div class="main-content mt-4">

        <div><a href="{{ route('report.monthly') }}"> Monthly Timesheet Report</a></div>

    </div>
@endsection
