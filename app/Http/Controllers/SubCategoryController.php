<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use Validator;
use Session;
use DB;

class SubCategoryController extends Controller
{
    public function getAll(){
        $all = SubCategory::all();
        // return response()->json(['data'=>$all]);
        return view('admin.subcategory.List')->with(['category'=>$all]);
    }


    public function add(){
        $category = Category::all();
        return view('admin.subcategory.FormAdd')->with(['category'=>$category]); 
    }

    public function AddSubCategory(Request $request){
      
        $rules=[
            'idParent'=>'required',
            'category_name' => 'required',
            'category_desc' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }


        $category_sub = new SubCategory;
        $category_sub->idParent = $request->idParent;
        $category_sub->category_name = $request->category_name;
        $category_sub->category_desc = $request->category_desc;

        if($request->hasFile('image')){
            $image_name = $request->file('image')->getClientOriginalName()."_".str_random(8).'.jpeg';
            $request->file('image')->move("sanpham/hinhanh/",$image_name);
            $category_sub->image = $image_name;
  
        }
        else{
            $category_sub->image = 'noImage.jpeg';
        }
  
        $category_sub->save();
        // return response()->json(['message'=>'Đã thêm subcategory vừa taọ vào database']);
        Session::flash('success','Đã thêm subcategory vừa taọ vào database');
        return redirect()->back();
    }



    public function edit($id){
        $subcategory = SubCategory::where('id',$id)->first();
        $category = Category::all();
        return view('admin.subcategory.FormEdit')->with(['subcategory'=>$subcategory,'category'=>$category]);
    }


    public function EditSubCategory($id,Request $request){
        $category_sub = SubCategory::where('id',$id)->first();
        $category_sub->idParent = $request->idParent;
        $category_sub->category_name = $request->category_name;
        $category_sub->category_desc = $request->category_desc;
      
        if($request->hasFile('image'))
        {
            $image_name = $request->file('image')->getClientOriginalName()."_".str_random(8).'.jpeg';
            $request->file('image')->move("sanpham/hinhanh/",$image_name);
            $category_sub->image = $image_name;
        }else{

        }
        $category_sub->save();
        // return response()->json(['message'=>'Đã sửa thành công category']);    
        Session::flash('success','Đã sửa danh mục có id = '.$id);
        return redirect()->back();
    }

    public function searchID($id){
        $subcategory = SubCategory::where('id',$id)->first();
        return response()->json(['subcategory'=>$subcategory]);
    }

    

    public function DeleteSubCategory($id){
        SubCategory::where('id',$id)->delete();
        Session::flash('success','Đã xoá subcategory có id = ' . $id);
        return redirect()->back();
        // return response()->json(['message'=>'Đã xóa subcategory  có id = ' . $id]);
    }








     public function api_getAll(){
        $all = DB::table('subcategory')->get();
        return response()->json(['success'=>1,'data'=>$all]);
    }

    public function api_getSubcategoryByCategoryID($category_id){
        $subcategory = DB::table('subcategory')->where('idParent',$category_id)->get();
        return response()->json(['success'=>1,'data'=>$subcategory]);
    }

    public function product_admin($id){
        $products = DB::table('product')
        ->join('subcategory','product.subcategory_id','=','subcategory.id')
        ->where('subcategory.id','=',"$id")
        ->get(['product.id','product.subcategory_id','product.name as product_name','product.description','product.price','product.quantity','subcategory.category_name']);
        return view('admin.subcategory.ProductList')->with('products',$products);

       
    }
}
