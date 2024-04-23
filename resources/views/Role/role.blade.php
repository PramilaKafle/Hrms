@extends('layouts.master')

@section('contents')
<h1 class="mt-4">Role Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{url('redirect')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Role Table</li>
</ol>

<div class="main-content mt-4">
    @if($message=@session('success'))
    <div class="alert alert-danger">{{ $message }}</div>
    @elseif($message=@session('error'))
    <div class="alert alert-danger">{{ $message }}</div>
    @endif
    <div class="card  mb-4">
        <div class="card-header">
            <div class="row">

                <div class="col-md-6">
                    <a class="btn btn-success " href="{{ route('role.create') }}"><i class="fa-solid fa-plus"></i>Add Role</a>
                 
                </div>
                <div class="col-md-6  d-flex justify-content-end">

                </div>
            </div>
        </div>
        <div class="card-body">
            <table class=" table">
                <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 10%">SN</th>
                        <th scope="col" style="width: 10%">Name</th>
                       
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $sl=0;
                @endphp
                    @foreach($roles as $role)
                    <tr>
                       
                    <th scope="row">{{++$sl}}</th>
                    <td>{{$role->name}}</td>
                    <td>
                        <div class="d-flex">

                            <a class="btn-sm btn-success btn mx-2"
                                href="{{ route('role.edit', $role->id) }}">Edit </a>
                            <a class="btn-sm btn-primary btn mx-2"
                                href="{{ route('role.show', $role->id) }}">View</a>


                            <form action="{{ route('role.destroy', $role->id) }}" method="POST">
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
{{$roles->links()}}
        </div>
    </div>
</div>
@endsection