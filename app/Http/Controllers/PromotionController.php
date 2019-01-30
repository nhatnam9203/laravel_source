<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\Category;
use App\SubCategory;
use Session;
use Validator;
use DB;

class PromotionController extends Controller
{
    public function getAll(){
   
        $all = 
        DB::select('select promotion.id,promotion.description,promotion.quantity,promotion.discount,promotion.code,subcategory.category_name from promotion,subcategory where promotion.subcategory_id = subcategory.id ');
        
        return view('admin.promotion.List')->with(['promotions'=>$all]);
    }

    public function add(){
        $category = Category::all();
        return view('admin.promotion.FormAdd')->with(['category'=>$category]);
    }

    public function insertProm(Request $request){
        $rules=[
            'code' =>'required|unique:Promotion',
            'description'=>'required',
            'subcategory_id'=>'required',
            'discount'=>'required',
            'quantity'=>'required|max:100',
        ];
        $message = [
            'code.unique' => 'Mã code đã tồn tại hãy nhập mã khác',
            'description.required'=>'Chưa nhập mô tả',
            'code.required'=>'Chưa nhập mã code khuyến mãi',
            'subcategory_id.required'=>'Chưa chọn danh mục khuyến mãi',
            'discount.required'=>'Chưa nhập % giảm giá',
            'quantity.required'=>'Chưa nhập số lượng cho mã giảm giá',
            'quantity.max'=>'Mã khuyến mãi không quá 100 ký tự',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $promo = new Promotion;
        $promo->description = $request->description;
        $promo->subcategory_id = $request->subcategory_id;
        $promo->discount = $request->discount;
        $promo->code = $request->code;
        $promo->quantity = $request->quantity;
        $promo->save();
        Session::flash('success','Đã thêm mã khuyến mãi thành công');
        return redirect()->back();
    }

    public function delete($id){
        Promotion::where('id',$id)->delete();
        Session::flash('success','Đã xoá');
        return redirect()->back();
    }

    public function edit($id){
        $category = Category::all();
        // $category = 
        
        $prom = DB::table('promotion')
        ->join('subcategory','promotion.subcategory_id','=','subcategory.id')
        ->where('promotion.id','=',"$id")
        ->first(['promotion.id','promotion.code','promotion.description','promotion.discount','promotion.subcategory_id','promotion.quantity']);
        // $promotion = Promotion::where('id',$id)->first();
        return view('admin.promotion.FormEdit')->with(['promotion'=>$prom,'category'=>$category]);
    }
    public function postEdit($id,Request $request){

        $rules=[
            'code' =>'required',
            'description'=>'required',
            'subcategory_id'=>'required',
            'discount'=>'required',
            'quantity'=>'required|max:100',
        ];
        $message = [
            'description.required'=>'Chưa nhập mô tả',
            'code.required'=>'Chưa nhập mã code khuyến mãi',
            'subcategory_id.required'=>'Chưa chọn danh mục khuyến mãi',
            'discount.required'=>'Chưa nhập % giảm giá',
            'quantity.required'=>'Chưa nhập số lượng cho mã giảm giá',
            'quantity.max'=>'Mã khuyến mãi không quá 100 ký tự',
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $promo = Promotion::where('id',$id)->first();
        $promo->description = $request->description;
        $promo->subcategory_id = $request->subcategory_id;
        $promo->discount = $request->discount;
        $promo->code = $request->code;
        $promo->quantity = $request->quantity;
        $promo->save();
        Session::flash('success','Đã sửa mã khuyến mãi thành công');
        return redirect()->back();


    }

    // public function checkItemPromotion($code,$subcategory_id){
   
    //     $flag = 0; // ko tìm thấ mã
    //     $promotion = Promotion::where('subcategory_id',$subcategory_id)->get();
    //     foreach ($promotion as $key => $value) {
    //         if($code == $promotion[$key]["code"]){
    //             if($value["quantity"] == 0){
    //                 $flag = -1; //Mã giảm giá đã hết
    //                 break;
    //             }
    //             $flag = 1; //Tìm thấy mã giảm giá
    //         }
    //     }
    //     return $flag;
    // }

    public function api_checkPromotion(Request $request){
        $code = $request->code;
        $message = '';
        $arr_subcategory_id = $request->subcategory_id;
        foreach ($arr_subcategory_id as $key => $value) {
            $promotion = Promotion::where('subcategory_id',$value)->get();
            foreach ($promotion as $index => $obj) {
                if($code == $promotion[$index]["code"]){
                    if($obj["quantity"] == 0){
                        return response()->json(['success'=>-1,'data'=>'Số lượng mã giảm giá này đã hết']);                
                    }
                    return response()->json(['success'=>1,'data'=>$obj["discount"]]);           
                }
            }
        }
       return  response()->json(['success'=>0,'data'=>'Mã giảm giá không hợp lệ cho đơn hàng của bạn']); 
        // foreach ($arr_subcategory_id as $key => $value) {
        //     if($this->checkItemPromotion($code,$value) == -1){
        //         return response()->json(['succes'=>-1,'data'=>'Số lượng mã giảm giá này đã hết']);                

        //     }else if($this->checkItemPromotion($code,$value) == 1){
        //         return response()->json(['succes'=>1,'data'=>$code]);
        //     }
        // }
        // response()->json(['succes'=>0,'data'=>'Mã giảm giá không hợp lệ cho đơn hàng của bạn']); 
    }

    public function api_getAll(){
        $all = Promotion::all();
        return response()->json(['success'=>1,'data'=>$all]);
    }
}
