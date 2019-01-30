@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh sách nhân viên</h4>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Tên nhân viên</th>
              <th>email</th>
              <th>số điện thoại</th>
              <th>địa chỉ</th>
              <th>Chức vụ</th>
              <th>Tính năng</th>
            </tr>
          </thead>
          <tbody>
              @foreach($users as $u)
            <tr>
              <td>{{$u->name}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->phone}}</td>
              <td>{{$u->address}}</td>
              <td>
                @if($u->level == 0)
                    {{"Quản lý"}}
                @elseif($u->level == 1)
                  {{"Nhân viên"}}
                @endif
              </td>
              <td>
                    <a href="" class="btn btn-primary btn-fw">View</a>
                    <a href="{{url('/admin/edit/'.$u->id)}}" class="btn btn-warning btn-fw">Edit</a>
                    <a href="{{url('/admin/delete/'.$u->id)}}" onclick="return confirm('có muốn xoá nhân viên này có id = ?' );" class="btn btn-danger btn-fw">Delete</a>
              </td>
            </tr>
                @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>



@endsection