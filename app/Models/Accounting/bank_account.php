<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank_account extends Model
{
    use HasFactory;
    protected $table = 'bank_account';
    protected $fillable = [
        'bank_meta_id',
        'account_number',
        'account_holder',
        'email',
        'contact',
        'address',
        'country',
        'company',
        'zip',
    ];
    public function bank_meta()
    {
        return $this->hasOne(bank_meta_data::class,'id', 'bank_meta_id');
    }
}
