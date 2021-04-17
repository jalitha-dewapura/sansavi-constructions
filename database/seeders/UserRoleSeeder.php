<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Models\UserRole;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'name' => 'super_admin',
        ]);

        UserRole::create([
            'name' => 'purchasing_officer',
        ]);

        UserRole::create([
            'name' => 'project_manager',
        ]);

        UserRole::create([
            'name' => 'quantity_surveyor',
        ]);

        UserRole::create([
            'name' => 'stock_keeper',
        ]);

        UserRole::create([
            'name' => 'hr_officer',
        ]);
    }
}
