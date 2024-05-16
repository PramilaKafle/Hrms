@extends('layouts.master')

@section('contents')
    <h1 class="mt-4">Timesheet</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('project.selected', $projects->id) }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Timesheet</li>
    </ol>

    <div class="main-content">
        <div id="response-container" class="alert alert-danger" style="display: none"></div>

        <form action="" id="timesheetForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <input type="hidden" id ="employee_id" name="employee_id" value="{{ $employees->id }}">
                <label class="control-label col-sm-2" for="project">Project:</label>
                <div class="col-sm-2">
                    <input type="hidden" id ="project" name="project" value="{{ $projects->id }}">
                    {{ $projects->name }}
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
                {{-- <label class="control-label col-sm-2" for="user">Assign To:</label>
                <div class="col-sm-2">
                    <select name="user" id="assign-to-user" class="form-control">
                        <option value="" disabled selected>Select</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
            </div>

        </form>

        <div id='calendar' class='calendar'>


        </div>
        <div class="d-flex justify-content-end mt-4">
            <button id='timesheet-approve-btn'class="btn  btn-sm btn-primary  mx-2 hidden" data-bs-toggle="modal"
                data-bs-target="#myModal">Submit for Approve</button>
            <button id='timesheet-btn'class="btn btn-secondary hidden">Save</button>


        </div>

    </div>
    <!-- Modal Example Start-->
    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Submit Timesheet</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($statuses as $status)
                            <div class="form-group row">
                                <label class="control-label col-sm-5" for="check">
                                  <input type="text" value="{{ $status->id }}" hidden>  <strong>For {{ $status->name }}</strong>
                                </label>
                                <div class="col-sm-7"> <!-- Use col-sm-7 for the right column -->
                                    <div class="row">
                                        <label class="control-label col-sm-5">Assign To:</label>
                                        <div class="col-sm-7"> <!-- Use col-sm-7 for the select field -->
                                            <select name="assignTo" id="assignTo_{{$status->id}}" class="form-control">
                                                <option value="" disabled selected>select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"  id="timesheet-submit-btn">Submit </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Example End-->
@endsection



<script></script>
