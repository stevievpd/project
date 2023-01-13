<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HumanResources\employee;


class Cashadvance extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'description', 'date' , 'amount'];

    public function employee(){
        return $this->hasOne(employee::class, 'id', 'employee_id');
    }

}
