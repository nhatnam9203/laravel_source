@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh sách mã khuyến mãi</h4>
      <div class="table-responsive">
        <table id="promotionList" class="table table-hover">
          <thead>
            <tr>
              <th>Mã giảm giá</th>
              <th>Mô tả</th>
              <th>Phầm trăm giảm giá</th>
              <th>danh mục đuọc giảm</th>
              <th>số lượng mã</th>
              <th>Tính nang9</th>
            </tr>
          </thead>
          <tbody>
              @foreach($promotions as $prom)
            <tr>
              <td>{{$prom->code}}</td>
              <td>{{$prom->description}}</td>
              <td>{{ $prom->discount }}</td>
              <td>{{ $prom->category_name }}</td>
              <td>{{ $prom->quantity }}</td>
              <td>
                    <a href="{{url('/promotion/edit/'.$prom->id)}}" class="btn btn-warning btn-fw">Edit</a>
                    <a href="{{url('/promotion/delete/'.$prom->id)}}" class="btn btn-danger btn-fw">Delete</a>
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