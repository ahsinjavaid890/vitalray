<?php

namespace App\Http\Controllers;


use App\Models\order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Session;
use Stripe; 

class stripeController extends Controller
{
    public function stripePost(Request $request)
    {
        $product_id = $request['product_id'];
        $price = $request['price'];

        $request->total;
        Stripe\Stripe::setApiKey("sk_test_51Mdt8dFlScBLb25b16dvjbg0ACx5BjqcxF34yowethXJcCGCIfihaygF4GJQStLj9fYiu8WIIkuUSwig8JrZHlED00X4tEJWrY");
    
        $charge = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);
      
        $paymenyResponse = $charge->jsonSerialize();

            echo "<pre>";
            print_r($paymenyResponse);
            die;


            // check whether the payment is successful
            if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {


                $order = new order();
                // $payment = new payment();


                $order->name = $request['name'];
                $order->email = $request['email'];
                $order->address = $request['address'];
                $order->product_id =  $product_id;
                $order->qty =  1;
                $order->total_price = $price;
                $order->payment_type = "stripe";
                $order->payment_status = "succeeded";
                $order->save();
                $lastinsertedId = $order->id;

                // transaction details 
                //  $balanceTransaction = $paymenyResponse['balance_transaction'];
                //  $paidCurrency = $paymenyResponse['currency'];
                //  $paymentStatus = $paymenyResponse['status'];
                    // $charge_id = paymenyResponse['id'];

                //  $payment->order_id = $lastinsertedId;
                //  $payment->txn_id = $balanceTransaction;
                //  $payment->amount = $price;
                //  $payment->currency = $paidCurrency;
                //  $payment->status = $paymentStatus;
                //  $payment->save();


                Session::flash('success', 'Payment Successfull!, Your order has been placed');
                return response()->redirectTo('/');
            }
    }
}
