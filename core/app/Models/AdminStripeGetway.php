<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStripeGetway extends Model
{
    use HasFactory;
    protected $table = 'admin_stripe_getways';
    protected $fillable = [
        'id',
        'stripe_key',
        'stripe_secret',
      
    ];
}
