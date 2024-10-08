<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','manager_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function employeeCount()
    {
        return $this->employees()->count();
    }

    public function totalSalaries()
    {
        return $this->employees()->sum('salary');
    }
}
