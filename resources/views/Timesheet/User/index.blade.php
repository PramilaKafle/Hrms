@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Timesheet Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Timesheet Table</li>
    </ol>
    <div class="main-content mt-4">
        <form action="" id="" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group row mb-4">
            <label class="control-label col-sm-2" for="project">Project:</label>
            <div class="col-sm-3">
                <select name="project" id="projectdata" class="form-control">
                    <option value="" disabled selected>Select</option>
                    @foreach ($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>  --}}
        </form>

        <div class="card">
            <table class="table">
                <thead style="background: #d6e1d5">
                    <tr>
                        <th scope="col" style="width: 10%">SN</th>  
                        <th scope="col" style="width: 30%">Employee Name</th>
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 0;
                    @endphp
                    @foreach ($timesheetdataes->groupBy('employee_id') as $employeeId => $timesheetdatas)
                            @foreach ($timesheetdatas as $timesheetdata)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ $timesheetdatas->count() }}">
                                            {{ ++$sl }}
                                        </td>
                                        <td rowspan="{{ $timesheetdatas->count() }}">
                                            @foreach ($users as $user)
                                            @php
                                                $userid = $user->id;
                                                $matchedemployeeid = $employee->where('user_id', $userid)->first();
                                            @endphp
                                            @if ($employee && $matchedemployeeid && $matchedemployeeid->id == $timesheetdata->employee_id)
                                                {{ $user->name }}
                                            @endif
                                          @endforeach
                                        </td>
                                    @endif
                               
                                    @if ($loop->first)
                                        <td rowspan="{{ $timesheetdatas->count() }}">
                                            <a class="btn-sm btn-primary btn mx-2"
                                href="{{route("timesheet.show",$timesheetdata->employee_id)}}">View Details </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        


    </div>
@endsection
