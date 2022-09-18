<?php
namespace App\Repositories\Admin\UserGroup;

use App\Models\UserGroup;
use App\Traits\RepoResponse;
use DB;

class UserGroupAbstract implements UserGroupInterface
{
    use RepoResponse;

    protected $userGroup;

    public function __construct(UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    public function getPaginatedList($request, int $per_page = 20)
    {
        $data = $this->userGroup::join('roles', 'roles.id', '=', 'user_groups.role_id')
                ->select('user_groups.*','roles.role_name')->paginate($per_page);
        //prixt($data,1);
        return $this->formatResponse(true, '', 'admin.user-group', $data);
    }

    public function postStore($request)
    {
        DB::beginTransaction();

        try {

            $userGroup = new UserGroup();
            $userGroup->group_name = $request->user_group_name;
            $userGroup->role_id = $request->role;
            $userGroup->status = 1;
            $userGroup->save();

        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to create Admin User Group !', 'admin.user-group');
        }

        DB::commit();

        return $this->formatResponse(true, 'Admin User Group has been created successfully !', 'admin.user-group');
    }

    public function postUpdate($request, int $id)
    {
        DB::beginTransaction();
        try {
            $userGroup = $this->userGroup->where('id', $id)->first();
            $userGroup->group_name = $request->user_group_name;
            $userGroup->role_id = $request->role;
            $userGroup->status = 1;
            $userGroup->update();



        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to update admin User Group !', 'admin.user-group');
        }

        DB::commit();
        return $this->formatResponse(true, 'Admin User Group has been updated successfully !', 'admin.user-group');

    }

    public function getShow(int $id)
    {
        $data =  UserGroup::find($id);

        if (!empty($data)) {
            return $this->formatResponse(true, '', 'admin.user-group.edit', $data);
        }

        return $this->formatResponse(false, 'Did not found data !', 'admin.user-group', null);
    }

    public function delete(int $id)
    {
        DB::begintransaction();
        try {
            UserGroup::where('id', $id)->delete();
            DB::commit();
            echo 'deleted successfully';
        } catch (\Exception $e) {
            DB::rollback();

            return $this->formatResponse(false, 'Unable to delete admin User Group !', 'admin.user-group');
        }

        return $this->formatResponse(true, 'Successfully delete admin User Group !', 'admin.user-group');
    }
    
    public function getList()
    {
        return DB::table('user_groups')->pluck('group_name', 'id');
    }
}
