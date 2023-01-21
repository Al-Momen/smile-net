<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralUserVote extends Model
{
    use HasFactory;
    protected $table = 'user_vote';
    protected $fillable = [
        'id',
        'user_id',
        'vote_id',
        'image_one_vote',
        'image_two_vote',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
      public function generalUser(){
        return $this->belongsTo(GeneralUser::class,'user_vote','user_id','vote_id');
    }
}
