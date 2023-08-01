<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Plan;
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
use Session;
use DB;
use URL;
use Mail; 
use Auth;
use Illuminate\Support\Facades\Redirect;
class PayPalController extends Controller
{
    public function __construct()
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }
    public function postPaymentWithpaypal($id)
    {
        $plan = DB::table('plans')->where('id' , $id)->get()->first();

        Session::put('plainid',$id);

        $totalprice = round($plan->price+4);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($totalprice);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($totalprice);
        $transaction = new Transaction();
        $transaction->setAmount($amount)->setItemList($item_list)
        ->setDescription('Enter Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));            
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('warning','Connection timeout');
                return Redirect::route('paywithpaypal'); 

                $url = url('stepthree');
                return Redirect::to($url);

            } else {
                \Session::put('warning','Some error occur, sorry for inconvenient');
                $url = url('stepthree');
                return Redirect::to($url);             
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {            
            return Redirect::away($redirect_url);
        }

        \Session::put('warning','Unknown error occurred');
        $url = url('payement').'/'.$request->orderid;
        return Redirect::to($url);
    }


    public function getPaymentStatus(Request $request)
    {        
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('warning','Payment failed due to panga');
            $url = url('stepthree');
            return Redirect::to($url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));        
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {         



            $plainid = Session::get('plainid');

            $plan = Plan::find($plainid);
            $update = User::find(Auth::user()->id);
            $update->plan = $plainid;
            $update->payement_method = 'paypal';
            $update->save();
            
            $user = Auth::user();
            $plandata = DB::table('plans')->where('id' , $plainid)->get()->first();
            $subject = 'Welcome To Vital Ray | Invoice for Purchasing Plan';
            Mail::send('frontend.email.invoice', ['name' => 'test','planname' => $plandata->name,'price' => $plandata->price,'places_allowed' => 1], function($message) use($user , $subject){
                  $message->to($user->email);
                  $message->subject($subject);
            });
            $next_due_date = date('d/m/Y', strtotime("+$plandata->no_of_days days"));
            $plan = new subscriptions();
            $plan->user_id = Auth::user()->id;
            $plan->name = $plandata->name;
            $plan->plan_id = $plainid;
            $plan->ends_at = $next_due_date;
            $plan->save();
            $url = url('conferm');
            return Redirect::to($url);



        }else{
            \Session::put('warning','Payment failed due to very very panga !!');
            $orderid = Session::get('orderid');
            $url = url('stepthree');
            return Redirect::to($url);
        }

        
    }
}