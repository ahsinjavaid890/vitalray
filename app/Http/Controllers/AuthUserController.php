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
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
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


    public function steptwo()
    {
        return view('auth.steptwo');
    }

    public function stepthree()
    {
        return view('auth.stepthree');
    }
    
    public function stepfour()
    {
        Session::forget('message');
        return view('auth.stepfour');
    }
    

    public function stepfive()
    {
        return view('auth.stepfive');
    }

    public function stepsix()
    {
        return view('auth.stepsix');
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



    public function senduserrequrst(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required', 
        ]);
        $input = $request->all();
        $user = new user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type ='customer';
        $user->active =0; // 0 = Pending 1 = Active 2 = Rejected
        $user->is_admin =0;
        $user->save();
        foreach($input as $key => $value)
        {
            if($key != 'name')
            {
                if($key != 'email')
                {
                    if($key != 'password')
                    {
                        if($key != '_token')
                        {
                            $userfield = new userfields;
                            $userfield->user_id = $user->id;
                            $userfield->signup_parent = $key;
                            $userfield->value = $value;
                            $userfield->save();
                        }
                    }
                }
            }
        }

        $notification = $request->name.' Send New User Request';
        $url = url('admin/user/viewuserrequest/').'/'.$user->id;
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);
        return redirect()->route('user.signin')->with('success', 'You are Registerd Successfully');
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
        if(session()->get('user_id_temp'))
        {
            $this->validate($request, [
                'name' => 'required',
                'phonenumber' => 'required',
                'age' => 'required',
                'height' => 'required',
                'gender' => 'required',
            ]);
        }else{

             $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users',
                'phonenumber' => 'required|unique:users',
                'age' => 'required',
                'height' => 'required',
                'gender' => 'required',
            ]);
         }
        if(session()->get('user_id_temp'))
        {
            $user = User::find(session()->get('user_id_temp'));
        }else{
            $user = new User;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $this->generate_username($request->name);
        $user->phonenumber = $request->phonenumber;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->height = $request->height;
        $user->user_type ='customer';
        if(Cmf::get_store_value('vendor_pending_to_approve') == 'on')
        {
            $user->approve_status = 'approved';
        }else{
            $user->approve_status = 'notapproved';
            $user->new = 1;
        }
        $user->active = 1;
        $user->is_admin =0;
        $user->steps =1;
        $user->save();
        $token = Str::random(64);
        session()->put('user_id_temp', $user->id);
        return redirect()->route('user.steptwo');
    }
    public function registertwo(Request $request)
    {

        if(session()->get('user_id_temp'))
        {
            userfields::where('user_id' , session()->get('user_id_temp'))->delete();
        }


        $input = $request->all();
        foreach($input as $key => $value)
        {
            if($key != 'country')
            {
                if($key != 'about')
                {

                    if($key != '_token')
                    {
                        $userfield = new userfields;
                        $userfield->user_id = session()->get('user_id_temp');
                        $userfield->signup_parent = $key;
                        $userfield->value = $value;
                        $userfield->save();
                    }
                    
                }
            }
        }

        $user = user::find(session()->get('user_id_temp'));
        $user->about = $request->about;
        $user->country =$request->country;
        $user->steps =2;
        $user->save();
        session()->put('seconddone', 1);
        return redirect()->route('user.stepthree');
    }

    public function registerthree(Request $request)
    {
        $data = DB::table('subscriptionplans')->where('id' , $request->selectedplan)->get()->first();
        if($data->price == 0)
        {
            $user = user::find(session()->get('user_id_temp'));
            $user->selectplan = $request->selectedplan;
            $user->steps = 3;
            $user->save();
            return redirect()->route('user.stepfour');
        }
        else
        {

            if(subscribedplans::where('user_id' , session()->get('user_id_temp'))->where('plan_id' , $request->selectedplan)->count() > 0)
            {
                return redirect()->route('user.stepfour');
            }
            else
            {
                return view('auth.payement')->with(array('selectedplan'=>$request->selectedplan));
            }
            

        }
        
    }

    public function stripePost(Request $request)
    {
        $plan = DB::table('subscriptionplans')->where('id' , $request->planid)->get()->first();
        $totalprice = round($plan->price);
        $totalprice = $totalprice+100;
        Stripe\Stripe::setApiKey(Cmf::get_site_settings_by_colum_name('secret_stripe'));
        $payement = Stripe\Charge::create ([
                "amount" => $totalprice,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => $plan->name
        ]);
        if(!empty($payement->id))
        {
            if(Auth::check())
            {
                $user = user::find(Auth::user()->id);
                $user->selectplan = $request->planid;
                $user->save();
            }else{
                $user = user::find(session()->get('user_id_temp'));
                $user->selectplan = $request->planid;
                $user->zipcode = $request->zipcode;
                $user->address = $request->address;
                $user->steps = 3;
                $user->save();
            }
            $payments = new payments();
            $payments->currency = 'usd';
            $payments->charge_id = $payement->id;
            $payments->payment_channel = 'stripe';
            $payments->description = $payement->description;
            $payments->amount = $payement->amount;
            $payments->order_id = $plan->id;
            $payments->status = $payement->status;
            if(Auth::check())
            {
                $payments->customer_id = Auth::user()->id;
            }else{
                $payments->customer_id = session()->get('user_id_temp');
            }
            $payments->save();
            $plandata = DB::table('subscriptionplans')->where('id' , $request->planid)->get()->first();
            $subject = 'Welcome To '.Cmf::get_store_value('site_name').'| Invoice for Purchasing Plan';
            // Mail::send('frontend.email.invoice', ['name' => $user->name,'planname' => $plandata->name,'price' => $plandata->price,'places_allowed' => $plandata->places_allowed], function($message) use($user , $subject){
            //       $message->to($user->email);
            //       $message->subject($subject);
            // });
            $plan = new subscribedplans();
            if(Auth::check())
            {
                $plan->user_id = Auth::user()->id;
            }else{
                $plan->user_id = session()->get('user_id_temp'); 
            }
            $plan->plan_id = $request->planid;
            $plan->save();

            if(Auth::check())
            {
                return redirect()->back()->with('message', 'Payemnt Successfully Processed');
            }else{
                return redirect()->route('user.stepfour');
            }
            
        }
        else
        {
            return redirect()->route('user.stepthree');
        }   
    }



    public function postPaymentWithpaypal(Request $request)
    {
        $plan = DB::table('subscriptionplans')->where('id' , $request->planid)->get()->first();

        Session::put('plainid',$request->planid);

        $totalprice = round($plan->price);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($totalprice);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($totalprice);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)
        ->setDescription('Enter Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('warning','Connection timeout');
                return Redirect::route('paywithpaypal'); 

                $url = url('stepthree');
                return Redirect::to($url);

            } else {
                \Session::put('warning','Some error occur, sorry for inconvenient');
                $url = url('stepthree');
                return Redirect::to($url);             
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('warning','Unknown error occurred');
        $url = url('payement').'/'.$request->orderid;
        return Redirect::to($url);
    }


    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('warning','Payment failed due to panga');
            $url = url('stepthree');
            return Redirect::to($url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {         



            $plainid = Session::get('plainid');

            $plan = DB::table('subscriptionplans')->where('id' , $plainid)->get()->first();

            \Session::put('message',"Your Payment $".$plan->price." Successfully Processed");

            $user = user::find(session()->get('user_id_temp'));
            $user->selectplan = $plainid;
            $user->steps = 3;
            $user->save();

            $payments = new payments();
            $payments->currency = 'usd';
            $payments->charge_id = $payment_id;
            $payments->payment_channel = 'paypal';
            $payments->description = 'Paypal Ammount';
            $payments->amount = $plan->price;
            $payments->order_id = $plan->id;
            $payments->status = $result->getState();
            $payments->customer_id = session()->get('user_id_temp');
            $payments->save();

            $plandata = DB::table('subscriptionplans')->where('id' , $plainid)->get()->first();
            $subject = 'Welcome To '.Cmf::get_store_value('site_name').'| Invoice for Purchasing Plan';
            Mail::send('frontend.email.invoice', ['name' => $user->name,'planname' => $plandata->name,'price' => $plandata->price,'places_allowed' => $plandata->places_allowed], function($message) use($user , $subject){
                  $message->to($user->email);
                  $message->subject($subject);
            });

            $plan = new subscribedplans();
            $plan->user_id = session()->get('user_id_temp');
            $plan->plan_id = $plainid;
            $plan->save();
            return redirect()->route('user.stepfour');



        }else{
            \Session::put('warning','Payment failed due to very very panga !!');
            $orderid = Session::get('orderid');
            $url = url('stepthree');
            return Redirect::to($url);
        }

        
    }


    public function registerfour(Request $request)
    {

        if(session()->get('profileimage'))
        {
            if($request->profileimage)
            {
                $profile_image  = Cmf::sendimagetodirectory($request->profileimage);
                $user = user::find(session()->get('user_id_temp'));
                $user->profileimage = $profile_image;
                $user->steps = 4;
                $user->save();
                Cmf::save_media_image($profile_image , 'profileimage' , session()->get('user_id_temp'));
                return redirect()->route('user.stepfive');
            }else{
                return redirect()->route('user.stepfive');
            }
        }
        else
        {
            $this->validate($request, [
                'profileimage' => 'required',
            ]);

            $profile_image  = Cmf::sendimagetodirectory($request->profileimage);
            $user = user::find(session()->get('user_id_temp'));
            $user->profileimage = $profile_image;
            $user->steps = 4;
            $user->save();
            session()->put('profileimage', 1);
            Cmf::save_media_image($profile_image , 'profileimage' , session()->get('user_id_temp'));
            return redirect()->route('user.stepfive');
        }
        // Cmf::checkplanavailability();
    }
    
    public function registerfive(Request $request)
    {

        if(session()->get('document'))
        {
            if($request->front_side)
            {
                $front_side = Cmf::sendimagetodirectory($request->front_side);
                $user = user::find(session()->get('user_id_temp'));
                $user->front_side = $front_side;
                $user->save();
            }

            if($request->back_side)
            {
                $back_side = Cmf::sendimagetodirectory($request->back_side);
                $user = user::find(session()->get('user_id_temp'));
                $user->back_side = $back_side;
                $user->save();
            }
            return redirect()->route('user.stepsix');
        }
        else
        {
            $this->validate($request, [
                'front_side' => 'required',
                'back_side' => 'required',
            ]);
            $front_side = Cmf::sendimagetodirectory($request->front_side);
            $back_side = Cmf::sendimagetodirectory($request->back_side);
            $user = user::find(session()->get('user_id_temp'));
            $user->front_side = $front_side;
            $user->back_side = $back_side;
            $user->steps = 5;
            $user->save();
            session()->put('document', 1);
            return redirect()->route('user.stepsix');
        }        
    }


    public function registersix(Request $request)
    {
        $user = user::find(session()->get('user_id_temp'));
        $user->password = Hash::make($request->password);
        $user->steps = 6;
        $user->delete_status = 'active';
        $user->save();
        session()->flush();
        Auth::login($user);
        $user = Auth::user();
        if(Cmf::get_store_value('vendor_pending_to_approve') == 'on')
        {
            $subject = 'Welcome To '.Cmf::get_store_value('site_name').'';
            Mail::send('frontend.email.welcome', ['name' => $user->name], function($message) use($user , $subject){
              $message->to($user->email);
              $message->subject($subject);
          });
        }else{
            $subject = 'Welcome To '.Cmf::get_store_value('site_name').' Your Request Submited Successfully';
            Mail::send('frontend.email.userrequest', ['name' => $user->name], function($message) use($user , $subject){
              $message->to($user->email);
              $message->subject($subject);
          });
        }
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
                    // $redirecturl =  session()->get('redirecturl');
                    // if(!empty($redirecturl))
                    // {
                    //     return Redirect::to($redirecturl);
                    // }
                    // else
                    // {
                        
                    // }
                    return 2;
                    // return redirect()->route('user.findpeople');
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
