<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\adminchildmodules;
class ChildModulesAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminchildmodules = [
            ['name' => 'Products', 'url' => 'ecommerece/all-products', 'counter' => '', 'adminparent' => '2'],
            ['name' => 'Categories ', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],
            ['name' => 'Sub Categories', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],
            ['name' => '3rd Level Sub Categories', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],
            ['name' => 'Brands ', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],
            ['name' => 'Orders', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],
            ['name' => 'Return Orders', 'url' => 'ecommerece/all-returnorders', 'counter' => '', 'adminparent' => '2'],

            ['name' => 'Add Product', 'url' => 'myshop/addproduct', 'counter' => '', 'adminparent' => '3'],
            ['name' => 'Products', 'url' => 'myshop/allproducts', 'counter' => '', 'adminparent' => '3'],
            ['name' => 'My Shop Stock', 'url' => 'myshop/stock', 'counter' => '', 'adminparent' => '3'],
            ['name' => 'My Shop Orders', 'url' => 'myshop/orders', 'counter' => '', 'adminparent' => '3'],
            ['name' => 'Coupons', 'url' => 'myshop/coupons', 'counter' => '', 'adminparent' => '3'],


            ['name' => 'User Plans', 'url' => 'subscriptions/userplans', 'counter' => '', 'adminparent' => '4'],
            ['name' => 'Vendors Plans', 'url' => 'subscriptions/vendorplans', 'counter' => '', 'adminparent' => '4'],


            ['name' => 'Approved Vendors', 'url' => 'vendor/approvedvendors', 'counter' => '', 'adminparent' => '7'],
            ['name' => 'Disabled Sellers', 'url' => 'vendor/disabeldvendors', 'counter' => '', 'adminparent' => '7'],

            ['name' => 'All Pages', 'url' => 'pages/allpages', 'counter' => '', 'adminparent' => '10'],
            ['name' => 'New Page', 'url' => 'pages/addnewpage', 'counter' => '', 'adminparent' => '10'],
            

            ['name' => 'Appearance', 'url' => 'settings/appearance', 'counter' => '', 'adminparent' => '11'],
            ['name' => 'Home Banners', 'url' => 'settings/homebanners', 'counter' => '', 'adminparent' => '11'],
            ['name' => 'Advertisements', 'url' => 'settings/advertisements', 'counter' => '', 'adminparent' => '11'],
            ['name' => 'Payement Methods', 'url' => 'settings/payementmethod', 'counter' => '', 'adminparent' => '11'],
            ['name' => 'Modules', 'url' => 'settings/modules', 'counter' => '', 'adminparent' => '11'],
            ['name' => 'Languages', 'url' => 'settings/languages', 'counter' => '', 'adminparent' => '11'],


            ['name' => 'All Staff', 'url' => 'staff/allstaff', 'counter' => '', 'adminparent' => '12'],
            ['name' => 'Staff Permission', 'url' => 'staff/permissions', 'counter' => '', 'adminparent' => '12'],

            ['name' => 'Banners', 'url' => 'mobileapp/banners', 'counter' => '', 'adminparent' => '13'],
            ['name' => 'Promo Banners', 'url' => 'mobileapp/promobanners', 'counter' => '', 'adminparent' => '13'],
            
        ];

        foreach($adminchildmodules as $r){
            adminchildmodules::create($r);
        }
    }
}
