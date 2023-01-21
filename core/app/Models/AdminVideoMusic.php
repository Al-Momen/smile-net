<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminVideoMusic extends Model
{
    use HasFactory;
    protected $table = 'admin_music_video';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'singer_name',
        'image',
        'mp4',
        'status'
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    
    // admin User relationship
    public function admin(){
        return $this->belongsTo(Auth::class,'user_id','id');
    }
}
