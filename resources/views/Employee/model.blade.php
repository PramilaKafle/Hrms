@extends('layouts.master')

@section('contents')

    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">
            @if (isset($user))
                Edit Employee
            @else
                Create Employee
            @endif
        </li>
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

                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('employee.index') }}">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form @if(isset($user))
                    action="{{ route('employee.update', $user->id) }}"
                    @else
                    action="{{ route('employee.store') }}" 
                    @endif
                    method='POST' enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))  @method('PUT') @endif
                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                name="name" @if(isset($user))  value="{{ $user->name }}" @endif>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-label">Employee Type:</label>
                            <select id="" class="form-control" name="emp_type_id">
                                <option value="">Select</option>

                                @foreach ($employeetypes as $employeetype)
                                    <option @if(isset($user))  {{ $user->emp_types->contains($employeetype->id) ? 'selected': ''}} @endif 
                                        value="{{ $employeetype->id }}">{{ $employeetype->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(isset($user))
                        <div class="form-group">
                            <label for="" class="form-label">Project:</label>
                            <select id="" class="form-control" name="project[]" multiple>
                               
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ $employee->projects->contains($project->id) ? 'selected': ''}} >
                                    {{ $project->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email"
                                name="email" @if(isset($user))  value="{{ $user->email }}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password"
                                name="password">
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection
