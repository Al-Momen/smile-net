<?php

use App\Models\Brand;
use App\Models\Hscode;
use App\Models\Category;
use App\Models\VatClass;
use App\Models\AdminUser;
use App\Models\SubCategory;
use App\Models\ProductModel;
use App\Models\Auth as CustomAuth;
use Illuminate\Support\Facades\DB;

if (!function_exists('getAuthId')) {

    function getAuthId()
    {
        if (Auth::user()) {
            $user_session = Auth::user();
            return $user_session->id;
        }
    }
}

if (!function_exists('userRolePermissionArray')) {
    function userRolePermissionArray() {
        $roles = DB::table('role_permission as rp')
            ->select('rp.permissions')
            ->join('auth_role as ar','ar.role_id', '=', 'rp.role_id')
            ->where('ar.auth_id', getAuthId())
            ->first();
        if (! empty($roles)) {
            return explode(",", $roles->permissions);
        }

        return [];
    }
}




if (!function_exists('hasRoleToThisUser')) {
    /**
     * Helper to return the current login user id
     *
     * @return mixed
     */
    function hasRoleToThisUser($user_id)
    {
        return DB::table('auth_role')->where('auth_id', $user_id)->value('role_id');
    }
}

if (!function_exists('hasAccessAbility')) {
    function hasAccessAbility($permission_slug, $permission_array) {
        $user_id = getAuthId();
        if ($user_id == 1) return true;

        $role_id = hasRoleToThisUser($user_id);
        if ($role_id == 1) return true;

        if (! empty($permission_slug) && ! empty($permission_array)) {
            if (in_array($permission_slug, $permission_array)) {
                return true;
            }
        }

        return false;
    }
}

/*
 *PHP Array into a PHP Object
 */
if (!function_exists('array_to_object')) {
    function array_to_object($array) {
        return (object) $array;
    }
}

/*
 *PHP Object into a PHP Array
 */
if (!function_exists('object_to_array')) {
    function object_to_array($object) {
        return (array) $object;
    }
}
/*Print+Exit = print */
if (!function_exists('prixt')) {

    function prixt($data, $exit = 0)
    {
        echo "<pre>";
        print_r($data);
        if($exit == 1)
        {
            exit;
        }
    }
}

/*Print Validation Error List*/
if (!function_exists('vError')) {

    function vError($errors)
    {
        if ($errors->any()){
            foreach ($errors->all() as $error){
                echo '<li class="text-danger">'. $error .'</li>';
            }
        }
        else {
            echo 'Not found any validation error';
        }

    }
}

if (!function_exists('get_error_response')) {

    function get_error_response($code, $reason, $errors = [],  $error_as_string = '', $description = '')
    {
        if ($error_as_string == '') {
            $error_as_string = $reason;
        }

        if ($description == '') {
            $description = $reason;
        }

        return [
            'code'          => $code,
            'errors'        => $errors,
            'error_as_string'  => $error_as_string,
            'reason'        => $reason,
            'description'   => $description,
            'error_code'    => $code,
            'link'          => ''
        ];
    }
}


if (!function_exists('getCategorCombo')) {
    function getCategorCombo() {
       return Category::where('IS_ACTIVE',1)->pluck('NAME', 'PK_NO');

    }
}

if (!function_exists('getSubCategorCombo')) {
    function getSubCategorCombo($category_id) {
       return SubCategory::where(['IS_ACTIVE' => 1, 'F_PRD_CATEGORY_NO' => $category_id])->pluck('NAME', 'PK_NO');

    }
}

if (!function_exists('getBrandCombo')) {
    function getBrandCombo() {
       return Brand::where('IS_ACTIVE',1)->pluck('NAME', 'PK_NO');

    }
}

if (!function_exists('getVatClassCombo')) {
    function getVatClassCombo() {
       return VatClass::where('IS_ACTIVE',1)->pluck('NAME', 'PK_NO');

    }
}

if (!function_exists('getModelCombo')) {
    function getModelCombo($brand_id) {
       return ProductModel::where(['IS_ACTIVE' => 1, 'F_PRD_BRAND_NO' => $brand_id])->pluck('NAME', 'PK_NO');

    }
}
if (!function_exists('getHScodeCombo')) {
    function getHScodeCombo($subcat_id) {
       return Hscode::where(['F_PRD_SUB_CATEGORY_NO' => $subcat_id])->pluck('CODE', 'PK_NO');

    }
}
