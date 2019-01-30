
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Cập nhật khuyến mãi cho sản phẩm</h4>
        <form class="forms-sample" action="{{url('/product/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Tên sản phẩm</label>
                <input type="text" class="form-control" disabled value="{{ $product->product_name }}" name="product_name">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Shop</label>
                <input type="text" class="form-control" value="{{ $product->shop_name }}" disabled name="shop_name" >
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Giá cũ</label>
                <input type="text" class="form-control" value="{{ $product->price }}" disabled name="price" >
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Giá khuyến mãi</label>
                <input type="text" class="form-control" name="new_price" placeholder="Nhập giá khuyến mãi cho sản phẩm">
            </div>


            <div class="form-group">
              <label for="">Chọn thời gian khuyến mãi</label>
              <select class="form-control" name="date_promotion" id="">
                <option value="">Chọn thời gian khuyến mãi</option>
                <option value="{{ $time2 }}" >Trước 15h</option>
                <option value="{{ $time1 }}" >Sau 15h</option>
              </select>
            </div>

          
            <button type="submit" class="btn btn-success mr-2">Submit</button>
        </form>
    </div>

   
</div>

@endsection('content')


