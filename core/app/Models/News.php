<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'image',
        'tag',
        'status',
        'slug',
        'date',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function category(){
        return $this->belongsTo(AdminCategory::class);
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }

}
