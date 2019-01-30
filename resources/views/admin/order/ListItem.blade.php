@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
            @if (count($orderItems) > 0)
      <h4 class="card-title">Danh sách đơn hàng</h4>
      <div class="table-responsive">
            <table id="OrderList" class="table table-hover">
                <thead>
                  <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Cập nhật</th>
 
                  </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $orderItem)
                    <tr>
                      <td>{{$orderItem->product_name}}</td>
                      <td>{{$orderItem->price}}</td>
                      <td>{{$orderItem->quantity}}</td>
                      <td>{{ $orderItem->status }}</td>
                      <td><a href="{{ url('/order/UpdateOrderItem/'.$orderItem->id) }}" class="btn btn-primary">Cập nhật</a></td>
                    </tr>
                        @endforeach
                </tbody>
              </table>
              @else
                {{ "Chứa có đơn đặt hàng" }}
              @endif
      
      </div>
    </div>
  </div>



@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#OrderList').DataTable();
        });
    </script>
@endsection