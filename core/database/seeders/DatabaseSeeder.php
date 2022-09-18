<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\GeneralSettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CurrencySeeder::class,
            GeneralSettingSeeder::class,
        ]);
    }
}
