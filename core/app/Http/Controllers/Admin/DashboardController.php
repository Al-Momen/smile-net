<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends Controller
{
    public function __construct()
    {
    }
    public function getIndex() {
        return view('admin.dashboard.index');
    }

    public function homepage() {
        return view('admin.dashboard.home');
    }
}
