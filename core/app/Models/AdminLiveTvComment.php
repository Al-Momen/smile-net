<?php

namespace App\Models;

use App\Models\AdminLiveTv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminLiveTvComment extends Model
{
    use HasFactory;
    protected $table = 'admin_live_tv_comments';
    protected $fillable = [
        'id',
        'live_tv_id',
        'user_id',
        'comment',
    ];
    public function user(){
        return $this->belongsTo(GeneralUser::class);
    }
    public function liveTV(){
        return $this->belongsTo(AdminLiveTv::class,'live_tv_id','id');
    }
}
