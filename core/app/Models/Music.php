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
        'song_title',
        'singer_name',
        'song_image',
        'song_file'
    ];
    
    // admin User relationship
    public function admin(){
        return $this->belongsTo(AdminUser::class,'user_id','id');
    }
}
