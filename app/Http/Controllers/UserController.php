<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\freequencies;
use App\Models\Plan;
use Validator;
use Auth;
use PDF;
use DB;
use Storage;
use Carbon;
use Stripe;
use Redirect;
class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('Userauthenticate');
        $this->middleware('auth');
    }
    public function dashboard()
    {

        if(Auth::user()->plan)
        {

            if(Auth::user()->payement_method == 'stripe')
            {
                $checksubscription = Cmf::checkstatusstripesubscription();
                if($checksubscription == 'active')
                {
                    return view('frontend.user.profile');
                }else{
                    $url = url('plans');
                    return Redirect::to($url);
                }
            }

        }else{
            $url = url('plans');
            return Redirect::to($url);
        }
    }
    public function cancelsubscription()
    {

        $subscriptionid = DB::table('subscriptions')->where('user_id' , Auth::user()->id)->where('stripe_status' , 'active')->first()->stripe_id;

        $stripe = new \Stripe\StripeClient('sk_test_xGtUq0Ocmz3drfEP0TOftndI005V9FjVqF');
        $response = $stripe->subscriptions->cancel($subscriptionid,['prorate' => 'true']);

        DB::table('subscriptions')->where('user_id' , Auth::user()->id)->where('stripe_id' , $subscriptionid)->update(array('stripe_status' => 'cancel'));

        $url = url('profile');
        return Redirect::to($url);
    }
    public function about()
    {
        $data = Auth::user();
        return view('frontend.user.aboutinfo')->with(array('data'=>$data));
    }
    
    public function freequencydetail($id , $url)
    {
        $data = freequencies::orderby('id' , 'desc')->where('id' , $id)->first();
        return view('frontend.user.frequenciesdetail')->with(array('data'=>$data));
    }
    public function generalsettings()
    {
        $data = Auth::user();
        return view('frontend.settings.general')->with(array('data'=>$data));
    }
    public function frequencies()
    {
        $data = freequencies::orderby('id' , 'desc')->paginate(10);
        return view('frontend.user.frequencies')->with(array('data'=>$data));
    }
    public function securitysettings()
    {
        $data = Auth::user();
        return view('frontend.settings.security')->with(array('data'=>$data));
    }


    public function plans()
    {
        $plans = Plan::get();
  
        return view("frontend.settings.plans", compact("plans"));
    }
    public function statuschange($id)
    {
        $array = array('read_status'=>0);
        $data = DB::table('usernotifications')->where('id' , $id)->update($array);
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
        if($request->profileimage)
        {
            $user->profileimage = Cmf::sendimagetodirectory($request->profileimage);    
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phonenumber = $request->phonenumber;
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
