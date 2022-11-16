<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNews extends Model
{
    use HasFactory;
    protected $table = 'admin_news';
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'title',
        'description',
        'image',
        'tag',
        'status', 
        'slug',
        
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->belongsTo(Auth::class,'user_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }
    public function category(){
        return $this->belongsTo(AdminCategory::class);
    }
    public function newsDetails(){
        return $this->hasMany(AdminNewsDetails::class,'news_id','id');
    }
}
