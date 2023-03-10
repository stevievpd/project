<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_list extends Model
{
    use HasFactory;
    protected $table = 'account_list';
    protected $fillable = [
        'code',
        'account_name',
        'type',
        'description',
        'status',
    ];

    public function item(){
        return $this->belongsTo(journal_item::class, 'id','account_id');
    }

    public function journItems(){
        return $this->hasMany(journal_item::class, 'account_id');
    }
    public function group(){
        return $this->hasOne(group_list::class, 'id', 'type');
    }
}
