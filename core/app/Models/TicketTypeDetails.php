<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTypeDetails extends Model
{
    use HasFactory;
    protected $table = 'ticket_type_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'ticket_type_id',
        'user_id',
        'paid_price',
        'coupon',
        'payment_getway',
        'method_code',
        'method_currency',
        'book_transactions',
        'charge',
        'rate',
        'final_amo',
        'status',
        'reject',
        'detail',
        'discount',
        'transaction_id',
        'sold',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function ticket_type(){
        return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }
    
    // public function gatewayCurrency()
    // {
    //     return $this->belongsTo(GatewayCurrency::class,'method_code','method_code');
    // }
    
    // scope
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
