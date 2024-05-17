<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'inventory.Employee';

    public function employeeStatus()
    {

        return $this->belongsTo('App\Models\EmployeeStatus');

    }

    public function hasRoles($roles)
    {

        return EmployeeRole::where('employee_id', $this->id)->whereIn('role_id', $roles)->first();

    }
    
}
