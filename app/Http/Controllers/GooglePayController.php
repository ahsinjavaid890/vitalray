<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class GooglePayController extends Controller
{
    public function payment(Request $request)
    {
        $googlePay = json_decode($request['data']['paymentMethodData']['tokenizationData']['token'], true);
       
        $order = new order();
        $order->name = $request['name'];
        $order->email = $request['email'];
        $order->phonenumber = $request['phonenumber'];
        $order->zipcode = $request['zipcode'];
        $order->city = $request['city'];
        $order->state = $request['state'];
        $order->address = $request['address'];
        // $order->product_id = $product_id;
        $order->qty =  1;
        // $order->total_price = $price;
        $order->payment_type = "Google Pay";
        $order->payment_status = "succeeded";
        $order->save();
        if ($order->save()) {
            return response(['success' => true, 'url' => 'success']);
        } else {
            return response(['success' => false]);
        }
    }
}
