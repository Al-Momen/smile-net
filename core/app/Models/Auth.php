<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'auths';
    protected $fillable = [
            'username','email','mobile_no',' password','gender','can_login'
    ];
    public function adminUser()
    {
        return $this->hasOne(AdminUser::class, 'auth_id','id');
    }

    
}
