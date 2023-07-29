<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class PasswordResetController extends Controller
{
    public function reset_password_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        $email =  $request['email'];
        $customer = DB::table('users')->where('email' , $email)->get()->first();
        if (isset($customer)) {
            $token = rand(1000,9999);
            
            $data = array('auth_code'=>$token);

            DB::table('users')->where('email' , $email)->update($data);

            Mail::send('frontend.email.api_forgotemail', ['token' => $token], function($message) use($customer){
                  $message->to($customer->email);
                  $message->subject('Reset Password');
              });

            return response()->json(['message' => 'We send you a code to reset your password'], 200);
        }else{
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'status' => false, 'message' => 'We couldnt find your email in our record.']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
        
    }

    public function verify_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        $check = DB::table('users')->where('email' , $request->email)->where('auth_code' , $request->code)->count();
        if($check > 0)
        {
            return response()->json(['message'=>trans('custom.valid_token')], 200);
        }else{
            return response()->json(['errors' => [
            ['code' => 'invalid', 'message' => trans('custom.invalid_token')]
        ]], 400);
        }    
    }
    public function reset_password_submit(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        $password = Hash::make($request->password);
        $data = array('password'=>$password);
        DB::table('users')->where('email' , $request->email)->update($data);
        return response()->json(['message'=>trans('custom.password_changed')], 200);
    }




    public function passwordupdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        // if($request->newpassword == $request->password_confirmed){
        $hashedPassword = DB::table('users')->where('email' , $request->email)->get()->first()->password;
       if (\Hash::check($request->oldpassword , $hashedPassword )) {
         if (!\Hash::check($request->newpassword , $hashedPassword)) {
              $users =User::find(DB::table('users')->where('email' , $request->email)->get()->first()->id);
              $users->password = bcrypt($request->newpassword);
              User::where( 'email' , $request->email)->update( array( 'password' =>  $users->password));
              $data['status'] = true;
              $data['message'] = 'Password Change successfully';
              return response()->json($data, 200);
            }
            else{
                  return response()->json([
                        'errors' => ['code' => 'error', 'message' => trans('New password can not be the old password!')]
                    ], 404);
                }
           }
          else{
               return response()->json([
                    'errors' => ['code' => 'error', 'message' => trans('Old password Doesnt matched')]
                ], 404);
             }
        // }else{

        //     return response()->json([
        //         'errors' => ['code' => 'error', 'message' => trans('Repeat password doesnt match')]
        //     ], 404);
        // }
    }
}
