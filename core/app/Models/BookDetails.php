<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookDetails extends Model
{
    use HasFactory;
    protected $table = 'book_details';
    protected $fillable = [
        'id',
        'book_id', 
        'user_id', 
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
        return $this->belongsTo(Book::class,'book_id','id');
    }
}
