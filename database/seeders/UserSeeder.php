<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super 1',
            'username' => 'super_1',
            'user_role_id' => '1',
            'email' => 'super1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PO 1',
            'username' => 'po_1',
            'user_role_id' => '2',
            'email' => 'po1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PO 2',
            'username' => 'po_2',
            'user_role_id' => '2',
            'email' => 'po2@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PO 3',
            'username' => 'po_3',
            'user_role_id' => '2',
            'email' => 'po3@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PO 4',
            'username' => 'po_4',
            'user_role_id' => '2',
            'email' => 'po4@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PO 5',
            'username' => 'po_5',
            'user_role_id' => '2',
            'email' => 'po5@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PM 1',
            'username' => 'pm_1',
            'user_role_id' => '3',
            'email' => 'pm1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PM 2',
            'username' => 'pm_2',
            'user_role_id' => '3',
            'email' => 'pm2@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PM 3',
            'username' => 'pm_3',
            'user_role_id' => '3',
            'email' => 'pm3@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PM 4',
            'username' => 'pm_4',
            'user_role_id' => '3',
            'email' => 'pm4@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'PM 5',
            'username' => 'pm_5',
            'user_role_id' => '3',
            'email' => 'pm5@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'QS 1',
            'username' => 'qs_1',
            'user_role_id' => '4',
            'email' => 'qs1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'QS 2',
            'username' => 'qs_2',
            'user_role_id' => '4',
            'email' => 'qs2@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'QS 3',
            'username' => 'qs_3',
            'user_role_id' => '4',
            'email' => 'qs3@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'QS 4',
            'username' => 'qs_4',
            'user_role_id' => '4',
            'email' => 'qs4@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
        User::create([
            'name' => 'QS 5',
            'username' => 'qs_5',
            'user_role_id' => '4',
            'email' => 'qs5@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
        
        User::create([
            'name' => 'SK 1',
            'username' => 'sk_1',
            'user_role_id' => '5',
            'email' => 'sk1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
        
        User::create([
            'name' => 'SK 2',
            'username' => 'sk_2',
            'user_role_id' => '5',
            'email' => 'sk2@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
        
        User::create([
            'name' => 'SK 3',
            'username' => 'sk_3',
            'user_role_id' => '5',
            'email' => 'sk3@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
        
        User::create([
            'name' => 'SK 4',
            'username' => 'sk_4',
            'user_role_id' => '5',
            'email' => 'sk4@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'SK 5',
            'username' => 'sk_5',
            'user_role_id' => '5',
            'email' => 'sk5@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'HR 1',
            'username' => 'hr_1',
            'user_role_id' => '6',
            'email' => 'hr1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        
    }
}
