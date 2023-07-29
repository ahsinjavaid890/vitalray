<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\CentralLogics\ProductLogic;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\global_attributes;
use App\Models\Attributes;
use App\Models\product_reviews;
use DB;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\StoreSetting;
class ProductController extends Controller
{
    public function get_latest_products(Request $request)
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
            ->where('products.new_arivals' ,1)
            ->paginate(20);

         

            $data['latest_products'] = products_format($products , $request->user_id);
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
    public function get_best_seller_products(Request $request)
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
            "product_reviews.stars",
            "products.sku",
            "products.sale_price",
            "wishlists.id as wishlistid",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id') 
            ->where('products.best_seller' ,1)
            ->paginate(20);

         

            $data['best_seller_products'] = products_format($products , $request->user_id);
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
    public function get_popular_products(Request $request)
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
            ->where('products.most_popular' ,1)
            ->paginate(20);

         

            $data['most_popular_products'] = products_format($products , $request->user_id);
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
    public function get_featured_products(Request $request)
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
            ->where('products.featured' ,1)
            ->paginate(20);

         

            $data['featured_products'] = products_format($products , $request->user_id);
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


    public function search_homepage($id , $user_id)
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
            ->Where('products.title', 'like', '%' . $id . '%')
            ->get();

         

            $data['searched_products'] = products_format($products,$user_id);
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



    public function search_store($id , $store_id, $user_id)
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
            ->Where('products.title', 'like', '%' . $id . '%')
            ->where('products.vendor_id' , $store_id)
            ->get();

         

            $data['searched_products'] = products_format($products,$user_id);
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

    public function update_status(Request $request)
    {   
        $product = Product::findOrFail($request->product_id);
        if(isset($product))
        {
            $product->status = $request->status;
            $product->save();
            $data['status'] = true;
            $data['message'] = "Prodcut updated!";
            return response()->json($data, 200);
        }
        else
        {
            $data['status'] = false;
            $data['message'] = "Product Not Found!";
            return response()->json($data, 200);
        }
    }

    public function delete_product(Request $request)
    {   
        $product = Product::findOrFail($request->product_id);
        if(isset($product))
        {
            $product->delete();
            $data['status'] = true;
            $data['message'] = "Prodcut Deleted!";
            return response()->json($data, 200);
        }
        else
        {
            $data['status'] = false;
            $data['message'] = "Product Not Found!";
            return response()->json($data, 200);
        }
    }

    public function stock_update(Request $request)
    {   
        $product = Product::findOrFail($request->peoduct_id);
        if(isset($product))
        {
            $product->available_stock = $request->newstock;
            $product->save();
            $data['status'] = true;
            $data['message'] = "Prodcut Stock Updated!";
            return response()->json($data, 200);
        }
        else
        {
            $data['status'] = false;
            $data['message'] = "Product Not Found!";
            return response()->json($data, 200);
        }
    }

    public function delete_coupon(Request $request)
    {   
        $coupon = Coupon::findOrFail($request->coupon_id);
        if(isset($coupon))
        {
            $coupon->delete();
            $data['status'] = true;
            $data['message'] = "Coupon Deleted!";
            return response()->json($data, 200);
        }
        else
        {
            $data['status'] = false;
            $data['message'] = "Coupon Not Found!";
            return response()->json($data, 200);
        }
    }


    public function delete_attribute(Request $request)
    {   
        $attribute = global_attributes::findOrFail($request->attribute_id);
        if(isset($attribute))
        {
            $attribute->delete();
            $data['status'] = true;
            $data['message'] = "Attribute Deleted!";
            return response()->json($data, 200);
        }
        else
        {
            $data['status'] = false;
            $data['message'] = "Attribute Not Found!";
            return response()->json($data, 200);
        }
    }



    public function get_attributes($id)
    {
        try
        {   
            $attribute = global_attributes::where('id' , $id)->get()->first();
            // $attributevalues = explode(',' , $attribute->values);
            return response()->json($attribute, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }

    }



    public function get_searched_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $products = ProductLogic::search_products($request['name'], $request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_product($id , $user_id)
    {
        try
        {   
           $products = Product::select(
            "products.id",
            "products.title",
            "products.created_at",
            "products.status",
            "products.product_img",
            "products.shortdescription",
            "products.description",
            "products.sale_price",
            "products.discount_price",
            "products.available_stock",
            "products.category",
            "products.vendor_id",
            "products.store_location",
            "products.sku",
            "product_reviews.stars",
            "products.sale_price",
            "wishlists.id as wishlistid",
            "categories.category_name")
            ->leftJoin('categories', 'products.category', '=', 'categories.id')  
            ->leftJoin('wishlists', 'products.id', '=', 'wishlists.product_id')
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id') 
            ->Where('products.id', $id)
            ->get();


            $gallery_images = DB::table('product_gallery_images')->where('products' , $id)->get();
            

            $similar_products = Product::select(
                "products.id",
                "products.title",
                "products.product_img",
                "products.sale_price",
                "products.discount_price")
                ->where('category' , $products->first()->category)
                ->limit(6)
                ->get();





            $seller = StoreSetting::select(
            "store_settings.id",
            "store_settings.shop_name",
            "store_settings.shop_logo",)
            ->Where('user_id' , $products->first()->vendor_id)
            ->get()->first();

            
            $variations = Attributes::select(
            "attributes.attribute_values",
            "attributes.product_id",
            "attributes.id",
            "global_attributes.name as attribute_name")
            ->leftJoin('global_attributes', 'attributes.attribute_id', '=', 'global_attributes.id')  
            ->Where('attributes.product_id', $id)
            ->get();
            
            $reviews = product_reviews::select(
            "product_reviews.review",
            "product_reviews.stars",
            "product_reviews.review_image",
            "users.name")
            ->leftJoin('users', 'product_reviews.user_id', '=', 'users.id')  
            ->Where('product_reviews.product_id', $id)
            ->where('status'  , 'published')
            ->get();
      

            $data['product_detail'] = products_format($products,$user_id);
            $data['gallery_images'] = $gallery_images;

            if(!empty($variations))
            {
                $data['variations'] = $variations;
            }
            if(!empty($reviews))
            {
                $data['reviews'] = $reviews;
            }
            if($reviews->count() > 0)
            {
                $globalstars['sumofglobal'] = $reviews->sum('stars')/$reviews->count();
                $globalstars['one'] = $reviews->where('stars'  ,1)->count();
                $globalstars['two'] = $reviews->where('stars'  ,2)->count();
                $globalstars['three'] = $reviews->where('stars'  ,3)->count();
                $globalstars['four'] = $reviews->where('stars'  ,4)->count();
                $globalstars['five'] = $reviews->where('stars'  ,5)->count();
                $data['globalrattings'] = $globalstars;
            }
            $data['similar_products'] = products_format($similar_products,$user_id);


            $data['seller'] = $seller;

            

            

            



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


    public function get_related_products($id)
    {
        if (Product::find($id)) {
            $products = ProductLogic::get_related_products($id);
            $products = Helpers::product_data_formatting($products, true);
            return response()->json($products, 200);
        }
        return response()->json([
            'errors' => ['code' => 'product-001', 'message' =>  trans('custom.no_data_found')]
        ], 404);
    }

    public function get_set_menus()
    {
        try {
            $products = Helpers::product_data_formatting(Product::active()->with(['rating'])->where(['set_menu' => 1, 'status' => 1])->get(), true);
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' =>  trans('custom.no_data_found')]
            ], 404);
        }
    }

    public function get_product_reviews($id)
    {
        $reviews = Review::with(['customer'])->where(['product_id' => $id])->get();

        $storage = [];
        foreach ($reviews as $item) {
            $item['attachment'] = json_decode($item['attachment']);
            array_push($storage, $item);
        }

        return response()->json($storage, 200);
    }

    public function get_product_rating($id)
    {
        try {
            $product = Product::find($id);
            $overallRating = ProductLogic::get_overall_rating($product->reviews);
            return response()->json(floatval($overallRating[0]), 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }

    public function submit_product_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'order_id' => 'required',
            'comment' => 'required',
            'rating' => 'required|numeric|max:5',
        ]);

        $product = Product::find($request->product_id);
        if (isset($product) == false) {
            $validator->errors()->add('product_id', trans('custom.no_data_found'));
        }

        $multi_review = Review::where(['product_id' => $request->product_id, 'user_id' => $request->user()->id])->first();
        if (isset($multi_review)) {
            $review = $multi_review;
        } else {
            $review = new Review;
        }

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $image_array = [];
        if (!empty($request->file('attachment'))) {
            foreach ($request->file('attachment') as $image) {
                if ($image != null) {
                    if (!Storage::disk('public')->exists('review')) {
                        Storage::disk('public')->makeDirectory('review');
                    }
                    array_push($image_array, Storage::disk('public')->put('review', $image));
                }
            }
        }

        $review->user_id = $request->user()->id;
        $review->product_id = $request->product_id;
        $review->order_id = $request->order_id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->attachment = json_encode($image_array);
        $review->save();

        return response()->json(['message' => trans('custom.review_submit_success')], 200);
    }







    // Add Product

    public function checksku($id)
    {
        try
        {   
            $product = product::where('sku' , $id)->where('vendor_id' , Auth::user()->id)->count();
            return response()->json($product, 200);
        } 
        catch (\Exception $e)
        {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }


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
