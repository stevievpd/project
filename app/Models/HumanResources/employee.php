<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HumanResources\job;
use App\Models\HumanResources\department;

class employee extends Model
{

    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'department_id',
        'job_id',
        'schedule_id',
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'birthdate',
        'contact_number',
        'gender',
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

}