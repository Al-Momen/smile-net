<?php

namespace App\Models;

use App\Models\AdminSmileTvComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminSmileTv extends Model
{
    use HasFactory;
    protected $table = 'admin_smile_tv';
    protected $fillable = [
        'id',
        'admin_id',
        'category_id',
        'ticket_type_id',
        'name',
        'title',
        'type',
        'image',
        'smile_tv_link',
        'date',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function admin()
    {
        return $this->belongsTo(Auth::class, 'admin_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(AdminCategory::class, 'category_id', 'id');
    }
    public function ticketType()
    {
       return  $this->belongsTo(TicketType::class, 'ticket_type_id', 'id');
    }
    public function smileTvDetails(){
        return $this->hasMany(AdminSmileTvComment::class,'smile_tv_id','id');
    }
}
