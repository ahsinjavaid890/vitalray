<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\payments;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request){

        $product_id = $request['product_id'];
        $price = $request['price'];

        $order = new order();

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
        $order->payment_type = "Paypal";
        $order->payment_status = "succeeded";
        $order->save();

        return redirect()->route('processTransaction');

    }
    public function createTransaction()
    {
        return response()->redirectTo('/');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('createTransaction')->with('error', 'Something went wrong.');
        } else {
            return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('createTransaction')->with('success', 'Transaction complete.');
        } else {
            return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
