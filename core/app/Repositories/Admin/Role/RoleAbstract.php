<?php
namespace App\Repositories\Admin\Role;

use App\Models\Auth;
use App\Models\Role;
use App\Models\User;
use App\Traits\RepoResponse;
use App\Models\RolePermission;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\DB;

class RoleAbstract implements RoleInterface
{
    use RepoResponse;

    protected $role;

    protected $permGroup;

    public function __construct(Role $role, PermissionGroup $permGroup)
    {
        $this->role = $role;
        $this->permGroup = $permGroup;
    }

    public function getPaginatedList($request, int $per_page = 20)
    {
        $data = $this->role::select(
            'roles.id',
            'roles.role_name',
            'roles.created_by',
            'roles.created_at',
            'au.first_name',
            'au.last_name'
            )->leftJoin('auths as a', 'a.id', '=', 'roles.created_by')
            ->leftJoin('admin_users as au', 'au.id', '=', 'a.id')
            ->paginate($per_page);

        return $this->formatResponse(true, '', 'admin.role', $data);
    }

    public function getAllGroups($status = 1, $order_by = 'id', $sort = 'asc')
    {
        return $this->permGroup->with('permissions')->where('status', $status)->orderBy($order_by, $sort)->get();
    }

    public function postStore($request, $permissions)
    {
        DB::beginTransaction();

        try {
            $role = new Role();
            $role->role_name = $request['role_name'];
            $role->created_by = auth()->user()->id;
            $role->edited_by = 0;
            $role->status = 1;

            if($role->save()) {
                $perm_string = ",dashboard,";

                if(count($permissions['permission'])){
                    $perm_string = implode(',',$permissions['permission']);
                    $perm_string = ','.$perm_string.',';
                }

                $rolePermission = new RolePermission();
                $rolePermission->role_id = $role->id;
                $rolePermission->permissions = $perm_string;
                $rolePermission->save();
            }

        } catch (\Exception $e) {

            DB::rollback();
            return $this->formatResponse(false, 'Unable to create role !', 'admin.role');
        }
        DB::commit();

        return $this->formatResponse(true, 'Role has been created successfully !', 'admin.role');
    }

    public function findOrThrowException($id)
    {
        $role = $this->role->with('permission')->find($id);

        if (! is_null($role)) return $role;
        throw new GeneralException('That role is not exist.');
    }

    public function postUpdate($request, int $id, $permissions)
    {
        DB::beginTransaction();

        try {
            $role = $this->findOrThrowException($id);

            $role->role_name = $request['role_name'];
            $role->edited_by = 1;

            //Update Role permission table
            $perm_string = ",dashboard,";

            if(count($permissions['permission'])) {
                $perm_string = implode(',', $permissions['permission']);
                $perm_string = ','.$perm_string.',';
            }

            $role->permission->permissions = $perm_string;
            $role->push();

        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to update Role !', 'admin.role');
        }

        DB::commit();

        return $this->formatResponse(true, 'Role has been updated successfully !', 'admin.role');
    }

    public function delete(int $id)
    {
        DB::begintransaction();
        try {
            User::where('auth_id', $id)->delete();
            Auth::where('id',$id)->delete();
            DB::commit();
            echo 'Deleted successfully';
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return $this->formatResponse(false, 'Unable to delete admin role !', 'admin.role');
        }

        return $this->formatResponse(true, 'Successfully delete admin role !', 'admin.role');
    }
    public function getList()
    {
        return DB::table('roles')->pluck('role_name', 'id');
    }
}
