<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ExtraSettingController extends Controller
{
    public function clearCache()
    {
        Artisan::call('optimize:clear');
        $notify[] = ['success', ' Cache cleared successfully.'];
        return redirect()->back()->withNotify($notify);
    }

    public function systemInfo()
    {
        $data['laravelVersion'] = app()->version();
        $data['serverDetails'] = $_SERVER;
        $data['currentPHP'] = phpversion();
        $data['timeZone'] = config('app.timezone');
        $data['pageTitle'] = 'System Information';
        
        return view('admin.setting.info', $data);
    }
}
