@extends('layouts.master')

@section('contents')
<h1 class="mt-4">Timesheet</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Timesheet Information</li>
</ol>

<div class="main-content mt-4">
 
    <div class="card mx-6">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-success mx-1" href="{{route('timesheet.create')}}">Add Timesheet</a>
                </div>
              
            </div>
        </div>
        <div class="card-body">
            
                   
        </div>
    </div>
</div>
@endsection