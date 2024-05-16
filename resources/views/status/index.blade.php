@extends('layouts.master')

@section('contents')
<div class="main-content mt-4">
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-md-6">
              <h2><strong> Add Timesheet Status</strong></h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-success mx-1" href="{{ route('timesheet.index') }}">Back</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        <form action="{{route('status.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-4">
                <label class="control-label col-sm-2 " for="status">Status:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="timesheet-status" name="name">
                </div>
                <div class="col-sm-2">
                    {{-- <button type="button" class="btn btn-secondary" onclick="addInputField()">Add </button> --}}
                </div>
            </div>

            <div id="dynamicInputContainer"></div>

            <div class="form-group row mb-4">
                <label class="control-label col-sm-2 " for="">
                </label>
                <div class="col-sm-5  d-flex justify-content-end ">
                   <a href=""> <button class="btn btn-success">Submit</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>

let inputFieldCounter = 1;

// Function to add a new input field
// function addInputField() {
//     // Create new input field HTML
//     let newInputFieldHtml = `
//         <div class="form-group row mb-4" id="inputField${inputFieldCounter}">
//             <label class="control-label col-sm-2" for="status">Status:</label>
//             <div class="col-sm-5">
//                 <input type="text" class="form-control" id="timesheet-status-${inputFieldCounter}" name="status${inputFieldCounter}">
//             </div>
//             <div class="col-sm-1">
//                 <button type="button" class="btn btn-danger" onclick="removeInputField(${inputFieldCounter})">Remove</button>
//             </div>
//         </div>
//     `;

//     // Append the new input field HTML to the dynamicInputContainer
//     $('#dynamicInputContainer').append(newInputFieldHtml);

//     // Increment the inputFieldCounter for unique IDs
//     inputFieldCounter++;
// }

// // Function to remove an input field
// function removeInputField(id) {
//     // Remove the input field with the specified ID
//     $(`#inputField${id}`).remove();
// }  
    </script>
@endsection