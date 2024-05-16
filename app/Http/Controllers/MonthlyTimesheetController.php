<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyTimesheet;
use App\Repositories\MonthlyTimesheetRepository;
class MonthlyTimesheetController extends Controller
{
    private MonthlyTimesheetRepository  $monthlytimesheetRepository;
    
    public function __construct(MonthlyTimesheetRepository  $monthlytimesheetRepository)
    { 
    $this->monthlytimesheetRepository= $monthlytimesheetRepository;

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = $request->validate([
            '*.employee_id' => [ 'integer'],
            '*.month_id' => [ 'integer'],
            '*.project_id' => [ 'integer'],
            '*.startDate'=>['date'],
            '*.endDate'=>['date'],
            '*.status'=>[],
          
        ]);
       
        $this->monthlytimesheetRepository->store($data);
           return response()->json(['data'=>$data]);
    
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
        //
    }
}
