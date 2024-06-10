<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style1.css') }}">
      <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
            <h1 class="mt-5"> Welcome {{ $name }} to website</h1>

            <nav>
                @if (!isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login')}}" > Login </a>
                @endif
               

                @if (isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login')}}" > logout </a>
                @endif
               
            </nav>

    <div class="row">
        <div class="col-md-4 mb-3 mt-3">
            <div class="card" >
                <img class="card-img-top" style="max-height: 200px" src="{{ asset($product['img_thumbnail'])}}" alt="Card image">
                <div class="card-body">
                  <h4 class="card-title">{{ $product['name']}}</h4>
                  <p class="card-text">{{ $product['price']}}</p>
                 
                  <form action="{{ url('cart/add') }}" method="GET">
                    <input type="hidden" name="productID" value="{{ $product['id']}}">
                    <input type="number" min="1" name="quantity" value="1">
                    <button type="submit"> Thêm vào giỏ hàng</button>

                  </form>
                </div>
              </div>
        </div>
    </div>
   

    
</body>
</html>