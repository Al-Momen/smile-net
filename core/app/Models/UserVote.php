<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVote extends Model
{
    use HasFactory;
    protected $table = 'user_votes';
    protected $fillable = [
        'user_id',
        'admin_vote_image_id',
        'admin_vote_id',
        'voted',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
//    // user voted
    public function adminVoteImage(){
        return $this->belongsTo(AdminVoteImage::class,'admin_vote_image_id','id');
    }
    public function adminVote(){
        return $this->belongsTo(AdminVote::class,'admin_vote_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }
}
