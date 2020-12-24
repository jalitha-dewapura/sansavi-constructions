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
            'name' => 'User 1',
            'username' => 'user_1',
            'user_role_id' => '1',
            'email' => 'user1@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 2',
            'username' => 'user_2',
            'user_role_id' => '2',
            'email' => 'user2@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 3',
            'username' => 'user_3',
            'user_role_id' => '3',
            'email' => 'user3@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 4',
            'username' => 'user_4',
            'user_role_id' => '4',
            'email' => 'user4@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 5',
            'username' => 'user_5',
            'user_role_id' => '5',
            'email' => 'user5@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 6',
            'username' => 'user_6',
            'user_role_id' => '6',
            'email' => 'user6@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 7',
            'username' => 'user_7',
            'user_role_id' => '1',
            'email' => 'user7@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);

        User::create([
            'name' => 'User 8',
            'username' => 'user_8',
            'user_role_id' => '2',
            'email' => 'user8@example.com',
            'phone' => '0711234567',
            'password' => Hash::make('1234')
        ]);
    }
}
