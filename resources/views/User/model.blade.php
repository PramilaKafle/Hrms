@extends('layouts.master')
@section('contents')

    <h1 class="mt-4">User Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">
            @if(isset($user)) Edit User @else Add User @endif
        </li>
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
                        Add New User
                    </div>
                    <div class="col-md-6  d-flex justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-success"> Back</a>

                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">
                            <form class="form-horizontal " 
                           @if(isset($user)) action="{{route('user.update',$user->id)}}" 
                           @else action="{{ route('user.store') }}" 
                           @endif
                           method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($user)) @method('PUT') @endif
                                <div class="form-group row mb-4">
                                    @if(isset($user))
                                    <div>
                                        <img style="width: 100px" src="{{asset($user->image)}}" alt="">
                                    </div>
                                    @endif
                                    <label class="control-label col-sm-2 " for="name">Image:</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="name">Name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name"  @if(isset($user)) value="{{$user->name}}" @endif>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="email">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email"  @if(isset($user)) value="{{$user->email}}" @endif>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="password">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="role">Role:</label>
                                    <div class="col-sm-8">
                                        <select name="roles" id="" class="form-control">
                                            <option value=""disabled selected>Select</option>
                                            @foreach ($roles as $role)
                                                <option  @if(isset($user))  {{$user->roles->contains($role->id) ? 'selected' :''}} @endif 
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="control-label col-sm-2 " for="name">
                                    </label>
                                    <div class="col-sm-8  d-flex justify-content-end ">
                                        <button class="btn btn-primary"> Add User</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
