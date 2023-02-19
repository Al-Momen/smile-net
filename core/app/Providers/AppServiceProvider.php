<?php

namespace App\Providers;

use App\Models\AdminBuyManualGetway;
use App\Models\User;
use App\Models\Frontend;
use App\Models\AdminCategory;
use App\Models\SupportTicket;
use App\Models\GeneralSetting;
use App\Models\AdminSocialLink;
use App\Models\AdminMailSetting;
use App\Models\FooterSection;
use App\Models\TicketTypeDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

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
        if ($checkSeed == 0) {
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
        //nabvar use this variable 
        $viewShare['category_events'] = AdminCategory::all();
        $viewShare['buyManualGetway'] = AdminBuyManualGetway::all();
        $viewShare['footer'] = FooterSection::first();
       
        // $viewShare['ticketTypeDetails'] = TicketTypeDetails::with('ticket_type')->pluck('user_id');
        // $viewShare['ticketTypeStanderd'] = TicketTypeDetails::where('ticket_slug','standard')->first();
        // $viewShare['ticketTypePremium'] = TicketTypeDetails::where('ticket_slug','premium')->first();
        
        $viewShare['social_link'] = AdminSocialLink::first();
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
                'pending_ticket_count'         => SupportTicket::whereIN('status', [0, 2])->count(),
                'support_ticket_closed_count'         => SupportTicket::where('status', 3)->count(),
            ]);
        });

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Schema::defaultStringLength(191);

        // ----------------------------------admin mail set up------------------------------------------------
        $adminMailSeeting = AdminMailSetting::first();
        if ($adminMailSeeting) {
            $data = [

                'driver'        => $adminMailSeeting->mail_transport,
                'host'          => $adminMailSeeting->mail_host,
                'port'          => $adminMailSeeting->mail_port,
                'encryption'    => $adminMailSeeting->mail_encryption,
                'username'      => $adminMailSeeting->mail_username,
                'password'      => $adminMailSeeting->mail_password,
                'from'          => [

                    'address'  => $adminMailSeeting->mail_from,
                    'name'     => 'AppDevs',

                ],  
            ];
            Config::set('mail', $data);
        }


        // -------------------------------seo setup-----------------------------
        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });
    }
}
