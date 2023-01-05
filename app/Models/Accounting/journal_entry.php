<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journal_entry extends Model
{
    use HasFactory;
    protected $table = 'journal_entry';
    protected $fillable = [
        'employee_id ',
        'entry_code',
        'description',
        'entry_date',
        'partner',
    ];
}
