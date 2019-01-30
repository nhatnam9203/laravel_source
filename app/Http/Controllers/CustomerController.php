<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use Validator;
use App\Customer;

class CustomerController extends Controller
{


    public function login(Request $request){
        if(Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
            $customer = Auth::guard('customer')->user();
            return response()->json(['success'=>1,'data'=>$customer]);
         }else{
             return response()->json(['success'=>0,'data'=>'Sai thông tin đăng nhập']);
         }
    }


    public function register(Request $request){
        $rules = [
            'email'=>'unique:Customer'
        ];
        $message = [
            'email.unique'=>'Email đã tồn tại, sử dụng email khác để đăng ký'
        ];
        $validator = Validator($request->all(),$rules,$message);
        if($validator->fails()){
            return response()->json(['success'=>0,'data'=>'Email đã tồn tại, sử dung email khác để đăng ký']);
        }
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->image = 'noImage.jpeg';
        $customer->save();
        return response()->json(['success'=>1,'data'=>'Đã đăng ký thành công']);
    }

    public function searchID($id){
        $customer = Customer::where('id',$id)->first();
        return response()->json(['success'=>1,'data'=>$customer]);
    }

  
}
