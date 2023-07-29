<?php

namespace App\Http\Controllers\Vendor;
use App\Helpers\Cmf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\user;
use App\Models\orderdetails;
use App\Models\orderstatus;
use App\Models\tickets;
use App\Models\ticketreplies;
use App\Models\product_reviews;
use Auth;
use DB;
use PDF;
use Storage;
class VendorController extends Controller
{
    //

    public function index()
    {
        $notifications = DB::table('vendornotification')->where('vendor_id' , Auth::user()->id)->paginate(10);
        return view('vendor.files.dashboard.index')->with(array('notifications'=>$notifications));
    }

   
    // Tickets

    public function alltickets()
    {
        $data = tickets::where('type' , 'vendor')->where('user_id' , Auth::user()->id)->paginate(10);
        return view('vendor.files.ticket.index')->with(array('data'=>$data));
    }


    public function submitticket(Request $request)
    {
        $input = $request->all();
        $ticket = new tickets;
        $ticket->type = "vendor";
        $ticket->user_id = Auth::user()->id;
        $ticket->query = $input['query'];
        $ticket->subject = $input['subject'];
        $ticket->status = "Open";
        $ticket->new = 1;
        $ticket->save();

        $notification = Auth::user()->name.' Open a New Ticket';
        $url = url('admin/tickets/viewticket/').'/'.$ticket->id;
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);
        return redirect()->back()->with('message', 'Ticket Open Successfully');
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

        $notification = Auth::user()->name.' Reply a Ticket';
        $url = url('admin/tickets/viewticket/').'/'.$input['id'];
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);
        return redirect()->back()->with('message', 'Ticket Reply Successfully');
    }


    public function viewticket($id)
    {
        $ticket = tickets::where('id' , $id)->get()->first();
        $ticketreplies = ticketreplies::where('ticket_id' , $id)->orderby('id' , 'asc')->get();
        return view('vendor.files.ticket.detail')->with(array('ticket'=>$ticket,'ticketreplies'=>$ticketreplies));
    }


    public function allorders()
    {
        $data = orderdetails::select(
            "orderdetails.order_id",
            "orderdetails.users",
            "orderdetails.newstatus",
            "orders.status",
            "orders.payment_method",
            "orders.created_at",
            "orders.id  as order_id",
            "orders.customer_id",
                  
                        )

            ->where('orderdetails.users'  ,Auth::user()->id)
            ->groupby('orderdetails.order_id')
            ->orderby('orders.id' , 'desc')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->get();
        $orderdetails = orderdetails::all();
        return view('vendor.files.orders.index')->with(array('data'=>$data,'orderdetails'=>$orderdetails));
    }

    public function ordersearch(Request $request)
    {

        $input = $request->all();


        $q = orderdetails::select(
            "orderdetails.order_id",
            "orderdetails.users",
            "orders.status",
            "orders.payment_method",
            "orders.created_at",
            "orders.id  as order_id",
            "orders.customer_id",
                  
                        );
        if ($input['orderid'])
        {
            $q->where('orders.id', $input['orderid']);  
        }
 if ($input['orderstatus'])
        {
       
            $q->where('orders.status', $input['orderstatus']);
        
        }
            $q->where('orderdetails.users'  ,Auth::user()->id);
            $q->groupby('orderdetails.order_id');
            $q->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id');
        $data = $q->get();
 
        $orderdetails = orderdetails::all();
        return view('vendor.files.orders.index')->with(array('data'=>$data,'orderdetails'=>$orderdetails));
    }


    public function orderdetail($id)
    {
        $data = array('newstatus' => 0);
        DB::table('orderdetails')->where('order_id' , $id)->update($data);
        $data  = orders::where('payment_status' , 1)->where('id' , $id)->get()->first();
        $orderdetails = orderdetails::select(
            "orderdetails.id",
            "orderdetails.order_id",
            "orderdetails.product_id",
            "orderdetails.quantity",
            "orderdetails.price",
            "orderdetails.users",
            "products.title",
            "products.url",
            "products.sale_price",
            "store_settings.shop_name",
                  
                        )
            ->leftJoin('products', 'orderdetails.product_id', '=', 'products.id')
            ->where('order_id' , $id)
            ->where('users' , Auth::user()->id)
            ->leftJoin('store_settings', 'orderdetails.users', '=', 'store_settings.user_id')
            ->get();

        $orderstatus = orderstatus::where('order_id' , $id)->get();
        $address = DB::table('user_addresses')->where('id'  , $data->addres_id)->get()->first();
        return view('vendor.files.orders.detail')->with(array('data'=>$data,'address'=>$address,'orderdetails'=>$orderdetails,'orderstatus'=>$orderstatus));
    }
    public function changeorderstatus($id , $status)
    {
       
        Cmf::changeorderstatus($id , $status);
        if($status == 'received')
        {
            $date = date('y-m-d');
            $data = array('status' => 'available','order_recieved_date'=>$date);
            DB::table('wallet_table')->where('order_id' , $id)->update($data);
            $available_after_day = Cmf::get_store_value('vendor_pending_to_approve');
            if($available_after_day == 0)
            {
                $notification = 'Your Payement for this Order is onhold to Approved you can Request for Withdraw.';
            }else{
                $notification = 'Your Payement for this Order is onhold to Pending.  After '.$available_after_day.' Days this Payement will be in your available';
            }
            $vendorurl = url('vendor/earnings/remaining');
            $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
            Cmf::save_vendor_notification($notification , $vendorurl , $icon , Auth::user()->id); 
            return redirect()->back()->with('message', 'Status Change Successfully.....'.$notification.'' );
        }
        return redirect()->back()->with('message', 'Status Change Successfully.....' );
    }


    public function downloadinvoice($id)
    {
        $orders = orders::where('payment_status' , 1)->where('id' , $id)->get()->first();
        if(!empty($orders))
        {
            $pdf = PDF::loadView('frontend.pdf.invoice', $orders);

            Storage::put('public/pdf/invoice.pdf', $pdf->output());

            return $pdf->download('Buy786( Order ID = '.$id.').pdf');
            
        }else{
            return response()->view('frontend.errors.404', [], 404);
        }
    }


    // Notification 


    public function shownotification()
    {
        $userid = Auth::user()->id;
        $data = DB::table('vendornotification')->where('vendor_id' , $userid)->where('status' , 1)->orderby('id' , 'desc')->limit(10)->get();

        foreach ($data as $r) {
            echo '<a target="_blank" href="'.$r->url.'" class="dropdown-item notify-item">
        <div class="notify-icon bg-primary">
            '.$r->icon.'
        </div>
        <p class="notify-details">'.$r->notification.'
            <small class="text-muted">'.$r->created_at.'</small>
        </p>
    </a>';
        }
    }

    public function getnotification()
    {
        $data = DB::table('vendornotification')->where('status' , 1)->where('alertstatus' , 1)->orderby('id' , 'desc')->get()->first();
        DB::table('vendornotification')->where('status' , 1)->where('alertstatus' , 1)->orderby('id' , 'desc')->update(array('alertstatus'=>0));
        if($data)
        {
            echo $data->notification;
        }
    }

    public function totalearnings()
    {
        $wallet = DB::table('wallet_table')->where('user_id' , Auth::user()->id)->get();
        $totalpayement = DB::table('orderdetails')->where('users' , Auth::user()->id)->get();
        $wallet_withdraw = DB::table('wallet_withdraw')->get();
        return view('vendor.files.earning.index')->with(array('wallet'=>$wallet,'totalpayement'=>$totalpayement,'wallet_withdraw'=>$wallet_withdraw));
    }
    public function earningspaid()
    {
        $wallet = DB::table('wallet_table')->where('user_id' , Auth::user()->id)->get();
        $orders = DB::table('orders')->where('payment_status' , 1)->get();
        $orderdetails = orderdetails::select(
            "orderdetails.id",
            "orderdetails.order_id",
            "orderdetails.product_id",
            "orderdetails.quantity",
            "orderdetails.price",
            "orderdetails.users",
            "products.title",
            "products.sale_price",
            "orders.customer_id",
            "store_settings.shop_name",
            "store_settings.user_id as seller_id",
            "orders.id as order_parent_id",
            "orders.payment_method",
                  
                        )
            ->leftJoin('products', 'orderdetails.product_id', '=', 'products.id')
            ->leftJoin('store_settings', 'orderdetails.users', '=', 'store_settings.user_id')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->leftJoin('users', 'orderdetails.users', '=', 'users.id')
            ->where('orderdetails.users' , Auth::user()->id)
            ->get();
        $totalpayement = DB::table('orderdetails')->where('users' , Auth::user()->id)->get();
        $wallet_withdraw = DB::table('wallet_withdraw')->get();
        return view('vendor.files.earning.paid')->with(array('orders'=>$orders,'orderdetails'=>$orderdetails,'wallet'=>$wallet,'totalpayement'=>$totalpayement,'wallet_withdraw'=>$wallet_withdraw));
    }
    public function earningsrequested()
    {
        $wallet = DB::table('wallet_table')->get();
        $orders = DB::table('orders')->where('payment_status' , 1)->get();
        $orderdetails = orderdetails::select(
            "orderdetails.id",
            "orderdetails.order_id",
            "orderdetails.product_id",
            "orderdetails.quantity",
            "orderdetails.price",
            "orderdetails.users",
            "products.title",
            "products.sale_price",
            "orders.customer_id",
            "store_settings.shop_name",
            "store_settings.user_id as seller_id",
            "orders.id as order_parent_id",
            "orders.payment_method",
                  
                        )
            ->leftJoin('products', 'orderdetails.product_id', '=', 'products.id')
            ->leftJoin('store_settings', 'orderdetails.users', '=', 'store_settings.user_id')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->leftJoin('users', 'orderdetails.users', '=', 'users.id')
            ->where('orderdetails.users' , Auth::user()->id)
            ->get();
        $totalpayement = DB::table('orderdetails')->where('users' , Auth::user()->id)->get();
        $wallet_withdraw = DB::table('wallet_withdraw')->get();
        return view('vendor.files.earning.requested')->with(array('orders'=>$orders,'orderdetails'=>$orderdetails,'wallet'=>$wallet,'totalpayement'=>$totalpayement,'wallet_withdraw'=>$wallet_withdraw));
    }
    public function earningsremaining()
    {
        $wallet = DB::table('wallet_table')->get();
        $orders = DB::table('orders')->where('payment_status' , 1)->get();
        $orderdetails = orderdetails::select(
            "orderdetails.id",
            "orderdetails.order_id",
            "orderdetails.product_id",
            "orderdetails.quantity",
            "orderdetails.price",
            "orderdetails.users",
            "products.title",
            "products.sale_price",
            "orders.customer_id",
            "store_settings.shop_name",
            "store_settings.user_id as seller_id",
            "orders.id as order_parent_id",
            "orders.payment_method",
                  
                        )
            ->leftJoin('products', 'orderdetails.product_id', '=', 'products.id')
            ->leftJoin('store_settings', 'orderdetails.users', '=', 'store_settings.user_id')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->leftJoin('users', 'orderdetails.users', '=', 'users.id')
            ->where('orderdetails.users' , Auth::user()->id)
            ->get();
        $totalpayement = DB::table('orderdetails')->where('users' , Auth::user()->id)->get();
        $wallet_withdraw = DB::table('wallet_withdraw')->get();
        return view('vendor.files.earning.remaining')->with(array('orders'=>$orders,'orderdetails'=>$orderdetails,'wallet'=>$wallet,'totalpayement'=>$totalpayement,'wallet_withdraw'=>$wallet_withdraw));
    }
    public function withdrawrequest(Request $request)
    {
        $total_earning = DB::table('wallet_table')->where('user_id' , Auth::user()->id)->sum('wallet_amt');
        $paid = DB::table('wallet_withdraw')->where('user_id' , Auth::user()->id)->where('transaction_status' , 'paid')->sum('amount');
        $requested = DB::table('wallet_withdraw')->where('user_id' , Auth::user()->id)->where('transaction_status' , 'requested')->sum('amount');
        if($request->requested_amt >  $total_earning)
        {
            if(Cmf::get_store_value('vendor_minimum_widthdraw') < $request->requested_amt)
            {
                return redirect()->back()->with('warning', 'You Request Minimum Rs'.Cmf::get_store_value('vendor_minimum_widthdraw').' according to Buy786 Vendor Withdraw Policy');
            }else{
                return redirect()->back()->with('warning', 'Requested Ammount is Bigger then your Earnings');
            }
            
        }else{
            if(Cmf::get_store_value('vendor_minimum_widthdraw') > $request->requested_amt)
            {
                return redirect()->back()->with('warning', 'You Request Minimum Rs'.Cmf::get_store_value('vendor_minimum_widthdraw').' according to Buy786 Vendor Withdraw Policy');
            }else{
                if($request->requested_amt > $total_earning-$requested)
                {
                    return redirect()->back()->with('warning', 'You Requested Already Rs'.$requested.' Your Remaining Balance is Less then your Requested Ammount');
                }else{
                    Cmf::wallet_withdraw(Auth::user()->id , $request->requested_amt , 'requested' , 'pending');
                    return redirect()->back()->with('message', 'Your Request Submited Successfully');
                }
            }
        }
    }
    public function reviewsall()
    {
        $data = product_reviews::select(
            "product_reviews.id",
            "product_reviews.product_id",
            "product_reviews.user_id",
            "product_reviews.review",
            "product_reviews.stars",
            "product_reviews.status",
            "products.vendor_id",
                  )
            ->leftJoin('products', 'product_reviews.product_id', '=', 'products.id')
            ->where('products.vendor_id' , Auth::user()->id)
            ->paginate();
        return view('vendor.files.reviews.all')->with(array('data'=>$data));
    }
    public function viewreview($id)
    {
         $data = product_reviews::where('id' , $id)->get()->first();
        return view('vendor.files.reviews.detail')->with(array('data'=>$data));
    }

    public function updateuserprofile(Request $request)
    {
        $user = user::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->country = $request->country;
        $user->state = $request->states;
        $user->zipcode = $request->zipcode;
        $user->website = $request->website;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        if(!empty($request->profileimage))
        {
            $user->profileimage = Cmf::sendimagetodirectory($request->profileimage);
        }
        $user->city = $request->city;
        $user->save();
        return redirect()->back()->with('message', 'Profile Updated Successfully');
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
