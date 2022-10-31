<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminManageSite extends Model
{
    use HasFactory;
    protected $table = 'admin_manage_site';
    protected $fillable = [
        'id',
        'manage_site_id',
        'image',
        'status',     
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function manageSite(){
        return $this->belongsTo(Pages::class,'manage_site_id','id');
    }
}
