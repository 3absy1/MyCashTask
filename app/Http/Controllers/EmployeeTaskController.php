<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeTasksDataTable;
use App\DataTables\TasksDataTable;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class EmployeeTaskController extends Controller
{
    public function index(EmployeeTasksDataTable $dataTable)
    {
        $auth_id = auth()->id();
        $tasks = Task::where('employee_id',$auth_id)->get();

        return $dataTable->render('Tasks.employeeTasks', compact('tasks'));
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
        ]);
        $task=Task::where('id',$task)->first();
        $task->update($data);
        return redirect()->route('employeeTasks.index');
    }
    public function delete($id)
    {
        $task= Task::where('id', $id)->first();
        $task->delete();
        return redirect()->route('employeeTasks.index');
    }

    // public function indexEmployee(TasksDataTable $dataTable)
    // {
    //     $auth_id = auth()->id();
    //     $tasks= Task::where('id', $auth_id)->get();
    //     return $dataTable->render('Tasks.tasks', compact('tasks','employees'));



    // }
}
