<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Session;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminController extends Controller
{



    public function getAll(){
        $all = Admin::all();
        return view('admin.user.List')->with(['users'=>$all]);
    }

    public function add(){
        return view('admin.user.FormAdd');
    }

    public function AddAdmin(Request $request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' =>'required|min:4|max:32',
            'phone' =>'required',
            'address' => 'required',
            'level' =>'required'
        ];
        $message = [
            'name.required' => 'Chưa nhập tên user',
            'email.required' =>'Chưa nhập email',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'Chưa nhập mật khẩu',
            'phone.required' => 'Chưa nhập số điện thoại',
            'address.required' => 'Chưa nhập địa chỉ',
            'level.required' => 'Chưa chọn chức vụ',
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $user = new Admin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;
        $user->save();
        Session::flash('success','Đã thêm nhân viên thành công');
        return redirect()->back();
    }


    public function edit($id){
        $user = Admin::where('id',$id)->first();
        return view('admin.user.FormEdit')->with(['user'=>$user]);
    }

    public function EditAdmin($id,Request $request){
        $rules = [
            'name' => 'required',
            'phone' =>'required',
            'address' => 'required',
            'level' =>'required'
        ];
        $message = [
            'name.required' => 'Chưa nhập tên user',
            'phone.required' => 'Chưa nhập số điện thoại',
            'address.required' => 'Chưa nhập địa chỉ',
            'level.required' => 'Chưa chọn chức vụ',
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $user = Admin::where('id',$id)->first();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;
        $user->save();
        Session::flash('success','Đã sửa nhân viên thành công');
        return redirect()->back();
    }


    public function DeleteAdmin($id){
        Admin::where('id',$id)->delete();
        Session::flash('success','Đã delete user có id = '. $id);
        return redirect()->back();
    }


    public function deleteMany(Request $request){
        foreach ($request->checkboxID as $key => $value) {
            Admin::where('id',$value)->delete();
        }
        Session::flash('success', 'Đã xoá thành công');
        return redirect()->back();
    }

    public function login(){
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {

        $rules = [
    
            'email' => 'required|email',
            'password' =>'required',
        ];
        $message = [

            'email.required' =>'Chưa nhập email',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'Chưa nhập mật khẩu',

        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/promotion/getAll');
         }else
             return redirect()->back()->withErrors('Sai thông tin đăng nhập');
    }


    public function logout_admin(){
        Auth::guard('admin')->logout(); 
        return view('admin.login');
    }


}
