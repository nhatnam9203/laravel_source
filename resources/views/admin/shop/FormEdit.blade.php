
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Sửa thông tin shop</h4>
        <form class="forms-sample" action="{{url('/shop/edit/'.$shop->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Tên Shop</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên shop" value="{{$shop->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email Shop</label>
                <input type="text" class="form-control" disabled name="email" placeholder="Nhập email" value="{{$shop->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">SĐT Shop</label>
                <input type="text" class="form-control" name="phone" placeholder="Nhập Số điện thoại" value="{{$shop->phone}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Địa chỉ Shop</label>
                <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{$shop->address}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Thông tin Shop</label>
                <input type="text" class="form-control" name="description" placeholder="Nhập mô tả thông tin của shop" value="{{$shop->description}}">
            </div>

            <button type="submit" class="btn btn-success mr-2">Sửa thông tin shop</button>
        </form>
    </div>

   
</div>

@endsection('content')

