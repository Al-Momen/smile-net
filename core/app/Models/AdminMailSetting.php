<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMailSetting extends Model
{
    use HasFactory;
    protected $table = 'admin_mail_settings';
    protected $fillable = [
        'id',
        'mail_transport',
        'mail_host',
        'mail_port',     
        'mail_username',     
        'mail_password',     
        'mail_encryption',     
        'mail_from',     
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
}
