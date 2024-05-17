<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $primaryKey = 'idShop';
    protected $guarded = ['idShop'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function employee()
    {
        return $this->hasMany(User::class, "idShop", "idShop");
    }
    public function products()
    {
        return $this->hasMany(Product::class, "idShop", "idShop");
    }
}
