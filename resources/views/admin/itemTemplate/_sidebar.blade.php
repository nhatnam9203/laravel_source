<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">


    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Danh mục</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{url('category/getAll')}}">Danh sách</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('category/add')}}">Thêm mới</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#subcategory" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Danh mục con</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="subcategory">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{url('subcategory/getAll')}}">Danh sách</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('subcategory/add')}}">Thêm mới</a>
          </li>
        </ul>
      </div>
    </li>
  
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#nhanvien" aria-expanded="false" aria-controls="nhanvien">
        <span class="menu-title">Nhân viên</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="nhanvien">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/getAll')}}">Danh sách</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('admin/add')}}">Thêm mới</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#promotion" aria-expanded="false" aria-controls="promotion">
        <span class="menu-title">Mã khuyến mãi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="promotion">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('promotion/getAll') }}">Danh sách</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('promotion/add') }}">Thêm mới</a>
          </li>
        </ul>
      </div>
    </li>


      

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#shop" aria-expanded="false" aria-controls="shop">
        <span class="menu-title">Shop</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="shop">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('shop/getAll') }}">Danh sách</a>
          </li>

        </ul>
      </div>
    </li>

  
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#hoadon" aria-expanded="false" aria-controls="hoadon">
        <span class="menu-title">Hoá đơn</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="hoadon">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{url('order/getAll') }}">Danh sách đơn hàng</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#capnhatkhuyenmai" aria-expanded="false" aria-controls="capnhatkhuyenmai">
        <span class="menu-title">Cập nhật sản phẩm khuyến mãi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="capnhatkhuyenmai">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{url('product/getAll') }}">Danh sách sản phẩm</a>
          </li>
        </ul>
      </div>
    </li>





  </ul>
</nav>