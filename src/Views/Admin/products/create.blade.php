@extends('layouts.master')

@section('title')
Thêm mới sản phẩm
@endsection

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-12">
      <div class="white_card card_height_100 mb_30">
          <div class="white_card_header">
              <div class="box_header m-0">
                  <div class="main-title">
                      <h1 class="m-0">Thêm mới sản phẩm</h1>
                  </div>
              </div>
          </div>
          <div class="white_card_body">
              <div class="table-responsive">
                @if (!empty($_SESSION['errors']))
                <div class=" alert alert-warning">
                  <ul>
                    @foreach(($_SESSION['errors']) as $error)
                    <li> {{ $error }}</li>
                    @endforeach
                  </ul>
                  @php
                      unset($_SESSION['errors']);
                  @endphp
                </div>    
                @endif
                <form action="{{ url('admin/products/store') }}" enctype="multipart/form-data" method="POST">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="mb-3 mt-3">
                              <label for="category_id" class="form-label">Category:</label>
                              
                             <select name="category_id" id="category_id">
                              @foreach ($categoryPluck as $id => $name)
                                  <option value="{{$id}}">{{ $name }}</option>
                              @endforeach
                             </select>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="name" class="form-label">Name:</label>
                              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="img_thumbnail" class="form-label">Img_thumbnail:</label>
                              <input type="file" class="form-control" id="img_thumbnail" placeholder="Enter img_thumbnail" name="img_thumbnail">
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="price" class="form-label">Price:</label>
                              <input type="text" class="form-control" id="price" placeholder="Enter price" name="price">
                            </div>
                   </div>
              
                      <div class="col-md-6">
                           
                            <div class="mb-3 mt-3">
                              <label for="discount_price" class="form-label">Discount_price:</label>
                              <input type="text" class="form-control" id="discount_price" placeholder="Enter discount_price" name="discount_price">
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="author" class="form-label">Author:</label>
                              <input type="text" class="form-control" id="author" placeholder="Enter author" name="author">
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="overview" class="form-label">Overview:</label>
                              <textarea class="form-control" id="overview" placeholder="Enter overview" name="overview"></textarea>
                            </div>
                            <div class="mb-3 mt-3">
                              <label for="content" class="form-label">Content:</label>
                              <textarea class="form-control" id="content" placeholder="Enter content" name="content"></textarea>
                            </div>
                      </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

