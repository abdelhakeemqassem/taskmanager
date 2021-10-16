<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\TaskEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('employee.auth:employee');
    }


    
    /**
     * Show the Employee dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
     
     $tasks=[];   
     if (Auth::guard('employee')->check()) {
        $id=Auth::guard('employee')->user()->id;
        $Assigned_tasks = TaskEmployee::where('employee',$id)->pluck('task');
        foreach($Assigned_tasks as $task){
            $t=DB::table('tasks')
            ->join('roles', 'roles.id', '=', 'tasks.role')
            ->where('tasks.id','=',$id)
            ->select('tasks.*', 'roles.name as role_name')
            ->first();
            array_push($tasks,$t);
        }
          return view('employee.layouts.mytasks',compact($tasks));
        }else{
          return redirect()->route('employee.login');
        }
    }
    public function show() {
     
     $tasks=[];   
     if (Auth::guard('employee')->check()) {
        $id=Auth::guard('employee')->user()->id;
        $Assigned_tasks = TaskEmployee::where('employee',$id)->pluck('task');
        foreach($Assigned_tasks as $task){
            $t=DB::table('tasks')
            ->where('tasks.id','=',$task)
            ->first();
             array_push($tasks,$t);
        }
        return $tasks;
        }else{
          return redirect()->route('employee.login');
        }
    }
}
 