<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'name' => 'Site A',
            'province_id' => '1',
            'district_id' => '2',
            'started_date' => '2001-01-01'
        ]);

        Site::create([
            'name' => 'Site B',
            'province_id' => '5',
            'district_id' => '17',
            'started_date' => '2001-01-01'
        ]);

        Site::create([
            'name' => 'Site C',
            'province_id' => '3',
            'district_id' => '24',
            'started_date' => '2001-01-01'
        ]);

        Site::create([
            'name' => 'Site D',
            'province_id' => '4',
            'district_id' => '14',
            'started_date' => '2001-01-01'
        ]);

        Site::create([
            'name' => 'Site E',
            'province_id' => '4',
            'district_id' => '13',
            'started_date' => '2001-01-01'
        ]);
    }
}
