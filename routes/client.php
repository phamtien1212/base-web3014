<?php

use Asus\BaseWeb3014\Controllers\Admin\ProductController;
use Asus\BaseWeb3014\Controllers\Client\CartController;
use Asus\BaseWeb3014\Controllers\Client\HomeController;
use Asus\BaseWeb3014\Controllers\Client\LoginController;
use Asus\BaseWeb3014\Controllers\Client\OrderController;

$router->get('/', HomeController::class . '@index');

$router->get('/login', LoginController::class .'@showFormLogin');
$router->post('/handle-login', LoginController::class .'@login');
$router->get('/logout', LoginController::class .'@logout');

$router->get('/products/{id}',  ProductController::class . '@detail');


$router->get('/cart/add', CartController::class .'@add');
$router->get('/cart/quantityInc', CartController::class .'@quantityInc');
$router->get('/cart/quantityDec', CartController::class .'@quantityDec');
$router->get('/cart/remove', CartController::class .'@remove');
$router->get('/cart/detail', CartController::class .'@detail');

$router->post('/order/checkout', OrderController::class .'@checkout');