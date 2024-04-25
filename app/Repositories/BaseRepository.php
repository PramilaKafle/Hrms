<?php

namespace App\Repositories;
use App\Interfaces\BaseRepositoryInterface;

use App\Models\User;
use App\Models\Employee;
use App\Models\Emp_type;
use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use File;
use Carbon\Carbon;

class BaseRepository implements BaseRepositoryInterface{
    protected $model; 
 
    public function __construct(Model $model){
        $this->model = $model;
    }

public function all($page=null)
{
    if ($page) {
        return $this->model->paginate(5, ['*'], 'page', intval($page));
    }
    else{
        return $this->model->all();
    }
 }

public function getById(string $id)
{
   return $this->model::findOrFail($id);
}

public function store(array $data)
{
    DB::beginTransaction();
    try{
      $record= $this->model::create($data);

    DB::commit();
  
       
    }catch(Exception $e)
    {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating user: '.$e->getMessage());
    }
  
}

public function update(string $id, array $data)
{
    DB::beginTransaction();

    try {
        $user = $this->model::findOrFail($id);
        $user->update($data);
        DB::commit();

    } catch (Exception $e) {
        DB::rollBack();
         return redirect()->back()->with('error', 'Error updating user: ');
    
    }
}

public function delete($id)
{
     $record = $this->model::find($id);
     return $record->delete();
    
    
}

}