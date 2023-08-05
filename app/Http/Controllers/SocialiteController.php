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
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
                Auth::login($finduser);
                if(Auth::user()->active == 0)
                {

                    Auth::logout();
                    return redirect()->route('user.signin')->with(array('activeerror'=>'Your Account is Deactive. For Activation pease Contact US'));
                }
                Cmf::online();
                return redirect()->route('userprofile');
            }else{
                $value = $user->name;
                $first_name =  strtok($value, " "); // Test
                $strArray = explode(' ',$value);
                $tes =  explode(' ',$value,2);
                $newUser = User::create([
                    'first_name' => $first_name,
                    'last_name' => $tes[1],
                    'username' => $this->generate_username($first_name.' '.$tes[1]),
                    'email' => $user->email,
                    'profileimage_social' => $user->avatar,
                    'google_id'=> $user->id,
                    'user_type'=> 'customer',
                    'active'=> '1',
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);
                Cmf::online();
                return redirect()->route('userprofile');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
