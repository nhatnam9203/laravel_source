@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh sách sản phẩm</h4>
      <div class="table-responsive">
        <table id="promotionList" class="table table-hover">
          <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Tên shop</th>
              <th>Cập nhật</th>
            </tr>
          </thead>
          <tbody>
              @foreach($products as $product)
            <tr>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->shop_name }}</td>
              <td>
                    <a href="{{url('/product/capnhatkhuyenmai/'.$product->id)}}" class="btn btn-warning btn-fw">Cập nhật khuyến mãi</a>
              </td>
            </tr>
                @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $('#promotionList').DataTable();
        });
    </script>
@endsection