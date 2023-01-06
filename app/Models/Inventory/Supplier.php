<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'supplier_name',
        'supplier_name',
        'supplier_phone',
        'supplier_email',
        'supplier_address',
        'note',
        'photo',
    ];

    public function debtSupplier()
    {
        return $this->hasMany(Debts_Supplier::class);
    }

    public function productSupplier()
    {
        return $this->hasMany(Product::class);
    }

}
