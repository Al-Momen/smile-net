<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNewsLike extends Model
{
    use HasFactory;
    protected $table = 'admin_news_likes';
    protected $fillable = [
        'id',
        'news_id',
        'user_id',
        'like',
    ];
    public function user(){
        return $this->belongsTo(GeneralUser::class);
    }
    public function news(){
        return $this->belongsTo(AdminNews::class,'news_id','id');
    }
}
