<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use Validator;
use DB;
use Session;

class ShopController extends Controller
{

    public function getAll(){
        $shops = Shop::all();
        return view('admin.shop.List')->with('shops',$shops);
    }

    public function edit($id){
        $shop = Shop::where('id',$id)->first();
        return view('admin.shop.FormEdit')->with('shop',$shop);
    }

    public function postEdit($id,Request $request){
        $rules = [

            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'description'=>'required'
        ];
        $message = [
    
            'name.required'=>'Chưa nhập tên shop',
            'phone.required'=>'Chưa nhập số điện thoaị shop',
            'address.required' =>'Chưa nhập địa chỉ',
            'description.required' =>'Chưa nhập thông tin mô tả shop'
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $shop = Shop::where('id',$id)->first();
        $shop->name = $request->name;
        $shop->phone = $request->phone;
        $shop->address = $request->address;
        $shop->description = $request->description;
        $shop->save();
        Session::flash('success','Đã sửa thành công thông tin của shop '.$request->name);
        return redirect()->back();
        


    }


    public function login(Request $request){
        if(Auth::guard('shop')->attempt(['email'=>$request->email,'password'=>$request->password])){
            $shop = Auth::guard('shop')->user();
            return response()->json(['success'=>1,'data'=>$shop]);
         }else{
             return response()->json(['success'=>0,'data'=>'Sai thông tin đăng nhập']);
         }
    }

    public function register(Request $request){
        $rules = [
            'email'=>'unique:Shop',
            'name'=>'unique:Shop',
        ];
        $message = [
            'email.unique'=>'email đã tồn tại',
            'name.unique'=>'Tên shop đã tồn tại',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return response()->json(['success'=>0,'data'=>$validator]);
        }
        $shop = new Shop;
        $shop->name = $request->name;
        $shop->password = bcrypt($request->password);
        $shop->email = $request->email;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->description = $request->description;
        $shop->image = 'noImage';
        if($shop->save())
        return response()->json(['success'=>1,'data'=>'Đã đăng ký thành công hãy đăng nhập để bán hàng']);
    }

    public function searchID($id){
        $shop = Shop::where('id',$id)->first();
        return response()->json(['success'=>1,'data'=>$shop]);
    }

    public function searchProductOfShop($id){
        $products = DB::select('select * from shop,product where id = ? and product.shop_id = shop.id', [$id])->get();
        return response()->json(['success'=>1,'data'=>$products]);
    }

    public function productShop($id){
        $products = DB::table('product')
        ->join('shop','product.shop_id','=','shop.id')
        ->join('product_image','product_image.product_id','=','product.id')
        ->where('shop.id','=',"$id")
        ->get(['product.id','product.shop_id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','product_image.image as product_image','shop.name as shop_name','shop.image as shop_image']);
        return response()->json(['succes'=>1,'data'=>$products]);
    }

    public function productShop_admin($id){
        $products = DB::table('product')
        ->join('shop','product.shop_id','=','shop.id')
        // ->join('product_image','product_image.product_id','=','product.id')
        ->where('shop.id','=',"$id")
        ->get(['product.id','product.shop_id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','shop.name as shop_name','shop.image as shop_image']);
        // return response()->json(['succes'=>1,'data'=>$products]);
        return view('admin.shop.ProductList')->with('products',$products);
       
    }

    
}
