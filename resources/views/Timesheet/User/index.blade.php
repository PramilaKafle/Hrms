@extends('layouts.master')
@section('contents')
@inject('carbon', 'Carbon\Carbon')
    <h1 class="mt-4">Timesheet Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Timesheet Information</li>
    </ol>
    <div class="main-content mt-4">
        <div id="response-container" class="alert alert-danger" style="display: none"></div>
      <div class="conatiner">
      <div><a href="{{route('timesheet.status')}}"><button class="btn btn-secondary">Timesheet Status</button></a></div>
        {{-- <form action="" id="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <label class="control-label col-sm-2" for="project">Project:</label>
                <div class="col-sm-3">
                    <select name="projectdata" id="projectdata" class="form-control" required>
                        <option value="" disabled selected>Select</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="control-label col-sm-2" for="project">Month:</label>
                <div class="col-sm-2">
                    <select name="month" id="month" class="form-control">
                        <option value="" disabled selected>Select</option>
                        @php
                            $months = [
                                'January',
                                'February',
                                'March',
                                'April',
                                'May',
                                'June',
                                'July',
                                'August',
                                'September',
                                'October',
                                'November',
                                'December',
                            ];
                        @endphp
                        @foreach ($months as $key => $month)
                            <option value="{{ $key + 1 }}">{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="control-label col-sm-2" for="employee">Employee:</label>
                <div class="col-sm-3">
                    <select name="employeedata" id="employeedata" class="form-control" required>
                        <option value="" disabled selected>Select</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-group row mb-4">
                <label class="control-label col-sm-2" for="startdate">From:</label>
                <div class="col-sm-3">
                    <input type="" class="form-control" id="startdate" name="startdate" required>
                </div>
                <label class="control-label col-sm-2" for="enddate">To:</label>
                <div class="col-sm-3">
                    <input type="" class="form-control" id="enddate" name="enddate" required>
                </div>
            </div>
            <div class=' d-flex justify-content-end'><button class="btn btn-sm btn-primary" id="timesheet-generate"> Generate</button></div>
        </form> --}}
    </div>
    <div id="timesheet-data-not-found" class="alert alert-primary mt-4 text-center hidden" role="alert"> <h1><strong>Timesheet Data  Not Found</strong></h1></div>
            <table class="table mt-4" id="timesheettable" >
                <thead style="background: #d6e1d5">
                    <tr>
                        {{-- <th scope="col" style="width: 10%">SN</th>  
                        <th scope="col" style="width: 10%">TimesheetID</th>
                        <th scope="col" style="width: 10%">Date</th>
                        <th scope="col" style="width: 10%">Hours Worked</th>
                        <th scope="col" style="width: 10%">Status</th> --}}
                        <th scope="col" style="width: 10%">SN</th>  
                        <th scope="col" style="width: 10%">Employee Name</th> 
                        <th scope="col" style="width: 10%">TimesheetID</th>
                        <th scope="col" style="width: 10%">Month</th>
                       
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                
                </thead>
                <tbody>
                    <tr>
                        @foreach($timesheets as $timesheet)
                        @php
                       
                            $sl=0;
                        @endphp
                        <td>
                            {{++$sl}}
                        </td>
                        <td>{{$timesheet->employee_id}}</td>
                        <td>{{$timesheet->monthlytimesheet_id}}</td>
                        <td>{{$timesheet->month_id}}</td>
                        <td><button type="button" class="btn btn-success"></button></td>
                        
                        @endforeach
                    </tr>
               
                </tbody>
            </table>

        
    </div>
@endsection
