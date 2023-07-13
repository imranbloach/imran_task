<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Session;
use Validator;
use Redirect;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'tasks');
        $tasks = Task::all();
        // load the view and pass the tasks
        return view('admin.tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task =Task::find($id);
        return view('admin/tasks/show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        if($id== ""){
            $title = 'Add Task';
            $task = new Task;
            $message = 'Task added successfully.';
        }else {
            $title = 'Edit Task';
            $task =Task::find($id);
            $message = 'Task updated successfully.';

        }
        if($request->isMethod('post')){
            $rules = [
                'name'=>'required',
            ];
            $customMessages = [
                'name.required'=>"Name is required",
            ];
            $this->validate($request, $rules, $customMessages);
            $task->name = $request->name;
            $task->descripton = $request->descripton;
            $task->save();
            return redirect('admin/tasks')->with('success_message', $message);
        }

        return view('admin/tasks/add-edit-task')->with(compact('title', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // delete
         $task = Task::find($id);
         dd($id);
         $task->delete();

         // redirect
         Session::put('success_message', 'Successfully deleted the task!');
         return Redirect::to('admin/tasks');
    }
}
