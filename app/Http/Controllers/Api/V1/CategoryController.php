<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\third_level_categories;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
             $categories = Category::select(
                "id",
                "category_name",
                "description",
                "category_mob_icon")
                ->where('category_status' ,'Published')
                ->get();


            $data['parent_categories'] = categories_format($categories);
            $data['status'] = true;


            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_childes($id)
    {       

        try {
            $categories = SubCategory::where(['category_id' => $id])->get();


            $data['categories'] = $categories;
            $data['status'] = true;


            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_sub_childes($id)
    {       

        try {
            $categories = third_level_categories::where(['sub_category_id' => $id])->get();


            $data['categories'] = $categories;
            $data['status'] = true;


            return response()->json($data, 200);
            
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products_parent($id , $user_id)
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
            "product_reviews.stars",
            "products.sale_price",
            "wishlists.id as wishlistid",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')  
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id') 
            ->where('products.category' ,$id)
            ->where('products.delete_status' , 'Active')
            ->get();

         

            $data['latest_products'] = products_format($products , $user_id);
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

    public function get_products_child($id , $user_id)
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
            "product_reviews.stars",
            "products.sale_price",
            "wishlists.id as wishlistid",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')  
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id') 
            ->where('products.sub_category' ,$id)
            ->where('products.delete_status' , 'Active')
            ->get();

         

            $data['latest_products'] = products_format($products,$user_id);
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

    public function get_products_sub_child($id,$user_id)
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
            "product_reviews.stars",
            "products.sale_price",
            "wishlists.id as wishlistid",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')  
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->where('products.sub_sub_category' ,$id)
            ->where('products.delete_status' , 'Active')
            ->get();

         

            $data['latest_products'] = products_format($products,$user_id);
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
