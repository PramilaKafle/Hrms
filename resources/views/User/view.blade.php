@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">User Information</li>
    </ol>
    <div class="main-content mt-4">
        <div class="card mx-6">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>User Details</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('user.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Column for image -->
                           
                            <img width="" src="{{ asset($users->image) }}" alt="">
        
                        </div>
                        <div class="col-md-8">
                            <!-- Column for data -->
                            <table class="table">
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $users->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $users->email }}</td>
                                </tr>
                                <tr>
                                    <td>User Id:</td>
                                    <td>{{ $users->id }}</td>
                                </tr>
                            
                                <tr>
                                    <td>Role Assigned:</td>
                                    <td>
                                        @if($users->roles->isNotEmpty())
                                            @foreach($users->roles as $role)
                                                <span>{{ $role->name }}</span><br>
                                            @endforeach
                                        @else
                                            <span>Not Assigned</span>
                                        @endif
                                    </td>
                                </tr>
                                
                               
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
