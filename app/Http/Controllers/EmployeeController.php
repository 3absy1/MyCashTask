<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(EmployeeDataTable $dataTable)
    {
        $employees = Employee::all();
        $departments = Department::all();
        $users = User::where('role', 'user')->get();
        return $dataTable->render('Employee.employee', compact('employees','departments','users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'manager_id' => 'nullable|exists:users,id',
            'department_id' => 'nullable|exists:departments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4000',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

            $data['image'] = $imagePath;
        }

        Employee::create($data);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'salary' => 'required|numeric',
            'image' => 'nullable|image',
            'department_id' => 'nullable|exists:departments,id',
            'manager_id' => 'nullable|exists:employees,id'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('employees');
        }

        $employee->update($data);
        return redirect()->route('employee.index');
    }

    public function delete($id)
    {
        $employee= Employee::where('id', $id)->first();
        $employee->delete();
        return redirect()->route('employee.index');
    }
}
