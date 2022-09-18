<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';

    public function members()
    {
        return $this->belongsToMany('App\Models\Auth','role_member', 'role_id', 'auth_id');
    }

    public function permission()
    {
        return $this->hasOne('App\Models\RolePermission');
    }
}
