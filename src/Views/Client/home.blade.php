
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://kit.fontawesome.com/ae333ffef2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style1.css') }}">
      <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
      <div class ="row">
        <!--4 cột trái-->
         <div class="col-3 d-flex justify-content-start align-items-center"> 
            <img src="{{ asset('assets/client/images/logos/logo-10.png')}}" style ="height: 80px;">
        </div>
        <!-- 4 cột giữa-->
        <div class="col-6 justify-content-center" style="margin-top: 25px;">
           <div class ="d-flex justify-content-start">
            <input type="text" class="form-control" id="tim-kiem" placeholder="Tìm Kiếm Sản Phẩm" name="ten-danhmuc" style="border-radius: 0px;">
            <button class="btn btn-dark" style="border-radius: 0px;"><i class="fa-solid fa-magnifying-glass fa-lg"></i> </button>
           </div>
        </div>
        <!-- 4 cột phải-->
        <div class="col-3 d-flex justify-content-center align-items-center">
            
           {{-- <div style="position: relative">
            <a href="/user/chi-tiet-gio-hang.html"><i class="fa-solid fa-cart-shopping ms-4 fa-lg"></i> </a>
            <span class="badge rounded-pill bg-danger" style="position: absolute; top: -12px; right: -20px">10</span>

           </div> --}}

           @if (!isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login')}}" > Đăng nhập </a>
           @endif

           @if (isset($_SESSION['user']))
           <a class="btn btn-sm btn-info ms-2 rounded-pill" href="{{ url('login')}}" > Đăng xuất </a>
           @endif       
        </div>

    </div>

    <nav class="navbar navbar-expand-sm ">

      <div class="container-fluid justify-content-center bg-info">
        <!-- Links -->
        <ul class="navbar-nav mr-5">
            @foreach ($categories as $category)
            <li class="nav-item ">
            <a class="nav-link" href="/user/sach-van-hoc.html">{{ $category['name']}}</a>
           </li>
            @endforeach
         
        </ul>
      </div>
    
    </nav>

    <div id="demo" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>
    
      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('assets/client/images/backgrounds/banner-1.jpg')}}" width="300px" height="400px" alt="Los Angeles" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('assets/client/images/backgrounds/banner-2.jpg')}}" width="500px" height="400px" alt="Chicago" class="d-block w-100">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('assets/client/images/backgrounds/banner-3.jpeg')}}" width="500px" height="400px" alt="New York" class="d-block w-100">
        </div>
      </div>
    
      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <div class =" container">
      <h1 class="text-center" style="margin-top: 40px;"> Sản Phẩm Mới </h1>
       <div class = "row ms-4" style="margin-top: 40px;">
        
           @foreach ($products as $product)
          <div class ="col-md-4 mb-3 mt-3">
            <div class="card">
              <img class="card-img-top" style="max-height: 300px" width="200px" src="{{ asset($product['img_thumbnail'])}}" alt="Card image"></a>
              <div class="card-body">
                <h5 class="card-title text-center">
                  <a href="{{ url('products/' . $product['id']) }}"> {{ $product['name']}} </a>
                </h5>
                <p class="card-text">
                  <p class="text-center text-danger">{{ $product['discount_price']}}</p>
                  <p class="text-center"> <del>{{ $product['price']}}</del></p>
                </p>
               <div class = "text-center">
                <a href="{{ url('cart/add') }}?quantity=1&productID={{ $product['id']}}" class="btn btn-primary">Thêm vào giỏi hàng</a>
               </div>
              </div>
            </div>

          </div>
          @endforeach

       </div>

    </div>

    <nav class="navbar navbar-expand-sm bg-info navbar-info flex-column mt-5 ">
      <div class="container-fluid justify-content-center nav flex-column">
        <span class = "text-light"> BOOK STORE - MANG TRI THỨC ĐI MUÔN NƠI</span>
       <span class ="text-light"> Hotline: 1900.1001</span>
      </div>
  </nav>

    
</body>
</html>