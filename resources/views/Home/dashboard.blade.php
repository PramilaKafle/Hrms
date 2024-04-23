@extends('layouts.master')
@section('contents')

    {{-- @if (auth()->user()->emp_types()->exists())
   

    @else --}}

    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    @cannot('hasEmployeeType')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header align-items-center">Total Users</div>
                    <div class="card-body">
                        <div class=" d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-user fa-lg mr-2"></i>
                            <!-- Added fa-lg class to increase icon size and mr-2 for margin -->
                            <div class="text-white mx-2" style="font-size: 20px;">{{ $allusers->count() }}</div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-header align-items-center">Employees</div>
                    <div class="card-body">
                        <div class=" d-flex align-items-center justify-content-center">
                         
                            <div class="text-white mx-2" style="font-size: 20px;">{{ $employees->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>User_id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Employee_id</th>
                            <th>Employee Type</th>
                            <th></th>
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
                                <td></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcannot
    {{-- 
    @endif --}}


@endsection
