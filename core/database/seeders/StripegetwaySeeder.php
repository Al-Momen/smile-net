<?php

namespace Database\Seeders;

use App\Models\AdminStripeGetway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StripegetwaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminStripe = new AdminStripeGetway();
        $adminStripe->stripe_key = 'stripe_key';
        $adminStripe->stripe_secret = 'stripe_secret';
        $adminStripe->save();
    }
}
