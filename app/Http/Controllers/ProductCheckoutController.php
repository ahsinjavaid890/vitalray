<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\user;
use App\Models\subscriptions;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductCheckoutController extends Controller
{
    public function __construct()
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    public function sendcheckoutpayementpaypal(Request $request)
    {
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
        $order->payment_status = "pending";
        $order->save();

        Session::put('order_id', $order->id);

        $totalprice = round($request->price + 4);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Product 1')->setCurrency('USD')->setQuantity(1)->setPrice($totalprice);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($totalprice);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Enter Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypalcheckout'))->setCancelUrl(URL::route('paypalcheckout'));
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {


                



            } else {


               



            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('warning', 'Unknown error occurred');
        $url = url('confirm');
        return Redirect::to($url);
    }


    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('warning', 'Payment failed due to panga');
            $url = url('stepthree');
            return Redirect::to($url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $order_id = Session::get('order_id');
            $order = order::find($order_id);
            $order->payment_status = "succeded";
            $order->save();
            return response()->redirectTo('success')->with('success','Payment Successfull!');
        } else {
            \Session::put('warning', 'Payment failed due to very very panga !!');
            $orderid = Session::get('orderid');
            $url = url('stepthree');
            return Redirect::to($url);
        }
    }
}
