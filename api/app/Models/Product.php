<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'idProduct';
    protected $guarded = ['idProduct'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, "idShop", "idShop");
    }
}
