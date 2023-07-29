<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Api\V1\AuthController;

Route::group(['namespace' => 'api\v1'], function () {

    // *************************************
    //           Authentication Apis
    // *************************************

    Route::post('login', [AuthController::class, 'login']);
    Route::get('signupfield', [AuthController::class, 'signupfield']);
    Route::post('signupfieldschild', [AuthController::class, 'signupfieldschilds']);
    Route::post('changepassword', [AuthController::class, 'signupfieldschilds']);


    // *************************************
    //           Site Settings
    // *************************************

    Route::get('sitesettings', 'ConfigController@configuration');

    // *************************************
    //           My Profile
    // *************************************

    Route::post('timeline', [ApiController::class,'timeline']);
    Route::post('about', [ApiController::class,'about']);
    Route::post('changepassword', [ApiController::class,'changepassword']);
    Route::post('profile_update',[ApiController::class,'ProfileUpdate']);
    Route::post('profileimageupdate',[ApiController::class,'profileimageupdate']);
    Route::post('profilecoverimageupdate',[ApiController::class,'profilecoverimageupdate']);
    Route::post('photos',[ApiController::class,'photos']);
    Route::post('getsaveplaces', [ApiController::class,'getsaveplaces']);
    Route::post('addnewplace', [ApiController::class,'addnewplace']);
    Route::post('removeplace', [ApiController::class,'removeplace']);


    // *************************************
    //           Find People
    // *************************************

    Route::post('getallmembers', [ApiController::class,'getallmembers']);
    Route::post('searchmemberwithname', [ApiController::class,'searchmemberwithname']);
    Route::post('peopleprofile', [ApiController::class,'peopleprofile']);

    Route::post('ceckifuserisalreadyfriend', [ApiController::class,'ceckifuserisalreadyfriend']);
    

    Route::get('apigoondate', [ApiController::class,'apigoondate'])->middleware('auth:api');
    Route::get('apisearchcountry/{id}', [ApiController::class,'apisearchcountry'])->middleware('auth:api');
    Route::get('apiplacedetails/{id}', [ApiController::class,'apiplacedetails'])->middleware('auth:api');
    Route::get('apiinvitations', [ApiController::class,'apiinvitations'])->middleware('auth:api');
    Route::get('apisendinvitations', [ApiController::class,'apisendinvitations'])->middleware('auth:api');
    Route::get('apiacceptplaceinvitation/{id}', [ApiController::class,'apiacceptplaceinvitation'])->middleware('auth:api');
    Route::get('apirejectplaceinvitation/{id}', [ApiController::class,'apirejectplaceinvitation'])->middleware('auth:api');
    Route::get('apiuserdates', [ApiController::class,'apiuserdates'])->middleware('auth:api');
    Route::get('apichatroom', [ApiController::class,'apichatroom'])->middleware('auth:api');

    Route::post('apisentplaceinvite', [ApiController::class,'apisentplaceinvite'])->middleware('auth:api');
    
    Route::get('apinotifications', [ApiController::class,'apinotifications'])->middleware('auth:api');
    Route::get('apigetcompletenotifications', [ApiController::class,'apigetcompletenotifications'])->middleware('auth:api');

    Route::post('forgotpassword', [ApiController::class,'apiForgotPassword']);





    Route::post('register', [ApiController::class,'register']);
    Route::get('allcountries', [ApiController::class, 'getcountries']);
    Route::post('allplaces', [ApiController::class, 'getplaces']);
    Route::post('placedetails', [ApiController::class, 'placedetails']);






    Route::post('sendfriendrequest', [ApiController::class,'apisendlove'])->middleware('auth:api');
    Route::get('cancelrequest/{id}', [ApiController::class,'apicancellove'])->middleware('auth:api');
    Route::get('friendrequests', [ApiController::class,'apifriendrequests'])->middleware('auth:api');
    Route::get('acceptreuqqest/{id}', [ApiController::class,'apiacceptreuqqest'])->middleware('auth:api');
    Route::get('unfriend/{id}', [ApiController::class,'apiunfriend'])->middleware('auth:api');

});