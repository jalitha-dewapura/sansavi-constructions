<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\MeasuringUnits;

class MeasuringUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $measureUnit_1 = MeasuringUnits::create([
            'id' => 1,
            'name' => 'Default',
            'is_visible' => false,
            'is_active' => false
        ]);
        
        
        $measureUnit_2 = MeasuringUnits::create([
            //
            'id' => 2,
            'name' => 'Length',
            'is_visible' => false,
            'is_active' => false
        ]);
        
        $measureUnit_3 = MeasuringUnits::create([
            //
            'id' => 3,
            'name' => 'Weight',
            'is_visible' => false,
            'is_active' => false
        ]);
        
        $measureUnit_4 = MeasuringUnits::create([
            //
            'id' => 4,
            'name' => 'Liquid',
            'is_visible' => false,
            'is_active' => false,
        ]);
        
        $measureUnit_5 = MeasuringUnits::create([
            //
            'id' => 5,
            'name' => 'Quantity',
            'is_visible' => false,
            'is_active' => false,
        ]);
       
        //
        $measureUnit_2->children()->create([
            'name' => 'm',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        $measureUnit_2->children()->create([
            'name' => 'cm',
            'is_visible' => true,
            'is_active' => true
        ]);

        $measureUnit_2->children()->create([
            'name' => 'mm',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        //
        $measureUnit_3->children()->create([
            'name' => 'Kg',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        $measureUnit_3->children()->create([
            'name' => 'g',
            'is_visible' => true,
            'is_active' => true
        ]);

        $measureUnit_3->children()->create([
            'name' => 'mg',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        //
        $measureUnit_4->children()->create([
            'name' => 'l',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        $measureUnit_4->children()->create([
            'name' => 'ml',
            'is_visible' => true,
            'is_active' => true
        ]);
        
        //
        $measureUnit_5->children()->create([
            'name' => 'Unit',
            'is_visible' => true,
            'is_active' => true
        ]);
        
    }
}
