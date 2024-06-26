@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Employee Table</li>
    </ol>
    <div class="main-content mt-4">
        @if ($message = @session('success'))
            <div class="alert alert-danger ">{{ $message }}</div>
        @elseif($message = @session('error'))
            <div class="alert alert-danger">{{ $message }}</div>
        @endif
        <div class="card  mb-4">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">
                        <h4>All Employees</h4>
                    </div>
                    <div class="col-md-6  d-flex justify-content-end">

                        <a class="btn btn-success  mx-2" href="{{ route('employee.create') }}">Create Employee</a>
                        
                        <a class="btn btn-success" href="{{ route('employee.assign') }}">Assign Project</a>
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class=" table">
                    <thead style="background: #f2f2f2">
                        <tr>
                            <th scope="col" style="width: 10%">User_id</th>
                            <th scope="col" style="width: 10%">Name</th>
                            <th scope="col" style="width: 10%">Email</th>
                            <th scope="col" style="width: 15%">Project Assigned</th>
                            <th scope="col" style="width: 10%">Employee_id</th>
                            <th scope="col" style="width: 10%"> Employee_type</th>
                           
                            <th scope="col" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                
                                @foreach ($employee->emp_types as $emp)
                                
                                    @php
                                        $matchedEmpIds = $empid->where('user_id', $employee->id);
                                        $projectNames = '';
                                    @endphp
                                     <td> 
                                     @foreach ($matchedEmpIds as  $matchedEmpId )
                                     @if($matchedEmpId->projects->isNotEmpty())
                                     @foreach($matchedEmpId->projects as $project)
                                     
                                    
                                        {{ $project->name }}
                                        @if (!$loop->last)
                                           ,
                                    @endif
                                     @endforeach
                                    @else
                                    Not Assigned
                                    @endif
                                     @endforeach
                                    </td>
                                    <td>{{ $matchedEmpIds->implode('id', ', ') }}</td>
                                    <td>{{ $emp->Name }}</td>
                                @endforeach

                                <td>
                                    <div class="d-flex">

                                        <a class="btn-sm btn-success btn mx-2"
                                            href="{{ route('employee.edit', $employee->id) }}">Edit </a>
                                        <a class="btn-sm btn-primary btn mx-2"
                                            href="{{ route('employee.show', $employee->id) }}">View</a>


                                        <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger btn">Delete</button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               {{$employees->links()}}

            </div>
        </div>
    </div>
@endsection
