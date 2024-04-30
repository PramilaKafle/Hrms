@extends('layouts.master')

@section('contents')

    <h1 class="mt-4">Timesheet</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('project.selected',$projects->id) }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Timesheet</li>
    </ol>

    <div class="main-content">
        <div id="response-container" class="alert alert-danger" style="display: none"></div>

        <form action="" id="timesheetForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <input type="hidden"  id ="employee_id" name="employee_id" value="{{$employees->id}}">
                <label class="control-label col-sm-2" for="project">Project:</label>
                <div class="col-sm-3">
                    <input type="hidden"  id ="project" name="project" value="{{$projects->id}}">
                    {{$projects->name}}
                </div>
                <label class="control-label col-sm-2" for="project">Month:</label>
                <div class="col-sm-3">
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
            </div>
           
        </form>
      
        <div id='calendar' class='calendar'>
    
         
        </div>
        <div class="d-flex justify-content-end mt-4"> <!-- Added mt-4 for margin top -->
            <button  id='timesheet-btn'class="btn btn-secondary hidden">Save</button>
        </div>
       
    </div>
@endsection



