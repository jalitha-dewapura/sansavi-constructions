<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(ProvinceDistrictSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(MeasuringUnitsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(SiteSeeder::class);
    }
}
