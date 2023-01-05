<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journal_item extends Model
{
    use HasFactory;
    protected $table = 'journal_item';
    protected $fillable = [
        'account_id',
        'group_id',
        'journal_id',
        'amount',
        'type',
    ];

    public function entry()
{
    return $this->belongsTo(journal_entry::class, 'journal_id');
}
public function account(){
    return $this->hasOne(account_list::class, 'id');
}
}