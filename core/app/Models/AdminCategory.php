<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
