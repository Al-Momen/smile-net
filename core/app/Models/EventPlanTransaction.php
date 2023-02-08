<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPlanTransaction extends Model
{
    use HasFactory;
    protected $table = 'event_plan_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'event_plan_id', 
        'author_event_id', 
        'buy_user_id', 
        'method_currency', 
        'paid_price', 
        'coupon', 
        'payment_getway', 
        'discount',
        'method_code',
        'reject',
        'detail',
        'status',
        'charge',
        'rate',
        'final_amo',
        'sold',
        'slug', 
        'created_at', 
        'updated_at'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function eventPlans(){
        return $this->belongsTo(EventPlan::class,'event_plan_id','id');
    }
    public function admin(){
        return $this->belongsTo(Auth::class,'author_book_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'buy_user_id','id');
    }
    public function scopegatewayCurrency()
    {
        return GatewayCurrency::where('method_code', $this->method_code)->where('currency', $this->method_currency)->first();
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    // public function scopeBaseCurrency()
    // {
    //     return $this->gateway->crypto == 1 ? 'USD' : $this->method_currency;
    // }

    public function scopePending()
    {
        return $this->where('status', 2);
    }
  
}
