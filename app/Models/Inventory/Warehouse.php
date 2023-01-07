<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'warehouse_name',
        'warehouse_description',
        'abrr',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function productWarehouse(){
        return $this->hasMany(Product_in_Warehouse::class);
    }

}
