@extends('layouts.master')
@section('contents')
<h1 class="mt-4">Timesheet Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('projectdash') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Assigned Projects</li>
</ol>
<div class="main-content mt-4">
    <div class="card mx-6">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4>Project Information</h4>
                </div>
                <div class="col d-flex justify-content-end">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class=" table">
                <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 10%">SN</th>
                        <th scope="col" style="width: 10%">Name</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sl=0;
                @endphp
                    @foreach($projects as $project)
                    <tr>
                       
                    <th scope="row">{{++$sl}}</th>
                    <td>
                        <a href="{{route('timesheet.create',$project->id)}}">{{$project->name}}</a>
                    </td>

                </tr>
                    @endforeach  
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection