<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Validator;
use Auth;
use PDF;
use DB;
use Storage;
use Carbon;
use Stripe;
use Redirect;
class PlanController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $plans = Plan::get();
  
        return view("frontend.user.plans", compact("plans"));
    }  
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view("frontend.user.subscription", compact("plan", "intent"));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    {
        $plan = Plan::find($request->plan);
  
        $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
                        ->create($request->token);
  

        $update = User::find(Auth::user()->id);
        $update->plan = $request->plan;
        $update->payement_method = 'stripe';
        $update->save();

        $url = url('profile');
        return Redirect::to($url);
    }
}
