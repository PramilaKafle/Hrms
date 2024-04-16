<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Interfaces\BaseRepositoryInterface;
class ProjectController extends Controller
{
    private BaseRepositoryInterface $baseRepository;

    public function __construct( BaseRepositoryInterface $baseRepository)
    {
      
       $this->baseRepository= $baseRepository;
    }
    public function index()

    {
        $projects = $this->baseRepository->all(Project::class);
        return view('Admin.project',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.createproject');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => ['required','string','max:255' ],
        ]);
        $this->baseRepository->store(Project::class,$data);
        return redirect()->route('project.index');
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
  
   
    public function destroy(string $id)
    {
        $this->baseRepository->delete(Project::class,$id);
        return redirect()->route('project.index');
    }
}
