<?php

namespace App\Models\HumanResources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedules extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $fillable  = ['time_in', 'time_out'];

}
