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

    public function eventPlans(){
        return $this->belongsTo(EventPlan::class,'event_plan_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'buy_user_id','id');
    }
  
}
