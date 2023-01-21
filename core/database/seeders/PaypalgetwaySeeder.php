<?php

namespace Database\Seeders;

use App\Models\AdminPaypalGetway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaypalgetwaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPaypal = new AdminPaypalGetway();
        $adminPaypal->client_id = 'client_id';
        $adminPaypal->secret_key = 'secret_key';
        $adminPaypal->app_id = 'app_id';
        $adminPaypal->mode = 'sandbox';
        $adminPaypal->save();
    }
}
