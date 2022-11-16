<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $table = "ticket_types";

    protected $fillable = [
        'id',
        'price_currency_id',
        'name',
        'price',
        'description',
       
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function plans()
    {
        return $this->hasMany(plan::class);
    }
    public function priceCurrency()
    {
        return $this->belongsTo(PriceCurrency::class, 'price_currency_id', 'id');
    }
}
