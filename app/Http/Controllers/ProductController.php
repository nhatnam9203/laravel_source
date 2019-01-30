<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use DB;
use App\Product_Khuyenmai;
use Session;
use Validator;




class ProductController extends Controller
{
    public function api_add(Request $request)
    {
        $product = new Product;
        $files = $request->file('images');
        // foreach ($files as $file) {
        //     $ext = $file->getClientOriginalExtension();
        //  
        //     if($ext !== 'jpeg' || $ext !== 'jpg' || $ext !== 'png')
        //     {
        //         return response()->json(['succes'=>0,'data'=>'File ảnh chỉ chấp nhận jpg,jpeg,png']);
        //     }
        // }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->shop_id = $request->shop_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->created_at = Carbon::now();
        $product->updated_at = Carbon::now();
        $product->save();
        foreach ($files as $file) {
            $productImage = new ProductImage;
            $productImage->product_id = $product->id;
            $filename = $file->getClientOriginalName() . "_" . str_random(8) . '.jpeg';
            $file->move("sanpham/hinhanh/", $filename);
            $productImage->image = $filename;
            $productImage->save();
        }
        return response()->json(['success' => 1, 'data' => 'Đăng sản phẩm thành công']);
    }

    public function api_getAll()
    {
        $products =
            DB::select('select product.id,product.shop_id,product.subcategory_id,product.name as product_name,product.description,product.price,product.quantity,product_image.image as product_image,shop.name as shop_name,shop.image as shop_image from product 
             JOIN product_image ON product_image.product_id = product.id 
             JOIN shop ON product.shop_id = shop.id
             JOIN subcategory ON product.subcategory_id = subcategory.id
             order by product.id desc');
        return response()->json(['success' => 1, 'data' => $products]);
    }


    public function getAll()
    {
        $products = DB::table('product')
            ->join('shop', 'shop.id', '=', 'product.shop_id')
            ->join('subcategory', 'product.subcategory_id', '=', 'subcategory.id')
            ->orderBy('product.id', 'DESC')
            ->get(['product.id', 'product.name as product_name', 'shop.name as shop_name', 'product.price']);
        return view('admin.product_promotion.List')->with(['products' => $products]);

    }

    public function capnhatkhuyenmai($id)
    {
        $product = DB::table('product')
            ->join('shop', 'shop.id', '=', 'product.shop_id')
            ->join('subcategory', 'product.subcategory_id', '=', 'subcategory.id')
            ->where('product.id', '=', "$id")
            ->first(['product.id', 'product.name as product_name', 'shop.name as shop_name', 'product.price']);
        // >get(['product.id', 'product.name as product_name', 'shop.name as shop_name', 'product.price']);

        $current = Carbon::now('Asia/Ho_Chi_Minh');
        $day = $current->day;
        $month = $current->month;
        $year = $current->year;
        $hour = '15';
        $minute = '00';
        $second = '00';
        $time1 = Carbon::create($year, $month, $day, $hour, $minute, $second);
        $hour = '00';
        $minute = '00';
        $second = '00';
        $time2 = Carbon::create($year, $month, $day, $hour, $minute, $second);

        return view('admin.product_promotion.Update')
            ->with(['product' => $product, 'time1' => $time1, 'time2' => $time2]);
    }

    public function time(){
        echo $date = date('Y-m-d H:i:s');
        $date2 = Carbon::now();
        echo $date2;
        $date3 = Carbon::today();
        echo $date3;
    }

    public function productKhuyenMai()
    {

        $products = DB::table('product_khuyenmai')
        ->join('product','product_khuyenmai.product_id','=','product.id')
        ->join('shop', 'shop.id', '=', 'product.shop_id')
        ->join('product_image','product_image.product_id','=','product.id')
        ->join('subcategory', 'product.subcategory_id', '=', 'subcategory.id')
        ->whereDate('time_khuyenmai',Carbon::today())
        ->get(['product_khuyenmai.time_khuyenmai','product_khuyenmai.price as new_price','product.id','product.shop_id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','product_image.image as product_image','shop.name as shop_name','shop.image as shop_image']);
        return response()->json(['success'=>1,'data'=>$products]);
    }





    public function update($id, Request $request)
    {
        $rules = [
            'new_price' => 'required',
            'date_promotion' => 'required',
        ];
        $message = [
            'new_price.required' => 'Chưa nhập giá khuyến mãi của sản phẩm',
            'date_promotion.required' => 'Chưa chọn thời gian khuyến mãi'
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $date_promotion = $request->date_promotion;
        $new_price = $request->new_price;
        $product_khuyenmai = new Product_Khuyenmai;
        $product_khuyenmai->product_id = $id;
        $product_khuyenmai->price = $new_price;
        $product_khuyenmai->time_khuyenmai = $date_promotion;
        $product_khuyenmai->save();
        Session::flash('success', 'Cập nhật khuyến mãi thành công');
        return redirect()->back();
    }




    public function api_searchProduct(Request $request)
    {
        $product_name = $request->product_name;

        $result = DB::table('product')
            ->join('product_image', 'product_image.product_id', '=', 'product.id')
            ->join('shop', 'shop.id', '=', 'product.shop_id')
            ->where('product.name', 'LIKE', "%$product_name%")
            ->orderBy('product.id', 'DESC')
            ->get(['product.id', 'product.name as product_name', 'shop.name as shop_name', 'product.description', 'product.price', 'product.quantity', 'product_image.image as product_image', 'shop.image as shop_image']);
        return response()->json(['success' => 1, 'data' => $result]);
    }

    public function api_searchID($id)
    {
        $result = DB::table('product')
            ->join('product_image', 'product_image.product_id', '=', 'product.id')
            ->join('shop', 'shop.id', '=', 'product.shop_id')
            ->join('subcategory', 'product.subcategory_id', '=', 'subcategory.id')
            ->join('category', 'category.id', '=', 'subcategory.idParent')
            ->where('product.id', '=', "$id")
            ->orderBy('product.id', 'DESC')
            ->get(['product.id', 'category.category_name', 'category.id as categoryID', 'product.name as product_name', 'shop.name as shop_name', 'product.description', 'product.price', 'product.quantity', 'product_image.image as product_image', 'shop.image as shop_image', 'product.subcategory_id', 'product.shop_id']);
        return response()->json(['success' => 1, 'data' => $result]);
    }

    public function api_searchProductByShopID($idShop)
    {
        $result = DB::table('product')
            ->join('product_image', 'product_image.product_id', '=', 'product.id')
            ->join('shop', 'shop.id', '=', 'product.shop_id')
            ->where('shop.id', '=', "$idShop")
            ->orderBy('product.id', 'DESC')
            ->get(['product.id', 'product.name as product_name', 'shop.name as shop_name', 'product.description', 'product.price', 'product.quantity', 'product_image.image as product_image', 'shop.image as shop_image', 'product.shop_id']);
        return response()->json(['success' => 1, 'data' => $result]);
    }

    public function api_deleteProductByID($id)
    {
        DB::table('product')->where('id', $id)->delete();
        DB::table('product_image')->where('product_id', $id)->delete();
        return response()->json(['success' => 1, 'data' => 'Đã xoá sản phẩm']);
    }
}
