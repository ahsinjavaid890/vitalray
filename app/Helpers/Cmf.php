<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\orders;
use App\Models\orderdetails;
use App\Models\User;
use App\Models\mediaimages;
use App\Models\orderstatus;
use App\Models\usernotifications;
use Illuminate\Support\Facades\Http;
class Cmf
{
    public static function saveusernotfication($user_id,$notification,$url,$name,$type)
    {
        $noti = new usernotifications();
        $noti->user_id = $user_id;
        $noti->notification = $notification;
        $noti->read_status = 1;
        $noti->type = $type;
        $noti->url = $url;
        $noti->name = $name;
        $noti->save();
    }
    public static function checkstatusstripesubscription()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe_customer = $stripe->customers->retrieve(Auth::user()->stripe_id, [ 'expand' => ['subscriptions'] ]);

        if($stripe_customer->subscriptions->data)
        {
            return $stripe_customer->subscriptions->data[0]->status;
        }else{
            return 'cancel';
        }
        
        
    }
    public static function date_format($data)
    {
        return date('d M Y', strtotime($data));
    }

    
    public static function get_site_settings_by_colum_name($name)
    {
        return DB::table('site_settings')->where('id' , 1)->get()->first()->$name;
    }

    public static function get_store_settings($value)
    {
       $userid = auth()->user()->id;
       return DB::table('store_settings')->where('user_id' , $userid)->get()->first()->$value;
    }

    public static function currenturl()
    {
       return $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }


    public static function checkplanavailability()
    {
        $user = Auth::user();
        
    }

    public static function sendimagetodirectory($imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        return $filename;
    }
    public static function shorten_url($text)
    {
        $words = explode('-', $text);
        $five_words = array_slice($words,0,12);
        $String_of_five_words = implode('-',$five_words)."\n";

        $String_of_five_words = preg_replace('~[^\pL\d]+~u', '-', $String_of_five_words);
        $String_of_five_words = iconv('utf-8', 'us-ascii//TRANSLIT', $String_of_five_words);
        $String_of_five_words = preg_replace('~[^-\w]+~', '', $String_of_five_words);
        $String_of_five_words = trim($String_of_five_words, '-');
        $String_of_five_words = preg_replace('~-+~', '-', $String_of_five_words);
        $String_of_five_words = strtolower($String_of_five_words);
        if (empty($String_of_five_words)) {
          return 'n-a';
        }
        return $String_of_five_words;
    }
}
