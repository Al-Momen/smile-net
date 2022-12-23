<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBuyManualGetway extends Model
{
    use HasFactory;
    Protected $table = 'buy_manual_getway';
    protected $fillable = [
        'id',
        'admin_id',
        'currency_id',
        'code',
        'name',
        'image',
        'minium_amount',
        'maximum_amount',
        'fixed_change',
        'percent_change', 
        'description',
        'user_data',
        'status',
        
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function admin(){
        return $this->belongsTo(Auth::class,'admin_id','id');
    }
    public function currency()
    {
       return  $this->belongsTo(PriceCurrency::class, 'currency_id', 'id');
    }
    public function scopeManual()
    {
        return $this->where('code', '>=', 1000);
    }
}
