<?php

namespace App\Models;

use App\Models\Auth;
use App\Models\Book;
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
        'paid_price', 
        'coupon', 
        'payment_getway', 
        'discount',
        'sold',
        'slug', 
        'created_at', 
        'updated_at'
    ];

    public function book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }

    public function user(){
        return $this->belongsTo(GeneralUser::class,'author_book_id','id');
    }
    public function admin(){
        return $this->belongsTo(Auth::class,'author_book_id','id');
    }
}
