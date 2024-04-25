@extends('layouts.master')

@section('contents')
<h1 class="mt-4">Project</h1>
<ol class="breadcrumb mb-4">
   
    <li class="breadcrumb-item active">{{$projects->name}}</li>
</ol>
@endsection