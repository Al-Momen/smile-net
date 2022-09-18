<?php

namespace App\Providers;

use App\Models\User;
use App\Models\SupportTicket;
use App\Models\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $checkSeed = DB::table('general_settings')->get()->count();
        if($checkSeed == 0) {
            Artisan::call('db:seed', [
                '--class' => 'DatabaseSeeder',
                '--force' => true // <--- add this line
            ]);
        }

        $activeTemplate = activeTemplate();
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
        view()->share($viewShare);
        view()->composer('admin.layout.left_sidebar', function ($view) {
            $view->with([
                'users_count'                  => User::count(),
                'active_users_count'           => User::active()->count(),
                'banned_users_count'           => User::banned()->count(),
                'email_verified_users_count' => User::emailVerified()->count(),
                'sms_verified_users_count'   => User::smsVerified()->count(),
                'email_unverified_users_count' => User::emailUnverified()->count(),
                'sms_unverified_users_count'   => User::smsUnverified()->count(),
                'kyc_verified_users_count'   => User::kycVerified()->count(),
                'kyc_unverified_users_count'   => User::kycUnVerified()->count(),
                'support_tickets'         => SupportTicket::all()->count(),
                'support_ticket_answerd_count'         => SupportTicket::where('status', 1)->count(),
                'pending_ticket_count'         => SupportTicket::whereIN('status', [0,2])->count(),
                'support_ticket_closed_count'         => SupportTicket::where('status', 3)->count()
            ]);
        });

        Schema::defaultStringLength(191);
    }
}
