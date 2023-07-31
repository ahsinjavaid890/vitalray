<?php

namespace App\Http\Controllers\admin;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\site_settings as Settings;
use App\Models\signupfields;
use App\Models\signupfieldschilds;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function appearance()
    {   
        $settings = Settings::first();
        return view('admin.settings.appearance',compact("settings"));
    }
    public function admin_settings_seo(Request $request)
    {
        $input = $request->all();
        $settings = Settings::first();
        $settings->metta_tittle = $input['metta_tittle'];
        $settings->metta_description = $input['meta_description'];
        $settings->metta_keywords = $input['meta_keywords'];    
        $updated = $settings->save();
        if($updated)
        {

          return redirect()->back()->with('message', 'Settings Updated Successfully');
        }
        else
        {
            return back()->with('warning', 'Something went Wrong!')->withInput();
        }
    }
    public function appearance_update(Request $request)
    {

        $input = $request->all();
        $settings = Settings::first();
        if(!empty($input['website_name']))
        $settings->site_name = $input['website_name'];
        if(!empty($input['site_motto']))
        $settings->site_moto = $input['site_motto'];
        

        if(!empty($input['site_email']))
        $settings->site_email = $input['site_email'];
        if(!empty($input['site_phonenumber']))
        $settings->site_phonenumber = $input['site_phonenumber'];
        if(!empty($input['site_fax']))
        $settings->site_fax = $input['site_fax'];
        if(!empty($input['site_address']))
        $settings->site_address = $input['site_address'];
        


        if(!empty($input['paypal']))
        $settings->paypal = $input['paypal'];
        if(!empty($input['stripe']))
        $settings->stripe = $input['stripe'];
        if(!empty($input['jazcash']))
        $settings->jazcash = $input['jazcash'];



        if(!empty($input['published_stripe']))
        $settings->published_stripe = $input['published_stripe'];
        if(!empty($input['secret_stripe']))
        $settings->secret_stripe = $input['secret_stripe'];

    

        if(!empty($input['vat_percentage']))
        $settings->vat_percentage = $input['vat_percentage'];
        if(!empty($input['vat_value']))
        $settings->vat_value = $input['vat_value'];
        if(!empty($input['sale_percentage']))
        $settings->sale_percentage = $input['sale_percentage'];
        if(!empty($input['sale_value']))
        $settings->sale_value = $input['sale_value'];


    
        $updated = $settings->save();
        
        if($updated)
        {

          return redirect()->back()->with('message', 'Settings Updated Successfully');
        }
        else
        {
            return back()->with('warning', 'Something went Wrong!')->withInput();
        }
    }

    public function updatelogos(Request $request)
    {
        $settings = Settings::first();
        if(!empty($request->header_logo))
        {
            $settings->header_logo = Cmf::sendimagetodirectory($request->header_logo);
        }
        if(!empty($request->footer_logo))
        {
            $settings->footer_logo = Cmf::sendimagetodirectory($request->footer_logo);
        }
        if(!empty($request->favicon))
        {
            $settings->favicon = Cmf::sendimagetodirectory($request->favicon);
        }
        $updated = $settings->save();
        if($updated)
        {
          return redirect()->back()->with('message', 'Settings Updated Successfully');
        }
        else
        {
            return back()->with('warning', 'Something went Wrong!')->withInput();
        }
    }

    public function payementmethod()
    {
        $settings = Settings::first();
        return view('admin.settings.payementmethod',compact("settings"));
    }
    public function signup()
    {
        
        $data = signupfields::where('delete_status' , 'active')->get();
        return view('admin.settings.signup',compact("data"));
    }

    public function cretesignup(Request $request)
    {
        $signup = new signupfields;
        $signup->name = $request->name;
        $signup->type = $request->type;
        $signup->order = 1;
        $signup->isrequired = $request->isrequired;
        $signup->published_status = 'published';
        $signup->delete_status = 'active';
        $signup->save();


        if($request->type == 'radio')
        {
            if(!empty($request->signupfieldschilds))
            {
                foreach ($request->signupfieldschilds as $r) {
                    if(!empty($r))
                    {
                        $signupfieldschilds = new signupfieldschilds;
                        $signupfieldschilds->name = $r;
                        $signupfieldschilds->signup_parent = $signup->id;
                        $signupfieldschilds->save();
                    }
                    
                }
            }else{

            }
            
        }

        if($request->type == 'checkbox')
        {
            if(!empty($request->signupfieldschilds))
            {
                foreach ($request->signupfieldschilds as $r) {
                    if(!empty($r))
                    {
                        $signupfieldschilds = new signupfieldschilds;
                        $signupfieldschilds->name = $r;
                        $signupfieldschilds->signup_parent = $signup->id;
                        $signupfieldschilds->save();
                    }
                }
            }else{
                
            }
        }else{
            
        }

        if($request->type == 'select')
        {
            if(!empty($request->signupfieldschilds))
            {
                foreach ($request->signupfieldschilds as $r) {
                    if(!empty($r))
                    {
                        $signupfieldschilds = new signupfieldschilds;
                        $signupfieldschilds->name = $r;
                        $signupfieldschilds->signup_parent = $signup->id;
                        $signupfieldschilds->save();
                    }
                }
            }else{
                
            }
        }else{
            
        }
        return redirect()->back()->with('message', 'New Field Created Successfully');
    }
    public function updatesignupfield($id , $value)
    {
        $update = signupfieldschilds::find($id);
        $update->name = $value;
        $update->save();
    }
    public function addnewchildfields(Request $request)
    {
        if(!empty($request->signupfieldschilds))
        {
            foreach ($request->signupfieldschilds as $r) {
                if(!empty($r))
                {
                    $signupfieldschilds = new signupfieldschilds;
                    $signupfieldschilds->name = $r;
                    $signupfieldschilds->signup_parent = $request->id;
                    $signupfieldschilds->save();
                }
            }
            return redirect()->back()->with('message', 'Added Successfully');
        }else{
            return redirect()->back()->with('warning', 'Please add Atleast One Input');
        }
    }
    public function updatesignup(Request $request)
    {
        $signup = signupfields::find($request->id);
        $signup->name = $request->name;
        $signup->order = $request->order;
        $signup->isrequired = $request->isrequired;
        $signup->save();
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function deletechildsignup($id)
    {
        signupfieldschilds::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function deletesignupfield($id)
    {
        $signup = signupfields::find($id);
        $signup->delete_status = 'delete';
        $signup->save();
        return redirect()->back()->with('message', 'Deleted Successfully');
    }
    public function editsignupfield($id)
    {
        $data = signupfields::find($id);
        return view('admin.settings.editsignupfields',compact("data"));
    }
    public function taxsettingsupdate(Request $request)
    {
        $input = $request->all();
        $settings = Settings::first();
        $settings->vat_percentage = $input['vat_percentage'];
        $settings->vat_value = $input['vat_value'];
        $settings->sale_percentage = $input['sale_percentage'];
        $settings->sale_value = $input['sale_value'];
        $updated = $settings->save();
        if($updated)
        {
          return redirect()->back()->with('message', 'Settings Updated Successfully');
        }
        else
        {
            return back()->with('warning', 'Something went Wrong!')->withInput();
        }
    }
    
    
}
