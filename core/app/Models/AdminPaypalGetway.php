<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPaypalGetway extends Model
{
    use HasFactory;
    protected $table = 'admin_paypal_getways';
    protected $fillable = [
        'id',
        'client_id',
        'secret_id',
        'fixed_change',
        'percent_change',
        'secret_id',
        'mode',
    ];
   
}
