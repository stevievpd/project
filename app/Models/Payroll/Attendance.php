<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HumanResources\employee;


class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'date', 'time_in' , 'status', 'time_out', 'num_hr'];

    public function employee(){
        return $this->hasOne(employee::class, 'id', 'employee_id');
    }
}
