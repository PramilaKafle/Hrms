@extends('layouts.master')

@section('contents')
<h1 class="mt-4">Project</h1>
<ol class="breadcrumb mb-4">
   
    <li class="breadcrumb-item active">
        <input type="hidden"  id ="projectid" name="projectid" value="{{$projects->id}}">
        {{$projects->name}}
    </li>

</ol>

<div class="main-content mt-4">
    <div class="form-group row mb-4">
        <input type="hidden"  id ="employeeid" name="employeeid" value="{{$employees->id}}">
        <label class="control-label col-sm-2" for="project">Month:</label>
        <div class="col-sm-3">
            <select name="month" id="monthselect" class="form-control">
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
    </div>
    <table class="table" id="timesheet-table-data">
        <thead style="background: #f2f2f2">
            <tr>
               
                <th scope="col" style="width: 10%">SN</th>
                <th scope="col" style="width: 10%">Timesheet ID</th>
                <th scope="col" style="width: 10%">Date</th>
                <th scope="col" style="width: 10%">Hours Worked</th>
            </tr>
        </thead>
        <tbody>
            @php
            $sl=0;
            $totalHours = 0;
            //$date= date('Y-m-d');
            $currentMonth = date('m'); 
            $currentYear = date('Y');
        @endphp
            @foreach($timesheets as $timesheet)
            @php
            // Extract month and year from the timesheet date
            $timesheetMonth = date('m', strtotime($timesheet->Date));
            $timesheetYear = date('Y', strtotime($timesheet->Date));
            @endphp
               @if ($timesheetMonth == $currentMonth && $timesheetYear == $currentYear)
            <tr>
             
                <td>{{++$sl}}</td>
                <td>{{$timesheet->id}}</td>
                <td>{{$timesheet->Date}}</td>
                <td>{{$timesheet->working_hour}}</td>
                @php
                     $totalHours += $timesheet->working_hour;
                @endphp
        
            </tr>
            @endif
            @endforeach
            <tr>
                <td colspan="3"  style="text-align:center"><strong>Total Hours worked</strong></td>
                <td colspan="3"  ><strong>{{ $totalHours }}</strong></td>
            </tr>
        </tbody>
    </table>

</div>
@endsection