<?php

namespace App\Http\Controllers;


use App\Models\order;
use App\Models\payments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Session;
use Stripe; 

class stripeController extends Controller
{
    public function success(){
        return view('frontend.checkout.success');
    }
    public function stripePost(Request $request)
    {
        $product_id = $request['product_id'];
        $price = $request['price'];

        $request->total;
        Stripe\Stripe::setApiKey("sk_test_xGtUq0Ocmz3drfEP0TOftndI005V9FjVqF");
    
        $charge = Stripe\Charge::create ([
                "amount" => $price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);
      
        $paymenyResponse = $charge->jsonSerialize();

            // echo "<pre>";
            // print_r($paymenyResponse);
            // die;


            // check whether the payment is successful
            if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {


                $order = new order();
                $payment = new payments();


                $order->name = $request['name'];
                $order->email = $request['email'];
                $order->phonenumber = $request['phonenumber'];
                $order->zipcode = $request['zipcode'];
                $order->city = $request['city'];
                $order->state = $request['state'];
                $order->address = $request['address'];
                $order->product_id =  $product_id;
                $order->qty =  1;
                $order->total_price = $price;
                $order->payment_type =  $paymenyResponse['calculated_statement_descriptor'];
                $order->payment_status = $paymenyResponse['status'] ;
                $order->order_status = "Pending";
                $order->new_status =  "1";
                $order->save();
                $lastinsertedId = $order->id;

                // transaction details 
                 $balanceTransaction = $paymenyResponse['balance_transaction'];
                 $paidCurrency = $paymenyResponse['currency'];
                 $paymentStatus = $paymenyResponse['status'];
                 $charge_id = $paymenyResponse['id'];

                 $payment->order_id = $lastinsertedId;
                 $payment->charge_id = $charge_id;
                 $payment->txn_id = $balanceTransaction;
                 $payment->amount = $price;
                 $payment->currency = $paidCurrency;
                 $payment->description = $paymenyResponse['description'];
                 $payment->refunded_amount = $paymenyResponse['amount_refunded'];
                 $payment->status = $paymentStatus;
                 $payment->save();

                // Session::flash('success', 'Payment Successfull!, Your order has been placed');
                return response()->redirectTo('/success')->with('success','Payment Successfull!');
            }else{
                Session::flash('error', 'Payment Unsuccessfull');
                return redirect()->back();
            }
    }
}
