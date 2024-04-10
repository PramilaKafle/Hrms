<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\LeaveRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private LeaveRepositoryInterface $leaveRepository;

     public function __construct( LeaveRepositoryInterface $leaveRepository)
     {
$this->leaveRepository=$leaveRepository;
     }
    public function index()
    {
     $users=  $this->leaveRepository->getUserByEmpId();
     //dd($users);
       $leaves=$this->leaveRepository->getLeaveByEmpId();
        return view('Employee.leave',compact('leaves','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('Employee.leaverequest');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data= $request->validate([
            'start_date'=>['required'],
            'end_date'=>['required'],
            'description'=>['required']

        ]);
        $this->leaveRepository->store($data);
        return redirect()->route('leave.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->leaveRepository->delete($id);
        return redirect()->route('leave.index');
    }
}
