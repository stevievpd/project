<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_list extends Model
{
    use HasFactory;
    protected $table = 'account_list';
    protected $fillable = [
        'account_name ',
        'description',
        'status',
    ];

    public function item(){
        return $this->belongsTo(journal_item::class, 'id');
    }
}
