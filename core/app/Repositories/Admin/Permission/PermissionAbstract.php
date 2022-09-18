<?php
namespace App\Repositories\Admin\Permission;

use App\Models\Permission;
use App\Traits\RepoResponse;
use DB;

class PermissionAbstract implements PermissionInterface
{
    use RepoResponse;

    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getPaginatedList($request,$per_page = 20)
    {
        $data = $this->permission::with('group')->get();
        // echo '<pre>';
        // echo '======================<br>';
        // print_r($data);
        // echo '<br>======================<br>';
        // exit();
        return $this->formatResponse(true, '', '', $data);
    }

    public function getList() {
        return DB::table('permission_groups')->pluck('group_name', 'id');
    }

    public function postStore($request)
    {
        DB::beginTransaction();

        try {
            $permission = new Permission();
            $permission->name = $request->permission_slug;
            $permission->display_name = $request->display_name;
            $permission->permission_group_id = $request->permission_group;
            $permission->status = 1;
            $permission->save();
        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to create permission !', 'admin.permission');
        }

        DB::commit();

        return $this->formatResponse(true, 'Permission has been created successfully !', 'admin.permission');
    }

    public function postUpdate($request, int $id)
    {
        DB::beginTransaction();

        try {
            $permission = $this->permission->where('id', $id)->first();
            $permission->name = $request->permission_slug;
            $permission->display_name = $request->display_name;
            $permission->permission_group_id = $request->permission_group;
            $permission->status = 1;
            $permission->update();

        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to update permission !', 'admin.permission');
        }

        DB::commit();

        return $this->formatResponse(true, 'Permission has been updated successfully !', 'admin.permission');
    }

    public function getShow(int $id)
    {
        $data =  Permission::find($id);

        if (!empty($data)) {
            return $this->formatResponse(true, '', 'admin.permission', $data);
        }

        return $this->formatResponse(false, 'Did not found data !', 'admin.permission', null);
    }

    public function delete(int $id)
    {
        DB::begintransaction();
        try {
            Permission::where('id', $id)->delete();
            DB::commit();
            echo 'deleted successfully';
        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to delete this action !', 'admin.permission');
        }

        return $this->formatResponse(true, 'Successfully delete this action !', 'admin.permission');
    }

}
