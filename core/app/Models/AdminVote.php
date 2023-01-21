<?php

namespace App\Models;

use App\Models\UserVote;
use App\Models\AdminVoteImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminVote extends Model
{
    use HasFactory;
    protected $table = 'admin_votes';
    protected $fillable = [
        'id',
        'category_id',
        'ticket_id',
        'vote_name',
        'vote_image',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
    public function category(){
        return $this->belongsTo(AdminCategory::class);
    }
    public function ticket(){
        return $this->belongsTo(TicketType::class);
    }
    // admin vote image has many relationship
    public function adminVoteImages(){
        return $this->hasMany(AdminVoteImage::class,'admin_vote_id','id');
    }
    public function userVotes(){
        return $this->hasMany(UserVote::class,'admin_vote_id','id');
    }
}
