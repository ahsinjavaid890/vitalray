<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\userplaces;
use App\Models\userfields;
use App\Models\mediaimages;
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
use App\Models\selectedplaces;
use App\Models\usernotifications;
use App\Models\Chat;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class ApiController extends Controller
{
    public function peopleprofile(Request $request)
    {
        $data = user::where('username' ,$request->username)->first();
        $fields = DB::table('signupfields')->where('published_status','published')->where('delete_Status','active')->orderby('order' , 'asc')->get();
        $temp = array();
        foreach($fields as $r)
        {
            $Userfields =  DB::Table('userfields')->where('signup_parent',$r->id)->where('user_id',$data->id)->get();
            foreach($Userfields as $f)
            {
               $temp['id'] = $data->id;
               $temp['name'] = $data->name;
               $temp['username'] = $data->username;
               $temp['Joined'] = Cmf::date_format($data->created_at);
               $temp['E-mail'] = $data->email;
               $temp['Phone'] = $data->phonenumber;
               $temp['Height'] = $data->height;
               $temp['Age'] = $data->age;
               $temp[$r->name] = $f->value;
            }
        }
        return response(['success' => true , 'data' => $temp]);
    }
    public function searchmemberwithname(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $data = user::where('user_type' , 'customer')->where('name','like', '%' .$request->search. '%' )->whereNotIn('id',[$user->id])->where('active' , 1)->where('is_admin' , 0)->get();
        return response(['success' => true, 'data' => $data]);
    }
    public function getallmembers(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $data = user::where('user_type' , 'customer')->whereNotIn('id',[$user->id])->where('active' , 1)->where('is_admin' , 0)->get();
        return response(['success' => true, 'data' => $data]);
    }
    public function removeplace(Request $request)
    {
        selectedplaces::where('id' , $request->id)->delete();
        return response()->json(['status' => true, 'data'=>'Place Deleted Successfully']);

    }
    public function addnewplace(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        if($request->selectedplaces)
        {
            foreach ($request->selectedplaces as $r) {
                $place = new selectedplaces();
                $place->user_id = $user->id;
                $place->places = $r;
                $place->save();
            }
        }
        return response()->json(['status' => true, 'data'=>'Place Added']);
    }
    public function getsaveplaces(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $placesselected = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "places.name",
            "places.image")
            ->leftJoin('places', 'selectedplaces.places', '=', 'places.id')
            ->where('selectedplaces.user_id' , $user->id)
            ->get();
        return response(['success' => true, 'data' => $placesselected]);
    }
    public function photos(Request $request)
    {
        $images = mediaimages::select("mediaimages.images")->where('user_id' , $request->user_id)->get();
        return response(['success' => true , 'data' => $images]);
    }
    public function profilecoverimageupdate(Request $request)
    {
        $vendor = User::where('id',$request->user_id)->first();
        if (isset($request['coverimage']))
        {
            $image['coverimage'] = Cmf::sendimagetodirectory($request->coverimage);
        }
        $vendor->update($image);
        return response(['success' => true , 'data' => 'Cover Image Updated successfully..']);
    }
    public function profileimageupdate(Request $request)
    {
        $vendor = User::where('id',$request->user_id)->first();
        if (isset($request['profileimage']))
        {
            $image['profileimage'] = Cmf::sendimagetodirectory($request->profileimage);
        }
        $vendor->update($image);
        return response(['success' => true , 'data' => 'Profile Image Updated successfully..']);
    }
    public function ProfileUpdate(Request $request)
    { 
        $vendor = User::where('id',$request->user_id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phonenumber' => 'required',
            'age' => 'required',
            'height' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => error_processor($validator)], 403);
        }
        $vendor['name'] = $request->name;
        $vendor['phonenumber'] = $request->phonenumber;
        $vendor['age'] = $request->age;
        $vendor['gender'] = $request->gender;
        $vendor['height'] = $request->height;
        $vendor['username'] = $this->generate_username($request->name);
        $vendor['about'] = $request->about;
        $vendor['address'] = $request->address;
        $vendor->save();
        // foreach($request->education as $key){
        //     $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$key)->first();
        //      DB::table('userfields')->where('user_id',auth()->user()->id)->update(['signup_parent' => $signupfieldschilds->signup_parent,'value' => $signupfieldschilds->name,]);
        // }
        return response()->json(['status' => true, 'data'=>'profile Updated']);
    }
    public function changepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'bail|required|min:6',
            'password' => 'bail|required|min:6',
            'password_confirmation' => 'bail|required|min:6',
        ]);
        $data = $request->all();
        $id = User::where('id',$request->user_id)->first();

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
    public function timeline(Request $request)
    {
        $vendor = User::where('id',$request->user_id)->first();
        $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status','active')->orderby('order' , 'asc')->get();
        $temp = array();
        foreach($fields as $r)
        {
            $Userfields =  DB::Table('userfields')->where('signup_parent',$r->id)->where('user_id',$request->user_id)->get();
            foreach($Userfields as $f)
            {
               $temp['name'] = $vendor->name;
               $temp['Joined'] = Cmf::date_format($vendor->created_at);
               $temp['E-mail'] = $vendor->email;
               $temp['Phone'] = $vendor->phonenumber;
               $temp['Height'] = $vendor->height;
               $temp['Age'] = $vendor->age;
               $temp[$r->name] = $f->value;

            }
        }
        return response(['success' => true , 'data' => $temp]);
    }
    public function about(Request $request)
    {
        $vendor = User::where('id',$request->user_id)->first();
        $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status','active')->orderby('order' , 'asc')->get();
        $temp = array();
        foreach($fields as $r)
        {
            $Userfields =  DB::Table('userfields')->where('signup_parent',$r->id)->where('user_id',$request->user_id)->get();
            foreach($Userfields as $f)
            {
               $temp['name'] = $vendor->name;
               $temp['Joined'] = Cmf::date_format($vendor->created_at);
               $temp['E-mail'] = $vendor->email;
               $temp['Phone'] = $vendor->phonenumber;
               $temp['Height'] = $vendor->height;
               $temp['Age'] = $vendor->age;
               $temp[$r->name] = $f->value;

            }
        }
        return response(['success' => true , 'data' => $temp]);
    }
    public function register(Request $request)
    { 



        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'phonenumber' => 'required|unique:users',
            'age' => 'required',
            'height' => 'required',
            'gender' => 'required',
            // 'profileimage'=> 'required',
            // 'front_side' => 'required',
            // 'back_side' => 'required',
            'Career' => 'required',
            'Smoking' => 'required',
            'Hobbies' => 'required',
            'Education' => 'required',


    ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => error_processor($validator)], 403);
        }

        $front_side = null;
        $back_side = null;
        $profileimage = null;

        if(isset($request->front_side))
        {
            $img = $request->front_side;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/') . $Iname . ".png";
            $success = file_put_contents($file, $data);
            $front_side = $Iname . ".png";

           
    

        }

        if(isset($request->back_side))
        {
            $img = $request->back_side;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/') . $Iname . ".png";
            $success = file_put_contents($file, $data1);
            $back_side = $Iname . ".png";

        }

        // if(!empty($request->profileimage))
        // {

        // $profileimage = Cmf::save_media_image($request->profileimage);
        // }

        if(isset($request->profileimage))
        {
            $img = $request->profileimage;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data2 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/') . $Iname . ".png";
            $success = file_put_contents($file, $data2);
            $profileimage = $Iname . ".png";

        }


        // dd($request->all());
        // die('here');
        $Vandor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'user_type' => 'customer',    
            'username' => $this->generate_username($request->name),
            'approve_status' => 'approved',
            'active' => 1,
            'back_side' => $back_side,
            'front_side' => $front_side,
            'profileimage' => $profileimage,
            'selectplan' => 5,
            'is_admin' => 0,
             'about' => $request->about,
            'password' => Hash::make($request->password),
                ]);

                      
                    if($request->Education)
                    {
                        
                    $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$request->Education)->orderBy('id', 'DESC')->first();
                    $userfield = new userfields;
                    $userfield->user_id = $Vandor->id;
                    $userfield->signup_parent = $signupfieldschilds->signup_parent;
                    $userfield->value = $signupfieldschilds->name;
                    $userfield->save();
                    }
                    
                      if($request->Career)
                    {
                        
                    $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$request->Career)->orderBy('id', 'DESC')->first();
                    $userfield = new userfields;
                    $userfield->user_id = $Vandor->id;
                    $userfield->signup_parent = $signupfieldschilds->signup_parent;
                    $userfield->value = $signupfieldschilds->name;
                    $userfield->save();
                    }
                      if($request->Smoking)
                    {
                        
                    $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$request->Smoking)->orderBy('id', 'DESC')->first();
                    $userfield = new userfields;
                    $userfield->user_id = $Vandor->id;
                    $userfield->signup_parent = $signupfieldschilds->signup_parent;
                    $userfield->value = $signupfieldschilds->name;
                    $userfield->save();
                    }
                      if($request->Hobbies)
                    {
                        
                    $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$request->Hobbies)->orderBy('id', 'DESC')->first();
                    $userfield = new userfields;
                    $userfield->user_id = $Vandor->id;
                    $userfield->signup_parent = $signupfieldschilds->signup_parent;
                    $userfield->value = $signupfieldschilds->name;
                    $userfield->save();
                    }

                // foreach($request->item as $key){

                //     $signupfieldschilds = DB::table('signupfieldschilds')->where('id',$key)->orderBy('id', 'DESC')->first();
                //     $userfield = new userfields;
                //     $userfield->user_id = $Vandor->id;
                //     $userfield->signup_parent = $signupfieldschilds->signup_parent;
                //     $userfield->value = $signupfieldschilds->name;
                //     $userfield->save();
    
                //       }
               
        

        $token =  $Vandor->createToken('MyApp')->accessToken; 
        return response()->json(['token' => $token, 'status' => true, 'VandorData'=>$Vandor], 200);
    }


    public function signupfields()
    {
        $signupfields = DB::table('signupfields')->where('published_status', 'published')->orderBy('id', 'DESC')->get();
        return response(['success' => true, 'data' => $signupfields]);
    }

    public function signupfieldschilds(Request $request)
    {
    
        $signupfieldschilds = DB::table('signupfieldschilds')->where('signup_parent',$request->signup_parent)->orderBy('id', 'DESC')->get();
        return response(['success' => true, 'data' => $signupfieldschilds]);
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
    
    

    
    


    
    
        
        
    public function getcountries()
    {
        $countries = DB::table('countries')->where('published_status', 'published')->orderBy('id', 'DESC')->get();
        
        $temp = array();
        $temp1 = array();

          foreach($countries as $f)
        {
           $temp['id'] = $f->id;
           $temp['name'] = $f->name;
           $temp['published_status'] = $f->published_status;
           $temp['image'] = 'http://baecay.petprotectusa.com/public/images/'.$f->image;

            $temp1[] = $temp;


        }
        return response(['success' => true, 'data' => $temp1]);
    }
    
     public function getplaces(Request $request)
    {
        $places = DB::table('places')->where('countries',$request->country)->get();
        return response(['success' => true, 'data' => $places]);
    }
    
       public function placedetails(Request $request)
    {
        $users = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "users.coverimage",
            "users.username",
            "users.profileimage",
            "users.name")
            ->leftJoin('users', 'selectedplaces.user_id', '=', 'users.id')
            ->where('selectedplaces.places' , $request->place_id)
            ->get();
        return response(['success' => true, 'data' => $users]);
    }
    
    
    
    

    
    
    
    
    
    
        public function apisendlove(Request $request)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($request->id);
        $user1->befriend($user2);
        return response(['success' => true]);
    }
    
        public function apicancellove($id)
    {
        DB::Table('friendships')->where('sender_id' , Auth::user()->id)->where('recipient_id' , $id)->where('status' , 'pending')->delete();
        return response(['success' => 'Cancel REquest Successfully']);

    }
        public function apifriendrequests()
    {
        $data = Auth::user();
        $user1 = User::find(Auth::user()->id);
        $data = $user1->getFriendRequests();
        $temp = array();
        $temp1 = array();

               foreach ($data as $r) {
                $userrequest = user::find($r->sender_id);
                $userrequest->profileimage;
                
           $temp['username'] = $userrequest->username;
           $temp['profileimage'] = $userrequest->profileimage;
           $temp['requestid'] = $userrequest->id;
           $temp1[] = $temp;

            }
        return response(['success' => true , 'data' => $temp1]);
    }
    
       public function apiacceptreuqqest($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);
        $user1->acceptFriendRequest($user2);
        return response(['success' => 'Request Accepted Successfully']);

    }
    
        public function apiunfriend($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);
        $user1->unfriend($user2);
        return response(['success' => 'Unfriend Successfully']);

    }

  public function apigoondate()
    {
        $data = DB::table('countries')->get();
        return response(['success' => true , 'data' => $data]);

    }

    public function apisearchcountry($id)
    {
        $places = DB::table('places')->where('countries'  ,$id)->get();
        return response(['success' => true , 'data' => $places]);

    }
    
    

    public function apiplacedetails($id)
    {
        $data = DB::table('places')->where('id' , $id)->get()->first();
        $users = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "users.coverimage",
            "users.username",
            "users.profileimage",
            "users.name")
            ->leftJoin('users', 'selectedplaces.user_id', '=', 'users.id')
            ->where('selectedplaces.places', $data->id)
            ->get();
        return response(['success' => true , 'data' => $users]);
}

  public function apiinvitations()
    {
  $data = DB::table('userplaces')->where('status' , 'pending')->where('reciever_id' , Auth::user()->id)->orderby('id' , 'desc')->get();
  return response(['success' => true , 'data' => $data]);

    }
     public function apisendinvitations()
    {
        
    $data = DB::table('userplaces')->where('status','pending')->where('send_id' , Auth::user()->id)->orderby('id' , 'desc')->get();
    return response(['success' => true , 'data' => $data]);

    }
    
      public function apiacceptplaceinvitation($id)
    {

        $place = userplaces::find($id);
        $place->status = 'approved';
        $place->save();
        $placename = DB::table('places')->where('countries',$place->place_id)->first();
        $notification = Auth::user()->name." Accepted your Invitation in ".$placename->name." For Date";
        $url = url("mydates");
        $name = Auth::user()->name;
        $type = "invitation";
        Cmf::saveusernotfication($place->send_id,$notification,$url,$name,$type);
        return response(['success' => 'Accepted Successfully']);

    }

    public function apirejectplaceinvitation($id)
    {
        $place = userplaces::find($id);
        $place->status = 'rejected';
        $place->save();
        $placename = DB::table('places')->where('countries',$place->place_id)->first();
        $notification = Auth::user()->name." Rejected your Invitation in ".$placename->name." For Date";
        $url = url("profile");
        $name = Auth::user()->name;
        $type = "invitation";
        Cmf::saveusernotfication($place->send_id,$notification,$url,$name,$type);
        return response(['success' => 'Reject Successfully']);

    }
    
      public function apiuserdates()
    {
        $data = userplaces::where('status','approved')->where('send_id' , Auth::user()->id)->orwhere('reciever_id' , Auth::user()->id)->orderby('id' , 'desc')->get();
        return response(['success' => true , 'data' => $data]);

    }
    
    public function apichatroom()
    {
        $id = Auth::user()->id;
        $currentUser=User::find($id);
        $chatUsers=DB::SELECT("SELECT chat.* FROM chat, (SELECT MAX(id) as lastid FROM chat WHERE (chat.sendTo = ".$id." OR chat.sendby = ".$id.") GROUP BY CONCAT(LEAST(chat.sendTo ,chat.sendby ),'.', GREATEST(chat.sendTo , chat.sendby))) as conversations WHERE id = conversations.lastid ORDER BY chat.created_at DESC");
        return response(['success' => true , 'chatUsers' => $chatUsers,'currentUser'=>$currentUser]);

    }
    
        public function apisentplaceinvite(Request $request)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($request->userid);
        $checkfriend = $user1->isFriendWith($user2);
        if($checkfriend)
        {
        $sent = new userplaces();
        $sent->send_id = Auth::user()->id;
        $sent->reciever_id = $request->userid;
        $sent->place_id = $request->place_id;
        $sent->status = 'pending';
        $sent->save();
        $place = DB::table('places')->where('countries',$request->place_id)->get()->first();
        $notification = Auth::user()->name." Invite You in ".$place->name." For Date";
        $url = url("profile/details/invitations");
        $name = " ";
        $type = "invitation";
        Cmf::saveusernotfication($request->userid,$notification,$url,$name,$type);
        return response(['success' => 'Invitation Sended Successfully']);
        }else
        {
        return response(['error' => 'First Send friend request']);

        }

    }
    
        public function apinotifications()
    {
        $notifications = usernotifications::where('user_id' , Auth::user()->id)->orderby('read_status','desc')->get();
        return response(['success' => true , 'data' => $notifications]);

    }
    
        public function apigetcompletenotifications()
    {
        $user1 = User::find(Auth::user()->id);
        $friendrequests = $user1->getFriendRequests();
        $notification = usernotifications::where('user_id' , Auth::user()->id)->where('read_status' , 1)->count();
        $chat = Chat::where('sendTo' , Auth::user()->id)->where('read' , 0)->count();
        return response(['friendrequests' => $friendrequests->count(),'notification' => $notification,'chat' => $chat]);
    }
    
        public function apiForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        $password = mt_rand(100000, 999999);
        if($user)
        {
            $user->password = Hash::make($password);
            $user->save();
       
            return response(['success' => true ,'password' => $password]);
        }
        else
        {
            return response(['success' => false , 'data' => 'Oops...user not found..!!']);
        }
    }




}
