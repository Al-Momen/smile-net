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
        'user_id',
        'category_id',
        'price_id',
        'price',
        'title',
        'description',
        'image',
        'tag',
        'status',
        'slug',
        'coupon',
        'discount',
        'file',
       
        
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function category(){
        return $this->belongsTo(AdminCategory::class);
    }
    public function price(){
        return $this->belongsTo(PriceCurrency::class);
    }
}
