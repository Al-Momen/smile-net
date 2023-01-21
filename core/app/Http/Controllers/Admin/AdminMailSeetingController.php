<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminMailSetting;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class AdminMailSeetingController extends Controller
{
    public function index()
    {
        $adminMail = AdminMailSetting::first();
        return view('admin.mail-setup.index',compact('adminMail'));
    }
    public function mailUpdate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'mail_transport' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from' => 'required',
        ]);
        
        try {
            $adminMail = AdminMailSetting::first();
            $adminMail->mail_transport = $request->mail_transport;
            $adminMail->mail_host = $request->mail_host;
            $adminMail->mail_port = $request->mail_port;
            $adminMail->mail_username = $request->mail_username;
            $adminMail->mail_password = $request->mail_password;
            $adminMail->mail_encryption = $request->mail_encryption;
            $adminMail->mail_from = $request->mail_from;
            $adminMail->update();
            $notify[] = ['success', 'Mail Update Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function mailTemplate(Request $request)
    {
        // dd($request->all());
        return view('admin.mail-setup.email_template');
    }
}
