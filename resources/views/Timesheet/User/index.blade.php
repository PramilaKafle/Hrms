@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Timesheet Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Timesheet Information</li>
    </ol>
    <div class="main-content mt-4">
        <div id="response-container" class="alert alert-danger" style="display: none"></div>
      <div class="conatiner">
        <form action="" id="" method="POST" enctype="multipart/form-data">
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
        </form>
    </div>
    <div id="timesheet-data-not-found" class="alert alert-primary mt-4 text-center hidden" role="alert"> <h1><strong>Timesheet Data  Not Found</strong></h1></div>
            <table class="table mt-4 hidden" id="timesheettable" >
                <thead style="background: #d6e1d5">
                    <tr>
                        <th scope="col" style="width: 10%">SN</th>  
                        <th scope="col" style="width: 10%">TimesheetID</th>
                        <th scope="col" style="width: 10%">Date</th>
                        <th scope="col" style="width: 10%">Hours Worked</th>
                        
                    </tr>
                
                </thead>
                <tbody>
               
                </tbody>
            </table>
    </div>
@endsection
