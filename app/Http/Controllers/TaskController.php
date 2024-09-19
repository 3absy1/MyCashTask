<?php

namespace App\Http\Controllers;

use App\DataTables\TasksDataTable;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TasksDataTable $dataTable)
    {
        $tasks = Task::all();
        $auth_id = auth()->id();
        $employees = Employee::whereHas('department', function ($query) use ($auth_id) {
            $query->where('manager_id', $auth_id);
        })->get();
        return $dataTable->render('Tasks.tasks', compact('tasks','employees'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'task' => 'required|string',
            'status' => 'required|in:pending,in-progress,completed'
        ]);

        Task::create($data);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $tasks = Task::find($id);
        return response()->json($tasks);
    }

    public function update(Request $request,$task)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,in-progress,completed',
            'employee_id' => 'required|exists:employees,id',
            'task' => 'required|string',
        ]);
        $task=Task::where('id',$task)->first();
        $task->update($data);
        return redirect()->route('tasks.index');
    }
    public function delete($id)
    {
        $task= Task::where('id', $id)->first();
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function indexEmployee(TasksDataTable $dataTable)
    {
        $auth_id = auth()->id();
        $tasks= Task::where('id', $auth_id)->get();
        return $dataTable->render('Tasks.tasks', compact('tasks','employees'));



    }
}
