<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Employee;
use App\Models\TaskEmployee;
use App\Models\Task;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('admin.task');
    }

    public function tasks() {
        return view('admin.task');
    }
    public function employees() {
        return view('admin.employee');
    }
    public function roles(){
        return Role::latest()->paginate(5);
    }


    public function assigntask($id){
        $task=Task::where('id',$id)->first();
        //get employees with the same job as the task 
        $emps = DB::table('employees')
        ->where('team_role',$task->role)
        ->get()->all();

        $busy_emps=TaskEmployee::pluck('employee')->toarray(); //busy employees with other tasks 
        if(count($emps)>0 ){
            foreach($emps as $emp ){
             //check if employee is free 
                if(!in_array($emp->id,$busy_emps)){
                     TaskEmployee::create([
                     'employee' => $emp->id,
                     'task' => $task->id,
                ]);
                return Employee::where('id',$emp->id)->value('name');
               
            }else{
                return "0";
            }
            break;
           }
       }else{
           return "0";
       }

    }




}

