<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetails extends Model
{
    use HasFactory;
    protected $table = 'book_details';
    protected $fillable = [
        'id',
        'book_id', 
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
        return $this->belongsTo(BookDetails::class,'book_id','id');
    }
}
