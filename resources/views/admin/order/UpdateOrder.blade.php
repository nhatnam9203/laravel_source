
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Cập nhật trạng thái đơn hàng</h4>
        <form class="forms-sample" action="{{url('/order/postUpdateOrder/'.$orderItem->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
              <select class="form-control" name="status">
                <option @if ($orderItem->status == "Chưa giao hàng" ) {{ "selected" }} @endif value="Chưa giao hàng">Chưa giao hàng</option>
                <option @if ($orderItem->status == "Đang giao hàng" ) {{ "selected" }} @endif  value="Đang giao hàng">Đang giao hàng</option>
                <option @if ($orderItem->status == "Đã thanh toán" ) {{ "selected" }} @endif value="Đã thanh toán">Đã thanh toán</option>
                <option @if ($orderItem->status == "Đơn hàng đã huỷ" ) {{ "selected" }} @endif value="Đơn hàng đã huỷ">Huỷ đơn hàng</option>
              </select>
            </div>
            
            <button type="submit" class="btn btn-success mr-2">Cập nhật</button>
        </form>
    </div>

   
</div>

@endsection('content')


