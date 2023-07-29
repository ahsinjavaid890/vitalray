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

    public function checkmobile()
    {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
        {
            return 'mobile';
        }else{
            return 'desktop';
        }
    }



    public static function updatevalue($columname , $value)
    {
      $array = array($columname=>$value);
      DB::table('site_settings')->update($array);
    }
    public static function online()
    {
        $user = User::find(Auth::user()->id);
        $user->online = 1;
        $user->save();
    }
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
    public static function get_store_value($value)
    {
        return DB::table('site_settings')->where('id' , 1)->get()->first()->$value;
    }

    public static function save_media_image($image , $type , $user_id)
    {
        $mediaimages = new mediaimages();
        $mediaimages->user_id = $user_id;
        $mediaimages->images = $image;
        $mediaimages->type = $type;
        $mediaimages->save();
        $user = User::find($user_id);
        $uploaded_photos = $user->uploaded_photos;
        $user->uploaded_photos = $uploaded_photos+1;
        $user->save();
    }

    public static function get_uservalue($id)
    {
        if(session()->get('user_id_temp'))
        {
            return User::where('id' , session()->get('user_id_temp'))->get()->first()->$id;
        }
    }


    public static function paginate()
    {
        return 10;
    }

    public static function date_format($data)
    {
        return date('d M Y', strtotime($data));
    }

    public static function changenewstatus($tablename , $id)
    {
        DB::table($tablename)->where('id' , $id)->update(array('new'=>1));
    }

    public static function add_user_walet_ammount($user_id , $order_id ,$order_detail_id ,  $wallet_amt , $reason)
    {
        $date = date('Y-m-d h:s');
        DB::statement("INSERT INTO `wallet_table` (`user_id`, `order_id`, `order_detail_id`, `wallet_amt`, `reason`, `status`, `created_at`)VALUES ('$user_id', '$order_id', '$order_detail_id', '$wallet_amt', '$reason' ,'onhold' , '$date')");
    }


    public function wallet_withdraw($user_id, $request_payment , $transaction_status , $status)
    {
        $data = array('user_id' =>$user_id , 'amount' =>$request_payment, 'transaction_status' =>$transaction_status, 'status' =>$status);
        DB::table('wallet_withdraw')->insert($data);
    }



    public static function changeorderstatus($id , $status)
    {

        $order = orders::find($id);
        $order->status = $status;
        $order->save();
        $data = DB::table('orderstatuses')->where('order_id' , $id)->where('status' , $status)->count();
        if($data == 0)
        {
            $newstatus = new orderstatus;
            $newstatus->order_id = $id;
            $newstatus->status = $status;
            $newstatus->save();
        }
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

    public static function updatedimage($id)
    {
        $user = user::find(Auth::user()->id);
        $user->imagesupload = $id;
        $user->save();
    }



    public static function checkplanavailability($id)
    {
        $user = Auth::user();
        $imagesupload = $user->imagesupload;
        $selectedplan = $user->selectplan;
        $checkavailableimages = DB::table('subscriptionplans')->where('id' , $selectedplan)->get()->first()->places_allowed;
        $total = $imagesupload+$id;
        if($checkavailableimages >= $total)
        {
            return 'yes';
        }else{
            return 'not';
        }
    }
    public static function sendemail()
    {
        
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
    public static function save_image_name($tablename ,$columname , $columid , $imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $date = date('Y-m-d h:m:s');
        $userid = auth()->user()->id;
        DB::statement("INSERT INTO `$tablename` (`$columname`, `image_name`, `image_status`, `added_by`, `created_at`)VALUES ('$columid', '$filename', 'Active', $userid , '$date')");
    }
    public static function get_image_name($tablename ,$columname , $columid)
    {
        return DB::table($tablename)->where($columname , $columid)->get();
    }
    public static function save_admin_notification($notification , $url , $icon)
    {
        DB::statement("INSERT INTO `adminnotification` (`notification`, `url`, `icon`, `status`, `alertstatus`)VALUES ('$notification', '$url', '$icon', '1', '1')");
    }

    public static function save_vendor_notification($notification , $url , $icon, $vendor_id)
    {
        DB::statement("INSERT INTO `vendornotification` (`notification`, `url`, `icon`, `status`,  `vendor_id`,`alertstatus`)VALUES ('$notification', '$url', '$icon', '1','$vendor_id', '1')");
    }
    public static function checkuserrolparent($id)
    {
        $roleid = Auth::user()->role_id;
        return DB::table('rolesparent')->where('userroles' , $roleid)->where('parentid' , $id)->count();
    }
    public static function checkuserrolchild($id)
    {
        $roleid = Auth::user()->role_id;
        return DB::table('childroles')->where('role' , $roleid)->where('module' , $id)->count();
    }


    public static function delete_common_function($tablename , $columname , $id)
    {
        $data = array('delete_status'=>'Delete');
        DB::table($tablename)->where($columname , $id)->update($data);
    }
}
