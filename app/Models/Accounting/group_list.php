<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_list extends Model
{
    use HasFactory;
    protected $table = 'group_list';
    protected $fillable = [
        'group_name ',
        'description',
        'type',
        'status',
    ];
}
