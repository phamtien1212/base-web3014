@extends('layouts.master')

@section('title')
    Danh sách danh mục
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách danh mục</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="table-responsive">
                        <a class="btn btn-primary" href="{{ url('admin/categories/create') }}"> Thêm mới</a>
                        @if (!empty($_SESSION['status']) && $_SESSION['status'])
                            <div class=" alert alert-warning">
                                {{ $_SESSION['msg'] }}
                            </div>
                            @php
                                unset($_SESSION['status']);

                                unset($_SESSION['msg']);

                            @endphp
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><?= $category['id'] ?></td>
                                        <td><?= $category['name'] ?></td>
                                        <td>
                                            <a class="btn btn-warning mr-3"
                                                href="{{ url('admin/categories/' . $category['id'] . '/edit') }}"> Sửa</a>
                                            <a class="btn btn-danger"
                                                href="{{ url('admin/categories/' . $category['id'] . '/delete') }}"
                                                onclick="return confirm('Chắc chắn xóa không?')"> Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
