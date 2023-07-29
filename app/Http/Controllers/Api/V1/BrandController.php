<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\CentralLogics\BakeryLogic;
use App\CentralLogics\ProductLogic;
use App\Models\allbrands;
use App\Model\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function get_all_brands()
    {      
        try
        {
            $allbrands = allbrands::all();
            return response()->json($allbrands, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
    public function get_brand_by_id($id)
    {   
        try
        {
            $allbrands = allbrands::find($id);
            return response()->json($allbrands, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }



   public function get_product_by_brand($id)
   {
        try
        {   
            $products = Product::select(
            "products.id",
            "products.title",
            "products.created_at",
            "products.status",
            "products.product_img",
            "products.sale_price",
            "products.available_stock",
            "products.store_location",
            "products.sku",
            "products.sale_price",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->where('brand' , $id) 
            ->get();

         

            $data['all_products'] = products_format($products);
            $data['status'] = true;

            return response()->json($data, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
   } 

   public function get_recent_bakeries()
   {
        try
        {
            $all_bakery = Bakery::active()->get();
            $product = Helpers::bakery_data_formatting($all_bakery, true);
            $data['popular_bakeries'] = $product;
            $data['status'] = true;
            return response()->json($data, 200);
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }

   } 


   public function get_bakery_details(Request $request)
   {
        try
        {
            $id = $request->input('id');
            
            $bakery = Bakery::active()->where('id', $id)->first();
            
            $bakery = Helpers::bakery_data_formatting($bakery, false);

            $categories = Category::where(['position'=>0,'status'=>1])->get();

            $bakery['categories'] = Helpers::category_withproducts_data_formatting($categories,true);

            // print_r($bakery);
            // die('here');
            $data['bakery'] = $bakery;
            $data['status'] = true;
            return response()->json($data, 200);
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }

   }
  

}
