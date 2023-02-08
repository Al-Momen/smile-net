<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;

class AdminUserManageController extends Controller
{
    public function allUsers()
    {
        $all_users = GeneralUser::orderBy('id','desc')->paginate(8);
        return view('admin.manage-user.all_users',compact('all_users'));
    }
    public function activeUsers()
    {
        $active_users = GeneralUser::where('access','=', 0)->paginate(8);
        return view('admin.manage-user.active_users',compact('active_users'));
    }
    public function bannedUsers()
    {
        $banned_users = GeneralUser::where('access','=', 1)->paginate(8);
        return view('admin.manage-user.banned_users',compact('banned_users'));
    }
    public function planUsers()
    {
        $all_users = GeneralUser::paginate(8);
        return view('admin.manage-user.all_users',compact('all_users'));
    }
    public function userDetails($id)
    {
        $view_user = GeneralUser::where('id', $id)->first();
        return view('admin.manage-user.view_user',compact('view_user'));
    }
    public function plan()
    {
        $sub_plans = TicketTypeDetails::with('user','ticket_type')->paginate(8);
        return view('admin.manage-user.plan_users',compact('sub_plans'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
       if($request->search != ''){
            $data = GeneralUser::where('full_name','LIKE',"%$search%")
            ->orWhere('email','LIKE',"%$search%")
            ->orderBy('id','desc')->paginate();
            if($data->count() > 0){
                return response()->json([
                    'data'=> $data,
                    'status' => 1,
                ]);
            }else{
                return response()->json([
                    'data'=> 'No found data',
                    'status' => 0,
                ]);
            }
       }
    }
    
    public function statusAccess(Request $request, $id)
    {
        $statusAccess = GeneralUser::where('id', $id)->first();
        // dd($statusAccess);
        if ($request->access == 'on') {
            $statusAccess->access = 1;
            $statusAccess->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $statusAccess->access = 0;
            $statusAccess->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
}
