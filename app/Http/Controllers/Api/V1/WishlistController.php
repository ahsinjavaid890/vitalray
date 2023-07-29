<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    public function add_to_wishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false,'errors' => error_processor($validator)], 403);
        }


        $wishlist = wishlists::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();

        if (empty($wishlist)) {
            $wishlist = new wishlists;
            $wishlist->user_id = $request->user_id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
            return response()->json(['message' => trans('custom.added_success')], 200);
        }

        return response()->json(['message' => trans('custom.already_added')], 403);
    }

    public function remove_from_wishlist(Request $request)
    {
        $wishlist = wishlists::where('user_id', $request->user_id)->where('product_id', $request->product_id)->delete();
        return response()->json(['message' => 'Deleted Successfully'], 403);
    }

    public function wish_list($id)
    {
        try
        {
            $data = wishlists::select(
            "products.id as product_id",
            "products.title",
            "products.created_at",
            "products.status",
            "products.product_img",
            "products.sale_price",
            "products.discount_price",
            "products.available_stock",
            "wishlists.user_id",
            "wishlists.id as wishlist_id",
                  
                        )
            ->leftJoin('products', 'wishlists.product_id', '=', 'products.id')
            ->where('status'  ,1)
            ->where('wishlists.user_id' , $id)
            ->where('products.delete_status' , 'Active')
            ->get();
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
