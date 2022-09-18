<?php
namespace App\Repositories\Admin\Auth;
use App\Traits\RepoResponse;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Member;
use App\Models\Auth;

class AuthAbstract implements AuthInterface
{
    use RepoResponse;

    public function postStore($request)
    {
        $auth = new Auth();
        $auth->username = $request->username;
        $auth->mobile_no = $request->mobile_no;
        $auth->email = $request->email;
        $auth->password = Hash::make($request->password);
        $auth->gender = $request->gender;
        $auth->can_login = $request->can_login;
        $auth->model_id = $request->status;

        if ($auth->save()) {
            return $this->formatResponse(true, 'Member created successfully !', '', $auth->id);
        } else {
            return $this->formatResponse(false, 'Unable to created member !', '', 0);
        }
    }

    public function postUpdate($request, int $id)
    {
        $auth = Auth::where('id', $id)->first();
        $auth->username = $request->username;
        $auth->mobile_no = $request->mobile_no;
        $auth->email = $request->email;
        $auth->gender = $request->gender;
        $auth->can_login = $request->can_login;
        $auth->model_id = $request->status;

        if ($auth->update()) {
            return $this->formatResponse(true, 'Member created successfully !', '', $auth->id);
        } else {
            return $this->formatResponse(false, 'Unable to created member !', '', 0);
        }
    }

    public function getShow(int $id)
    {
        // TODO: Implement getShow() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
