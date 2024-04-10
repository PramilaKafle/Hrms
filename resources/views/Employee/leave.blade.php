@extends('layouts.master')

@section('contents')
<h1 class="mt-4">Leave Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Leave Information</li>
</ol>
<div class="main-content mt-4">
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
                    @foreach($leaves as $leave)
                
                    <tr>
                        
                        <td>{{$leave->id}}</td>
                        <td>{{$leave->created_at->format('Y-m-d')}}</td>
                     
                       
                           
                        <td>{{$users->implode('name','')}}</td>
             
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>
                       
                        <td>
                        </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        @else
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('leave.create')}}" class="btn btn-success">Request Leave</a>
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
                        <th scope="col" style="width: 10%">Status</th>
                        <th scope="col" style="width: 10%">Action</th>
    
                       
                    </tr>
                </thead>
                <tbody>
                    {{-- @can('hasleaveRequest') --}}
                    @foreach($leaves as $leave)
                    <tr>
                        
                        <td>{{$leave->id}}</td>
                        <td>{{$leave->start_date}}</td>
                        <td>{{$leave->end_date}}</td>
                        <td>--</td>
                        <td>
                            <form action="{{ route('leave.destroy', $leave->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger btn">Cancel Request</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    {{-- @endcan --}}
                
                </tbody>
            </table>
        </div>
            
        @endcannot
       
    </div>
    
</div>
@endsection