<?php
namespace App\Repositories\Admin\PermissionGroup;

use App\Models\PermissionGroup;
use App\Traits\RepoResponse;
use DB;

class PermissionGroupAbstract implements PermissionGroupInterface
{
    use RepoResponse;

    protected $permissionGroup;

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->permissionGroup = $permissionGroup;
    }

    public function getPaginatedList($request, int $per_page = 20)
    {
        $data = $this->permissionGroup::paginate($per_page);
        return $this->formatResponse(true, '', 'admin.permission-group', $data);
    }

    public function postStore($request)
    {
        DB::beginTransaction();

        try {

            $permissionGroup = new PermissionGroup();
            $permissionGroup->group_name = $request->permission_group_name;
            $permissionGroup->status = 1;
            $permissionGroup->save();

        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to create admin permissionGroup !', 'admin.permission-group');
        }

        DB::commit();

        return $this->formatResponse(true, 'Admin User has been created successfully !', 'admin.permission-group');
    }

    public function postUpdate($request, int $id)
    {
        DB::beginTransaction();

        try {
            $permissionGroup = $this->permissionGroup->where('id', $id)->first();
            $permissionGroup->group_name = $request->permission_group_name;
            $permissionGroup->status = 1;
            $permissionGroup->update();



        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to update admin permissionGroup !', 'admin.permission-group');
        }

        DB::commit();
        return $this->formatResponse(true, 'Admin User has been updated successfully !', 'admin.permission-group');

    }

    public function getShow(int $id)
    {
        $data =  PermissionGroup::find($id);

        if (!empty($data)) {
            return $this->formatResponse(true, '', 'admin.permission-group.edit', $data);
        }

        return $this->formatResponse(false, 'Did not found data !', 'admin.permission-group', null);
    }

    public function delete(int $id)
    {
        DB::begintransaction();
        try {
            PermissionGroup::where('id', $id)->delete();
            DB::commit();
            echo 'deleted successfully';
        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to delete admin permissionGroup !', 'admin.permission-group');
        }

        return $this->formatResponse(true, 'Successfully delete admin permissionGroup !', 'admin.permission-group');
    }
}
