<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ecommerce\CategoryController;
use App\Http\Controllers\Admin\Ecommerce\SubCategoryController;
use App\Http\Controllers\Admin\Ecommerce\ThirdlevelCategory;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Vendor\StoreSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\ChatController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MyshopController;
use App\Models\Chat;


// Admin


Route::POST('/paypal', [AuthUserController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('/paypal', [AuthUserController::class, 'getPaymentStatus'])->name('status');
// WEbsite Routes



Route::middleware("auth")->group(function () {
    Route::get('plans', [PlanController::class, 'index']);
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");
});



Route::get('/quiz', [QuizController::class, 'index']);




Route::get('/', [SiteController::class, 'indexview'])->name('home');
Route::get('/about-us', [SiteController::class, 'aboutus']);
Route::get('/privacy-policy', [SiteController::class, 'privacypolicy']);
Route::get('/terms-and-conditions', [SiteController::class, 'termsandconditions']);
Route::get('/cookies-policy', [SiteController::class, 'cookiespolicy']);
Route::post('stripe', [AuthUserController::class, 'stripePost'])->name('stripe.post');
Route::get('/search', [SiteController::class, 'mainsearch']);
Route::get('/contact-us', [SiteController::class, 'contactus']);
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialiteController::class, 'facebookSignin']);


// Customer Auth
Route::get('/signin', [AuthUserController::class, 'signin'])->name('user.signin');
Route::get('/signup', [AuthUserController::class, 'signup'])->name('user.signup');
Route::get('/steptwo', [AuthUserController::class, 'steptwo'])->name('user.steptwo');
Route::get('/stepthree', [AuthUserController::class, 'stepthree'])->name('user.stepthree');
Route::get('/stepfour', [AuthUserController::class, 'stepfour'])->name('user.stepfour');
Route::get('/stepfive', [AuthUserController::class, 'stepfive'])->name('user.stepfive');
Route::get('/stepsix', [AuthUserController::class, 'stepsix'])->name('user.stepsix');


Route::POST('/register', [AuthUserController::class, 'register'])->name('user.register');

Route::POST('/userlogin', [AuthUserController::class, 'login'])->name('user.login');

Route::POST('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
Route::get('/verifyemail', [AuthUserController::class, 'verifyemail'])->name('email.verify');
Route::POST('/verifyemail', [AuthUserController::class, 'submiverifyemail'])->name('email.verify.post');
Route::get('/verified/{token}', [AuthUserController::class, 'verified'])->name('email.verified');
Route::get('forgot-password', [AuthUserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [AuthUserController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [AuthUserController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthUserController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/verify/{id}', [AuthUserController::class, 'emailverify']);
Route::get('/resendemail/{id}', [AuthUserController::class, 'resendemail']);



// Nesfeed

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('userprofile');
    Route::get('/cancelsubscription', [UserController::class, 'cancelsubscription']);
    Route::get('/settings', [UserController::class, 'generalsettings']);
    Route::POST('/updategeneraldetails', [UserController::class, 'updategeneraldetails']);
    Route::get('/changepassword', [UserController::class, 'securitysettings']);
    Route::POST('/securetycredentials', [UserController::class, 'securetycredentials']);
    Route::get('/plans', [UserController::class, 'plans']);
    Route::get('/frequencies', [UserController::class, 'frequencies']);
    
});



Route::get('/get/messageread/{id}',[ChatController::class, 'messageread']);
Route::get('/get/getChatUserById/{id}',[ChatController::class, 'getChatUserById']);