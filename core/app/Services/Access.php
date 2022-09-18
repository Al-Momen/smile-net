<?php

namespace App\Services;

/**
 * Created by
 * user: REZOAN LIKHON
 * Date: 12-Feb-2020
 * Time: 12:31 PM
 */
use DB;

class Access {

    public function can(string $permission_slug) {
        $auth_id = getAuthId();

        //If user is admin
        if ($auth_id == 1) return true;

        //Get user role id
        $role_id = $this->hasRole($auth_id);

        //If user role is admin
        if ($role_id == 1) return true;
        $roles = $this->has_permission($role_id,$permission_slug);

        if(count($roles) > 0) {
            return true;
        }

        return false;
    }

    private function hasRole(int $auth_id) {
        return DB::table('auth_role')->where('auth_id', $auth_id)->value('role_id');
    }

    private function has_permission(int $role_id, string $permission_slug) {
        $permissions = DB::table('role_permission')
            ->where('role_id', $role_id)
            ->where('permissions','like', "%".$permission_slug."%")
            ->get();

        return $permissions;
    }
}
