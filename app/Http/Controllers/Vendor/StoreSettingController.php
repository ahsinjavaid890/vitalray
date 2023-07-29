<?php

namespace App\Http\Controllers\Vendor;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\StoreSetting;
use Validator;
use Illuminate\Support\Facades\Auth;

class StoreSettingController extends Controller
{
    
    public function index()
    {   
        
        $store = StoreSetting::where('user_id', Auth::guard('vendor')->user()->id)->first();
        return view('vendor.files.settings.store-settings',compact("store"));
    }

    public function updatestoresocialmedia(Request $request)
    {
        $store = StoreSetting::find($request->id);
        $store->facebook_link = $request->facebook;
        $store->twitter_link = $request->twitter;
        $store->youtube_link = $request->youtube;
        $store->google_link = $request->google;
        $store->save();
        return redirect()->back()->with('message', 'Social Media Links Updated Successfully');
    }

    public function storebanners(Request $request)
    {
        $store = StoreSetting::find($request->id);
        $store->shop_banner = Cmf::sendimagetodirectory($request->file('banner'));
        $store->save();
        return redirect()->back()->with('message', 'Social Media Banner Updated Successfully');
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(),[ 
            'shop_name'  => 'required',
            'shop_phone'  => 'required',
            'shop_address'  => 'required',
            'meta_title'  => 'required',
            'meta_description'  => 'required',
            'shop_logo'  => 'required|mimes:png,jpg|max:2048',
        ]);




        $store = StoreSetting::find($request->id);
        $store->shop_name = $request->shop_name;
        $store->shop_phone = $request->shop_phone;
        $store->shop_address = $request->shop_address;
        $store->shop_about = $request->shop_about;
        $store->shop_policy = $request->shop_policy;
        $store->meta_title = $request->meta_title;
        $store->meta_description = $request->meta_description;
        if(!empty($request->file('shop_logo')))
        {
            $store->shop_logo = Cmf::sendimagetodirectory($request->file('shop_logo'));
        }
        if(!empty($request->file('banner')))
        {
            $store->shop_banner = Cmf::sendimagetodirectory($request->file('banner'));
        }
        $store->save();
        return redirect()->back()->with('message', 'Store Settings Updated Successfully');
       
    }
}
