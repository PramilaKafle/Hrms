<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Employee;
use App\Models\User;
// use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    private ProjectRepository $projectRepository;

    public function __construct( ProjectRepository $projectRepository)
    {
      
       $this->projectRepository= $projectRepository;
    }
    public function index(Request $request)

    {
        $page = $request->input('page', 1);
        $projects = $this->projectRepository->all($page);
        return view('Project.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Project.formmodel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name' => ['required','string','max:255' ],
        ]);
        $this->projectRepository->store($data);
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project=$this->projectRepository->getById($id);
        return view('Project.formmodel',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $data=$request->validate([
            'name' => ['required','string','max:255' ],
        ]);
        $this->projectRepository->update($id,$data);
        return redirect()->route('project.index');
    }
  
   
    public function destroy(string $id)
    {
        $this->projectRepository->delete($id);
        return redirect()->route('project.index');
    }

  public function dashboard()
  {

    $projects=$this->projectRepository->getProjectByEmp();
    return view('Project.dashboard',compact('projects'));
  }

  public function getProject(string $id)
  {
    $projects=$this->projectRepository->getById($id);
 
     return view('project.projectdash',compact('projects','id'));
  }


}
