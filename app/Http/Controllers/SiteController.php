<?php

namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\allbanners;
use App\Models\Product;
use App\Models\blogs;
use App\Models\blogcategories;
use App\Models\allbrands;
use App\Models\third_level_categories;
use App\Models\StoreSetting;
use App\Models\SubCategory;
use App\Models\vendorrequests;
use App\Models\global_attributes;
use App\Models\Attributes;
use App\Models\wishlists;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\newsletters;

use Validator;
use Auth;
use DB;
use Session;

use Redirect;
use URL;
use Mail;



class SiteController extends Controller
{
   

    public function currenturl()
    {
       return $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    public function checkemail($id)
    {
        return DB::table('users')->where('email'  ,$id)->get()->count();
    }
    public function vendorrequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cnicfront' => 'required',
            'cnicback' => 'required',
            'phonenumber' => 'required|numeric',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required| min:8|confirmed',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } 


        $vendor = new vendorrequests;
        $vendor->name = $request->name;
        $vendor->buisnessname = $request->buisnessname;
        $vendor->email = $request->email;
        $vendor->phonenumber = $request->phonenumber;
        $vendor->country = $request->country_id;
        $vendor->state = $request->state_id;
        $vendor->city = $request->city;
        $vendor->completeaddress = $request->completeaddress;
        $vendor->website = $request->website;
        $vendor->zipcode = $request->zipcode;
        $vendor->cnicfront = Cmf::sendimagetodirectory($request->cnicfront);
        $vendor->cnicback = Cmf::sendimagetodirectory($request->cnicback);
        $vendor->status = 0; // 0 Not Approved 1 Approved 2 Rejected 
        $vendor->password = Hash::make($request->password);
        $vendor->new = 1;
        $vendor->save();


        $notification = $request->name.' Send New Seller Request';
        $url = url('admin/vendor/viewvendorrequest/').'/'.$vendor->id;
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);


        // return redirect()->back()->with('message', 'Your Request Submited Successfully. We Will Contact You Soon');
    }
    public function saveblogcoment(Request $request)
    {
        $comentid = rand('123654' , '456321');
        if(Auth::check()){
            $userid = Auth::user()->id;
            DB::statement("INSERT INTO `blogcoments` (`id`,`users`, `blogs`, `coment`, `newstatus`, `visible_status`, `delete_status`)VALUES ('$comentid','$userid', '$request->blogid', '$request->coment', 'new', 'Not Published', 'Active')");
            $notification = '1 New Blog Coment';
            $url = url('admin/blogs-coments');
            Cmf::save_admin_notification($notification ,$url,'uil-home-alt');
        }else{
        DB::statement("INSERT INTO `blogcoments` (`id`,`name`,`email`, `blogs`, `coment`, `newstatus`, `visible_status`, `delete_status`)VALUES ('$comentid','$request->name','$request->email', '$request->blogid', '$request->coment', 'new', 'Not Published', 'Active')");
            $notification = '1 New Blog Coment';
            $url = url('admin/blogs-coments');
            Cmf::save_admin_notification($notification ,$url,'uil-home-alt');
        }
        $message = "Your Comment Added Successfully We Will Approve Soon";
        $alert = 'message';
        return redirect()->back()->with($alert, $message);
    }

    public function aboutus()
    {
        return view('frontend.about.index');
    }
    public function privacypolicy()
    {
        return view('frontend.about.privacypolicy');
    }
    public function termsandconditions()
    {
        return view('frontend.about.termsandconditions');
    }
    public function cookiespolicy()
    {
        return view('frontend.about.cookiespolicy');
    }
    public function page($id)
    {
        $page = DB::Table('dynamicpages')->where('slug' , $id)->get()->first();
        return view('frontend.dynamicpages.index')->with(array('data'=>$page));
    }

    public function indexview()
    {
        // session()->flush();
        if(Auth::check())
        {
            return redirect()->route('userprofile');
        }else{
            $url = url('');
            session()->put('redirecturl', $this->currenturl());
            $blogs = DB::table('blogs')->where('delete_status' , 'Active')->where('visible_status' , 'Published')->limit(3)->get();
            return view('frontend.homepage.index')->with(array('blogs'=>$blogs));
        }
    }


    
    public function adminlogin()
    {
        if(Auth::check()){
            $isadmin = Auth::user()->is_admin;
            if($isadmin == 1)
            {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('userprofile');
            }
        }else{
            return view('auth.adminlogin');
        }
    }
    
    // becomeaseller

   

    // shopbystore

    // Blogs Section
    public function allblogs()
    {
        $data = blogs::where('delete_status' , 'Active')->get();
        $blogcategories = blogcategories::all();
        return view('frontend.blog.allblogs')->with(array('data'=>$data,'blogcategories'=>$blogcategories));
    }

    public function showblog($id)
    {
        $data = blogs::where('url' , $id)->where('delete_status' , 'Active')->get()->first();
        $blogcategories = blogcategories::all();
        return view('frontend.blog.index')->with(array('data'=>$data,'blogcategories'=>$blogcategories));
    }

    public function blogbycategory($id)
    {
        $category = DB::table('blogcategories')->where('slug' , $id)->get()->first();
        $data = DB::table('blogs')->where('cat_id' , $category->id)->where('delete_status' , 'Active')->get();
        return view('frontend.blog.blogbycategory')->with(array('data'=>$data,'category'=>$category));
    }



    public function contactus()
    {
        return view('frontend.contactus.index');
    }

    public function submitcontactusform(Request $request)
    {
        $date = date('Y-m-d H:s');
        DB::statement("INSERT INTO `contactuses` (`name`, `email`, `message`, `status`, `new`, `created_at`)VALUES ('$request->name', '$request->email', '$request->message', '1', '1' , '$date')");
        return redirect()->back()->with('message', 'Your query Submited Successfully we will contact you Soon');
    }

    public function getstate($id)
    {
        $data  = DB::table('states')->where('country_id' , $id)->get();
        foreach ($data as $r) {
            echo "<option value='".$r->id."'>".$r->name."</option>";
        }
    }
    public function submitnewsletter(Request $request)
    {
       $email =  $request->email;
       $check = newsletters::where('email' , $email)->count();
       if($check == 0)
       {
          $order = new newsletters;
          $order->email = $email;
          $order->save();

          return redirect()->back()->with('message', 'Subscribed Successfully');
       }else{
        return redirect()->back()->with('warning', 'Your Email is already in Our System Pleas Try With another Email');
       }
    }
}
