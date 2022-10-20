<?php

namespace App\Models;

use App\Models\PriceCurrency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'bookable_id',
        'bookable_type',
        'category_id',
        'price_id',
        'price',
        'paid_price', 
        'title',
        'tag',
        'description',
        'image',
        'status',
        'admin_status',
        'file', 
        'coupon',
        'discount',
        'sold', 
        'slug',
        
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function admin(){
        return $this->belongsTo(Auth::class,'bookable_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'bookable_id','id');
    }
    public function category(){
        return $this->belongsTo(AdminCategory::class);
    }
    public function priceCurrency(){
        return $this->belongsTo(PriceCurrency::class,'price_id','id');
    }
    public function bookDetails(){
        return $this->hasMany(BookDetails::class,'id','book_id');
    }
    public function bookable()
    {
        return $this->morphTo();
    }
}
