@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Leave Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Leave Request</li>
    </ol>
    <div class="main-content mt-4">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-ms-6 d-flex justify-content-end">
                        <a href="{{route('leave.index')}}"class="btn btn-success">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <form class="form-horizontal" action="{{route('leave.store')}}" method='POST' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="control-label col-sm-4 " for="start_date">Start Date</label>
                            <div class="col-sm-5"   data-date-format="mm-dd-yyyy">
                                 <input type="" class="form-control" id="from" name="start_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="control-label col-sm-4 " for="end_date">End Date:</label>
                            <div class="col-sm-5">
                                <input type="" class="form-control" id="to" name="end_date" autocomplete="off">
                            </div>
                        </div>
                          <div class="form-group row mb-4">
                            <label class="control-label col-sm-4 " for="end_date">Description:</label>
                            <div class="col-sm-5">  
                                <textarea name="description" id="" cols="50" rows="3"></textarea>
                             </div>
                          </div>
                          <div class="form-group  col-sm-9 d-flex justify-content-end">
                            <button class="btn btn-primary ">Submit</button>
                            
                          </div>
                        
                    </form>
                </div>
                
            </div>
        </div>
        
    </div>
@endsection
