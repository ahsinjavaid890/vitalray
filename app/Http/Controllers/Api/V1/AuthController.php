<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\Http\Controllers\Controller;
use App\Models\allbanners;
use Illuminate\Http\Request;
use DB; 
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\userfields;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Helpers;
use App\Helpers\Cmf;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Socialite;
use Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {      
            $token = Auth::user()->createToken('name');
            return response()->json(['token' => $token,'status' => true,'UserData'=>auth()->user()], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'status' => false, 'message' => trans('Credentials are Wrong')]);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }
    public function signupfield()
    {
        $signupfields = DB::table('signupfields')->where('published_status', 'published')->orderBy('id', 'DESC')->get();
        return response(['success' => true, 'data' => $signupfields]);
    }
    public function signupfieldschilds(Request $request)
    {
        $signupfieldschilds = DB::table('signupfieldschilds')->where('signup_parent',$request->signup_parent)->orderBy('id', 'DESC')->get();
        return response(['success' => true, 'data' => $signupfieldschilds]);
    }
    public function ChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'bail|required|min:6',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|min:6',
        ]);
        $data = $request->all();
        $id = auth()->user();

        if(Hash::check($data['old_password'], $id->password) == true)
        {
            if($data['password'] == $data['password_confirmation'])
            {
                $id->password = Hash::make($data['password']);
                $id->save();
                return response(['success' => true , 'data' => 'Password Update Successfully...!!']);
            }
            else
            {
                return response(['success' => false , 'data' => 'password and confirm password does not match']);
            }
        }
        else
        {
            return response(['success' => false , 'data' => 'Old password does not match.']);
        }
    }
}
