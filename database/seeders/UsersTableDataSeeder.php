<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
                'name' => 'Supper Admin',
                'email' => 'buy786@gmail.com',
                'password' => Hash::make(12345678),
                'api_token' => 'sadfsdf234sadsa2134',
                'active' => '1',
                'role_id' => '1',
                'is_admin' => '1',
                'user_type' => 'admin',
                'business_name' =>'buy 786',
            ],

            // [
            //     'name' => 'Shafiq Anjum',
            //     'email' => 'shafiqanjum794@gmail.com',
            //     'password' => Hash::make(123456789),
            //     'api_token' => 'sadfsdf234sadsa2134',
            //     'active' => '1',
            //     'role_id' => '1',
            //     'user_type' => 'vendor',
            // ]



        );
    }
}
