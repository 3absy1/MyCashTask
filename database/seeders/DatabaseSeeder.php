<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $employeeUser = User::factory()->create([
            'role' => 'employee',
        ]);

        $normalUser = User::factory()->create([
            'role' => 'user',
        ]);

        $departments = Department::factory(5)->create();

        // Assign one department manager to each department
        foreach ($departments as $department) {
            $department->update([
                'manager_id' => $normalUser->id, // Assign the normal user as the manager
            ]);
        }


        $employees = Employee::factory(5)->create([
            'manager_id' => $employeeUser->id, // Assign the employee user as the manager
            'department_id' => $departments->random()->id, // Randomly assign a department
        ]);

        foreach ($employees as $employee) {
            Task::factory(5)->create([
                'employee_id' => $employee->id, // Assign tasks to employees
            ]);
        }

    }
}
