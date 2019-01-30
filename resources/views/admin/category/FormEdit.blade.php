
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Sửa danh mục cha</h4>
        <form class="forms-sample" action="{{url('/category/edit/'.$category->id)}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Tên danh mục</label>
                <input type="text" class="form-control" name="category_name" placeholder="Nhập tên danh mục" value="{{$category->category_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Mô tả danh mục</label>
                <input type="text" class="form-control" name="category_desc" placeholder="Nhập mô tả" value="{{$category->category_desc}}">
            </div>

            <div class="form-group">
                <label>File upload</label>
                <input type="file" name="image" onchange="previewFile()" class="form-control file-upload-info">
            </div>
            <div class="img_add">
                <img src="" id="img" name="img" alt="">
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
        </form>
    </div>

   
</div>

@endsection('content')


@section('script')
<script>
    function previewFile() {
        var preview = document.getElementById('img');
        var file    = document.querySelector('input[type=file]').files[0];
        var reader  = new FileReader();
        console.log(file)
        reader.readAsDataURL(file);
        reader.onload=()=>{
            preview.src = reader.result;
        }
      }
</script>
@endsection