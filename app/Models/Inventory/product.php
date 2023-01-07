<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_supplier_name',
        'product_supplier_price',
        'product_retail_price',
        'product_wholesale_price',
        'product_qoh',
        'product_unit',
        'product_min_qoh',
        'warehouse_id',
        'category_id',
        'supplier_id',
        'product_max_discount',
        'note',
        'photo',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productWarehouse(){
        return $this->belongsTo(Product_in_Warehouse::class);
    }

    
}
