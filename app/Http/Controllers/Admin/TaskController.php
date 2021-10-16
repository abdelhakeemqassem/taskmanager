<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\TaskEmployee;

class TaskController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = DB::table('tasks')
        ->join('roles', 'roles.id', '=', 'tasks.role')
        ->join('task_employees', 'task_employees.task', '=', 'tasks.id')
        ->join('employees', 'employees.id', '=', 'task_employees.employee')
        ->select('tasks.*', 'roles.name as role_name','employees.name as employee')
        ->get()->all();
        return $tasks;
    }

    public function edit($id)
    {
        $task= Task::where('id',$id)->first();
        return $task;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'description' =>'nullable',
            'start_date' =>'required',
            'duration' =>'required',
            'role' =>'required',
        ]);
       $date= date('Y-m-d', strtotime($request->start_date));  
       $request_data=$request->all();
       $request_data['start_date']=$date;
       $task= Task::create($request_data);
       return $task;
        
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' =>'required',
            'description' =>'nullable',
            'start_date' =>'required',
            'duration' =>'required',
            'role' =>'required',
        ]);
       $date= date('Y-m-d', strtotime($request->start_date));  
       $request_data=$request->all();
       $request_data['start_date']=$date;
       $task= Task::findOrFail($id)->update($request_data);
       return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::findorfail($id);
        $task->delete();
    }
}
