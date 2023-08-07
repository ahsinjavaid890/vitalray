<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use DB;
use Redirect;
class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $googleuser = Socialite::driver('google')->user();
        $finduser = User::where('email', $googleuser->email)->first();
        if($finduser){
            Auth::login($finduser);
            return redirect()->route('userprofile');
        }else{
            $add = new User;
            $add->first_name = $googleuser->name;
            $add->email = $googleuser->email;
            $add->user_type ='customer';
            $add->active = 1;
            $add->is_admin =0;
            $add->email_verify =1;
            $add->save();
            $finduser = User::where('email', $googleuser->email)->first();
            Auth::login($finduser);
            return redirect()->route('userprofile');
        }
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookSignin()
    {
        $googleuser = Socialite::driver('facebook')->user();
        $finduser = User::where('email', $googleuser->email)->first();
        if($finduser){
            Auth::login($finduser);
            return redirect()->route('userprofile');
        }else{
            $add = new User;
            $add->first_name = $googleuser->name;
            $add->email = $googleuser->email;
            $add->user_type ='customer';
            $add->active = 1;
            $add->is_admin =0;
            $add->email_verify =1;
            $add->save();
            $finduser = User::where('email', $googleuser->email)->first();
            Auth::login($finduser);
            return redirect()->route('userprofile');
        }
    }
}
