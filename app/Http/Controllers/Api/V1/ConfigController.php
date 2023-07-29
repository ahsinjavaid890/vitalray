<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\site_settings as Settings;
use App\Model\BusinessSetting;
use App\Model\Currency;
use DB;
class ConfigController extends Controller
{
    public function configuration()
    {
        try
        {
            $site_settings = Settings::all();
            return response()->json($site_settings, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }



    public function getcountries()
    {
        try
        {
            $countries = DB::table('countries')->get();
            return response()->json($countries, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
    public function getstates($id)
    {
        try
        {
            $countries = DB::table('states')->where('country_id'  ,$id)->get();
            return response()->json($countries, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
}
