@extends('layouts.master')
@section('contents')

<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"> Project Dashboard</li>
</ol>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-header align-items-center">Total Projects</div>
            <div class="card-body">
                <div class=" d-flex align-items-center justify-content-center">
                    <i class="fa-regular fa-user fa-lg mr-2"></i>
                    <!-- Added fa-lg class to increase icon size and mr-2 for margin -->
                    <div class="text-white mx-2" style="font-size: 20px;">{{ $projects->count() }}</div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection