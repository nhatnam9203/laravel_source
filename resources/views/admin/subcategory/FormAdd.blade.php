
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm danh mục cha</h4>
        <form class="forms-sample" action="{{url('/subcategory/add')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Chọn danh mục cha</label>
                  <select class="form-control" name="idParent" id="">
                      <option value="" selected>Chọn danh mục cha</option>
                      @foreach($category as $cate)
                    <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Tên danh mục con </label>
                <input type="text" class="form-control" name="category_name" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Mô tả danh mục</label>
                <input type="text" class="form-control" name="category_desc" placeholder="Nhập mô tả">
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
    {{-- function validate(){
        let name = document.getElementById('name').value;
        let desc = document.getElementById('desc').value;
        if(!name){
            document.getElementById('mess_name').innerHTML = 'Chưa nhập tên danh mục';
            return false;
        }else{
            document.getElementById('mess_name').innerHTML = '';
        }
        if(!desc){
            document.getElementById('mess_desc').innerHTML = 'Chưa nhập mô tả';
            return false;
        }else{
            document.getElementById('mess_desc').innerHTML = '';
        }
    }


    funtion onSubmit(fld){
        if(!/(\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(fld.value)) {
            alert("Invalid image file type.");      
            fld.form.reset();
            fld.focus();        
            return false;  
    } --}}

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