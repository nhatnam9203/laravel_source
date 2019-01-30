@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh mục</h4>
      <div class="table-responsive">
        <table id="categoryList" class="table table-hover">
          <thead>
            <tr>
              <th>Tên danh mục</th>
              <th>Mô tả</th>
              <th>Hình</th>
              <th>Tính năng</th>
            </tr>
          </thead>
          <tbody>
              @foreach($category as $cate)
            <tr>
              <td>{{$cate->category_name}}</td>
              <td>{{$cate->category_desc}}</td>
                <td>{{$cate->image}}</td>
              <td>
                    <a href="{{ url('category/product/'.$cate->id) }}" class="btn btn-primary btn-fw">View</a>
                    <a href="{{url('/subcategory/edit/'.$cate->id)}}" class="btn btn-warning btn-fw">Edit</a>
                    <a href="{{url('/subcategory/delete/'.$cate->id)}}" class="btn btn-danger btn-fw">Delete</a>
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
            $('#categoryList').DataTable();
        });
    </script>
@endsection
