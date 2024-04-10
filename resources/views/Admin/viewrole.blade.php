@extends('layouts.master')
@section('contents')
    <h1 class="mt-4">Role Management</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">View Role</li>
    </ol>

    <div class="main-content mt-4">
        <div class="card mx-6">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4>Role Information</h4>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('role.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                        <table class="d-flex justify-content-center">
                            <tr>
                                <td style="padding:20px;">Name:</td>
                                <td>{{ $role->name }}</td>
                            </tr>
        
                            <tr>
                                <td style="padding:20px;">Permissions:</td>
                                @foreach ($role->permissions as $permission)
                                    <td>
                                        {{ $permission->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
        
                                    </td>
                                @endforeach
                            </tr>
        
                        </table>
            </div>
        </div>
    </div>
@endsection
