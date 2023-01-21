<?php

namespace App\Models;

use App\Models\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Music extends Model
{
    use HasFactory;
    protected $table = 'music';

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
        'mp3',
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
