<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
use App\Models\Status;
use App\Models\TimesheetStatus;
use App\Repositories\TimesheetRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;

class TimesheetController extends Controller
{
    private TimesheetRepository  $timesheetRepository;
    private EmployeeRepository  $employeeRepository;
    private UserRepository  $userRepository;
    private $baseRepository;
    public function __construct(TimesheetRepository  $timesheetRepository,EmployeeRepository  $employeeRepository,UserRepository  $userRepository)
    {
       $this->timesheetRepository=$timesheetRepository;
       $this->employeeRepository=$employeeRepository;
       $this->userRepository =$userRepository;
       $this->baseRepository = new BaseRepository(new Status());
    }
    public function index()
     {
    
      $timesheetdataes= $this->timesheetRepository->all();
      $projects=Project::all();
      $users=User::all();
      $employees=$this->employeeRepository-> getEmployeeOnly();
      $timesheets=$this->timesheetRepository->getmonthlytimesheetdata();
        //dd($timesheets);
       return view('Timesheet.User.index',compact('timesheetdataes','projects','users','employees','timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
        $users=$this->userRepository->getUserOnly();
        $statuses = Status::all();
       // $timesheet=$this->timesheetRepository->gettimesheetdata($projects,$employees);
        //dd($timesheet);
        return view('Timesheet.index',compact('projects','id','employees','users','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data using specified rules
        $data = $request->validate([
            '*.id'=>[],
            '*.Date' => ['required', 'date'],
            '*.working_hour' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'not_in:0','max:24'],
            '*.project_id' => [],
            '*.employee_id' => [],
        ]);
        $this->timesheetRepository->store($data);
           if ($request->ajax()) {
            return response()->json(['message' => 'Timesheet Data stored successfully', 'data' => $data]);
           
            }

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$employee=$this->employeeRepository->getUserByEmpid($id);
        //dd($employee);
       //return view('Timesheet.User.viewtimesheet');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletedata(Request $request ,string $id)
    {
        
       $this->timesheetRepository->delete($id);
        if ($request->ajax()) {
          
            return response()->json(['message' => 'Timesheet Data deleted successfully' ]);
        }
           
    }
    public function viewtimesheet(string $id)
    {
        $projects = Project::findOrFail($id);
        $user=auth()->user();
        $employees = Employee::where('user_id', $user->id)->first();
        $timesheets =$this->timesheetRepository->gettimesheetdata( $projects,$employees);
        return view('Timesheet.viewtimesheet',compact('id','projects','employees','timesheets'));
    }
  
    public function gettimesheetdata(Request $request ,string $id)
    {
        
        $user=auth()->user();
        $employees=$this->employeeRepository->findByUserId($user->id);
        $projects=Project::find($id);
        $timesheet=$this->timesheetRepository->gettimesheetdata($projects,$employees);
        
        return response()->json(['message' => 'Data taken successfully', 'data' => $timesheet]);
    }

    public function generatedata(Request $request)

    { 
        $data=$request->validate([
            'project_id' => ['required'], 
             'employee_id' => ['required'],
             'start_date' => ['required', 'date'],
             'end_date' => ['required', 'date', 'after_or_equal:startdate'],
        ]);
        //$data= $request->all();
       $timesheets=  $this->timesheetRepository->generateTimesheetData($data);
         return response()->json(['timesheets' => $timesheets]);  
    }
  

    public function approve(Request $request)
    {
        try {
            $timesheetIds = $request->input('timesheet_ids');
            Timesheet::whereIn('id', $timesheetIds)
            ->update(['status' => 'approved']);
            return response()->json(['message' => 'All timesheets approved successfully']);
        } catch (Exception $e) {
            Log::error('Error updating timesheet ID ' . $timesheetId . ': ' . $e->getMessage());
        }
    }


    public function status()
    {
        return view('status.index');
    }
    public function status_store(Request $request)
    {
       $data = $request->validate([
         'name'=>['required'],
       ]);
       //dd($data);
       $this->baseRepository->store($data);
       return redirect()->route('timesheet.index');
       
    }

   
}
