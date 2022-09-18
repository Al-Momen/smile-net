<?php

namespace App\Services;

/**
 * Created by
 * user: REZOAN LIKHON
 * Date: 12-Feb-2020
 * Time: 12:31 PM
 */

use DB;

// use App\Models\Role;
// use App\Models\Permission;
// use App\Models\PermissionGroup;

class HasAccess {

    public function hasTokenValidity(string $token, $client) {

        $token_info = DB::table('tokens as t')
            ->join('auths as a', 'a.id', '=', 't.auth_id')
            ->where(['a.status' => 1, 'a.can_login' => 1])
            ->where(['t.token' => $token, 't.client' => $client])
            ->where('t.expire_at', '>', date("Y-m-d H:i:s"))
            ->where('t.is_expire', 0)
            ->orderBy('t.id', 'desc')
            ->first();

        if (!empty($token_info)) {
            return $token_info->auth_id;
        }
        return null;
    }

    public function can($permission_slug, $auth_id){
        //Get auth role id
        $role_id = $this->hasRole($auth_id);

        if($role_id == 1){
            return true;
        }

        $roles = $this->has_permission($role_id, $permission_slug);
        if(count($roles) > 0) {
            return true;
        }
        return false;
    }

    private function hasRole($auth_id){
        return DB::table('auth_role')->where('auth_id', $auth_id)->value('role_id');
    }

    private function has_permission($role_id, $permission_slug){
        $permissions = DB::table('role_permission')
            ->where('role_id', $role_id)
            ->where('permissions','like', "%".$permission_slug."%")
            ->get();
        return $permissions;
    }


}
