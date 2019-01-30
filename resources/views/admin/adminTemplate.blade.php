
        {{--  <div class="master_page">
            <div class="left_sidebar">
                <h4>Admin</h4>
            </div>
            <div class="content_right">
                <div class="header">
                    <div class="admin_log">
                        <p>admin</p>
                    </div>
                </div>
                <div class="main_content">
                    @yield('content')
                </div>
            </div>
        </div>  --}}

        <!DOCTYPE html>
        <html lang="en">
        
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Quản lý web bán hàng</title>
          <!-- plugins:css -->
          <link rel="stylesheet" href="{{ URL::asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
          <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.base.css') }}">
          <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.addons.css') }}">
          <!-- endinject -->
          <!-- plugin css for this page -->
          <!-- End plugin css for this page -->
          <!-- inject:css -->
          <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
          <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
          <!-- endinject -->
          <link rel="shortcut icon" href="{{ URL::asset('images/favicon.png') }}" />
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  

        </head>
        
        <body>
          <div class="container-scroller">
            @include('admin.itemTemplate._navbar')
            <div class="container-fluid page-body-wrapper">
                    @include('admin.itemTemplate._sidebar')
                    <div class="main-panel">
                            <div class="content-wrapper">
                               @yield('content')
                            </div>
                    </div>
            </div>
            
       
            



          

          <!-- plugins:js -->
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
          <script src="{{ URL::asset('vendors/js/vendor.bundle.base.js') }}"></script>
          <script src="{{ URL::asset('vendors/js/vendor.bundle.addons.js') }}"></script>
          <!-- endinject -->
          <!-- Plugin js for this page-->
          <!-- End plugin js for this page-->
          <!-- inject:js -->
          <script src="{{ URL::asset('js/off-canvas.js') }}"></script>
          <script src="{{ URL::asset('js/misc.js') }}"></script>
          <!-- endinject -->
          <!-- Custom js for this page-->
          <script src="{{ URL::asset('js/dashboard.js') }}"></script>
          <!-- End custom js for this page-->

          @yield('script')
        </body>
        
        </html>


