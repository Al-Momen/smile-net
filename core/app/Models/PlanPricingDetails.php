<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPricingDetails extends Model
{
    use HasFactory;
    protected $table = 'plan_pricing_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'plan_pricing_id',
        'user_id',
        'paid_price',
        'coupon',
        'payment_getway',
        'discount',
        'transaction_id',
        'sold',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function planPricing(){
        return $this->belongsTo(Plan::class,'plan_pricing_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }
}
