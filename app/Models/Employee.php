<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'image',
        'manager_id',
        'department_id',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Accessor to get full name
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
