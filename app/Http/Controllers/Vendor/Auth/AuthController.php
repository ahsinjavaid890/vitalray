<?php
  
namespace App\Http\Controllers\Vendor\Auth;
use RealRashid\SweetAlert\Facades\Alert;   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\sitesettings;   
use Validator;
use Session;
Use DB;
use Auth;
use App\Helpers;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  //protected $redirectTo = '/vandor/dashboard';



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {   
        if(Auth::check())
        {
            if(Auth::user()->user_type == 'vendor')
            {
                return redirect()->route('vendor.dashboard');
            }else
            {
                return redirect()->route('home');
            }
        }
        else
        {
             return view('auth.login');
        }
       
    }

    public function register()
    {
        return view('auth.register');
    }



    public function logout()
    {
       
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.auth.login');

    }
    

    public function login(Request $request)
    {   
     
        $input = $request->all();



        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);



        $check = DB::table('vendorrequests')->where('email' , $input['email'])->get()->first();


        if(!empty($check))
        {
            $status = $check->status;
            if($status == 0)
            {
                return redirect()->route('vendor.login')->with(array('error'=>'Your Account is Not Approved Yet Please Contact Us.' , 'email'=>$request->email));
            }
        }


        $remember = $request->has('remmber_me') ? true : false; 

        if(Auth::guard('vendor')->attempt(array('email' => $input['email'], 'password' => $input['password']),$remember))
        {   
            if(Auth::guard('vendor')->user()->user_type == 'vendor')
                return redirect()->route('vendor.dashboard');
            else
            {
                Auth::guard('vendor')->logout();
                return redirect()->route('vendor.login')->with(array('error'=>'You Are Not Authrized As Vendor.' , 'email'=>$request->email));
            }
            
        }
        else
        {
            return redirect()->route('vendor.login')->with(array('error'=>'Email-Address or Password Are Wrong.' , 'email'=>$request->email));
        }
          
    }
    

}