<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\adminmodules;
class AdminModulesseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $adminmodules = [
            ['name' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'uil-home-alt', 'counter' => ''],
            ['name' => 'Products', 'url' => '', 'icon' => 'uil-store', 'counter' => ''],
            ['name' => 'My Shop', 'url' => '', 'icon' => 'uil-briefcase', 'counter' => ''],
            ['name' => 'Subscription Plans', 'url' => '', 'icon' => 'uil-clipboard-alt', 'counter' => ''],
            ['name' => 'Users', 'url' => 'users/allusers', 'icon' => 'uil-users-alt', 'counter' => ''],
            ['name' => 'Earnings', 'url' => 'earnings/totalearning', 'icon' => 'uil-folder-plus', 'counter' => ''],
            ['name' => 'Vendors', 'url' => '', 'icon' => 'uil-clipboard-alt', 'counter' => ''],
            ['name' => 'New Vendors', 'url' => 'vendor/newvendorsreuqests', 'icon' => 'uil-folder-plus', 'counter' => 'vendorrequests'],
            ['name' => 'Vendors Settings', 'url' => 'vendor/vendrosettings', 'icon' => 'uil-folder-plus', 'counter' => ''],
            ['name' => 'Pages', 'url' => '', 'icon' => 'uil-clipboard-alt', 'counter' => ''],
            ['name' => 'Website Settings', 'url' => '', 'icon' => 'uil-copy-alt', 'counter' => ''],
            ['name' => 'Staff', 'url' => '', 'icon' => 'uil-clipboard-alt', 'counter' => ''],
            ['name' => 'Mobile App', 'url' => '', 'icon' => 'uil-clipboard-alt', 'counter' => ''],
            ['name' => 'Tickets', 'url' => 'tickets/alltickets', 'icon' => 'uil-folder-plus', 'counter' => ''],
            ['name' => 'Contact Form', 'url' => 'contact/allcontactmessages', 'icon' => 'uil-comment-message', 'counter' => ''],
        ];

        foreach($adminmodules as $r){
            adminmodules::create($r);
        }
    }
}
