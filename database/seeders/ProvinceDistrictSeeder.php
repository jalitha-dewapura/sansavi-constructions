<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Province;
use App\Models\District;

class ProvinceDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add province

        $provinceObject1 = Province::create([
            'id' => 1,
            'name' => 'Central Province'
        ]);
        
        $provinceObject2 = Province::create([
            'id' => 2,
            'name' => 'Eastern Province'
        ]);
        
        $provinceObject3 = Province::create([
            'id' => 3,
            'name' => 'Northern Province'
        ]);
        
        $provinceObject4 = Province::create([
            'id' => 4,
            'name' => 'Southern Province'
        ]);
        
        $provinceObject5 = Province::create([
            'id' => 5,
            'name' => 'Western Province'
        ]);
        
        $provinceObject6 = Province::create([
            'id' => 6,
            'name' => 'North Western Province'
        ]);
        
        $provinceObject7 = Province::create([
            'id' => 7,
            'name' => 'North Central Province'
        ]);
        
        $provinceObject8 = Province::create([
            'id' => 8,
            'name' => 'Uva Province'
        ]);
        
        $provinceObject9 = Province::create([
            'id' => 9,
            'name' => 'Sabaragamuwa Province'
        ]);
        
        //add districts

        $provinceObject1->districts()->create([
            'name' => 'Matale',
            'code' => 'MT'
        ]);
        
        $provinceObject1->districts()->create([
            'name' => 'Kandy',
            'code' => 'KY'
        ]);
        
        $provinceObject1->districts()->create([
            'name' => 'Nuwara Eliya',
            'code' => 'NE'
        ]);
        
        $provinceObject2->districts()->create([
            'name' => 'Trincomalee',
            'code' => 'TM'
        ]);
        
        $provinceObject2->districts()->create([
            'name' => 'Batticaloa',
            'code' => 'BC'
        ]);
        
        $provinceObject2->districts()->create([
            'name' => 'Ampara',
            'code' => 'AP'
        ]);
        
        $provinceObject3->districts()->create([
            'name' => 'Jaffna',
            'code' => 'JF'
        ]);
        
        $provinceObject3->districts()->create([
            'name' => 'Kilinochchi',
            'code' => 'KN'
        ]);
        
        $provinceObject3->districts()->create([
            'name' => 'Mannar',
            'code' => 'MN'
        ]);
        
        $provinceObject3->districts()->create([
            'name' => 'Mullaitivu',
            'code' => 'ML'
        ]);
        
        $provinceObject3->districts()->create([
            'name' => 'Vavuniya',
            'code' => 'VN'
        ]);
        
        $provinceObject4->districts()->create([
            'name' => 'Hambantota',
            'code' => 'HT'
        ]);
        
        $provinceObject4->districts()->create([
            'name' => 'Matara',
            'code' => 'MR'
        ]);
        
        $provinceObject4->districts()->create([
            'name' => 'Galle',
            'code' => 'GL'
        ]);
        
        $provinceObject5->districts()->create([
            'name' => 'Gampaha',
            'code' => 'GP'
        ]);
        
        $provinceObject5->districts()->create([
            'name' => 'Kalutara',
            'code' => 'KT'
        ]);
        
        $provinceObject5->districts()->create([
            'name' => 'Colombo',
            'code' => 'CB'
        ]);
        
        $provinceObject6->districts()->create([
            'name' => 'Kurunegala',
            'code' => 'KG'
        ]);
        
        $provinceObject6->districts()->create([
            'name' => 'Puttalam',
            'code' => 'PT'
        ]);
        
        $provinceObject7->districts()->create([
            'name' => 'Polonnaruwa',
            'code' => 'PN'
        ]);
        
        $provinceObject7->districts()->create([
            'name' => 'Anuradapura',
            'code' => 'AN'
        ]);
        
        $provinceObject8->districts()->create([
            'name' => 'Moneragala',
            'code' => 'MG'
        ]);
        
        $provinceObject8->districts()->create([
            'name' => 'Badulla',
            'code' => 'BD'
        ]);
        
        $provinceObject9->districts()->create([
            'name' => 'Kegalle',
            'code' => 'KE'
        ]);
        
        $provinceObject9->districts()->create([
            'name' => 'Ratnapura',
            'code' => 'RP'
        ]);
    }
}
