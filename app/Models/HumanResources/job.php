<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HumanResources\employee;

class job extends Model
{
    use HasFactory;
    protected $table = 'job';
    protected $fillable  = ['job_name', 'description', 'rate'];

}
