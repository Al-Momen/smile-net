<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSocialLink extends Model
{
    use HasFactory;
    protected $table = 'admin_social_links';
    protected $fillable = [
        
        'id',
        'address',
        'email',
        'phone',
        'fb_link',
        'twitter_link',
        'instragram_link',
        'linkedin_link',
    ];
    
}
