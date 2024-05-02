@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Timesheet Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">View Timesheet</li>
    </ol>
    <div class="main-content mt-4">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('timesheet.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                        

                        </div>
                        <div class="col-md-8">
                            <!-- Column for data -->
                            <table class="table">
                                <tr>
                                    <td>Name:</td>

                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
