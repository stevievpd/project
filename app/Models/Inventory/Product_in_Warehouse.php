<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_in_Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity'

    ];

    // public function warehouse()
    // {
    //     return $this->hasMany(Warehouse::class);
    // }

}
