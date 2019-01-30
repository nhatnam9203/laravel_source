@extends('admin.adminTemplate')
@section('content')


@include('alert.error')
@include('alert.success')
<div class="card">
    <div class="card-body">
            @if (count($products) > 0)
      <h4 class="card-title">Danh sách sản phẩm của danh mục này</h4>
      <div class="table-responsive">
            <table id="productList_Shop" class="table table-hover">
                <thead>
                  <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                  <tr>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                  </tr>
                      @endforeach
                </tbody>
              </table>
              @else
                {{ "Danh mục này chưa có sản phẩm." }}
              @endif
      
      </div>
    </div>
  </div>



@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#productList_Shop').DataTable();
        });
    </script>
@endsection