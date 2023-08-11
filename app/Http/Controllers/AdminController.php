<?php
namespace App\Http\Controllers;
use App\Helpers\Cmf;
use Illuminate\Http\Request;
use App\Models\modules;
use App\Models\freequencies;
use App\Models\user;
use App\Models\Plan;
use App\Models\dynamicpages;
use App\Models\products;
use App\Models\products_images;
use App\Models\Coupon;
use App\Models\subscriptionplans;
use App\Models\StoreSetting;
use App\Models\Product;
use App\Models\blogs;
use App\Models\blogcategories;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\Menu;
use App\Models\orderstatus;
use App\Models\vendorrequests;
use App\Models\product_reviews;
use App\Models\tickets;
use App\Models\ticketreplies;
use App\Models\quizefields;
use App\Models\quizes;
use App\Models\newsletters;
use App\Models\deniedrequests;
use App\Models\payments;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DataTables;
use PDF;
use Storage;
use App\Http\Requests;
use App\Models\order;
use Illuminate\Validation\Rule;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Image;
use Illuminate\Support\Facades\Hash;
use Stripe;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admindashboard()
    {
        if(Auth::user()->user_type == 'admin')
        {
            $users = user::where('user_type' , 'customer')->get();
            return view('admin.dashboard.index')->with(array('data'=>$users));
        }
        else
        {
            return redirect()->back()->with('warning', "you do not have Permission to Access Admin");
        }
        
    }
    public function checkorderofquiz($id)
    {
        $check = quizes::where('order' , $id)->count();
        return $check;
    }
    public function deletequesquestion($id)
    {
        quizefields::where('quiz_parent' , $id)->delete();
        quizes::where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Quiz Question Deleted Successfully');
    }
    public function newusers()
    {
        $users = user::where('delete_status'  , 'active')->get();
        return view('admin.users.requests')->with(array('data'=>$users));
    }

    public function declinerequests()
    {
        $data = deniedrequests::groupby('user_id')->get();
        return view('admin.users.deniedrequest')->with(array('data'=>$data));
    }

    public function users()
    {
        $users = user::where('delete_status' , 'active')->get();
        return view('admin.users.all')->with(array('data'=>$users));
    }


    public function addfreequency()
    {
        return view('admin.freequency.add');
    }
    public function createfreequency(Request $request)
    {
        $add = new freequencies();
        $add->name  = $request->name;
        $add->slug  = Cmf::shorten_url($request->name);
        $add->freequency  = Cmf::sendimagetodirectory($request->freequency);
        $add->image  = Cmf::sendimagetodirectory($request->image);
        $add->vibration  = $request->vibration;
        $add->emitter  = $request->emitter;
        $add->description  = $request->description;
        $add->show_on_homepage  = $request->show_on_homepage;
        $add->save();
        return redirect()->back()->with('message', 'Freequency Added Successfully');
    }
    public function allfreequencies()
    {
        $data = freequencies::orderby('id' , 'desc')->paginate(10);
        return view('admin.freequency.all')->with(array('data'=>$data));
    }
    public function editfreequency($id)
    {
        $data = DB::table('freequencies')->where('id' , $id)->get()->first();
        return view('admin.freequency.edit')->with(array('data'=>$data));
    }
    

    public function deletefreequency($id)
    {
        DB::table('freequencies')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'freequency Deleted Successfully');
    }

    public function updatefreequency(Request $request)
    {
        $add = freequencies::find($request->id);
        $add->name  = $request->name;
        $add->slug  = Cmf::shorten_url($request->name);
        if($request->freequency)
        {
            $add->freequency  = Cmf::sendimagetodirectory($request->freequency);
        }
        if($request->image)
        {
            $add->image  = Cmf::sendimagetodirectory($request->image);
        }
        $add->vibration  = $request->vibration;
        $add->emitter  = $request->emitter;
        $add->description  = $request->description;
        $add->show_on_homepage  = $request->show_on_homepage;
        $add->save();
        return redirect()->back()->with('message', 'Freequency Updated Successfully');
    }

    public function allproducts()
    {
        $data = DB::table('products')->orderby('id' , 'desc')->get();
        return view('admin.products.all')->with(array('data'=>$data));
    }
    public function addproduct()
    {
       return view('admin.products.addproduct');
    }
    public function createproduct(Request $request)
    {
        $add = new products();
        $add->name = $request->name;
        $add->url = Cmf::shorten_url($request->name);
        $add->short_description = $request->short_description;
        $add->description = $request->description;
        $add->price = $request->price;
        $add->image = Cmf::sendimagetodirectory($request->image);
        $add->document = Cmf::sendimagetodirectory($request->document);
        $add->save();

        if($request->gallaryimages)
        {
            foreach ($request->gallaryimages as $r) {
                $gallaryimage = new products_images();
                $gallaryimage->product_id = $add->id;
                $gallaryimage->image = Cmf::sendimagetodirectory($r);
                $gallaryimage->save();
            }
        }

        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function updateproduct(Request $request)
    {
        $add = products::find($request->id);
        $add->name = $request->name;
        $add->url = Cmf::shorten_url($request->name);
        $add->short_description = $request->short_description;
        $add->description = $request->description;
        $add->price = $request->price;
        if($request->image)
        {
            $add->image = Cmf::sendimagetodirectory($request->image);
        }
        if($request->document)
        {
            $add->document = Cmf::sendimagetodirectory($request->document);
        }
        $add->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }


    public function editproduct($id)
    {
        $data = DB::table('products')->where('id' , $id)->get()->first();
        return view('admin.products.edit')->with(array('data'=>$data));
    }

    public function deleteproduct(Request $request){
        DB::table('products')->where('id',$request->id)->delete();
        return redirect()->back();
    }

    public function deletegalleryimage($id){
        DB::table('products_images')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function updategallaryimages(Request $request){
        // $add = DB::table('products_images')->where('product_id' , $request->id);
   
        if($request->gallaryimages)
        {
            foreach ($request->gallaryimages as $r) {
                // $gallaryimage = products_images::where('product_id' , $request->id)->first();
                $gallaryimage = new products_images();
                $gallaryimage->product_id = $request->id;
                $gallaryimage->image = Cmf::sendimagetodirectory($r);
                $gallaryimage->save();
            }
        }

        return redirect()->back()->with('message', 'Gallery Image Updated Successfully');
    }


    public function allquizes()
    {
        $data = DB::table('quizes')->where('delete_status' , 'active')->where('published_status' , 'published')->orderby('order' , 'asc')->get();
        return view('admin.quizes.all')->with(array('data'=>$data));
    }

    public function createquiz(Request $request)
    {
        $quize = new quizes;
        $quize->name = $request->name;
        $quize->type = $request->type;
        $quize->order = $request->order;
        $quize->isrequired = $request->isrequired;
        $quize->published_status = 'published';
        $quize->delete_status = 'active';
        $quize->save();


        if($request->type == 'radio')
        {
            if(!empty($request->signupfieldschilds))
            {
                foreach ($request->signupfieldschilds as $r) {
                    if(!empty($r))
                    {
                        $quizefields = new quizefields;
                        $quizefields->name = $r;
                        $quizefields->quiz_parent = $quize->id;
                        $quizefields->save();
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
                        $quizefields = new quizefields;
                        $quizefields->name = $r;
                        $quizefields->quiz_parent = $quize->id;
                        $quizefields->save();
                    }
                }
            }else{
                
            }
        }else{
            
        }

        return redirect()->back()->with('message', 'New Quiz Field Created Successfully');
    }




    public function allstaff()
    {
        return view('admin.staff.allstaff');
    }
    public function permissions()
    {
        return view('admin.staff.permissions');
    }
    public function createuserrole(Request $request)
    {
        $rand = rand('1000' , '2000000');
        $role = new roles;
        $role->id = $rand;
        $role->name = $request->name;
        $role->save();
        foreach($request->parent as $r)
        {
            DB::statement("INSERT INTO `rolesparent` (`userroles`,`parentid`)VALUES ('$rand', '$r')");
        }
        foreach($request->child as $r)
        {
            DB::statement("INSERT INTO `childroles` (`module`,`role`)VALUES ('$r', '$rand')");
        }
        return redirect()->back()->with('message', 'Role Added Successfully');
    }
    public function updateuserrole(Request $request)
    {
        DB::table('rolesparent')->where('userroles' , $request->id)->delete();
        DB::table('childroles')->where('role' , $request->id)->delete();
        $rand = $request->id;
        foreach($request->parent as $r)
        {
            DB::statement("INSERT INTO `rolesparent` (`userroles`,`parentid`)VALUES ('$rand', '$r')");
        }
        foreach($request->child as $r)
        {
            DB::statement("INSERT INTO `childroles` (`module`,`role`)VALUES ('$r' , '$rand')");
        }
        return redirect()->back()->with('message', 'Role Updated Successfully');
    }
    public function createadminuser(Request $request)
    {

        $email = $request->email;
        if(DB::table('users')->where('email' , $email)->count() > 0)
        {
            return redirect()->back()->with('warning', 'This Email is Already Exist in System');
        }
        else
        {
            $user = new user;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phonenumber = $request->phonenumber;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->zipcode = $request->zipcode;
            $user->user_type = 'admin';
            $user->is_admin = 1;
            $user->active = 1;
            $user->role_id = $request->userroleid;
            $user->password = Hash::make($request->password);            
            $user->save();
            return redirect()->back()->with('message', 'User Added Successfully');
        }
    }
    public function updateadminuser(Request $request)
    {
        $user = user::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->is_admin = 1;
        $user->active = 1;
        $user->role_id = $request->userroleid;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('message', 'User Added Successfully');
    }
    public function changetopublishuser($one , $two)
    {
        if($two == 1)
        {
            $data = array('active'=>0);
        }else{
            $data = array('active'=>1);
        }
        user::where('id', $one)->update($data);
    }


    /****************************************************
                   Dynamic Pages
    *****************************************************/
    public function addpage()
    {
        return view('admin.pages.addnewpage');
    }
    public function allpages()
    {
        $data = dynamicpages::where('delete_status' , 'Active')->get();
        $viewstatus = 'all';
        return view('admin.pages.allpages')->with(array('data'=>$data,'viewstatus'=>$viewstatus));
    }
    public function allpageswithid($id)
    {
        if($id == 'published')
        {
            $data = dynamicpages::where('delete_status' , 'Active')->where('visible_status' , 'Published')->get();
        }
        if($id == 'notpublished')
        {
            $data = dynamicpages::where('delete_status' , 'Active')->where('visible_status' , 'Not Published')->get();
        }
        
        $viewstatus = $id;
        return view('admin.pages.allpages')->with(array('data'=>$data,'viewstatus'=>$viewstatus));
    }

    public function editpage($id)
    {
        $data = dynamicpages::where('id' , $id)->get()->first();
        return view('admin.pages.editpage')->with(array('data'=>$data));
    }
    public function createdynamicpage(Request $request)
    {
        $name = $request->name;
        // if(Cmf::checkurl($request->slug) > 0)
        // {
        //     return redirect()->back()->with('warning', 'Please Change the Page Slug Because This URL is Same With Other Url');
        // }
        // else
        // {
            $dynamicpages = new dynamicpages;
            $dynamicpages->name = $name;
            $dynamicpages->slug = $request->slug;
            $dynamicpages->content = $request->content;
            $dynamicpages->show_on_footer = $request->show_on_footer;
            $dynamicpages->show_bellow = $request->show_bellow;
            $dynamicpages->visible_order = 0;
            $dynamicpages->metta_tittle = $request->metta_tittle;
            $dynamicpages->metta_description = $request->metta_description;
            $dynamicpages->metta_keywords = $request->metta_keywords;            
            $dynamicpages->delete_status = 'Active';
            $dynamicpages->added_by = 1;
            $dynamicpages->visible_status = $request->visible_status;
            $dynamicpages->save();
            // Cmf::savesiteurl($request->slug , 'dynamicpages');
            return redirect()->back()->with('message', 'Page Successfully Inserted');
        // }
    }
    public function updatepage(Request $request)
    {
         $url = $request->slug;
        // $savedurl = DB::table('siteurls')->where('url', $url)->where('modulename' , 'dynamicpages')->first();
        // if(empty($savedurl))
        // {
        //     DB::statement("INSERT INTO `siteurls` (`url`, `modulename`)VALUES ('$url', 'dynamicpages')");
        // }

        $data = array('show_bellow'=>$request->show_bellow,'visible_order'=>$request->visible_order,'show_on_footer'=>$request->show_on_footer,'slug'=>$url,'name'=>$request->name,'content'=>$request->content,'metta_tittle'=>$request->metta_tittle,'metta_description'=>$request->metta_description,'metta_keywords'=>$request->metta_keywords,'visible_status'=>$request->visible_status);
        $id =  $request->id;
        dynamicpages::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Page Updated Successfully');
    }

    public function deletepage($id)
    {
        $data = DB::table('dynamicpages')->where('id' , $id)->get()->first();
        DB::table('dynamicpages')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Page Deleted Successfully');
    }
    




    
    // Subscription Plans
    
    public function userplans()
    {
        $data = DB::table('subscriptionplans')->get();
        return view('admin.subscriptions.userplans')->with(array('data'=>$data));
    }
    public function createplan(Request $request)
    {
        $this->validate($request, [
            'price' => 'required|unique:subscriptionplans',
        ]);
        $plan = new subscriptionplans;
        $plan->name = $request->name;
        $plan->places_allowed = $request->places_allowed;
        $plan->images_allowed = $request->images_allowed;
        $plan->price = $request->price;
        $plan->feature1 = $request->feature1;
        $plan->feature2 = $request->feature2;
        $plan->feature3 = $request->feature3;
        $plan->feature4 = $request->feature4;
        $plan->feature5 = $request->feature5;
        $plan->feature6 = $request->feature6;
        $plan->duration = $request->duration;
        $plan->status = 1;
        $plan->save();
        return redirect()->back()->with('message', 'Plan Successfully Inserted');
    }
    public function editplan($id)
    {
        $data = subscriptionplans::where('id' , $id)->get()->first();
        return view('admin.subscriptions.edit.editplan')->with(array('data'=>$data));
    }

    public function planstatus($id , $two)
    {
        $plan = subscriptionplans::find($two);
        $plan->status = $id;
        $plan->save();
        return redirect()->back()->with('message', 'Plan Updated Successfully');
    }



    /****************************************************
                   Plan Module
    *****************************************************/
    public function allplans()
    {
        $data = Plan::all();
        return view('admin.plans.all')->with(array('data'=>$data));
    }
    public function updateplan(Request $request)
    {
        $update = Plan::find($request->id);
        $update->name = $request->name;
        $update->no_of_days = $request->no_of_days;
        $update->stripe_plan = $request->stripe_plan;
        $update->price = $request->price;
        $update->save();
        return redirect()->back()->with('message', 'Plan Updated Successfully');
    }
    public function deleteblogcategory($id)
    {
        blogs::where('cat_id' , $id)->update(['delete_status'=>'trash']);
        $data = array('delete_status'=>'trash');
        blogcategories::where('id' ,$id)->update($data);
        return redirect()->back()->with('message', 'Blog Category Move To Trash');
    }
    public function deleteblogcategorypermanently($id)
    {
        blogs::where('cat_id' , $id)->update(['delete_status'=>'Delete']);
        $data = array('delete_status'=>'Delete');
        blogcategories::where('id' ,$id)->update($data);
        return redirect()->back()->with('message', 'Blog Category Deleted Successfully');
    }
    public function addblog()
    {
        return view('admin.blogs.addblog');
    }
    public function addnewcategory()
    {
        return view('admin.blogs.addblogcategory');
    }
    public function createblogcategory(Request $request)
    {
        $saveblog = new blogcategories;
        $saveblog->name = $request->name;
        $saveblog->slug = $request->slug;
        $saveblog->image = Cmf::sendimagetodirectory($request->image);
        $saveblog->visible_status = 'Published';
        $saveblog->delete_status = 'Active';
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Successfully Inserted');
        
    }
    public function updateblogcategory(Request $request)
    {
        $saveblog = blogcategories::find($request->id);
        $saveblog->name = $request->name;
        $saveblog->slug = $request->slug;
        if($request->image)
        {
            $saveblog->image = Cmf::sendimagetodirectory($request->image);
        }
        $saveblog->visible_status = $request->visible_status;
        $saveblog->delete_status = 'Active';
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Category Updated Successfully ');
    }
    public function editblogcategory($id)
    {
        $data = blogcategories::where('id' , $id)->get()->first();
        return view('admin.blogs.editcategory')->with(array('data'=>$data));
    }
    public function restoreblogcategory($id)
    {
        $data = array('delete_status'=>'Active');
        blogcategories::where('id' ,$id)->update($data);
        return redirect()->back()->with('message', 'Blog Category Move To Publish');
    }
    public function createblog(Request $request)
    {
        $saveblog = new blogs;
        $saveblog->name = $request->name;
        $saveblog->url = $request->slug;
        $saveblog->blog = $request->content;
        $saveblog->visible_status = 'Published';
        $saveblog->delete_status = 'Active';
        $saveblog->cat_id = $request->cat_id;
        $saveblog->image = Cmf::sendimagetodirectory($request->image);
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Successfully Inserted');
    }
    public function blogs(Request $request)
    {
        $data = blogs::where('delete_status' ,'Active')->get();
        return view('admin.blogs.all')->with(array('data'=>$data));
    }
    public function blogcoments()
    {
        $data = DB::table('blogcoments')->where('delete_status' , 'Active')->orderby('created_at' , 'desc')->get();
        return view('admin.blogs.blogcoment')->with(array('data'=>$data));
    }
    public function editblogcoment($id)
    {
        $data = array('newstatus'=>'old');
        DB::table('blogcoments')->where('id' , $id)->update($data);
        $data = DB::table('blogcoments')->where('id' , $id)->get()->first();
        return view('admin.blogs.editblogcoment')->with(array('data'=>$data));
    }
    public function updateblogcoment(Request $request)
    {
        $data = array('coment'=>$request->coment,'visible_status'=>$request->visible_status);
        DB::table('blogcoments')->where('id' , $request->id)->update($data);
        return redirect()->back()->with('message', 'Comment Updated Successfully');
    }
    public function deleteblogcoment($id)
    {
        DB::table('blogcoments')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Comment Deleted Successfully');
    }
    public function deleteblogcomentreply($id)
    {
        DB::table('comentreply')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Comment Reply Deleted Successfully');
    }
    public function deleteblog($id)
    {
        $data = blogs::where('id', $id)->get()->first();
        $array = array('delete_status'=>'Delete');
        blogs::where('id', $id)->update($array);
        return redirect()->back()->with('message', 'Blog Delete Successfully');
    }
    public function deleteblogtrash($id)
    {
        blogs::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Blog Delete Successfully');
    }
    public function editblog($id)
    {
        $data = blogs::where('id' ,$id)->get()->first();
        return view('admin.blogs.edit-blog')->with(array('data'=>$data));
    }
    public function updateblog(Request $request)
    {
        $saveblog = blogs::find($request->id);
        $saveblog->name = $request->name;
        $saveblog->url = $request->slug;
        $saveblog->blog = $request->content;
        $saveblog->visible_status = $request->visible_status;
        $saveblog->delete_status = 'Active';
        $saveblog->visible_status = 'Published';
        $saveblog->cat_id = $request->cat_id;
        if($request->image)
        {
            $saveblog->image = Cmf::sendimagetodirectory($request->image);
        }
        $saveblog->save();
        return redirect()->back()->with('message', 'Blog Updated Successfully');
    }


    public function userdetail($id)
    {
        $data = User::find($id);
        return view('admin.users.userdetail')->with(array('data'=>$data));
    }

    // Notification


    public function shownotification()
    {
        $data = DB::table('adminnotification')->where('status' , 1)->orderby('id' , 'desc')->limit(10)->get();

        foreach ($data as $r) {
            echo '<a onclick="statuschange('.$r->id.')" target="_blank" href="'.$r->url.'" class="dropdown-item notify-item">
        <div class="notify-icon bg-primary">
            '.$r->icon.'
        </div>
        <p class="notify-details">'.$r->notification.'
            <small class="text-muted">'.$r->created_at.'</small>
        </p>
    </a>';
        }
    }

    public function updateprofilestatus(Request $request)
    {
        $update = User::find($request->id);
        $update->active = $request->status;
        $update->save();
        Mail::send('frontend.email.statuschange', ['email' => $update->email , 'name' => $update->name, 'status' => $request->status], function($message) use($update){
              $message->to($update->email);
              $message->subject('Profile Status Is Changed');
        });
        return redirect()->back()->with('message', 'Status Updated Successfully');

    }

    public function getadminnotification()
    {
        $data = DB::table('adminnotification')->where('status' , 1)->where('alertstatus' , 1)->orderby('id' , 'desc')->get()->first();
        DB::table('adminnotification')->where('status' , 1)->where('alertstatus' , 1)->orderby('id' , 'desc')->update(array('alertstatus'=>0));
        if($data)
        {
            echo $data->notification;
        }
    }
    public function allreviews()
    {
        $data = product_reviews::all();
        return view('admin.ecommerece.reviews.index')->with(array('data'=>$data));
    }
    public function reviewdetail($id)
    {
        $data = product_reviews::where('id' , $id)->get()->first();
        return view('admin.ecommerece.reviews.detail')->with(array('data'=>$data));
    }


    public function changereviewstatus(Request $request)
    {
        $review = product_reviews::find($request->reviewid);
        $review->status = $request->status;
        $review->stars = $request->stars;
        $review->review = $request->review;
        $review->save();
        return redirect()->back()->with('message', 'Status Updated Successfully');
    }


    // All Tickets

    public function alltickets()
    {
        $data = tickets::where('type', 'vendor')->orderby('id' , 'desc')->paginate(10);
        return view('admin.tickets.alltickets')->with(array('data'=>$data));
    }


    public function submitticketreply(Request $request)
    {
        $input = $request->all();
        $ticket = new ticketreplies;
        $ticket->ticket_id = $input['id'];
        $ticket->user_id = Auth::user()->id;
        $ticket->reply = $input['query'];
        $ticket->status = 1;
        $ticket->new = 1;
        $ticket->save();
        return redirect()->back()->with('message', 'Ticket Reply Successfully');
    }

    public function changeticktstatus(Request $request)
    {
        $ticket = tickets::find($request->id);
        $ticket->status = $request->status;
        $ticket->save();
        return redirect()->back()->with('message', 'Ticket Status Changed Successfully');
    }


    public function viewticket($id)
    {
        $ticket = tickets::where('id' , $id)->get()->first();
        $ticketreplies = ticketreplies::where('ticket_id' , $id)->orderby('id' , 'asc')->get();
        return view('admin.tickets.detail')->with(array('ticket'=>$ticket,'ticketreplies'=>$ticketreplies));
    }




    // Menues


     public function menueview(){
        $menus = Menu::where('parent_id', '=', 0)->get();
        $allMenus = Menu::all();
        return view('admin.menu.menuTreeview',compact('menus','allMenus'));
    }

    public function menuestore(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'url' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Menu::create($input);
        return back()->with('message', 'Menu added successfully.');
    }

    public function updatemenu(Request $request)
    {
        $menu = Menu::find($request->id);
        $menu->title = $request->title;
        $menu->url = $request->url;
        $menu->parent_id = $request->parent_id;
        $menu->save();
        return back()->with('message', 'Menu Updated successfully.');
    }

    public function getmenu($id)
    {
        $data = Menu::where('id' , $id)->get()->first();

        $allMenus = Menu::all();

        echo '<input type="hidden" name="id" value="'.$id.'" class="form-control">  <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label>Title</label>
                 <input type="text" value="'.$data->title.'" name="title" class="form-control">   
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label>Url</label>
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">'.url('').'</span>
                    </div>
                    <input value="'.$data->url.'" type="text" class="form-control" name="url" placeholder="Enter URL">
                  </div>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
              <div class="form-group">
                 <label>Parent</label>
                 <select class="form-control" name="parent_id">
                    <option selected disabled>Select Parent Menu</option>';

                    foreach($allMenus as $r)
                    {

                       echo '<option ';



                       if($data->parent_id != 0)
                       {


                            if($data->parent_id == $r->id)
                            {
                                echo "selected";
                            }



                       }
                            





                         echo ' value="'.$r->id.'">'.$r->title.'</option>';
                    }
            
                echo '</select>
              </div>
           </div>
        </div>
        <div class="row">
           <div class="col-md-12">
              <button type="submit" class="btn btn-success">Update</button>
           </div>
        </div>';
    }




    // Attributes


    public function addattributes()
    {
        return view('admin.ecommerece.attributes.add');
    }


    public function attributes_list()
    {   
        $attributes = global_attributes::select(
            "global_attributes.id",
            "global_attributes.name",
            "global_attributes.values",
            "global_attributes.status")
            ->paginate(10);
        return view('admin.ecommerece.attributes.all',compact("attributes"));
    }

    public function editattributes($id)
    {   
        
        $attributes = global_attributes::find($id); 
        $attributes->values = explode(',', $attributes->values);      
        return view('admin.ecommerece.attributes.edit',compact("attributes"));
    }



    public function store_attributes(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[ 
            'name'  => 'required',
            'attribute_name'  => 'required',
        ]);

        if($validator->fails())
        return redirect()->back()->with('errors', $validator->errors()); 
        $attributes = new global_attributes;
        $attributes->name = $input['name'];
        $attributes->values = implode(',', $input['attribute_name']);
        $attributes->status = 1;
        $created = $attributes->save();
        if($created)
        {
            return redirect()->back()->with('message', 'Attribute Added Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        } 
    }

    public function updateattributes(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[ 
            'name'  => 'required',
            'attribute_name'  => 'required',
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 

        $attributes = global_attributes::find($input['id']);
        $attributes->name = $input['name'];
        $attributes->values = implode(',', $input['attribute_name']);
        $attributes->status = 1;
        $created = $attributes->save();
        if($created)
        {
            return redirect()->back()->with('message', 'Attribute Updated Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        } 
    }



    // Earnings Module

    public function totalearning()
    {
        $data = payments::all();
        return view('admin.earnings.totalearning')->with(array('data'=>$data));
    }


    public function viewearning($id)
    {
        $data = payments::find($id);
        return view('admin.earnings.view')->with(array('data'=>$data));
    }
    public function refund(Request $request)
    {

        $stripe = new \Stripe\StripeClient(
          "".Cmf::get_site_settings_by_colum_name('secret_stripe').""
        );
        $response = $stripe->paymentIntents->create([
          'amount' => '1000',
          'currency' => 'usd',
          'payment_method_types' => ['card'],
        ]);


        print_r($response);
        exit;

        $data = payments::find($request->charge_id);
        $stripe = new \Stripe\StripeClient(Cmf::get_site_settings_by_colum_name('secret_stripe'));
        $stripe->refunds->create(
          ['payment_intent' => 'ch_3Kr1JOIoZddv8maD1dwRNxlU', 'amount' => 1000]
        );
    }


    // Contact Us MEssages
    public function allcontactmessages()
    {
        $data = DB::table('contactuses')->get();
        return view('admin.contact.allmessages')->with(array('data'=>$data));
    }
    public function contactview($id)
    {
        $data2 = array('status'=>0);
        DB::table('contactuses')->where('id' , $id)->update($data2);
        $data = DB::table('contactuses')->where('id',$id)->get()->first();
        return view('admin.contact.view')->with(array('data'=>$data));
    }
    public function deletecontactus($id)
    {
        DB::table('contactuses')->where('id',$id)->delete();
        return redirect()->back()->with('message', 'Deleted Successfully');
    }


    public function newsletter()
    {
        $data = newsletters::all();
        return view('admin.newsletters.index')->with(array('data'=>$data));
    }


    public function sendemailsnewsletters(Request $request)
    {
        $subject = $request->subject;
        $emailbody = $request->emailbody;
        foreach ($request->allemails as $email) {
            Mail::send(array('html' => 'frontend.email.newsletteremail'), array('emailbody' => $request->emailbody), function($message) use ($email, $subject)
            {
                $message->to($email)->subject($subject);
            });
        }
        return redirect()->back()->with('message', 'Mails Sended Successfully');
    }


    // Coupens


    public function coupon_list()
    {   
        $coupons = Coupon::select(
            "coupons.id",
            "coupons.end_date",
            "coupons.start_date",
            "coupons.coupon_code",
            "coupons.discount") 
            ->paginate(10);
         
        return view('admin.coupen.list',compact("coupons"));
    }
    public function addcoupon(Request $request)
    {   
        return view('admin.coupen.add');

    }

    public function editcoupon($id)
    {   
        $coupon = Coupon::find($id);
        return view('admin.coupen.edit',compact("coupon"));

    }

    public function store_coupon(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[ 
            'date_range'  => 'required',
            'coupon_code'  => 'required',
            'discount'  => 'required',
          
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 
    
        $dates = explode('-', $input['date_range']);
        $coupon = new Coupon;
        $coupon->start_date = $dates[0];
        $coupon->end_date = $dates[1];
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->discount = $input['discount'];
        $created = $coupon->save();

        if($created)
        {
            return redirect()->back()->with('message', 'Coupon Added Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        }
    }


    public function update_coupon(Request $request)
    {
        $input = $request->all();

        //dd($input);

        $validator = Validator::make($input,[ 
            'date_range'  => 'required',
            'coupon_code'  => 'required',
            'discount'  => 'required',
          
        ]);

        $coupon = Coupon::find($input['id']);
        $dates = explode('-', $input['date_range']);
        //$coupon = new Coupon;
        $coupon->start_date = $dates[0];
        $coupon->end_date = $dates[1];
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->discount = $input['discount'];
        $created = $coupon->save();

        if($created)
        {
            return redirect()->back()->with('message', 'Coupon Updated Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        }
    }
    public function notifications()
    {
        $data = DB::table('adminnotification')->orderby('id' , 'desc')->paginate(10);
        return view('admin.notification.index')->with(array('data'=>$data));
    }
    public function statuschange($id)
    {
        $array = array('status'=>0);
        $data = DB::table('adminnotification')->where('id' , $id)->update($array);
    }


    public function allorders(){
        $orders = order::all();
        return view('admin.orders.allorders')->with(array('orders'=>$orders));
    }
}