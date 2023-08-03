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
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\ChatController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MyshopController;
use App\Models\Chat;


// Admin


Route::get('/paypalpayement/{id}', [PayPalController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('/paypal', [PayPalController::class, 'getPaymentStatus'])->name('status');


Route::middleware("auth")->group(function () {
    Route::get('plans', [PlanController::class, 'index']);
    Route::get('conferm', [PlanController::class, 'conferm']);
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
Route::get('/page/{id}', [SiteController::class, 'page']);
Route::get('/contact-us', [SiteController::class, 'contactus']);
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialiteController::class, 'facebookSignin']);


// Customer Auth
Route::get('/login', [AuthUserController::class, 'signin'])->name('login');
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
    Route::get('/frequency/{id}/{url}', [UserController::class, 'freequencydetail']);

});



Route::get('/get/messageread/{id}',[ChatController::class, 'messageread']);
Route::get('/get/getChatUserById/{id}',[ChatController::class, 'getChatUserById']);


// Admin Post Routes
Route::POST('/createuserrole', [AdminController::class, 'createuserrole']);
Route::POST('/updateuserrole', [AdminController::class, 'updateuserrole']);
Route::POST('/createadminuser', [AdminController::class, 'createadminuser']);
Route::POST('/updateadminuser', [AdminController::class, 'updateadminuser']);
Route::POST('/createdynamicpage', [AdminController::class, 'createdynamicpage']);
Route::POST('/updatepage', [AdminController::class, 'updatepage']);
Route::POST('/addnewbanner', [AdminController::class, 'addnewbanner']);
Route::POST('/updatebanner', [AdminController::class, 'updatebanner']);
Route::POST('/createcategory', [CategoryController::class, 'createcategory']);
Route::POST('/updatecategory', [CategoryController::class, 'updatecategory']);
Route::POST('/createsubcategory', [SubCategoryController::class, 'createsubcategory']);
Route::POST('/updatesubcategory', [SubCategoryController::class, 'updatesubcategory']);
Route::POST('/createthirdlevelcategory', [ThirdlevelCategory::class, 'createcategory']);
Route::POST('/updatethirdlevel', [ThirdlevelCategory::class, 'updatethirdlevel']);
Route::POST('/addnewdealbanner', [AdminController::class, 'addnewdealbanner']);
Route::POST('/updatedealbanner', [AdminController::class, 'updatedealbanner']);






// Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/chat/all', function () {
          if(!empty($_GET['id'])){
              Chat::where('sendBy',$_GET['id'])->update(['read'=>1]);
          }
        return view('admin.chat.index');
    });
    Route::get('/reviews/all', function () {
        return view('admin.files.reviews.all');
    });
    Route::get('blog-categories', [AdminController::class, 'blogcategories']);
    Route::get('blog-categories/{id}', [AdminController::class, 'blogcategoriesbystatus']);
    Route::get('/deleteblogcategory/{id}', [AdminController::class, 'deleteblogcategory']);
    Route::get('/deleteblogcategorypermanently/{id}', [AdminController::class, 'deleteblogcategorypermanently']);
    
    Route::POST('/socialmedia', [AdminController::class, 'socialmedia']);
    Route::get('/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');
    Route::get('/notifications', [AdminController::class, 'notifications']);
    Route::get('/statuschange/{id}', [AdminController::class, 'statuschange']);
    Route::get('/login', [SiteController::class, 'adminlogin'])->name('admin.login');
    Route::POST('logout', [AuthController::class, 'logout'])->name('logout');
    Route::POST('adminlogin', [AuthController::class, 'login'])->name('adminlogin');
    Route::get('/forgotpassword', [SiteController::class, 'adminforgotpassword']);

    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::POST('updateuserprofile', [DashboardController::class, 'updateuserprofile']);
    Route::POST('updateusersecurity', [DashboardController::class, 'updateusersecurity']);
    Route::get('/shownotification', [AdminController::class, 'shownotification']);
    Route::get('/getadminnotification', [AdminController::class, 'getadminnotification']);
    Route::get('/newsletter', [AdminController::class, 'newsletter']);
    Route::get('new-users', [AdminController::class, 'newusers']);
    Route::POST('menuestore', [AdminController::class, 'menuestore'])->name('menus.store');
    Route::get('users', [AdminController::class, 'users']);
    Route::POST('updatemenu', [AdminController::class, 'updatemenu']);
    Route::get('contact/allcontactmessages', [AdminController::class, 'allcontactmessages']);
    Route::get('contact/view/{id}', [AdminController::class, 'contactview']);
    Route::get('contact/delete/{id}', [AdminController::class, 'deletecontactus']);

    Route::group(['prefix' => 'countries'], function () { 
        Route::get('/', [AdminController::class, 'allcountries']);
        Route::get('edit/{id}', [AdminController::class, 'editcountries']);
        Route::get('delete/{id}', [AdminController::class, 'deletecountries']);
        Route::POST('create', [AdminController::class, 'createcountry']);
        Route::POST('updatecountry', [AdminController::class, 'updatecountry']);
    });

    Route::group(['prefix' => 'freequency'], function () { 
        Route::get('/add', [AdminController::class, 'addfreequency']);
        Route::get('/all', [AdminController::class, 'allfreequencies']);
        Route::get('edit/{id}', [AdminController::class, 'editfreequency']);
        Route::get('delete/{id}', [AdminController::class, 'deletefreequency']);
        Route::POST('createfreequency', [AdminController::class, 'createfreequency']);
        Route::POST('updatefreequency', [AdminController::class, 'updatefreequency']);
    });

    
    Route::group(['prefix' => 'requests'], function () { 
        Route::get('/declinerequests', [AdminController::class, 'declinerequests']);

        
    });

    


    Route::group(['prefix' => 'quizes'], function () { 
        Route::get('/', [AdminController::class, 'allquizes']);
        Route::get('edit/{id}', [AdminController::class, 'editcountries']);
        Route::POST('create', [AdminController::class, 'createquiz']);
        Route::POST('update', [AdminController::class, 'updatecountry']);
        Route::get('checkorderofquiz/{id}', [AdminController::class, 'checkorderofquiz']);
        Route::get('deletequesquestion/{id}', [AdminController::class, 'deletequesquestion']);
        
    });



    Route::group(['prefix' => 'earnings'], function () { 
        Route::get('/', [AdminController::class, 'totalearning']);
        Route::get('view/{id}', [AdminController::class, 'viewearning']);
        Route::POST('refund', [AdminController::class, 'refund']);
        
    });
     Route::group(['prefix' => 'tickets'], function () {
        Route::get('/alltickets', [AdminController::class, 'alltickets']);
        Route::get('/allusertickets', [AdminController::class, 'allusertickets']);
        Route::get('/view/{id}', [AdminController::class, 'viewticket']);
        Route::POST('/submitticketreply', [AdminController::class, 'submitticketreply']);
        Route::POST('/changeticktstatus', [AdminController::class, 'changeticktstatus']);    
    });
    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/userplans', [AdminController::class, 'userplans']);
        Route::POST('/createplan', [AdminController::class, 'createplan']);
        Route::get('/editplan/{id}', [AdminController::class, 'editplan']);
        Route::POST('/updateplan', [AdminController::class, 'updateplan']);
        Route::get('/planstatus/{id}/{idtwo}', [AdminController::class, 'planstatus']);
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/newvendorsreuqests', [AdminController::class, 'newvendorsreuqests']);
        Route::get('/viewuserrequest/{id}', [AdminController::class, 'viewvendorrequest']);
        Route::get('/deleterequest/{id}', [AdminController::class, 'deleterequest']);
        Route::get('/delete/{id}/{password}', [AdminController::class, 'deleteuser']);
        Route::POST('/approverequest', [AdminController::class, 'approverequest']);
        Route::POST('/rejectrequest', [AdminController::class, 'rejectrequest']);
        Route::get('/approvedvendors', [AdminController::class, 'approvedvendors']);
        Route::get('/searchapprovevendor', [AdminController::class, 'searchapprovevendor']);
        Route::get('/vendordetail/{id}', [AdminController::class, 'vendordetail']);
        Route::POST('/setcommission', [AdminController::class, 'setcommission']);
        Route::get('/allowwithoutreviewproduct/{id}/{status}', [AdminController::class, 'allowwithoutreviewproduct']);
        Route::get('/disabeldvendors', function () {
            return view('admin.vendor.disabeldvendors');
        });        
        Route::get('/userdetail/{id}', [AdminController::class, 'userdetail']);
        Route::POST('/vendorsettingsupdate', [AdminController::class, 'vendorsettingsupdate']);

        Route::POST('/updateprofilestatus', [AdminController::class, 'updateprofilestatus']);
        
        Route::get('/vendrosettings', [AdminController::class, 'vendrosettings']);
        Route::get('/add', function () {
            return view('admin.vendor.add');
        });
    });
    Route::group(['prefix' => 'staff'], function () { 
        Route::get('/changetopublishuser/{id}/{two}', [AdminController::class, 'changetopublishuser']);
        Route::get('/allstaff', [AdminController::class, 'allstaff']);
        Route::get('/permissions', [AdminController::class, 'permissions']);
    });
    Route::group(['namespace' => 'Admin','prefix' => 'settings'], function () { 
        Route::get('payementmethod', 'SettingsController@payementmethod');
        Route::get('signup', 'SettingsController@signup');
        Route::post('cretesignup', 'SettingsController@cretesignup');
        Route::get('appearance', 'SettingsController@appearance')->name('admin_settings_appearance');
        Route::post('appearance', 'SettingsController@appearance_update')->name('admin_settings_appearance_update');
        Route::post('admin_settings_seo', 'SettingsController@admin_settings_seo')->name('admin_settings_seo');
        Route::get('dealsbannersdelete/{id}', [AdminController::class, 'dealsbannersdelete']);
        Route::get('dealsbanners', [AdminController::class, 'dealsbanners']);
        Route::get('deletesignupfield/{id}', 'SettingsController@deletesignupfield');
        Route::get('updatesignupfield/{id}/{value}', 'SettingsController@updatesignupfield');
        Route::get('deletechildsignup/{id}', 'SettingsController@deletechildsignup');
        Route::get('editsignupfield/{id}', 'SettingsController@editsignupfield');
        Route::post('updatelogos', 'SettingsController@updatelogos');
        Route::post('addnewchildfields', 'SettingsController@addnewchildfields');
        Route::post('updatesignup', 'SettingsController@updatesignup');
    });
    Route::group(['prefix' => 'pages'], function () { 
        Route::get('addnewpage', [AdminController::class, 'addpage']);
        Route::get('allpages', [AdminController::class, 'allpages']);
        Route::get('all-pages/{id}', [AdminController::class, 'allpageswithid']);
        Route::get('edit/{id}', [AdminController::class, 'editpage']);
        Route::get('deletepage/{id}', [AdminController::class, 'deletepage']);
        Route::get('allpages/{id}', [AdminController::class, 'allpageswithid']);
    });
    Route::group(['prefix' => 'mobileapp'], function () { 
        Route::get('banners', [AdminController::class, 'banners']);
        Route::get('deletebanner/{id}', [AdminController::class, 'deletebanner']);
        Route::get('promobanners', [AdminController::class, 'promobanners']);
        Route::get('edit/{id}', [AdminController::class, 'editpage']);
        Route::get('admin/deletepage/{id}', [AdminController::class, 'deletepage']);
    });
    Route::POST('/vendorsettingsupdate', [AdminController::class, 'vendorsettingsupdate']);
});
Route::get('/admin/add-blog', [AdminController::class, 'addblog']);
Route::POST('/createblog', [AdminController::class, 'createblog']);
Route::get('admin/blogs', [AdminController::class, 'blogs']);
Route::get('admin/blogs/{id}', [AdminController::class, 'blogswithid']);
Route::get('admin/blogslist', [AdminController::class, 'getblogslist'])->name('blogs.list');
Route::get('changetopublishblog/{one}/{two}', [AdminController::class, 'changetopublishblog']);
Route::get('deleteblog/{one}', [AdminController::class, 'deleteblog']);
Route::get('deleteblogtrash/{one}', [AdminController::class, 'deleteblogtrash']);
Route::get('/admin/edit/blog/{one}', [AdminController::class, 'editblog']);
Route::POST('/updateblog', [AdminController::class, 'updateblog']);
Route::POST('/updateblogimage', [AdminController::class, 'updateblogimage']);
Route::get('/admin/blog/addnewcategory', [AdminController::class, 'addnewcategory']);
Route::POST('/createblogcategory', [AdminController::class, 'createblogcategory']);
Route::get('/admin/blogcategory/edit/{id}', [AdminController::class, 'editblogcategory']);
Route::get('/admin/blogcategory/restore/{id}', [AdminController::class, 'restoreblogcategory']);
Route::POST('/updateblogcategory', [AdminController::class, 'updateblogcategory']);
Route::get('/admin/blogs-coments', [AdminController::class, 'blogcoments']);
Route::get('admin/deleteblogcoment/{id}', [AdminController::class, 'deleteblogcoment']);
Route::get('/admin/editblogcoment/{id}', [AdminController::class, 'editblogcoment']);
Route::POST('/updateblogcoment', [AdminController::class, 'updateblogcoment']);
Route::get('admin/deleteblogcomentreply/{id}', [AdminController::class, 'deleteblogcomentreply']);
