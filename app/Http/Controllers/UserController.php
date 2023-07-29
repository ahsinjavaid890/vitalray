<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\usernotifications;
use App\Models\peoplereviews;
use App\Models\subscribedplans;
use App\Models\selectedplaces;
use App\Models\userplaces;
use App\Models\userfields;
use Validator;
use Auth;
use PDF;
use DB;
use Storage;
use Carbon;
use Stripe;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('Userauthenticate');
    }
    public function searchheaderpeoples($id)
    {
        $data = user::where('user_type' , 'customer')->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->where('is_admin' , 0)->where('name','like', '%' .$id. '%' )->get();

        if($data->count() > 0)
        {
            foreach ($data as $r) {
                echo '<a style="width:100%;" href="'.url('profile').'/'.$r->username.'"><div>'.$r->name.'</div></a>';
            }
        }else{
            echo '<span style=" padding-top: 50%; position: absolute; left: 30%; ">No User Found</span>';
        }
        
    }
    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
            
        $SERVER_API_KEY = 'AIzaSyA-IGKMe9-2VDoQXye2L4r1IVP0aMNqljQ';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  

        print_r($response);
    }
    public function friendrequests()
    {
        $data = Auth::user();
        $user1 = User::find(Auth::user()->id);
        $friendrequest = $user1->getFriendRequests();
        return view('frontend.user.friendrequest')->with(array('data'=>$data,'friendrequest'=>$friendrequest));
    }
    public function allfriends()
    {
        $data = Auth::user();
        $user1 = User::find(Auth::user()->id);
        $friendrequest = $user1->getFriends();
        return view('frontend.user.allfriends')->with(array('data'=>$data,'friendrequest'=>$friendrequest));
    }

    public function sentrequests()
    {
        $data = Auth::user();
        $user1 = User::find(Auth::user()->id);
        $friendrequest = $user1->getPendingFriendships();
        // print_r($friendrequest);exit;
        return view('frontend.user.sentrequests')->with(array('data'=>$data,'friendrequest'=>$friendrequest));
    }
    public function chatroom()
    {
        $id = Auth::user()->id;
        $currentUser=User::find($id);
        $chatUsers=DB::SELECT("SELECT chat.* FROM chat, (SELECT MAX(id) as lastid FROM chat WHERE (chat.sendTo = ".$id." OR chat.sendby = ".$id.") GROUP BY CONCAT(LEAST(chat.sendTo ,chat.sendby ),'.', GREATEST(chat.sendTo , chat.sendby))) as conversations WHERE id = conversations.lastid ORDER BY chat.created_at DESC");
        return view('frontend.chat.chatroom')->with(array('chatUsers'=>$chatUsers,'currentUser'=>$currentUser));
    }

    public function chatwithuser($username)
    {
        $id = User::where('username' , $username)->get()->first()->id;
        $currentUser=Auth::user();
        $chatUsers=DB::SELECT("SELECT chat.* FROM chat, (SELECT MAX(id) as lastid FROM chat WHERE (chat.sendTo = ".$currentUser->id." OR chat.sendby = ".$currentUser->id.") GROUP BY CONCAT(LEAST(chat.sendTo ,chat.sendby ),'.', GREATEST(chat.sendTo , chat.sendby))) as conversations WHERE id = conversations.lastid ORDER BY chat.created_at DESC");
        Chat::where('sendBy',$id)->update(['read'=>1]);
        return view('frontend.chat.chatwithuser')->with(array('chat'=>$id,'chatUsers'=>$chatUsers,'currentUser'=>$currentUser));
    }
    public function dashboard()
    {
        $data = Auth::user();
        $placesselected = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "places.name",
            "places.image",
            "places.id as place_id")
            ->leftJoin('places', 'selectedplaces.places', '=', 'places.id')
            ->where('selectedplaces.user_id' , Auth::user()->id)
            ->get();
        return view('frontend.user.userprofile')->with(array('data'=>$data,'placesselected'=>$placesselected));
    }
    public function userprofile($id)
    {
        $data = user::where('username' , $id)->get()->first();
        $placesselected = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "places.name",
            "places.image")
            ->leftJoin('places', 'selectedplaces.places', '=', 'places.id')
            ->where('selectedplaces.user_id' , $data->id)
            ->get();
        return view('frontend.user.userprofile')->with(array('data'=>$data,'placesselected'=>$placesselected));
    }
    public function about()
    {
        $data = Auth::user();
        return view('frontend.user.aboutinfo')->with(array('data'=>$data));
    }
    public function loveplaces()
    {
        $data = Auth::user();
        $placesselected = selectedplaces::select(
            "selectedplaces.id",
            "selectedplaces.user_id",
            "selectedplaces.places",
            "selectedplaces.created_at",
            "places.name",
            "places.image")
            ->leftJoin('places', 'selectedplaces.places', '=', 'places.id')
            ->where('selectedplaces.user_id' , $data->id)
            ->get();
        return view('frontend.user.loveplaces')->with(array('data'=>$data,'placesselected'=>$placesselected));
    }
    public function invitations()
    {
        return view('frontend.user.invitations');
    }
    public function acceptplaceinvitation($id)
    {
        $place = userplaces::find($id);
        $place->status = 'approved';
        $place->save();
        $placename = DB::table('places')->where('id' , $place->place_id)->get()->first();
        $notification = Auth::user()->name." Accepted your Invitation in ".$placename->name." For Date";
        $url = url("mydates");
        $name = Auth::user()->name;
        $type = "invitation";
        Cmf::saveusernotfication($place->send_id,$notification,$url,$name,$type);
        return redirect()->back()->with('message', 'Accepted Successfully');
    }
    public function rejectplaceinvitation($id)
    {
        $place = userplaces::find($id);
        $place->status = 'rejected';
        $place->save();
        $placename = DB::table('places')->where('id' , $place->place_id)->get()->first();
        $notification = Auth::user()->name." Rejected your Invitation in ".$placename->name." For Date";
        $url = url("profile");
        $name = Auth::user()->name;
        $type = "invitation";
        Cmf::saveusernotfication($place->send_id,$notification,$url,$name,$type);
        return redirect()->back()->with('message', 'Accepted Successfully');
    }
    public function sendlove($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);
        $user1->befriend($user2);
        return redirect()->back()->with('message', 'Request Sended Successfully');
    }
    public function cancellove($id)
    {
        DB::Table('friendships')->where('sender_id' , Auth::user()->id)->where('recipient_id' , $id)->where('status' , 'pending')->delete();
        return redirect()->back()->with('message', 'Cancel REquest Successfully');
    }
    public function unfriend($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);
        $user1->unfriend($user2);
        return redirect()->back()->with('message', 'Unfriend Successfully');
    }
    public function sentplaceinvite($id , $userid)
    {
        $sent = new userplaces();
        $sent->send_id = Auth::user()->id;
        $sent->reciever_id = $userid;
        $sent->place_id = $id;
        $sent->status = 'pending';
        $sent->save();
        $place = DB::table('places')->where('id' , $id)->get()->first();
        $notification = Auth::user()->name." Invite You in ".$place->name." For Date";
        $url = url("profile/details/invitations");
        $name = " ";
        $type = "invitation";
        Cmf::saveusernotfication($userid,$notification,$url,$name,$type);

        return redirect()->back()->with('message', 'Invitation Sended Successfully');
    }

    public function chatall()
    {
        return view('frontend.chat.all');
    }

    public function getcompletenotifications()
    {
        $user1 = User::find(Auth::user()->id);
        $friendrequests = $user1->getFriendRequests();
        $notification = usernotifications::where('user_id' , Auth::user()->id)->where('read_status' , 1)->count();
        $chat = Chat::where('sendTo' , Auth::user()->id)->where('read' , 0)->count();
        return response()->json(['friendrequests' => $friendrequests->count(),'notification' => $notification,'chat' => $chat]);
    }

    public function notifications()
    {
        $notifications = usernotifications::where('user_id' , Auth::user()->id)->orderby('read_status' , 'desc')->get();
        return view('frontend.user.notifications')->with(array('data'=>$notifications));
    }

    public function changecoverphoto(Request $request)
    {
        $this->validate($request, [
            'coverphoto' => 'required',
        ]);
        $image =  Cmf::sendimagetodirectory($request->coverphoto);
        $user = user::find(Auth::user()->id);
        $user->coverimage = $image;
        $user->save();
        Cmf::save_media_image($image  , 'cover' , Auth::user()->id);
        return redirect()->back()->with('message', 'Media Image Updated Successfully');
    }


    public function addgalleryphoto(Request $request)
    {
        $image =  Cmf::sendimagetodirectory($request->profileimage);
        Cmf::save_media_image($image  , 'gallary' , Auth::user()->id);

        $user = user::find(Auth::user()->id);
        $getprevious = $user->imagesupload;
        $user->imagesupload = $getprevious+1;
        $user->save();

        return redirect()->back()->with('message', 'Gallery Image Added Successfully');
    }
    public function deleteallery($id)
    {
        $image = DB::Table('mediaimages')->where('id' , $id)->first();
        if($image->type == 'gallary')
        {
            $user = user::find(Auth::user()->id);
            $getprevious = $user->imagesupload;
            $user->imagesupload = $getprevious-1;
            $user->save();
        }
        DB::Table('mediaimages')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Gallary Image Deleted Successfully');
    }
    public function removeplace($id)
    {
        selectedplaces::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Places Deleted Successfully');
    }
    public function saveplaces(Request $request)
    {
        selectedplaces::where('user_id' , Auth::user()->id)->delete();
        if($request->selectedplaces)
        {
            foreach ($request->selectedplaces as $r) {
                $place = new selectedplaces();
                $place->user_id = Auth::user()->id;
                $place->places = $r;
                $place->save();
            }
        }
        return redirect()->back()->with('message', 'Places Updated Successfully');
    }
    public function changeprofilephoto(Request $request)
    {
        $this->validate($request, [
            'profilephoto' => 'required',
        ]);
        $image =  Cmf::sendimagetodirectory($request->profilephoto);
        $user = user::find(Auth::user()->id);
        $user->profileimage = $image;
        $user->save();
        Cmf::save_media_image($image  , 'profileimage',Auth::user()->id);
        return redirect()->back()->with('message', 'Media Image Updated Successfully');
    }
    public function generalsettings()
    {
        $data = Auth::user();
        return view('frontend.settings.general')->with(array('data'=>$data));
    }
    public function subscribesettings()
    {
        $data = Auth::user();

        $check = subscribedplans::where('user_id'  , $data->id);

        if($check->count() == 0)
        {
            return view('frontend.settings.subscribe')->with(array('data'=>$data));
        }else{
            return view('frontend.settings.subscribed')->with(array('data'=>$data,'plan'=>$check->get()->first()));
        }
        
    }
    public function securitysettings()
    {
        $data = Auth::user();
        return view('frontend.settings.security')->with(array('data'=>$data));
    }

    public function viewgallery()
    {
        $data = user::where('id' , Auth::user()->id)->get()->first();
        $galery = DB::table('mediaimages')->where('user_id' , Auth::user()->id)->orderby('id' , 'desc')->get();
        return view('frontend.user.gallery')->with(array('data'=>$data,'galery'=>$galery));
    }

    public function subscribeplan($id)
    {
        $plan = DB::table('subscriptionplans')->where('id' , $id)->get()->first();
        $data = Auth::user();
        if($plan->price > 0)
        {
            return view('frontend.settings.subscribeplan')->with(array('data'=>$data,'plan'=>$plan));
        }
        else
        {
            if(Auth::user()->free_subscription == 1)
            {
                return redirect()->back()->with('message', 'Plan Already Subscribed');
            }else{
                $user = user::find(Auth::user()->id);
                $user->free_subscription = 1;
                $user->save();


                $plan = new subscribedplans();
                $plan->user_id = Auth::user()->id;
                $plan->plan_id = $id;
                $plan->save();
                return redirect()->back()->with('message', 'Plan Successfully Subscribed');
            }
            
        }
    }
    public function statuschange($id)
    {
        $array = array('read_status'=>0);
        $data = DB::table('usernotifications')->where('id' , $id)->update($array);
    }
    public function allnotifications()
    {
        $notification = usernotifications::where('user_id' , Auth::user()->id)->where('read_status' , 1)->orderby('id' , 'desc')->get();

        $data = array('read_status' => 0);
        

        if($notification->count() > 0)
        {

            foreach ($notification as $r) {
                echo '<a onclick="changenotistatus('.$r->id.')" href="'.$r->url.'" class="media">
                    <div class="media-body">';
                        if($r->name)
                        {
                            echo '<h6 class="item-title">'.$r->name.'</h6>';
                        }
                        
                        echo '<div class="item-time">'.$r->created_at->diffForHumans().'</div>
                        <p>'.$r->notification.'</p>
                    </div>
                </a>';
            }


        }else{
            echo '<div class="media">
                    <div class="media-body">
                        <h6 class="item-title">No New Notifications</h6>
                    </div>
                </div>';
        }
    }


    public function getfriendrequest()
    {
        $user1 = User::find(Auth::user()->id);
        $data = $user1->getFriendRequests();
        if($data->count() > 0)
        {
            foreach ($data as $r) {
                $userrequest = user::find($r->sender_id);
                $mutualfriendcount  = $user1->getMutualFriendsCount($userrequest);
                echo '<div class="media">
                    <div class="item-img">';
                    if($userrequest->profileimage)
                    {
                        echo '<img src="'.asset("public/images").'/'.$userrequest->profileimage.'" alt="Notify">';
                    }else{
                        echo '<img src="'.asset("front/media/profileavatar.png").'" alt="Notify">';
                    }
                        
                    echo '<span class="chat-status'; if($userrequest->online == 1) {echo " online";}else{echo ' ofline';} echo ' "></span>
                    </div>
                    <div class="media-body">
                        <h6 class="item-title"><a href="'.url('profile').'/'.$userrequest->username.'">'.$userrequest->name.'</a></h6>';
                        if($mutualfriendcount > 0)
                        {
                            echo '<p>'.$mutualfriendcount.' in Mutual Friends</p>';
                        }else{
                            echo "<p>No Mutual Friends</p>";
                        }
                        echo '<div class="btn-area">
                            <a href="'.url('profile/acceptreuqqest/').'/'.$userrequest->id.'" class="item-btn"><i class="icofont-plus"></i></a>
                            <a href="'.url('profile/rejectreuqqest/').'/'.$userrequest->id.'" class="item-btn"><i class="icofont-minus"></i></a>
                        </div>
                    </div>
                </div>';
            }
        }else{
            echo '<div class="media">
                    <div class="media-body">
                        <h6 class="item-title">No Firned Requests</h6>
                    </div>
                </div>';
        }
        
    }

    public function chat_starts_with($id)
    {
        $data = user::find(Auth::user()->id);
        $data->chat_starts_with = $id;
        $data->save();
    }
    public function closchat()
    {
        $data = user::find(Auth::user()->id);
        $data->chat_starts_with = 0;
        $data->save();
    }
    public function acceptreuqqest($id)
    {
        $user1 = User::find(Auth::user()->id);
        $user2 = User::find($id);
        $user1->acceptFriendRequest($user2);
        return redirect()->back()->with('message', 'Request Accepted Successfully');
    }


    public function securetycredentials(Request $request)
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
            session()->flash('errorsecurity','Repeat password doesn’t match');
            return redirect()->back();
        }
    }
   

    public function updategeneraldetails(Request $request)
    {
        $user = user::find(Auth::user()->id);
        $user->name = $request->name;
        $user->phonenumber = $request->phonenumber;
        $user->age = $request->age;
        $user->height = $request->height;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->save();
        return redirect()->back()->with('message', ''.$request->name.' Your Profile Updated Successfully');
    }
    public function updatemoreinformation(Request $request)
    {
        userfields::where('user_id' , Auth::user()->id)->delete();
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
                        $userfield->user_id = Auth::user()->id;
                        $userfield->signup_parent = $key;
                        $userfield->value = $value;
                        $userfield->save();
                    }
                    
                }
            }
        }

        $user = user::find(Auth::user()->id);
        $user->about = $request->about;
        $user->save();
        return redirect()->back()->with('message', ''.Auth::user()->name.' Your Profile Updated Successfully');
    }
    public function submitreview(Request $request)
    {
        $review = new peoplereviews();
        $review->from_id = Auth::user()->id;
        $review->user_id = $request->user_id;
        $review->rattings = $request->star;
        $review->review = $request->message;
        $review->save();
        return redirect()->back()->with('message', 'Review Submited Successfully');
    }
    // News Feed


    public function findpeople()
    {
        $data = user::where('user_type' , 'customer')->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->where('is_admin' , 0)->paginate(Cmf::paginate());
        return view('frontend.newsfeed.index')->with(array('data'=>$data));
    }


    public function goondate()
    {
        $data = DB::table('countries')->get();
        return view('frontend.date.goondate')->with(array('data'=>$data));
    }

    public function placedetails($id)
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
            "users.name",                 
                        )
            ->leftJoin('users', 'selectedplaces.user_id', '=', 'users.id')
            ->where('selectedplaces.places' , $data->id)
            ->paginate(10);
        return view('frontend.date.place')->with(array('data'=>$data,'users'=>$users));
    }

    public function searchcountries($id)
    {

        if($id == 'all')
        {
            $data = DB::table('countries')->get();
        }else{
            $data = DB::table('countries')->where('name','like', '%' .$id. '%' )->get();
        }
        



        foreach($data as $r){
            $dates = DB::table('users')->where('user_type' , 'customer')->where('country' , $r->id)->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->count();
            echo '<div class="col-xl-3 col-lg-4 col-md-6">
                <div class="widget-author user-group">
                    <div class="author-heading">
                        <div class="cover-img">
                            <img class="city-height" src="'.asset('public/images').'/'.$r->image.'" alt="cover">
                        </div>
                        
                        <div class="profile-name city-thumb">
                            <h4 class="author-name"><a href="'.url('searchcountry').'/'.$r->id.'">'.$r->name.'</a></h4>
                            <div class="author-location">'.$dates.' Dates</div>
                        </div>
                    </div>
                    <ul class="member-thumb mb-0 mt-0">';
                        if($dates > 0)
                        {
                            foreach(DB::table('users')->where('user_type' , 'customer')->where('country' , $r->id)->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->limit(5)->get() as $u)
                            {
                                echo '<a href="'.url('profile').'/'.$u->username.'"><li><img src="'.asset('public/images').'/'.$u->profileimage.'" alt="member"></li></a>';
                            }
                            
                            echo '<li><i class="icofont-plus"></i></li>';
                        }else
                        {
                            echo '<a href="'.url('searchcountry').'/'.$r->id.'">
                                <li><i class="icofont-plus"></i></li>
                            </a>';
                        }
                    echo '</ul>
                    
                </div>
            </div>';
        }
        
    }

    public function mydates()
    {
        $data = userplaces::where('status','approved')->where('send_id' , Auth::user()->id)->orwhere('reciever_id' , Auth::user()->id)->orderby('id' , 'desc')->get();
        return view('frontend.date.mydates')->with(array('data'=>$data));
    }

    public function searchcountry($id)
    {
        $data = user::where('user_type' , 'customer')->where('country' , $id)->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->where('is_admin' , 0)->paginate(Cmf::paginate());
        $country = DB::table('countries')->where('id' , $id)->get()->first();
        $places = DB::table('places')->where('countries'  ,$id)->get();
        return view('frontend.date.datedetail')->with(array('country'=>$country,'places'=>$places,'data'=>$data));
    }

    // Payement


    public function stripePost(Request $request)
    {
        $plan = DB::table('subscriptionplans')->where('id' , $request->planid)->get()->first();
        $totalprice = round($plan->price);
        Stripe\Stripe::setApiKey(Cmf::get_site_settings_by_colum_name('secret_stripe'));
        $payement = Stripe\Charge::create ([
                "amount" => $totalprice,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => $plan->name
        ]);
        if(!empty($payement->id))
        {

            $check = subscribedplans::where('user_id' , Auth::user()->id)->get()->first();

            if($check)
            {
                $plan = subscribedplans::find($check->id);
                $plan->plan_id = $request->planid;
                $plan->save();
            }else{
                $plan = new subscribedplans();
                $plan->user_id = Auth::user()->id;
                $plan->plan_id = $request->planid;
                $plan->save();
            }
        }
        else
        {
            $plan = new subscribedplans();
            $plan->user_id = Auth::user()->id;
            $plan->plan_id = $request->planid;
            $plan->save();
            return back();
        }   
    }
}
