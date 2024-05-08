@extends('layouts.master')

@section('contents')
    <h1 class="mt-4">Leave Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Leave Information</li>
    </ol>
    <div class="main-content mt-4">
        @if ($message = @session('error'))
            <div class="alert alert-danger">{{ $message }}</div>
        @endif
        @cannot('hasEmployeeType')
        <div class="input-group rounded justify-content-end mb-4">
            <input type="search" class="form-group rounded"  id="searchInput" placeholder="Search" aria-label="Search">
            
          </div>
        @endcannot
        <div class="card">
            @cannot('hasEmployeeType')
         
                <table class="table">
                    <thead style="background: #a7d7a3">
                        <tr>
                            <th scope="col" style="width: 10%">Request ID</th>
                            <th scope="col" style="width: 10%">Applied ON</th>
                            <th scope="col" style="width: 10%">Employee Name</th>
                            <th scope="col" style="width: 10%">Start Date</th>
                            <th scope="col" style="width: 10%">End Date</th>
                            <th scope="col" style="width: 10%">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>

                                <td>{{ $leave->id }}</td>
                                <td>{{ $leave->created_at->format('Y-m-d') }}</td>
                              
                                <td>
                                    @foreach ($users as $user)
                                        @php
                                            $userid = $user->id;
                                          
                                            $matcheemployeedid = $employee->where('user_id', $userid)->first();
                                            //@dd($matcheemployeedid);
                                        @endphp
                                     
                                        @if ($employee && $matcheemployeedid && $matcheemployeedid->id == $leave->emp_id)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>

                                <td>
                                    <div class="d-flex">

                                        <a class="btn-sm btn-success btn mx-2" href="{{ route('leave.approve', $leave->id) }}">
                                            @if ($leave->status == 'approved')
                                                Approved
                                            @else
                                                Approve
                                            @endif
                                        </a>

                                        <a class="btn-sm btn-danger btn mx-2" href="{{ route('leave.decline', $leave->id) }}">
                                            @if ($leave->status == 'declined')
                                                Declined
                                            @else
                                                Decline
                                            @endif
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{$leaves->links()}}
            @else
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('leave.create') }}" class="btn btn-success">Request Leave</a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <h1 class="mb-4" style="color:#e94e3d; font-weight:bold"> Remaining LeaveDays:
                                {{ $remainingleavedays }}</h1>
                        </div>


                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead style="background: #f2f2f2">
                            <tr>
                                <th scope="col" style="width: 10%">ID</th>
                                <th scope="col" style="width: 10%">Start Date</th>
                                <th scope="col" style="width: 10%">End Date</th>
                                <th scope="col" style="width: 10%">Applied for</th>
                                <th scope="col" style="width: 10%">Status</th>
                                <th scope="col" style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>

                                    <td>{{ $leave->id }}</td>
                                    <td>{{ $leave->start_date }}</td>
                                    <td>{{ $leave->end_date }}</td>
                                    <td>{{ $leave->applied_for }}</td>
                                    <td>{{ $leave->status }}</td>
                                    <td>
                                        <form action="{{ route('leave.destroy', $leave->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger btn">Cancel Request</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$leaves->links()}}
                </div>
            @endcannot
         
        </div>

    </div>
@endsection
