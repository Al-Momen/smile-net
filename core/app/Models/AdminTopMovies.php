<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTopMovies extends Model
{
    use HasFactory;
    protected $table = 'top_movies';
    protected $fillable = [
        'id',
        'admin_id',
        'ticket_type_id',
        'name',
        'category',
        'image',
        'mp4',
        'status', 
        'slug',
        
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function admin(){
        return $this->belongsTo(Auth::class,'admin_id','id');
    }
    public function ticketType()
    {
       return  $this->belongsTo(TicketType::class, 'ticket_type_id', 'id');
    }

}
