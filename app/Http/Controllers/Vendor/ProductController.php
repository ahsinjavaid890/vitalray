<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\StoreSetting;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attributes;
use App\Models\Coupon;
use App\Models\global_attributes;
use Validator;
use App\Helpers\Cmf;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{	



    public function __construct()
    {
        //$this->middleware('auth');
    }

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {           
        $viewstatus = 'all';
        $products = Product::select(
            "products.id",
            "products.title",
            "products.created_at",
            "products.status",
            "products.product_img",
            "products.sale_price",
            "products.url",
            "products.available_stock",
            "products.sale_price",
            "categories.category_name",
                  
                        )
            ->where('vendor_id' , Auth::user()->id)
            ->where('products.delete_status' , 'Active')
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->paginate(10);
         

            // print_r($products);exit;


        return view('vendor.files.products.all-products')->with(array('viewstatus'=>$viewstatus,'products'=>$products));
    }

    public function viewwithidproducts($id)
    {
        $viewstatus = $id;
        $products = Product::select(
            "products.id",
            "products.title",
            "products.created_at",
            "products.status",
            "products.product_img",
            "products.sale_price",
            "products.available_stock",
            "products.sale_price",
            "categories.category_name",
                  
                        )
            ->where('products.status' , $id)
            ->orderby('id' , 'desc')
            ->where('vendor_id' , Auth::user()->id)
            ->where('products.delete_status' , 'Active')
            ->leftJoin('categories', 'products.category', '=', 'categories.id')
            ->paginate(10);
            return view('vendor.files.products.all-products')->with(array('viewstatus'=>$viewstatus,'products'=>$products));
    }

    public function searchproducts(Request $request)
    {
        $input = $request->all();


        $q = Product::query();

        if ($input['searchword'])
        {
            $q->where('title','like', '%' . $input['searchword'] . '%' );
        }

        if ($input['category'] != 0)
        {
            $q->where('category', $input['category']);
        }

        if ($input['sub_category'] != 0)
        {
            $q->where('sub_category', $input['sub_category']);
        }
        if ($input['brand'] != 0)
        {
            $q->where('brand', $input['brand']);
        }
        $q->where('delete_status' , 'Active');
        $q->where('vendor_id' , Auth::user()->id);
        $products = $q->orderBy('id' , 'desc')->get();
        $viewstatus = 'all';
        return view('vendor.files.products.searchproducts')->with(array('viewstatus'=>$viewstatus,'products'=>$products));
    }


    public function create()
    {   
        $productid = rand('123465789' , '987654321');
        return view('vendor.files.products.add-product')->with(array('status'=>1,'productid'=>$productid));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeattributes(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } 


        $input = $request->all();
        $productid = $input['productid'];
       
        foreach ($input['attribute_id'] as $r) {
            $checkattribute = Attributes::where('product_id' , $productid)->where('attribute_id' , $r)->count();
            if($checkattribute == 0)
            {
                if(!empty($input['attributevalues'.$r.'']))
                {
                    
                    $saveattribute = new Attributes;
                    $saveattribute->attribute_id = $r;
                    $saveattribute->attribute_values = implode(',', $input['attributevalues'.$r.'']);
                    $saveattribute->product_id = $productid;
                    $saveattribute->save();
                }
            }
            else
            {
                if(!empty($input['attributevalues'.$r.'']))
                {
                    $data = array('attribute_values' => implode(',', $input['attributevalues'.$r.'']));
                    Attributes::where('attribute_id' , $r)->where('product_id' , $productid)->update($data);
                }
            }
        }
        echo "success";
    }

    public function storegalleryimages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_img' => 'required|max:500',
            'galaryimages' => 'max:500',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } 
        $input = $request->all();
        $product = Product::find($input['productid']);
        $product->video_link = $input['video_link'];
        $product->product_img = Cmf::sendimagetodirectory($input['product_img']);
        $product->save();
        if(!empty($input['galaryimages']))
        {
            foreach ($input['galaryimages'] as $r) {      
              $image =   Cmf::sendimagetodirectory($r);
              DB::statement("INSERT INTO `product_gallery_images` (`products`,`images`)VALUES ('$request->productid', '$image')");
            }
        }
        
        $notification = Auth::user()->name.' Add New Product';
        $url = url('admin/ecommerece/product/').'/'.$input['productid'];
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);
        echo "success";
    }


    public function storeproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'sku' => 'required',
            'sale_price' => 'required',
            'available_stock' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        } 


        $input = $request->all();

        $check = Product::where('id' , $input['productid'])->count();


        if($check == 0)
        {
            $product = new Product;
        }else{
            $product = Product::find($input['productid']);
        }
        
        $product->id = $input['productid'];
        $product->title = $input['title'];
        $product->url = Cmf::shorten_url($input['title']);
        $product->vendor_id = Auth::user()->id;
        $product->category = $input['category'];
        $product->shortdescription = $input['shortdescription'];
        $product->sub_category = $input['sub_category'];
        $product->sub_sub_category = $input['sub_sub_category'];
        $product->sale_price = $input['sale_price'];
        if(!empty($input['discount_price']))
        $product->discount_price = $input['discount_price'];
        if(!empty($input['brand']))
        $product->brand = $input['brand'];
        $product->description = $input['description'];
        $product->sku = $input['sku'];
        $product->available_stock = $input['available_stock'];
        if(!empty($input['store_location']))
        $product->store_location = $input['store_location'];
        
        if(!empty($input['est_shipping_days']))
        $product->est_shipping_days = $input['est_shipping_days'];
        if(!empty($input['free_shipping']))
        {
            $product->free_shipping = 1;
        }
        else
        {
            $product->flat_rate = $input['flat_rate'];
        }
        if(!empty($input['low_warning_change']))
        $product->low_warning_change = $input['low_warning_change'];

        if(Auth::user()->allowwithoutreviewproduct == 1)
        {
            $product->status = 1;
        }else{
           $product->status = 0;  // (0) Pending from Approve (1) published (2) rejected (3) trash
        }
        $product->delete_status = 'Active';
        $created = $product->save();
        if($created)
        {
            echo "success";
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\  $models
     * @return \Illuminate\Http\Response
     */
    public function show(Models $models)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\  $models
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $product = Product::where('id' , $id)->get()->first();
        $attributes = DB::table('attributes')->where('product_id' , $id)->get();
        return view('vendor.files.products.edit-product')->with(array('status'=>1,'product'=>$product,'attributes'=>$attributes)); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\  $models
     * @return \Illuminate\Http\Response
     */
    public function updateattributesforproduct(Request $request)
    {

        $input = $request->all();
        $productid = $input['productid'];
       
        foreach ($input['attribute_id'] as $r) {
            $checkattribute = Attributes::where('product_id' , $productid)->where('attribute_id' , $r)->count();
            if($checkattribute == 0)
            {
                if(!empty($input['attributevalues'.$r.'']))
                {
                    
                    $saveattribute = new Attributes;
                    $saveattribute->attribute_id = $r;
                    $saveattribute->attribute_values = implode(',', $input['attributevalues'.$r.'']);
                    $saveattribute->product_id = $productid;
                    $saveattribute->save();
                }
            }
            else
            {
                if(!empty($input['attributevalues'.$r.'']))
                {
                    $data = array('attribute_values' => implode(',', $input['attributevalues'.$r.'']));
                    Attributes::where('attribute_id' , $r)->where('product_id' , $productid)->update($data);
                }
            }
        }

        $notification = Auth::user()->name.' Update Product Attributes';
        $url = url('admin/ecommerece/product/').'/'.$input['productid'];
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);


        return redirect()->back()->with('message', 'Product Attributes Updated Successfully');
    }


    public function updateproduct(Request $request)
    {   
        $input = $request->all();


        $product = Product::find($input['id']);         
        $product->title = $input['title'];
        $product->url = Cmf::shorten_url($input['title']);
        $product->category = $input['category'];
        $product->sub_category = $input['sub_category'];
        $product->sub_sub_category = $input['sub_sub_category'];
        $product->sale_price = $input['sale_price'];
        if(!empty($input['discount_price']))
        $product->discount_price = $input['discount_price'];
        if(!empty($input['brand']))
        $product->brand = $input['brand'];
        $product->description = $input['description'];
        $product->sku = $input['sku'];
        $product->available_stock = $input['available_stock'];
        if(!empty($input['store_location']))
        $product->store_location = $input['store_location'];
        if(!empty($input['video_link']))
        $product->video_link = $input['video_link'];
        if(!empty($input['est_shipping_days']))
        $product->est_shipping_days = $input['est_shipping_days'];

        if(!empty($input['free_shipping']))
        {
            $product->free_shipping = 1;
        }
        else
        {
            $product->flat_rate = $input['flat_rate'];
        }
        if(!empty($input['low_warning_change']))
        $product->low_warning_change = $input['low_warning_change'];


        $product->save();


        $notification = Auth::user()->name.' Update Product Basic Details';
        $url = url('admin/ecommerece/product/').'/'.$input['id'];
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);


        return redirect()->back()->with('message', 'Product Updated Successfully');

    }


    public function updategalleryimages(Request $request)
    {
        $input = $request->all();

        $product = Product::find($input['productid']);
        $product->video_link = $input['video_link'];
        if(!empty($input['product_img']))
        {
            $product->product_img = Cmf::sendimagetodirectory($input['product_img']);
        }
        
        if(!empty($input['galaryimages']))
        {
            foreach ($input['galaryimages'] as $r) {      
              $image =   Cmf::sendimagetodirectory($r);
              DB::statement("INSERT INTO `product_gallery_images` (`products`,`images`)VALUES ('$request->productid', '$image')");
            }
        }
        $product->save();


        $notification = Auth::user()->name.' Update Product Gallery';
        $url = url('admin/ecommerece/product/').'/'.$input['productid'];
        $icon = '<div class="notify-icon bg-primary"> <i class="mdi mdi-comment-account-outline"></i> </div>';
        Cmf::save_admin_notification($notification , $url , $icon);

        return redirect()->back()->with('message', 'Product Gallery Updated Successfully');
    }

    public function coupon_list()
    {   
        $coupons = Coupon::select(
            "coupons.id",
            "coupons.end_date",
            "coupons.coupon_code",
            "coupons.discount") 
            ->paginate(10);
         
        return view('vendor.files.products.coupen',compact("coupons"));


    }
    public function addcoupon(Request $request)
    {   
        return view('vendor.files.products.add-coupen');

    }

    public function editcoupon($id)
    {   
        $coupon = Coupon::find($id);
        return view('vendor.files.products.edit-coupen',compact("coupon"));

    }

    public function store_coupon(Request $request)
    {
        $input = $request->all();

        // print_r($input);
        // die('herer');

        $validator = Validator::make($input,[ 
            'products_ids'  => 'required',
            'date_range'  => 'required',
            'coupon_code'  => 'required',
            'discount'  => 'required',
          
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 
    
        $dates = explode('-', $input['date_range']);
        $coupon = new Coupon;
        $coupon->products_ids = implode(',', $input['products_ids']);
        $coupon->start_date = $dates[0];
        $coupon->end_date = $dates[1];
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->discount = $input['discount'];
        $created = $coupon->save();

        if($created)
        {
            return redirect()->back()->with('message', 'Coupon Added Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        }
    }


    public function update_coupon(Request $request)
    {
        $input = $request->all();

        //dd($input);

        $validator = Validator::make($input,[ 
            'products_ids'  => 'required',
            'date_range'  => 'required',
            'coupon_code'  => 'required',
            'discount'  => 'required',
          
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 
        $coupon = Coupon::find($input['id']);
        $dates = explode('-', $input['date_range']);
        //$coupon = new Coupon;
        $coupon->products_ids = implode(',', $input['products_ids']);
        $coupon->start_date = $dates[0];
        $coupon->end_date = $dates[1];
        $coupon->coupon_code = $input['coupon_code'];
        $coupon->discount = $input['discount'];
        $created = $coupon->save();

        if($created)
        {
            return redirect()->back()->with('message', 'Coupon Updated Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        }
    }

	


    public function attributes_list()
    {   
        $attributes = global_attributes::select(
            "global_attributes.id",
            "global_attributes.name",
            "global_attributes.values",
            "global_attributes.status")
        ->where('seller_id' , Auth::user()->id)
            ->paginate(10);
         

        return view('vendor.files.products.attributes',compact("attributes"));
    }

    public function editattributes($id)
    {   
        
        $attributes = global_attributes::find($id); 
        $attributes->values = explode(',', $attributes->values);      
        return view('vendor.files.products.editattributes',compact("attributes"));
    }

    public function store_attributes(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[ 
            'name'  => 'required',
            'attribute_name'  => 'required',
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 
        $attributes = new global_attributes;
        $attributes->name = $input['name'];
        $attributes->values = implode(',', $input['attribute_name']);
        $attributes->seller_id = Auth::user()->id;
        $attributes->status = 1;
        $created = $attributes->save();
        if($created)
        {
            return redirect()->back()->with('message', 'Attribute Added Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        } 
    }

    public function update_attributes(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[ 
            'name'  => 'required',
            'attribute_name'  => 'required',
        ]);

        if($validator->fails())
         return redirect()->back()->with('errors', $validator->errors()); 

        $attributes = global_attributes::find($input['id']);
        // $attributes = new global_attributes;
        $attributes->name = $input['name'];
        $attributes->values = implode(',', $input['attribute_name']);
        $attributes->status = 1;
        $created = $attributes->save();
        if($created)
        {
            return redirect()->back()->with('message', 'Attribute Updated Successfully');
        }
        else
        {
            return back()->with('faild', 'Something went Wrong!')->withInput();
        } 
    }

    public function stock_manage(Request $request)
    {   
        $input = $request->all();

        $q = product::query();
        if ($input['search_term'])
        {
            $q->where('sku','like', '%' . $input['search_term'] . '%' );
        }

        if ($input['status'])
        {
            $q->where('status', $input['status']);
        }
        $q->where('delete_status' , 'Active');
        $q->where('vendor_id' , Auth::user()->id);
        $products = $q->orderBy('id' , 'desc')->paginate(10);


        return view('vendor.files.products.manage-stock',compact("products"));
    }


    public function searchstock($id)
    {
        $products = product::Where('sku', 'like', '%' . $id . '%')->get();
    }
    public function checkattribute($id)
    {
        echo $products = global_attributes::where('seller_id', Auth::user()->id)->where('name' , $id)->count();
    }
    public function deleteimage($id,$productid)
    {
        DB::table('product_gallery_images')->where('id' ,$id)->delete();

        $data = DB::table('product_gallery_images')->where('products' , $productid)->get();


        foreach ($data as $r) {
          echo  '<div style="margin-bottom: 20px;" class="col-2">
                <div style="border:1px solid #DDDD;">
                    <div style="height:30px;background-color: #DDD; padding: 5px;" >
                        <div class="row">
                            <div class="col-md-10">
                                Gallary Image 
                            </div>
                            <div onclick="removegalleryimages('.$r->id.','.$productid.')" style="color:red;cursor: pointer;" class="col-md-2">
                                X
                            </div>
                        </div>
                    </div>
                    <div style="padding: 10px;">
                       <img style="width:100%;" src="'.asset('images/').'/'.$r->images.'"  class="rounded mr-3" height="100" />
                    </div>
                </div>
            </div>';
        }
    }

    public function checksku($id)
    {
        $product = product::where('sku' , $id)->where('vendor_id' , Auth::user()->id)->count();
        return response()->json($product, 200);
    }


    public function movetotrash($id)
    {
        $product = product::find($id);
        $product->status = 3;
        $product->save();
        return redirect()->back()->with('message', 'Product Moved to Trash Successfully');
    }
}