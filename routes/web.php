<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'can:view-all-tasks'])->group(function () {

    Route::prefix('DepartmentsPage')->group(function () {
        Route::get('/', [DepartmentController::class,'index'])->name('departments.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::put('/{departments}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::get('/{departments}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::delete('/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
    });

    Route::prefix('EmployeePage')->group(function () {
        Route::get('/', [EmployeeController::class,'index'])->name('employee.index');
        Route::post('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::delete('/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    });

    Route::prefix('TasksPage')->group(function () {
        Route::get('/', [TaskController::class,'index'])->name('tasks.index');
        Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::put('/{tasks}', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('/{tasks}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::delete('/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:view-assigned-tasks'])->group(function () {

    Route::prefix('EmployeeTasksPage')->group(function () {
    Route::get('/', [EmployeeTaskController::class,'index'])->name('employeeTasks.index');
    Route::get('/create', [EmployeeTaskController::class, 'create'])->name('employeeTasks.create');
    Route::put('/{tasks}', [EmployeeTaskController::class, 'update'])->name('employeeTasks.update');
    Route::get('/{tasks}/edit', [EmployeeTaskController::class, 'edit'])->name('employeeTasks.edit');
    Route::delete('/{id}', [EmployeeTaskController::class, 'delete'])->name('employeeTasks.delete');
    });

});


require __DIR__.'/auth.php';
