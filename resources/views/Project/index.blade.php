@extends('layouts.master')
@section('contents')
<h1 class="mt-4">Project Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Project Information</li>
</ol>
<div class="main-content mt-4">
    <div class="card  mb-4">
        <div class="card-header">
            <div class="row">

                <div class="col-md-6">
                    <a class="btn btn-success " href="{{ route('project.create') }}"><i class="fa-solid fa-plus"></i>Create Project</a>
                 
                </div>
                <div class="col-md-6  d-flex justify-content-end">

                </div>
            </div>
        </div>
        <div class="card-body">
            <table class=" table">
                <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" style="width: 10%">Project ID</th>
                        <th scope="col" style="width: 10%"> Project Name</th>
                       
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{$project->name}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn-sm btn-success btn mx-2"
                            href="{{ route('project.edit', $project->id) }}">Edit </a>
                            <form action="{{ route('project.destroy', $project->id) }}" method="POST">
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
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection