<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\CentralLogics\ProductLogic;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\global_attributes;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
   public function searchstock($id){ 
        try {
            $products = product::where('sku', 'like', '%' . $id . '%')->get();
            $data['products'] = $products;
            $data['status'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }

    }
}
