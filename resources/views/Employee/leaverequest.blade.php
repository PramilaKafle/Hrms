@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Leave Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Leave Request</li>
    </ol>
    <div class="main-content mt-4">
        <div class="card">
            <div class="card-header">
                <div class="row"></div>
            </div>
            <div class="card-body">
                <form action="" method='POST' enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection
