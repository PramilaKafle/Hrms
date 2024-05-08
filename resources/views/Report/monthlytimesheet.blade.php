@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Report</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('report.index') }}">Back</a></li>
        <li class="breadcrumb-item active">Monthly Timesheet Report</li>
    </ol>
    <div class="main-content mt-4">
        <form action="" id="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <label class="control-label col-sm-2" for="start_date">Start Date:</label>
                <div class="col-sm-3">
                    <input type="" class="form-control" id="start_date" name="start_date" autocomplete="off">
                </div>
                <label class="control-label col-sm-2" for="end_date">End Date:</label>
                <div class="col-sm-3">
                    <input type="" class="form-control" id="end_date" name="end_date" autocomplete="off">
                </div>
            </div>
            <div class=' d-flex justify-content-end'><button class="btn btn-sm btn-primary" id="report-generate">
                    Generate</button></div>
        </form>

        <div id="report-table"></div>
    </div>
@endsection
