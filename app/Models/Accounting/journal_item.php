<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journal_item extends Model
{
    use HasFactory;
    protected $table = 'journal_item';
    protected $fillable = [
        'entry_date',
        'account_id',
        'group_id',
        'journ_code',
        'amount',
        'type',
    ];

    public function entry()
{
    return $this->belongsTo(journal_entry::class, 'journ_code','entry_code');
}
public function account_list(){
    return $this->hasOne(account_list::class, 'id', 'account_id');
}
public function group(){
    return $this->hasOne(group_list::class, 'id', 'group_id');
}
}