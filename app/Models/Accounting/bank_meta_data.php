<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank_meta_data extends Model
{
    use HasFactory;
    protected $table = 'bank_meta_data';
    protected $fillable = [
        'bank_name',
        'bank_branch',
        'bank_image',
    ];
}
