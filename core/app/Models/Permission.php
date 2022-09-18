<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function group() {
        return $this->belongsTo('App\Models\PermissionGroup', 'permission_group_id', 'id');
    }
}
