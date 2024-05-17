<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $primaryKey = 'idshop';
    protected $guarded = ['idshop'];

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
