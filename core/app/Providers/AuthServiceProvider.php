<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\GeneralUser;
use App\Models\TicketTypeDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();
        // Gate::define('subscribe-plan-standard', function (GeneralUser $user, $ticketTypeDetails) {
        //     dd($user);
        //     $pluck = $ticketTypeDetails->pluck('ticket_type_id');
        //     return in_array(2,$pluck->toArray());
        // });

        $this->registerPolicies();

        Gate::define('course', function (User $user) {

            dd('ok');
           if (auth()->user()->id == 1 || auth()->user()->id == 3 ) {
            return true;
           } else {
               return false;
           }
           
        });
    }
}
