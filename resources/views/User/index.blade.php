@extends('layouts.master')
@section('contents')
<h1 class="mt-4">User Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('redirect')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">User Table</li>
</ol>
<div class="main-content mt-4">
    @if($message=@session('success'))
    <div class="alert alert-danger">{{ $message }}</div>
    @elseif($message=@session('error'))
    <div class="alert alert-danger">{{ $message }}</div>
    @endif
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-success " href="{{route('user.create')}}"><i class="fa-solid fa-plus"></i>New User</a>
            </div>
            <div class="col-md-6  d-flex justify-content-end">
               
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead style="background: #f2f2f2">
                <tr>
                   
                    <th scope="col" style="width: 10%">User_id</th>
                    <th scope="col" style="width: 10%">Name</th>
                    <th scope="col" style="width: 10%">Email</th>
                    <th scope="col" style="width: 10%">Role</th>

                    <th scope="col" style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    
                        @if($user->roles->isNotEmpty())
                        @foreach($user->roles as  $userwithrole)
                        <td>{{$userwithrole->name}}</td>
                        @endforeach
                        @else
                        <td>Not assigned</td>

                        @endif
                    
                    <td>
                        <div class="d-flex">

                            <a class="btn-sm btn-success btn mx-2"
                                href="{{ route('user.edit', $user->id) }}">Edit </a>
                            <a class="btn-sm btn-primary btn mx-2"
                                href="{{ route('user.show', $user->id) }}">View</a>


                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger btn">Delete</button>
                            </form>


                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
</div>
</div>
@endsection