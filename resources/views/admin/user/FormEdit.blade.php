
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm Nhân viên</h4>
        <form class="forms-sample" action="{{url('/admin/edit/'.$user->id)}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Tên</label>
                <input type="text" value="{{$user->name}}" class="form-control" name="name" placeholder="Nhập họ tên">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="email" value="{{$user->email}}" disabled class="form-control" name="email" placeholder="Nhập email">
            </div>
        
            <div class="form-group">
                    <label for="exampleInputName1">Phone</label>
                    <input type="text" value="{{$user->phone}}" class="form-control" name="phone" placeholder="Nhập số điện thoại">
            </div>
             <div class="form-group">
                <label for="exampleInputName1">Address</label>
                <input type="text" value="{{$user->address}}" class="form-control" name="address" placeholder="Nhập địa chi">
            </div>
            <div class="form-group">
                    <label for="exampleInputName1">Chức vụ</label>
                      <select class="form-control" name="level">
                        <option value="" selected>Chọn chức vụ</option>
                        <option @if($user->level == 0) {{"selected"}} @endif value="0">Quản lý</option>
                        <option @if($user->level == 1) {{"selected"}} @endif value="1">Nhân viên</option>
                      </select>
                    </div>
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
        </form>
    </div>

   
</div>

@endsection('content')



@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm Nhân viên</h4>
        <form class="forms-sample" action="{{url('/admin/edit')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Tên</label>
                <input type="text" value={{$user->name}} class="form-control" name="name" placeholder="Nhập họ tên">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="text" value={{$user->email}} class="form-control" name="email" placeholder="Nhập email">
            </div>
   
    
            <div class="form-group">
                    <label for="exampleInputName1">Phone</label>
                    <input type="text" class="form-control" value={{$user->phone}} name="phone" placeholder="Nhập số điện thoại">
            </div>
             <div class="form-group">
                <label for="exampleInputName1">Address</label>
                <input type="text" class="form-control" value={{$user->address}} name="address" placeholder="Nhập địa chi">
            </div>
            <div class="form-group">
                    <label for="exampleInputName1">Chức vụ</label>
                      <select class="form-control" name="level">
                        <option value="" selected>Chọn chức vụ</option>
                        <option @if($user->id == 0) {{"selected"}} @endif value="0">Quản lý</option>
                        <option @if($user->id == 1) {{"selected"}} @endif value="1">Nhân viên</option>
                      </select>
                    </div>
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
        </form>
    </div>
</div>

@endsection('content')


