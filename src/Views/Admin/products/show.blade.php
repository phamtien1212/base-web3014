@extends('layouts.master')

@section('title')
Chi tiết sản phẩm {{ $product['name']}}
@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-12">
      <div class="white_card card_height_100 mb_30">
          <div class="white_card_header">
              <div class="box_header m-0">
                  <div class="main-title">
                      <h1 class="m-0">Danh sách user</h1>
                  </div>
              </div>
          </div>
          <div class="white_card_body">
              <div class="table-responsive">
                 
                <table class="table">
                  <thead> 
                    <tr>
                      <th>Trường</th>
                      <th>Giá trị</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($product as $field => $value)
                    <tr>
                      <td>{{ $field }}</td>
                      <td> {{ $value }}</td>
                    @endforeach
                      <a class="btn btn-info" href="{{ url('admin/products/') }}"
                      > Quay lại</a>
                  </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>


@endsection

