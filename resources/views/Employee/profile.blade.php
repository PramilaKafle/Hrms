@extends('layouts.master')
@section('contents')
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profile View</li>
    </ol>
    <div class="main-content mt-4">
        @if ($message = @session('success'))
        <div class="alert alert-danger">{{ $message }}</div>
    @elseif($message = @session('error'))
        <div class="alert alert-danger">{{ $message }}</div>
    @endif
        <div class="card mx-6">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Profile</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        {{-- <a class="btn btn-success mx-1" href="">Back</a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            @if (is_null($users->image) || $users->image === '')
                                <form action="{{route('upload.image',$users->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $users->id }}">
                                    <input type="file" name="image" accept="image">
                                    <button type="submit" class="btn btn-primary">Upload Image</button>
                                </form>
                            @else
                            <img width="" src="{{ asset($users->image) }}" alt="">
                            @endif

                        </div>
                        <div class="col-md-8">
                            <!-- Column for data -->
                            <table class="table">
                                <tr>
                                    <td>User ID</td>
                                    <td>{{ $users->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $users->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $users->email }}</td>
                                </tr>
                                <tr>
                                    <td>Employee ID</td>
                                    <td>{{ $employee->id }}</td>
                                </tr>
                                @foreach ($users->emp_types as $emp)
                                    <tr>
                                        <td>Employee Type</td>
                                        <td>{{ $emp->Name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
