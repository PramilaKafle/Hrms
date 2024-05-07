<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;
use App\Repositories\TimesheetRepository;

class ReportController extends Controller
{

    private EmployeeRepository $employeeRepository;
    private TimesheetRepository $timesheetRepository;
   public function __construct( EmployeeRepository $employeeRepository,TimesheetRepository $timesheetRepository)
   {
     $this->employeeRepository=$employeeRepository;
     $this->timesheetRepository=$timesheetRepository;
   }
    public function index()
    {
        $employees=$this->employeeRepository->getEmployeeOnly();
        return view('Report.index',compact('employees'));
    }

    public function getdata(Request $request)
    {
        $data=$request->all();
        $timesheetdata=$this->timesheetRepository->getreportdata($data);
        return response()->json(['data'=>$timesheetdata]);
    }
  

  
}
