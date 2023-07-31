<?php

namespace App\Http\Controllers\Admin;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\user;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile()
    {
        return view('admin.profile.index');
    }

    public function updateuserprofile(Request $request)
    { 

        if($request->profileimage)
        {
            $profileimage = Cmf::sendimagetodirectory($request->profileimage);
            $data = array('first_name'=>$request->first_name,'last_name'=>$request->last_name,"email"=>$request->email,"profileimage"=>$profileimage);
        }else{
            $data = array('first_name'=>$request->first_name,'last_name'=>$request->last_name,"email"=>$request->email);
        }

        
        $id =  Auth::user()->id;
        user::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Your Profile Updated Successfully');
    }

    public function updateusersecurity(Request $request)
    {
        $this->validate($request, [
        'oldpassword' => 'required',
        'newpassword' => 'required',
        ]);
        if($request->newpassword == $request->password_confirmed){
        $hashedPassword = Auth::user()->password;
       if (\Hash::check($request->oldpassword , $hashedPassword )) {
         if (!\Hash::check($request->newpassword , $hashedPassword)) {
              $users =User::find(Auth::user()->id);
              $users->password = bcrypt($request->newpassword);
              User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
              session()->flash('message','password updated successfully');
              return redirect()->back();
            }
            else{
                  session()->flash('errorsecurity','New password can not be the old password!');
                  return redirect()->back();
                }
           }
          else{
               session()->flash('errorsecurity','Old password Doesnt matched ');
               return redirect()->back();
             }
        }else{
            session()->flash('errorsecurity','Repeat password Doesnt matched With New Password');
            return redirect()->back();
        }
    }
}
