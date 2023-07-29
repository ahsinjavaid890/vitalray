<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreSetting;
use App\Models\Product;
class StoreController extends Controller
{
    public function get_detail($id,$user_id)
    {
        try
        {   
            $data = StoreSetting::where('user_id' , $id)->get()->first();
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
                "product_reviews.stars",
                "products.sale_price",
                "wishlists.id as wishlistid",
                "categories.category_name")
                ->leftJoin('categories', 'products.category', '=', 'categories.id') 
                ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
                ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')  
                ->where('products.status'  ,1)
                ->where('products.vendor_id'  ,$data->user_id)
                ->limit(15)
                ->get();
            $bestselling = Product::select(
                "products.id",
                "products.title",
                "products.created_at",
                "products.status",
                "products.product_img",
                "products.sale_price",
                "products.available_stock",
                "products.store_location",
                "products.sku",
                "product_reviews.stars",
                "products.sale_price",
                "wishlists.id as wishlistid",
                "categories.category_name")
                ->leftJoin('categories', 'products.category', '=', 'categories.id') 
                ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
                ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id') 
                ->where('products.status'  ,1)
                ->where('best_seller'  ,1)
                
                ->where('vendor_id'  ,$data->user_id)
                ->limit(3)
                ->get();
            $data['products'] = products_format($products , $user_id);
            $data['best_selling'] = products_format($bestselling , $user_id);
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



    public function allstores()
    {
        $q = StoreSetting::query();
        $q->wherenotNull('shop_banner');
        $q->wherenotNull('shop_logo');
        $allstores = $q->get();
        $data['allstores'] = $allstores;
        $data['status'] = true;
        return response()->json($data, 200);
    }
}
