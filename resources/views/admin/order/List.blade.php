@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
            @if (count($orders) > 0)
      <h4 class="card-title">Danh sách đơn hàng</h4>
      <div class="table-responsive">
            <table id="OrderList" class="table table-hover">
                <thead>
                  <tr>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Địa chỉ giao hàng</th>
                    <th>Chi tiết đơn hàng</th>
 
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                      <td>{{$order->customer_name}}</td>
                      <td>{{$order->date_order}}</td>
                      <td>{{$order->address}}</td>
                      <td><a href="{{ url('/order/orderItem/'.$order->id) }}" class="btn btn-primary">Xem chi tiết đơn hàng</a></td>
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