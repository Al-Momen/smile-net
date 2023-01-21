<?php

namespace App\Models;

use App\Models\Auth;
use App\Models\Book;
use App\Models\Gateway;
use App\Models\GatewayCurrency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookTransaction extends Model
{
    use HasFactory;
    protected $table = 'book_transactions';
    protected $fillable = [
        'id',
        'book_id', 
        'author_book_id', 
        'author_book_type', 
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

    public function book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }

    public function user(){
        return $this->belongsTo(GeneralUser::class,'buy_user_id','id');
    }
    public function admin(){
        return $this->belongsTo(Auth::class,'author_book_id','id');
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
