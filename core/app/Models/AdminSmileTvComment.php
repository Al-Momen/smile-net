<?php

namespace App\Models;

use App\Models\AdminLiveTv;
use App\Models\AdminSmileTv;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminSmileTvComment extends Model
{
    use HasFactory;
    protected $table = 'admin_smile_tv_comments';
    protected $fillable = [
        'id',
        'smile_tv_id',
        'user_id',
        'comment',
    ];
    public function user(){
        return $this->belongsTo(GeneralUser::class);
    }
    public function liveTV(){
        return $this->belongsTo(AdminSmileTv::class,'smile_tv_id','id');
    }
}
