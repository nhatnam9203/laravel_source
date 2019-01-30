<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>

<body style="background-color:#2097D1">
       
        <div class="adminLogin-container">
                @include('alert.error')
                <div class="adminLogin-wrapper">
                        <div class = "adminLogin-title">
                                <h4>Admin</h4>
                        </div>
            
                        <form action="{{url('/login')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                              <input type="email" name="email" class="form-control" placeholder="Nhập email" >
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="****************">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </div>
                        </form>
                </div>
           
        </div>

</body>
</html>