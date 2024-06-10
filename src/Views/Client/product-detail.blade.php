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
                <img src="{{ asset('assets/client/images/logos/logo-10.png') }}" style ="height: 80px;">
            </div>
            <!-- 4 cột giữa-->
            <div class="col-6 justify-content-center" style="margin-top: 25px;">
                <div class ="d-flex justify-content-start">
                    <input type="text" class="form-control" id="tim-kiem" placeholder="Tìm Kiếm Sản Phẩm"
                        name="ten-danhmuc" style="border-radius: 0px;">
                    <button class="btn btn-dark" style="border-radius: 0px;"><i
                            class="fa-solid fa-magnifying-glass fa-lg"></i> </button>
                </div>
            </div>
            <!-- 4 cột phải-->
            <div class="col-3 d-flex justify-content-center align-items-center">

                {{-- <div style="position: relative">
            <a href="/user/chi-tiet-gio-hang.html"><i class="fa-solid fa-cart-shopping ms-4 fa-lg"></i> </a>
            <span class="badge rounded-pill bg-danger" style="position: absolute; top: -12px; right: -20px">10</span>

           </div> --}}

                @if (!isset($_SESSION['user']))
                    <a class="btn btn-primary" href="{{ url('login') }}"> Đăng nhập </a>
                @endif

                @if (isset($_SESSION['user']))
                    <a class="btn btn-sm btn-info ms-2 rounded-pill" href="{{ url('login') }}"> Đăng xuất </a>
                @endif
            </div>

        </div>



        <div class ="container">
            <div class = "row">

                <div class ="col-5 d-flex justify-content-start">
                    <img src="{{ asset($product['img_thumbnail']) }}"
                        style ="height: 450px; width: 350px;  margin-top: 50px;">

                </div>


                <div class ="col-5 " style="margin-top: 50px;">
                    <div class="justify-content-center mt-30">
                        <div class ="mt-20">
                            <h2> {{ $product['name'] }}</h2>
                        </div>

                        <div class="mt-2">
                            <span> Tác giả: </span> <span
                                style ="font-weight: 700; font-size: 20px">{{ $product['author'] }}</span>
                        </div>
                        <div class="mt-2">
                            <span> Nhà xuất bản: </span> <span style ="font-weight: 700;">NXB Tổng Hợp TPHCM</span>
                        </div>
                        <div class="mt-2">
                            <span>Nhà cung cấp: </span> <span class="text-danger"> FIRST NEWS</span>
                        </div>
                        <div class="mt-2">
                            <span> Hình thức bìa: </span> <span style ="font-weight: 700;">Bìa Mềm</span>
                        </div>
                        <div class="mt-2">
                            <span> Đã bán: </span> <span style ="font-weight: 700;">20 sản phẩm</span>
                        </div>
                        <div class="mt-2">
                            <span style ="font-size:30px" class="text-danger"> {{ $product['discount_price'] }} </span>
                            <span> <del>{{ $product['price'] }}</del></span>
                        </div>
                        <div class="mt-2">
                            <span> Chính sách đổi trả </span> <span> trong vòng 30 ngày</span>
                        </div>

                        <div class ="mt-5">

                            <form action="{{ url('cart/add') }}" method="GET">
                                <input type="hidden" name="productID" value="{{ $product['id'] }}">
                                <input type="number" class="btn btn-outline-info btn-lg" min="1" name="quantity"
                                    value="1">
                                <button type="submit" class="btn btn-info btn-lg "> Thêm vào giỏ hàng</button>

                            </form>
                        </div>
                    </div>



                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-6" style="margin-top: 60px;">
                            <h3>Thông Tin Sản Phẩm</h3>
                            <table class="table table-striped">

                                <tr>
                                    <th>Tên nhà cung cấp</th>
                                    <th>FIRST NEWS</th>
                                </tr>

                                <tr>
                                    <th>Tác giả</th>
                                    <th>{{ $product['author']}}</th>
                                </tr>
                                <tr>
                                    <th>NXB</th>
                                    <th>NXB Tổng Hợp TPHCM</th>
                                </tr>
                                <tr>
                                    <th>Năm XB</th>
                                    <th>2020</th>
                                </tr>
                                <tr>
                                    <th>Trọng lượng (gr)
                                    </th>
                                    <th>450</th>
                                </tr>
                                <tr>
                                    <th>Kích thước bao bì</th>
                                    <th>20.5 x 14 cm</th>
                                </tr>
                                <tr>
                                    <th>Số trang</th>
                                    <th>408</th>
                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="container border-bottom">
                    <h3> Giới Thiệu Sản Phẩm </h3>
                    <p>
                        “Muôn kiếp nhân sinh” là tác phẩm do Giáo sư John Vũ - Nguyên Phong viết từ năm 2017 và hoàn tất
                        đầu năm 2020 ghi lại những câu chuyện, trải nghiệm tiền kiếp kỳ lạ từ nhiều kiếp sống của người
                        bạn tâm giao lâu năm, ông Thomas – một nhà kinh doanh tài chính nổi tiếng ở New York. Những câu
                        chuyện chưa từng tiết lộ này sẽ giúp mọi người trên thế giới chiêm nghiệm, khám phá các quy luật
                        về luật Nhân quả và Luân hồi của vũ trụ giữa lúc trái đất đang gặp nhiều tai ương, biến động,
                        khủng hoảng từng ngày.

                        “Muôn kiếp nhân sinh” là một bức tranh lớn với vô vàn mảnh ghép cuộc đời, là một cuốn phim đồ
                        sộ, sống động về những kiếp sống huyền bí, trải dài từ nền văn minh Atlantis hùng mạnh đến vương
                        quốc Ai Cập cổ đại của các Pharaoh quyền uy, đến Hợp Chủng Quốc Hoa Kỳ ngày nay.


                    </p>

                </div>

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
