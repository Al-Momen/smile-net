<?php

namespace App\Models;

use App\Models\AdminVote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminCategory extends Model
{
    use HasFactory;
    protected $table = 'admin_categories';
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
    ];
    public function events(){
        return $this->hasMany(Event::class,"category_id","id");
    }
    public function votes(){
        return $this->hasMany(AdminVote::class,"category_id","id");
    }
}
