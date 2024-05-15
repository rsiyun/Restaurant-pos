<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'idOrder';
    protected $guarded = ['idOrder'];
    public function kasir()
    {
        return $this->hasOne(User::class, "idUser");
    }
    public function tickets()
    {
        return $this->hasMany(Tickets::class, "idOrder", "idOrder");
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
