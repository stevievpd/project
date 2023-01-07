<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debts_Supplier extends Model
{
    use HasFactory;

    protected $table = 'debts_suppliers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'supplier_id',
        'amount',
        'note',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
