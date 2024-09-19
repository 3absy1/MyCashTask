<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentDataTable;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(DepartmentDataTable $dataTable)
    {
        // $departments = Department::withCount('employees')
        //     ->withSum('employees', 'salary')
        //     ->get();
        $departments = Department::all();
        $users = User::where('role', 'user')->get();
            return $dataTable->render('Department.department', compact('departments', 'users'));
    }



    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        Department::create($data);
        return redirect()->route('departments.index');
    }

    public function edit($id)
    {
        $departments = Department::find($id);
        return response()->json($departments);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'manager_id' => 'nullable|exists:users,id',
        ]);
        $department= Department::find($id);
        $department->update($data);
        return redirect()->route('departments.index');
    }

    public function delete($id)
    {
        // if ($department->employees()->exists()) {
        //     return redirect()->route('departments.index')->with('error', 'Cannot delete department with employees.');
        // }
        $department=Department::where('id', $id)->first();

        $department->delete();
        return redirect()->route('departments.index');
    }
}
