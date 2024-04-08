@extends('layouts.master')
@section('contents')

    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Employee</li>
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
                    <form action="{{ route('employee.update', $user->id) }}" method='POST' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                name="name" value="{{ $user->name }}">
                        </div>
                       
                              @if ($emp)  
                                <div class="form-group">
                                    <label for="" class="form-label">Employee Type:</label>
                                    <select id="" class="form-control" name="emp_type_id">
                                        <option value="">Select</option>
                                        @foreach ($employeetypes as $employeetype)
                                        <option value="{{ $employeetype->id }}"
                                            {{ $user->emp_types->contains($employeetype->id) ? 'selected': ''}}>
                                            {{ $employeetype->Name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            @endif
                      
                        <div class="form-group">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email"
                                name="email" value="{{ $user->email }}">
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
