<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_in_Warehouse extends Model
{
    use HasFactory;

    protected $table = 'product_in_warehouse';
    protected $fillable = ['product_id', 'warehouse_id', 'quantity'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function warehouse()
    {
        return $this->hasOne(warehouse::class, 'id', 'warehouse_id');
    }
}
