<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminVoteImage extends Model
{
    use HasFactory;
    protected $table = 'admin_vote_images';
    protected $fillable = [
        'id',
        'admin_vote_id',
        'name',
        'image',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
    public function adminVote(){
        return $this->belongsTo(AdminVote::class);
    }
    public function userVotes(){
        return $this->hasMany(UserVote::class,'admin_vote_image_id','id');
    }
    
}
