@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Employee Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Employee Table</li>
    </ol>
    <div class="main-content mt-4">
        <div class="card  mb-4">
            <div class="card-header">
                <div class="row">

                    <div class="col-md-6">
                        <h4>All Users</h4>
                    </div>
                    <div class="col-md-6  d-flex justify-content-end">

                        <a class="btn btn-success " href="{{ route('employee.create') }}">Create Employee</a>

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
                            <th scope="col" style="width: 10%">Employee_id</th>
                            <th scope="col" style="width: 10%"> Employee_type</th>

                            <th scope="col" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allusers as $alluser)
                            <tr>
                                <th scope="row">{{ $alluser->id }}</th>
                                <td>{{ $alluser->name }}</td>
                                <td>{{ $alluser->email }}</td>

                                @if ($alluser->emp_types->isNotEmpty())
                                    @foreach ($alluser->emp_types as $emp)
                                        @php
                                            $matchedEmpIds = $employees->where('user_id', $alluser->id);
                                        @endphp
                                        <td>{{ $matchedEmpIds->implode('id', ', ') }}</td>

                                        <td>{{ $emp->Name }}</td>
                                    @endforeach
                                @else
                                    <td>-</td>
                                    <td>-</td>
                                @endif

                                <td>
                                    <div class="d-flex">

                                        <a class="btn-sm btn-success btn mx-2"
                                            href="{{ route('employee.edit', $alluser->id) }}">Edit </a>
                                        <a class="btn-sm btn-primary btn mx-2"
                                            href="{{ route('employee.show', $alluser->id) }}">View</a>


                                        <form action="{{ route('employee.destroy', $alluser->id) }}" method="POST">
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

            </div>
        </div>
    </div>
@endsection
