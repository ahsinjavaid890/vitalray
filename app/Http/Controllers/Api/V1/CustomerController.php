<?php

namespace App\Http\Controllers\Api\V1;
use App\Helpers\Cmf;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\CustomerAddress;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\PointTransitions;
use App\Models\user;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\user_addresses;
class CustomerController extends Controller
{
    public function address_list($id)
    {
        try {

            $userdetails = user_addresses::where('user_id' , $id)->get();
            return response()->json($userdetails, 200);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function add_new_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'addressname' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'country' => 'required',
            'state_id' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'streetaddress1' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => error_processor($validator)], 403);
        }

        $address = new user_addresses;
        $address->user_id = $request->user_id;
        $address->addressname = $request->addressname;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phonenumber = $request->phonenumber;
        $address->country = $request->country;
        $address->state_id = $request->state_id;
        $address->zip = $request->zip;
        $address->town = $request->town;
        $address->streetaddress1 = $request->streetaddress1;
        $address->streetaddress2 = $request->streetaddress2;
        $address->delete_status = 'Active';
        $address->save();
        return response()->json(['message' => trans('custom.added_success')], 200);
    }

    public function update_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'addressname' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'country' => 'required',
            'state_id' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'streetaddress1' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => error_processor($validator)], 403);
        }

        $address = user_addresses::find($request->address_id);
        $address->user_id = $request->user_id;
        $address->addressname = $request->addressname;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phonenumber = $request->phonenumber;
        $address->country = $request->country;
        $address->state_id = $request->state_id;
        $address->zip = $request->zip;
        $address->town = $request->town;
        $address->streetaddress1 = $request->streetaddress1;
        $address->streetaddress2 = $request->streetaddress2;
        $address->save();
        return response()->json(['message' => trans('custom.update_success')], 200);
    }

    public function delete_address($id)
    {
        $address = user_addresses::find($id);
        $address->delete_status = 'Delete';
        $address->save();
        return response()->json(['message' => trans('custom.deleted')], 200);
    }

    public function get_order_list(Request $request)
    {

        $orders = orders::where('payment_status' , 1)->where(['email' => Auth::user()->email])->get();
        return response()->json($orders, 200);
    }

    public function get_order_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $details = OrderDetail::where(['order_id' => $request['order_id']])->get();
        foreach ($details as $det) {
            $det['product_details'] = Helpers::product_data_formatting(json_decode($det['product_details'], true));
        }

        return response()->json($details, 200);
    }
 
    public function info()
    {
        try {

            $userdetails = user::where('id' , Auth::user()->id)->get()->first();
            return response()->json($userdetails, 200);
        } catch (Exception $e) {
            dd($e->getMessage());
        }   
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'countryid' => 'required',
            'stateid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => error_processor($validator)], 403);
        }


        $update = user::find($request->user_id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phonenumber = $request->phonenumber;
        $update->country = $request->country;
        $update->state = $request->state;
        if(!empty($request->profileimage))
        {
            $update->profileimage = Cmf::sendimagetodirectory($request->profileimage);
        }
        $update->save();
        $data['userdata'] = user::where(['id' => $request->user_id])->get()->first();
        $data['message'] = 'Profile Updated Succssfully';
        $data['status'] = true;
        return response()->json($data, 200);
    }

    public function update_cm_firebase_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        DB::table('users')->where('id', $request->user()->id)->update([
            'cm_firebase_token' => $request['cm_firebase_token'],
        ]);

        return response()->json(['message' => trans('custom.update_success')], 200);
    }

    public function get_transaction_history(Request $request)
    {
        try {
            return response()->json(PointTransitions::latest()->where(['user_id' => $request->user()->id])->get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
