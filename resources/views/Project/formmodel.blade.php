
@extends('layouts.master')
@section('contents')
<h1 class="mt-4">Project Management</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('redirect') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">
        @if(isset($project))
        Edit Project
    @else
    Create New Project
    @endif
</li>
</ol>
<div class="main-content mt-4">
    <div class="card mx-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6  d-flex justify-content-end">
                    <a href="{{ route('project.index') }}" class="btn btn-success"> Back</a>

                </div>
            </div>
        </div>
        <div class="card-body ">
            <form class="form-horizontal "
                @if (isset($project)) action="{{ route('project.update', $project->id) }}"
        @else
        action="{{ route('project.store') }}" @endif
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($project))
                    @method('PUT')
                @endif
                <div class="form-group row mb-4">
                    <label class="control-label col-sm-2 " for="name">Name:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="name"
                            @if (isset($project)) value="{{ $project->name }}" @endif>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="control-label col-sm-2 " for="">
                    </label>
                    <div class="col-sm-5  d-flex justify-content-center ">
                        <button class="btn btn-primary"> Add Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection