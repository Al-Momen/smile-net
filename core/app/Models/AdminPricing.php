<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPricing extends Model
{
    use HasFactory;
    protected $table = 'admin_pricing';
    protected $fillable = [
        'id',
        'admin_id',
        'ticket_type_id',
        'price_currency_id',
        'name',
        'price',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function admin()
    {
        return $this->belongsTo(Auth::class, 'admin_id', 'id');
    }
    public function priceCurrency()
    {
        return $this->belongsTo(PriceCurrency::class, 'price_currency_id', 'id');
    }
    public function ticketType()
    {
       return  $this->belongsTo(TicketType::class, 'ticket_type_id', 'id');
    }
}
