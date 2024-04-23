@extends('layouts.master')

@section('contents')
    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Project Assign</li>
    </ol>
    <div class="main-content mt-4">
        @if($message=@session('success'))
        <div class="alert alert-danger">{{ $message }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('employee.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('employee.project')}}" method='POST' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Employee Name:</label>
                            <select id="" class="form-control" name="user_id">
                                <option value="">Select</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Project Name:</label>
                            <select id="" class="form-control" name="project_id[]" multiple>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">
                                        {{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
