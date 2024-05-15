<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = 'idTicket';
    protected $guarded = ['idTicket'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'idOrder', 'idOrder');
    }
}
