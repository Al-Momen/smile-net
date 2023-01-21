<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AssignAccessRequest;
use App\Repositories\Admin\AdminUser\AdminUserInterface;

class AssignAccessController extends Controller
{
    //protected $role;
    protected $user;

    public function __construct(AdminUserInterface $user)
    {
        $this->user = $user;
    }

    public function getIndex(Request $request)
    {
        return view('admin.assign-access.index')->withTriggers(0)->with('userName','');
    }
    
    public function postIndex(AssignAccessRequest $request)
    {
        $this->resp = $this->user->getSearchList($request);
        
        return view('admin.assign-access.index')->with('userName', $request->search_string)->withTriggers($this->resp->data);
    }

    
}
