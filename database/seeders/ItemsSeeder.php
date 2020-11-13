<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Items;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::create([
            'code' => '1',
            'name' => 'Item 01',
            'measuring_unit_id' => '6',
            'price' => '120',
            'is_consumable' => true,
            'description' => 'Any description 01'
        ]);
        Items::create([
            'code' => '2',
            'name' => 'Item 02',
            'measuring_unit_id' => '8',
            'price' => '15000',
            'is_consumable' => false,
            'description' => 'Any description 02'
        ]);
        Items::create([
            'code' => '3',
            'name' => 'Item 03',
            'measuring_unit_id' => '1',
            'price' => '5000',
            'is_consumable' => true,
            'description' => 'Any description 03'
        ]);
    }
}
