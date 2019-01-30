<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
use App\SubCategory;
use Session;
use Validator;


class CategoryController extends Controller
{
    public function testPost(Request $req)
    {
        $test = $req->name;
        return response()->json(['test'=>$test]);
    }

    public function getAll(){
        $all = DB::table('category')->get();
        return view('admin.category.List')->with(['category'=>$all]);
        // return response()->json(['data'=>$all]);
    }

    public function add(){
        return view('admin.category.FormAdd');
    }

    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.FormEdit')->with(['category'=>$category]);
    }
    public function AddCategory(Request $request)
    {
    
        $rules=[
            'category_name' =>'required',
            'category_desc' =>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        if($request->hasFile('image')){
            $image_name = $request->file('image')->getClientOriginalName()."_".str_random(8).'.jpeg';
            $request->file('image')->move("sanpham/hinhanh/",$image_name);
            $newCategory = new Category;
            $newCategory->category_desc = $request->category_desc;
            $newCategory->category_name = $request->category_name;
            $newCategory->image = $image_name;
            $newCategory->save();
            // return response()->json(['data'=>'insert thành công']);
            Session::flash('success','Thêm danh mục thành công');
            return redirect()->back();
        }else{
            // return response()->json(['data'=>'Chưa chọn ảnh']);
            return redirect()->back()->withErrors('Lỗi chưa chọn ảnh');
        }
    }

    public function DeleteCategory($id){
        Category::where('id',$id)->delete();
        // return response()->json(['data'=>'xoá thành công']);
        Session::flash('success','Đã xoá danh mục có ID = '. $id);
        return redirect()->back();
    }

    public function EditCategory($id,Request $request){
        $category = Category::where('id',$id)->first();
        $category->category_desc = $request->category_desc;
        $category->category_name = $request->category_name;
        if($request->hasFile('image')){
            $image_name = $request->file('image')->getClientOriginalName()."_".str_random(8);
            $request->file('image')->move("sanpham/hinhanh/",$image_name);
            $category->image = $image_name;
        }else{

        }
        $category->save();
        Session::flash('success','Sửa danh mục thành công có id = ' . $id);
        return redirect()->back();

        // return response()->json(['message'=>'Đã sửa thành công user có id : '.$id]);
      
    }

    public function api_search($id){
        $category = 
        DB::select('select product.id,product.subcategory_id,product.name as product_name,product.description,product.price,product.quantity,product_image.image as product_image,shop.name as shop_name,shop.image as shop_image,product.shop_id from product JOIN product_image ON product_image.product_id = product.id JOIN shop ON product.shop_id = shop.id where product.subcategory_id = ? order by product.id desc', [$id]);
        return response()->json(['success'=>1,'data'=>$category]);
    }


    public function searchSubcategory($id){
        $subcategory = SubCategory::where('idParent',$id)->get();
        return response()->json($subcategory);
    }

    public function api_getAll(){
        $all = Category::all();
        return response()->json(['success'=>1,'data'=>$all]);
    }

    public function api_getSubCategory_By_CategoryID($id){
        $subcategory = SubCategory::where('idParent',$id)->get();
        if(count($subcategory)>0)
        return response()->json(['success'=>1,'data'=>$subcategory]);
        else
        return response()->json(['success'=>0,'data'=>'Không tìm thấy']);
    }


    public function productCategory($id){
        $products = DB::table('product')
        ->join('shop','product.shop_id','=','shop.id')
        ->join('product_image','product_image.product_id','=','product.id')
        ->join('subcategory','product.subcategory_id','=','subcategory.id')
        ->where('subcategory.idParent','=',"$id")
        ->get(['product.id','product.shop_id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','product_image.image as product_image','shop.name as shop_name','shop.image as shop_image']);
        return response()->json(['succes'=>1,'data'=>$products]);
    }


    public function product_admin($id){
        $products = DB::table('product')
        ->join('subcategory','product.subcategory_id','=','subcategory.id')
        ->where('subcategory.idParent','=',"$id")
        ->get(['product.id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','subcategory.category_name']);
        return view('admin.category.ProductList')->with('products',$products);
       
    }



}
