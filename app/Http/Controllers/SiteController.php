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
use App\Models\products;
use Validator;
use Auth;
use DB;
use Session;

use Redirect;
use URL;
use Mail;



class SiteController extends Controller
{
   
    public function indexview()
    {
        if(Auth::check())
        {
            return redirect()->route('userprofile');
        }else{
            $product = products::all();
            return view('frontend.homepage.index')->with(array('product'=>$product));
        }
    }
    public function productdetail($url){
        $product = DB::table('products')->where('url',$url)->first();
        // $product = products::find($url);
        return view('frontend.product.productdetail')->with(array('product'=>$product));
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
    public function contactus()
    {
        return view('frontend.contactus.index');
    }

    public function checkout($url){
        return view('frontend.checkout.checkout');
    }
}
