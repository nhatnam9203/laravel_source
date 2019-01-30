@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
      <h4 class="card-title">Danh mục</h4>
      <div class="table-responsive">
        <table id="subCategoryList" class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên danh mục</th>
              <th>Danh mục cha</th>
              <th>Mô tả</th>
              <th>Hình</th>
              <th>Tính năng</th>
            </tr>
          </thead>
          <tbody>
              @foreach($category as $cate)
            <tr>
              <td>
                  <input type="checkbox" name="checkID" class="form-check-input" value="{{$cate->id}}">
              </td>
              <td>{{$cate->category_name}}</td>
              <td>{{$cate->category->category_name}}</td>
              <td>{{$cate->category_desc}}</td>
                <td><img src="http://localhost:8000/sanpham/hinhanh/{{$cate->image}}" alt=""></td>
              <td>
                    <a href="{{ url('/subcategory/product/'.$cate->id) }}" class="btn btn-primary btn-fw">View</a>
                    <a href="{{url('/subcategory/edit/'.$cate->id)}}" class="btn btn-warning btn-fw">Edit</a>
                    <a href="{{url('/subcategory/delete/'.$cate->id)}}" class="btn btn-danger btn-fw" onclick="return confirm('Bạn có chắc chắn muốn xoá không ?')">Delete</a>
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
            $('#subCategoryList').DataTable();
        });
    </script>
@endsection