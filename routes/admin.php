<?php

use Asus\BaseWeb3014\Controllers\Admin\CategoryController;
use Asus\BaseWeb3014\Controllers\Admin\DashboardController;
use Asus\BaseWeb3014\Controllers\Admin\ProductController;
use \Asus\BaseWeb3014\Controllers\Admin\UserController;

$router->before('GET|POST', '/admin/*.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' . url('login'));
        exit();
    }
});



$router->mount('/admin', function () use ($router){

    $router->get('/', DashboardController::class . '@dashboard');

    $router->mount('/users' , function () use ($router){

        $router->get('/',              UserController::class .'@index'); // danh sach
        $router->get('/create',        UserController::class .'@create');// show form them moi
        $router->post('/store',        UserController::class .'@store');// Luu moi va DB
        $router->get('/{id}/show',     UserController::class .'@show');// xem chi tiet
        $router->get('/{id}/edit',     UserController::class .'@edit');// show form sua
        $router->post('/{id}/update',   UserController::class .'@update');//lua sua vao DB
        $router->get('/{id}/delete',   UserController::class .'@delete');// xoa

    });
});

$router->mount('/admin', function () use ($router){

    $router->get('/', DashboardController::class . '@dashboard');

    $router->mount('/categories' , function () use ($router){

        $router->get('/',              CategoryController::class .'@index'); // danh sach
        $router->get('/create',        CategoryController::class .'@create');// show form them moi
        $router->post('/store',        CategoryController::class .'@store');// Luu moi va DB
        $router->get('/{id}/show',     CategoryController::class .'@show');// xem chi tiet
        $router->get('/{id}/edit',     CategoryController::class .'@edit');// show form sua
        $router->post('/{id}/update',   CategoryController::class .'@update');//lua sua vao DB
        $router->get('/{id}/delete',   CategoryController::class .'@delete');// xoa

    });
});

$router->mount('/admin', function () use ($router){

    $router->get('/', DashboardController::class . '@dashboard');

    $router->mount('/products' , function () use ($router){

        $router->get('/',              ProductController::class .'@index'); // danh sach
        $router->get('/create',        ProductController::class .'@create');// show form them moi
        $router->post('/store',        ProductController::class .'@store');// Luu moi va DB
        $router->get('/{id}/show',     ProductController::class .'@show');// xem chi tiet
        $router->get('/{id}/edit',     ProductController::class .'@edit');// show form sua
        $router->post('/{id}/update',   ProductController::class .'@update');//lua sua vao DB
        $router->get('/{id}/delete',   ProductController::class .'@delete');// xoa

    });
});

// $router->get('/admin/users/',               UserController::class . '@index');
// $router->get('/admin/users/create',         UserController::class . '@create');
// $router->post('/admin/users/store',         UserController::class . '@store');
// $router->get('/admin/users/{id}',           UserController::class . '@show');
// $router->get('/admin/users/{id}/edit',      UserController::class . '@edit');
// $router->post('/admin/users/{id}/update',   UserController::class . '@update');
// $router->post('/admin/users/{id}/delete',   UserController::class . '@delete');