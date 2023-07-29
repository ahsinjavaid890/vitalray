<?php

namespace App\Http\Controllers\Api\V1;
use App\Helpers\Cmf;
use App\CentralLogics\Helpers;
use App\CentralLogics\OrderLogic;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\Product;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\addtocart;
use App\Models\orderstatus;
use Carbon\Carbon;
use Auth;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function track_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        return response()->json(OrderLogic::track_order($request['order_id']), 200);
    }

    public function place_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'cart_id' => 'required',
            'address_id' => 'required',
            'payment_method' => 'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        try {
        
            $previusorder =   DB::table('orders')->orderby('id' , 'DESC')->get()->first();
            if(!empty($previusorder))
            {
                $order_number = $previusorder->order_number+1;
            }else{
                $order_number = 1;
            }

            $order = new orders;
            $order->order_number = $order_number;
            $order->customer_id = $request->user_id;
            $order->status = 'payementpending';
            $order->addres_id = $request->address_id;
            $order->payment_method = $request->payment_method;
            $order->ordernotes = $request->ordernotes;
            $order->save();
            $cart = DB::table('addtocarts')->where('user_cart_id' , $request->cart_id)->get();
            $subtotal = 0;
            foreach ($cart as $r) {
                $productid = $r->product_id;
                $quantity = $r->quantity;
                $product = DB::table('products')->where('id' , $productid)->get()->first();

                if(!empty($product->discount_price))
                {
                    $price = $product->discount_price;
                }else{
                    $price = $product->sale_price;
                }
                if(Cmf::get_store_value('vat_value') != 0)
                {
                    if(Cmf::get_store_value('vat_percentage') == 1)
                    {
                        $getpercentagevat = $price*Cmf::get_store_value('vat_value');
                        $vat = $getpercentagevat/100;
                    }
                    else
                    {
                        $vat = Cmf::get_store_value('vat_value');
                    }
                }
                if(Cmf::get_store_value('sale_value') != 0)
                {
                    if(Cmf::get_store_value('sale_percentage') == 1)
                    {
                        $getpercentagevat = $price*Cmf::get_store_value('sale_value');
                        $sale_value = $getpercentagevat/100;
                    }
                    else
                    {
                        $sale_value = Cmf::get_store_value('sale_value');
                    }
                }
                $total_price = $price+$sale_value+$vat;
                $orderdetails = new orderdetails;
                $orderdetails->order_id = $order->id;
                $orderdetails->product_id = $productid;
                $orderdetails->quantity = $quantity;
                $orderdetails->price = $quantity*$total_price;
                $orderdetails->users = $product->vendor_id;        
                $orderdetails->save();

                if(DB::table('addtocartvariations')->where('addtocarts' , $r->id)->count() > 0)
                {
                    $variations = DB::table('addtocartvariations')->where('addtocarts' , $r->id)->get();
                    foreach ($variations as $r) {
                       parse_str($r->variations);
                       $insertarray = array('main_variation' => $mainvariation,'variation_name' => $value,'orderdetails' => $orderdetails->id);
                       DB::table('order_variations')->insert($insertarray);
                    }
                }

                $subtotal += $price*$quantity;
            }
            if(Cmf::get_store_value('vat_value') != 0)
            {
                if(Cmf::get_store_value('vat_percentage') == 1)
                {
                    $getpercentagevat = $subtotal*Cmf::get_store_value('vat_value');
                    $vat = $getpercentagevat/100;
                }
                else
                {
                    $vat = Cmf::get_store_value('vat_value');
                }
            }
            if(Cmf::get_store_value('sale_value') != 0)
            {
                if(Cmf::get_store_value('sale_percentage') == 1)
                {
                    $getpercentagevat = $subtotal*Cmf::get_store_value('sale_value');
                    $sale_value = $getpercentagevat/100;
                }
                else
                {
                    $sale_value = Cmf::get_store_value('sale_value');
                }
            }
            $total = $subtotal+$sale_value+$vat;
            $updateorder = orders::find($order->id);
            $updateorder->sub_total = $subtotal;
            $updateorder->vat_tax = $vat;
            $updateorder->sale_tax = $sale_value;
            $updateorder->grand_total = $total;
            $updateorder->save();
            foreach ($cart as $r) {
                DB::table('addtocartvariations')->where('addtocarts' , $r->id)->delete();
            }
            DB::table('addtocarts')->where('user_cart_id' , $request->cart_id)->delete();
            $data['orderid'] = $order->id;
            $data['status'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([$e], 403);
        }
    }

    public function get_order_list($id)
    {
        try {
            
            $orderdetails = orderdetails::select(
            "orderdetails.order_id",
            "orderdetails.product_id",
            "orderdetails.quantity",
            "orderdetails.price",
            "products.title",
            "products.product_img",
            "orders.customer_id",
            "orders.status",
            "orders.id as order_parent_id")
            ->leftJoin('products', 'orderdetails.product_id', '=', 'products.id')
            ->leftJoin('orders', 'orderdetails.order_id', '=', 'orders.id')
            ->where('orders.customer_id' ,$id)
            ->where('orders.payment_status' ,1)
            ->orderby('orders.id' ,'desc')
            ->paginate(5);


            $data['orderdetails'] = $orderdetails;
            $data['status'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
        
    }


    public function stripepayement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderid' => 'required',
            'stripeToken' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }

        
        $price = orders::where('id' , $request->orderid)->sum('grand_total');
        $totalprice = round($price);
        Stripe\Stripe::setApiKey(Cmf::get_site_settings_by_colum_name('secret_stripe'));
        $payement = Stripe\Charge::create ([
                "amount" => $totalprice,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
        if(!empty($payement->id))
        {
            $order = orders::find($request->orderid);
            $order->payment_status = 1;
            $order->payement_id = $payement->id;
            $order->status = 'completed';
            $order->save();
            Session::forget('cart');
            
            $allproducts = orderdetails::where('order_id' , $request->orderid)->get();
            foreach ($allproducts as $r) {
                $this->stockdeduct($r->product_id , $r->quantity);
                $commission_value = Cmf::get_store_value('vendor_commission');
                $price = $r->price;
                $total = $price*$commission_value;
                $get_percentage = $total/100;
                $wallet_amt = $price-$get_percentage;
                $reason  = 'The Rs '.$get_percentage.' Ammount Is Deducted According the Buy786.com Vendor Commission Policy';
                Cmf::add_user_walet_ammount($r->users,$r->order_id,$r->id,$wallet_amt,$reason);
            }
            // Save Admin Notification
            $notification = Auth::user()->name.' Place New Order';
            $url = url('admin/ecommerece/orderdetail/').'/'.$request->orderid;
            $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
            Cmf::save_admin_notification($notification , $url , $icon);
            // Save Vendor Notification
            $notification = Auth::user()->name.' Place New Order';
            $vendorurl = url('vendor/orders/orderdetail/').'/'.$request->orderid;
            $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
            Cmf::save_vendor_notification($notification , $vendorurl , $icon);
            // Save My Shop Notification
            $url = url('ordercomplete').'/'.$request->orderid;
            return response()->json(['message' => trans('custom.payement_successfully')], 200);
        }
        else
        {
            return response()->json([
            'errors' => [
                    ['code' => 'stripepayement', 'message' => trans('Error')]
                ]
            ], 401);
        }   
    }




    public function get_order_details($id)
    {

        $details = orderdetails::where('order_id' , $id)->get();
        if ($details->count() > 0) {
            return response()->json($details, 200);
        } else {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => trans('custom.no_data_found')]
                ]
            ], 401);
        }
    }

    public function cancel_order(Request $request)
    {
        if (Order::where(['user_id' => $request->user()->id, 'id' => $request['order_id']])->first()) {
            Order::where(['user_id' => $request->user()->id, 'id' => $request['order_id']])->update([
                'order_status' => 'canceled'
            ]);
            return response()->json(['message' => trans('custom.order_canceled')], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => trans('custom.no_data_found')]
            ]
        ], 401);
    }

    public function update_payment_method(Request $request)
    {
        if (Order::where(['user_id' => $request->user()->id, 'id' => $request['order_id']])->first()) {
            Order::where(['user_id' => $request->user()->id, 'id' => $request['order_id']])->update([
                'payment_method' => $request['payment_method']
            ]);
            return response()->json(['message' => trans('custom.payment_method_updated')], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => trans('custom.no_data_found')]
            ]
        ], 401);
    }



    public function addtocart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_cart_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }
        $addtocart = new addtocart;
        $addtocart->product_id = $request->product_id;
        $addtocart->quantity = $request->quantity;

        if(isset($request->selected_variation))
        {
            $addtocart->selected_variations = $request->selected_variation;
        }

        $addtocart->user_cart_id = $request->user_cart_id;   
        $addtocart->save();
        if(isset($request->selected_variation))
        {
           foreach (explode('|', $request->selected_variation) as $r) {
               $insertarray = array('addtocarts' => $addtocart->id,'variations' => $r);
               DB::table('addtocartvariations')->insert($insertarray);
           }
        }
        if($addtocart)
        {
            return response()->json(['message' => trans('custom.addtocartsuccessfully')], 200);
        }else{
            return response()->json([
            'errors' => [
                    ['code' => 'addtocart', 'message' => trans('custom.no_data_found')]
                ]
            ], 401);
        }
    }


    public function updatecart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }

        

        $addtocart = addtocart::find($request->cart_id);
        $addtocart->quantity = $request->quantity;
        $addtocart->save();
        if($addtocart)
        {
            return response()->json(['message' => trans('custom.Updated Successfully')], 200);
        }else{
            return response()->json([
            'errors' => [
                    ['code' => 'addtocart', 'message' => trans('custom.no_data_found')]
                ]
            ], 401);
        }
    }


    public function addtocartlist($id)
    {
    
        try {
            
            $cartdata = addtocart::select(
            "addtocarts.id",
            "addtocarts.user_cart_id",
            "addtocarts.product_id",
            "addtocarts.quantity",
            "addtocarts.selected_variations",
            "products.sale_price",
            "products.discount_price")
            ->leftJoin('products', 'addtocarts.product_id', '=', 'products.id')  
            ->where('addtocarts.user_cart_id' ,$id)
            ->get();


            $data['cartdata'] = $cartdata;
            $data['status'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


    public function removefromcart(Request $request)
    {
        foreach (explode(',' , $request->cartids) as $r) {
            $cart = addtocart::where('id' , $r)->get()->first();
            if($cart)
            {
                DB::table('addtocartvariations')->where('addtocarts' , $r)->delete();
                addtocart::where('id' , $r)->delete();
            }
        }

        $cartdata = addtocart::select(
        "addtocarts.id",
        "addtocarts.user_cart_id",
        "addtocarts.product_id",
        "addtocarts.quantity",
        "addtocarts.selected_variations",
        "products.sale_price",
        "products.discount_price")
        ->leftJoin('products', 'addtocarts.product_id', '=', 'products.id')  
        ->where('addtocarts.user_cart_id' ,$request->user_cart_id)
        ->get();
        $data['cartdata'] = $cartdata;
        $data['status'] = true;
        return response()->json($data, 200);     
    }
}
