<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HumanResources\job;
use App\Models\HumanResources\department;
use App\Models\HumanResources\schedules;
use App\Models\Payroll\cashadvance;


class employee extends Model
{

    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'department_id',
        'job_id',
        'schedule_id',
        'employee_code',
        'manager',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'birthdate',
        'civil_status',
        'contact_number',
        'gender',
        'address',
        'perma_address',
        'elementary',
        'highschool',
        'college',
        'yearElem',
        'yearHigh',
        'yearCollege',
        'degree',
        'sss',
        'tin',
        'pagibig',
        'philhealth',
        'image',
    ];

    public function job()
    {
        return $this->hasone(job::class, 'id', 'job_id');
    }

    public function department()
    {
        return $this->hasone(department::class, 'id', 'department_id');
    }
    public function sched()
    {
        return $this->hasone(schedules::class, 'id', 'schedule_id');
    }

    // public function cashadvance(){
    //     return $this->hasMany(cashadvance::class, 'employee_id', 'id');
    // }

}