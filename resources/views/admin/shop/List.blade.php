@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh sách các cửa hàng</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          
          <thead>
            <tr>
              <th>Tên shop</th>
              <th>Email</th>
              <th>Số diện thoại</th>
              <th>Địa chỉ</th>

            </tr>
          </thead>
          <tbody>
              @foreach($shops as $shop)
            <tr>
              <td>{{ $shop->name }}</td>
              <td>{{ $shop->email }}</td>
              <td>{{ $shop->phone }}</td>
              <td>{{ $shop->address }}</td>
              <td>
                    <a href="{{ url('/shop/product/'.$shop->id) }}" class="btn btn-primary btn-fw">View</a>
                    <a href="{{url('/shop/edit/'.$shop->id)}}" class="btn btn-warning btn-fw">Edit</a>
                    <a href="{{url('/shop/delete/'.$shop->id)}}" class="btn btn-danger btn-fw">Delete</a>
              </td>
            </tr>
                @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>



@endsection