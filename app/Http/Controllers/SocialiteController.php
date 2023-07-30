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
     public function generate_username($string_name, $rand_no = 200){
            $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
            $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part
            $part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):""; //cut first name to 8 letters
            $part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):""; //cut second name to 5 letters
            $part3 = ($rand_no)?rand(0, $rand_no):"";
            $username = $part1. str_shuffle($part2). $part3; //str_shuffle to randomly shuffle all characters 
            return $username;
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->route('userprofile');
            }else{
                $user = new User;
                $user->first_name = $user->name;
                $user->email = $user->email;
                $user->user_type ='customer';
                $user->active = 1;
                $user->is_admin =0;
                $user->save();
                $finduser = User::where('email', $user->email)->first();
                Auth::login($finduser);
                return redirect()->route('userprofile');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
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
