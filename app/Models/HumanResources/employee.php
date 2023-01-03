<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class employee extends Model
{
    
    use HasFactory;
    protected $table = 'employee';
    protected $fillable  = ['department_id',
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


}