
@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thêm mã khuyễn mãi cho danh mục</h4>
        <form class="forms-sample" action="{{url('/promotion/insertProm')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputName1">Danh mục</label>
                  <select class="form-control" id="category" name="category" onchange="triggleSubcategory();">
                      <option value="">Chọn danh mục</option>
                      @foreach ($category as $item)
                      <option value={{ $item->id }}>{{ $item->category_name }}</option>
                      @endforeach
                  </select>
            <div class="form-group">
                <label for="exampleInputName1">Danh mục con</label>
                <div class="form-group">
                  <label for="">Danh mục con</label>
                  <select class="form-control" id="subcategory" name="subcategory_id">
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Mã khuyến mãi</label>
                <input type="text" class="form-control" name="code" placeholder="Nhập mã khuyến mãi">
            </div>
            <div class="form-group">
                    <label for="exampleInputName1">Phần trăm khuyến mãi</label>
                    <input type="text" class="form-control" name="discount" placeholder="Nhập % khuyến mãi">
                </div>
            <div class="form-group">
                <label for="exampleInputName1">Mô tả</label>
                <input type="text" class="form-control" name="description" placeholder="Nhập mô tả">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Số lượng</label>
                <input type="text" class="form-control" name="quantity" placeholder="Nhập số lượng">
            </div>
            <button type="submit" class="btn btn-success mr-2">Submit</button>
        </form>
    </div>

   
</div>

@endsection('content')


@section('script')
<script>

    function triggleSubcategory(){
        const category_value = $('#category').val();
        $.get("/category/searchSubcategory/"+category_value,{
        },(data)=>{
            $("select[name='subcategory_id']").html('');
            $.each(data,(key,value)=>{
                $("select[name='subcategory_id']").append(
                       "<option value="+value.id+">"+value.category_name+"</option>"
                );
            })
        })
    }
</script>
@endsection