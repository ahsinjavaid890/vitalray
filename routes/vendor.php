<?php

use Illuminate\Support\Facades\Route;
use App\Models\Chat;


	


	Route::group(['namespace' => 'Vendor\Auth', 'prefix' => 'auth'], function () {

		Route::get('login', 'AuthController@index')->name('vendor.auth.login');
		Route::POST('login', 'AuthController@login')->name('vendor.login');
		Route::get('register', 'AuthController@register')->name('vendor.register');
		Route::get('logout', 'AuthController@logout')->name('vendor.logout');


	});
	Route::group(['namespace' => 'Vendor','middleware' => 'auth:vendor' ], function () {
	

		Route::POST('updateuserprofile', 'VendorController@updateuserprofile');
		Route::POST('updateusersecurity', 'VendorController@updateusersecurity');

		Route::get('dashboard', 'VendorController@index')->name('vendor.dashboard');

		Route::get('shownotification', 'VendorController@shownotification');
		Route::get('getnotification', 'VendorController@getnotification');

		Route::get('earnings', 'VendorController@totalearnings');
		Route::get('earnings/paid', 'VendorController@earningspaid');
		Route::get('earnings/requested', 'VendorController@earningsrequested');
		Route::get('earnings/remaining', 'VendorController@earningsremaining');

		Route::POST('withdrawrequest', 'VendorController@withdrawrequest');


	    Route::group(['prefix' => 'products'], function () { 
	    	Route::get('/checksku/{id}', 'ProductController@checksku');
	    	Route::get('/add', 'ProductController@create')->name('product-add');
	    	Route::post('/store', 'ProductController@storeproduct')->name('product-store');
	    	Route::get('/all', 'ProductController@index')->name('product-list');
	    	Route::get('/all/{id}', 'ProductController@viewwithidproducts');
	    	Route::get('/show', 'ProductController@show')->name('product-show');
	    	Route::get('/edit/{id}', 'ProductController@edit')->name('product-edit');
	    	Route::get('/searchproducts', 'ProductController@searchproducts');
	    	Route::post('/storeattributes', 'ProductController@storeattributes');
	    	Route::post('/storegalleryimages', 'ProductController@storegalleryimages');
	        Route::get('/coupen', 'ProductController@coupon_list')->name('coupon_list');
	        Route::get('/stock', 'ProductController@stock_manage')->name('stock_manage');
	        Route::get('/addcoupen', 'ProductController@addcoupon')->name('add-coupon');
			Route::get('/editcoupen/{id}', 'ProductController@editcoupon')->name('edit-coupon');
	        Route::post('/store_coupon', 'ProductController@store_coupon')->name('store_coupon');
			Route::post('/update_coupon', 'ProductController@update_coupon')->name('update_coupon');
	        Route::get('/attributes', 'ProductController@attributes_list')->name('attributes_list');
			Route::get('/editattributes/{id}', 'ProductController@editattributes')->name('attributes_edit');
	        Route::post('/store_attributes', 'ProductController@store_attributes')->name('store_attributes');
	        Route::post('/attributes/update', 'ProductController@update_attributes')->name('update_attributes');
	        Route::get('/deleteimage/{id}/{productid}', 'ProductController@deleteimage');
	        Route::get('/checkattribute/{id}', 'ProductController@checkattribute');
	        Route::get('/movetotrash/{id}', 'ProductController@movetotrash');

	        Route::post('/updateproduct', 'ProductController@updateproduct');
	        Route::post('/updateattributesforproduct', 'ProductController@updateattributesforproduct');
	        Route::post('/updategalleryimages', 'ProductController@updategalleryimages');


	        Route::get('/addattributes', function () {
	            return view('vendor.files.products.addattributes');
	        });
	    });





	    //Order

	    Route::prefix('/orders')->group(function () {


	    	Route::get('/all', 'VendorController@allorders');
	    	Route::get('/orderdetail/{id}', 'VendorController@orderdetail');
	    	Route::get('/downloadinvoice/{id}', 'VendorController@downloadinvoice');
	    	Route::get('/changeorderstatus/{id}/{status}', 'VendorController@changeorderstatus');
	    	Route::get('/ordersearch', 'VendorController@ordersearch');

	    	
	
	    });
    
	    
	    Route::get('/get/Chat/users','ChatController@index');
	    Route::get('/get/ChatByUser/{id}','ChatController@getChatByUserId');
	    Route::get('/get/messageread/{id}','ChatController@messageread');
	    Route::post('/save/Chat','ChatController@saveMessage');
		Route::get('/get/getChatUserById/{id}','ChatController@getChatUserById');



	    Route::get('/chat/all', function () {
			  if(!empty($_GET['id'])){
				  Chat::where('sendBy',$_GET['id'])->update(['read'=>1]);
			  }
	        return view('vendor.files.chat.index');
	    });
	    Route::get('/reviews/all','VendorController@reviewsall');
	    Route::get('/viewreview/{id}','VendorController@viewreview');
	    Route::prefix('/settings')->group(function () {
	        Route::post('/add', 'StoreSettingController@store');
	        Route::get('/store-settings', 'StoreSettingController@index');
	        Route::post('/updatestoresocialmedia', 'StoreSettingController@updatestoresocialmedia');
	        Route::post('/storebanners', 'StoreSettingController@storebanners');
	        
	    });
	    Route::get('/settings/profile-settings', function () {
	        return view('vendor.files.settings.profile-settigns');
	    });


	    Route::prefix('/tickets')->group(function () {


	    	Route::get('/all', 'VendorController@alltickets');
	    	Route::post('/submitticket', 'VendorController@submitticket');
	    	Route::get('/view/{id}', 'VendorController@viewticket');
	    	Route::post('/submitticketreply', 'VendorController@submitticketreply');

	    	
	
	    });



});



?>