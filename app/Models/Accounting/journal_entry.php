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

    public function journal_item()
    {
        return $this->hasMany(journal_item::class,'journ_code', 'entry_code');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User'::class, 'id', 'user_id');
    }
}
