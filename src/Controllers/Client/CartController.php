<?php

namespace Asus\BaseWeb3014\Controllers\Client;

use Asus\BaseWeb3014\Commons\Controller;
use Asus\BaseWeb3014\Commons\Helper;
use Asus\BaseWeb3014\Models\Cart;
use Asus\BaseWeb3014\Models\CartDetail;
use Asus\BaseWeb3014\Models\Product;

class CartController extends Controller{

    private Product $product;

    private Cart $cart;

    private CartDetail $cartDetail;

    public function __construct(){
        $this->product = new Product();
        $this->cart = new Cart();
        $this->cartDetail = new CartDetail();
    }
    

    //thêm vào giỏ hàng
    public function add(){
       
        //lấy thông tin sản phẩm theo id
        $product = $this->product->findByID($_GET['productID']);
        //khởi tạo SESSION cart
        //check đang đăng nhập hay k
        $key = 'cart';
        if(isset($_SESSION['user'])){
            $key .= '-' . $_SESSION['user']['id'];
        }

        if(!isset($_SESSION[$key][ $product['id'] ])){
            $_SESSION[$key][ $product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        }else{
            $_SESSION[$key][ $product['id']]['quantity'] += $_GET['quantity'];
        }


        //Nếu đăng nhập thì phải lưu nó vào csdl
        if(isset($_SESSION['user'])){
            $conn = $this->cart->getConnection();

            // $conn->beginTransaction();
            try{

                $cart = $this->cart->findByUserID($_SESSION['user']['id']);

                if(empty($cart)){
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id'],
                    ]);
                }
               

                $cartID = $cart['id'] ?? $conn->lastInsertId();

                $_SESSION['cart_id'] = $cartID;

                $this->cartDetail->deleteByCartID($cartID);

                foreach($_SESSION[$key] as $productID => $item){
                        $this->cartDetail->insert([
                            'cart_id' => $cartID,
                            'product_id'=> $productID,
                            'quantity'=> $item['quantity'],
                        ]);
                }

                // $conn->commit();

            }catch(\Throwable $th){

                // $conn->rollBack();

            }
        }
        header('Location: ' . url('cart/detail'));
        exit;
    }
    
     //chi tiết giỏi hàng
     public function detail(){
        $this->renderViewClient('cart', []);
     }
    // tăng số lượng
    public function quantityInc(){
       // lấy ra dữ liệu từ cart_details để đảm bảo nó cos tồn tại bảng ghi

       // thay đổi trong SESSION
       $key = 'cart';
       if(isset($_SESSION['user'])){
           $key .= '-' . $_SESSION['user']['id'];
       }

       $_SESSION[$key][$_GET['productID']]['quantity'] += 1;

       // thay đổi trong DB
       if(isset($_SESSION['user'])){
        $this->cartDetail->updateByCartIDAndProductID($_GET['cartID'], $_GET['productID'], $_SESSION[$key][$_GET['productID']]['quantity']);
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }
    

    //giảm số lượng
    public function quantityDec(){
        // lấy ra dữ liệu từ cart_details để đảm bảo nó cos tồn tại bảng ghi

       // thay đổi trong SESSION
       $key = 'cart';
       if(isset($_SESSION['user'])){
           $key .= '-' . $_SESSION['user']['id'];
       }
       
       if( $_SESSION[$key][$_GET['productID']]['quantity'] > 1){
        $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
       }
      

       // thay đổi trong DB
       if(isset($_SESSION['user'])){
        $this->cartDetail->updateByCartIDAndProductID($_GET['cartID'], $_GET['productID'], $_SESSION[$key][$_GET['productID']]['quantity']);
        }

        header('Location: ' . url('cart/detail'));
        exit;

    }

    //xóa item or xóa trắng
    public function remove(){

        $key = 'cart';
        if(isset($_SESSION['user'])){
            $key .= '-' . $_SESSION['user']['id'];
        }

        unset($_SESSION[$key][ $_GET['productID']]);

        if(isset($_SESSION['user'])){
            $this->cartDetail->deleteByCartIDAndProductID($_GET['cartID'], $_GET['productID']);
        }

        header('Location: ' . url('cart/detail'));
        exit;

    }



}