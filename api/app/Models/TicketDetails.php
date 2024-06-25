<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketDetails extends Model
{
    use HasFactory;
    protected $table = 'ticket_details';
    protected $primaryKey = 'idDetailTicket';
    protected $guarded = ['idDetailTicket'];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'idTicket', 'idTicket');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'idProduct', 'idProduct');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
