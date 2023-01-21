<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNewsComment extends Model
{
    use HasFactory;
    protected $table = 'admin_news_comments';
    protected $fillable = [
        'id',
        'news_id',
        'user_id',
        'comment',
    ];
    public function user(){
        return $this->belongsTo(GeneralUser::class);
    }
    public function news(){
        return $this->belongsTo(AdminNews::class,'news_id','id');
    }
}
