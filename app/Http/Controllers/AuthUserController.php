<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userfields;
use Illuminate\Support\Str;
use App\Helpers\Cmf;
use DB; 
use Carbon\Carbon; 
use Mail; 
use App\Models\subscribedplans;
use App\Models\payments;
use URL;
use Stripe;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // Customer Auth
    public function signin()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('auth.signin');
        }
    }
    public function signup()
    {
        // Session::forget('user_id_temp');
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('auth.signup');
        }
    }

    public function showForgetPasswordForm()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('auth.forgot-password');
        }
    }

    public function verified($token)
    {
        $token = DB::table('password_resets')->where('token' , $token)->where('verify' , 1)->get();
        if($token->count() > 0)
        {
            $arrayName = array('email_verify' => 1);
            DB::table('users')->where('email' , $token->first()->email)->update($arrayName);
            return redirect()->route('user.signin')->with('success', 'Your Email has been Verified!');
        }else{
            return redirect()->route('email.verify')->with('warning', 'Your Verification Tokem is Expired Please Genrate New One');
        }   
    }

    public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
          $token = Str::random(64);
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
          ]);
          Mail::send('frontend.email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
          $email = $request->email;
          return back()->with('message', 'We Will Send a Password Reset Link on your Email.');
      }


    public function resendemail($id)
    {
        $token = Str::random(64);
        DB::table('password_resets')->insert([
          'email' => $id, 
          'token' => $token, 
          'created_at' => Carbon::now()
        ]);
        Mail::send('frontend.email.forgetPassword', ['token' => $token], function($message) use($id){
            $message->to($id);
            $message->subject('Reset Password');
        });
        return back()->with('message', $id);
    }


    public function showResetPasswordForm($token) { 
        $token = DB::table('password_resets')->where('token' , $token)->get();
        if($token->count() > 0)
         {
            return view('auth.showpasswordlink', ['token' => $token->first()->token , 'email'=>$token->first()->email]);
        }else{
            return redirect()->route('forget.password.get')->with('warning', 'Your Token is Expired Please Genrate New One');
        }     
    }

    public function verifyemail()
    {
        return view('frontend.auth.verifyemail');
    }
    public function submiverifyemail(Request $request)
    {
        $request->validate([
          'email' => 'required|email|exists:users'
      ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
          'email' => $request->email, 
          'token' => $token,
          'verify' => 1, 
          'created_at' => Carbon::now()
        ]);
        Mail::send('frontend.email.verifyemail', ['token' => $token], function($message) use($request){
          $message->to($request->email);
          $message->subject('Verify Your Email');
      });

     return back()->with('message', 'We have e-mailed your Verified link!');
    }


    public function emailverify($id)
    {
        $token = Str::random(64);
        DB::table('password_resets')->insert([
          'email' => $id, 
          'token' => $token,
          'verify' => 1, 
          'created_at' => Carbon::now()
        ]);
        Mail::send('frontend.email.verifyemail', ['token' => $token], function($message) use($id){
          $message->to($id);
          $message->subject('Verify Your Email');
      });

     return back()->with('message', 'We have e-mailed your Verified link!');
    }



    public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
          if(!$updatePassword){
              return back()->withInput()->with('warning', 'Invalid token!');
          }
          $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return redirect()->route('user.signin')->with('success', 'Your password has been changed!');
      }

    public function logout(Request $request) {
      Auth::logout();
      return redirect()->route('home');
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


    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type ='customer';
        $user->active =1;
        $user->is_admin =0;
        $user->save();
        auth()->attempt(array('email' => $request->email, 'password' => $request->password));
        return redirect()->route('userprofile');
    }

    public function login(Request $request)
    {   
     
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {   

            if(Auth::user()->user_type == 'customer')
            {
                if (Auth::user()->active == 1) {
                    return 2;
                }else{
                    Auth::logout();
                    return 1;
                }
            }
            else
            {
                Auth::logout();
                return 4;
            }
        }
        else
        {
            return 3;
        }
          
    }
}
