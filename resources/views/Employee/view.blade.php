@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">View Detail</li>
    </ol>
    <div class="main-content mt-4">
        <div class="card mx-6">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>View Detail</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('employee.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            @if (is_null($user->image) || $user->image === '')
                            <h1><strong>No Image Found</strong></h1>
                            @else
                            <img width="" src="{{ asset($user->image) }}" alt="">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <!-- Column for data -->
                            <table class="table">
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>User Id:</td>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    {{-- @if ($employee) --}}
                                        <td>Employee ID:</td>
                                        <td>{{ $employee->id }}</td>
                                </tr>
                                <tr>
                                    <td>Employee Type:</td>
                                    @foreach($user->emp_types as $emptype)
                                    <td>{{ $emptype->Name }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>Project Assigned:</td>
                                   
                                    <td>
                                        @if($employee->projects->isNotEmpty() )
                                        @foreach($employee->projects as $project)
                                            {{ $project->name }}
                                            @if (!$loop->last) 
                                                ,
                                            @endif
                                        @endforeach
                                        @else
                                        Not Assigned
                                        @endif
                                    </td>
                                
                                </tr>
                                {{-- @endif --}}
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
