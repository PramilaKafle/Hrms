@extends('layouts.master')
@section('contents')
<h1 class="mt-4">Role Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Edit Role</li>
</ol>

<div class="main-content mt-4">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif
    <div class="card mx-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6  d-flex justify-content-end">
                    <a href="{{ route('role.index') }}" class="btn btn-success"> Back</a>

                </div>
            </div>
        </div>
        <div class="card-body ">
            <form class="form-horizontal " action="{{route('role.update',$role->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row mb-4"> 
                    <label class="control-label col-sm-2 " for="name">Name:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}">
                    </div>
                </div>
                <div class="form-group row mb-4"> 
                    <label class="control-label col-sm-2 " for="permission">Permission:</label>
                    <div class="col-sm-5">
                       <select name="permissions[]" id="" class="form-control" multiple>
                        @foreach($permissions as $permission)
                       <option {{$role->permissions->contains($permission->id)? 'selected' :''}} value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                       </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="control-label col-sm-2 " for="name">
                    </label>
                    <div class="col-sm-5  d-flex justify-content-center ">
                     <button class="btn btn-primary"> Add Role</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>
</div>
@endsection