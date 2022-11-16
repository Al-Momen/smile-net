<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserManualGetwayRequest extends Model
{
    use HasFactory;
    protected $table = "user_manual_getway_request";
    protected $fillable = [
        'id',
        'user_id',
        'currency_id',
        'amount',
        'gateway_method',
        'transaction_no',
        'gateway_parameters',
        'reject',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }
    public function priceCurrency()
    {
        return $this->belongsTo(PriceCurrency::class,'currency_id','id');
    }
}
