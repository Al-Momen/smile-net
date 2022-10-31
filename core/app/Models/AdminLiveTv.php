<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLiveTv extends Model
{
    use HasFactory;
    protected $table = 'admin_live_tv';
    protected $fillable = [
        'id',
        'admin_id',
        'title',
        'description',
        'image',
        'tv_name',
        'tv_link',
        'date',
        'status',  
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function admin(){
        return $this->belongsTo(Auth::class,'admin_id','id');
    }
    public function liveTvDetails(){
        return $this->hasMany(AdminLiveTvComment::class,'live_tv_id','id');
    }
}
