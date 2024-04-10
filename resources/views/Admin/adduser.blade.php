@extends('layouts.master')
@section('contents')

    <h1 class="mt-4">User Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Add User</li>
    </ol>
    <div class="main-content mt-4">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="card mx-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        Add New User
                    </div>
                    <div class="col-md-6  d-flex justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-success"> Back</a>

                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">


                            <form class="form-horizontal " action="{{ route('user.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="name">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="email">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="password">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="role">Role:</label>
                                    <div class="col-sm-8">
                                        <select name="roles" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="name">
                                    </label>
                                    <div class="col-sm-8  d-flex justify-content-end ">
                                        <button class="btn btn-primary"> Add User</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
