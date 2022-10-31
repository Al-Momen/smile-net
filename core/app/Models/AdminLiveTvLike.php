<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLiveTvLike extends Model
{
    use HasFactory;
    protected $table = 'admin_live_tv_likes';
    protected $fillable = [
        'id',
        'live_tv_id',
        'user_id',
        'like',
    ];
    public function user(){
        return $this->belongsTo(GeneralUser::class);
    }
    public function liveTV(){
        return $this->belongsTo(AdminLiveTv::class,'live_tv_id','id');
    }
}
