<?php

namespace Asus\BaseWeb3014\Controllers\Client;

use Asus\BaseWeb3014\Commons\Controller;
use Asus\BaseWeb3014\Models\Cart;
use Asus\BaseWeb3014\Models\CartDetail;
use Asus\BaseWeb3014\Models\Order;
use Asus\BaseWeb3014\Models\OrderDetail;
use Asus\BaseWeb3014\Models\User;

class OrderController extends Controller{

    public Order $order;

    public User $user;

    public OrderDetail $orderDetail;

    private Cart $cart;

    private CartDetail $cartDetail;

    public function __construct(){
       $this->order = new Order();
       $this->user = new User();
       $this->orderDetail = new OrderDetail();
       $this->cart = new Cart();
       $this->cartDetail = new CartDetail();
    }

    public function checkout(){
        // chưa đăng nhập thì phải tạo tài khoản
        $userID = $_SESSION['user']['id'] ?? null;
        if(! $userID){
            $conn = $this->user->getConnection();

           $this->user->insert([
            'name' => $_POST['user_name'],
            'email' => $_POST['user_email'],
            'password' => password_hash($_POST['user_email'], PASSWORD_DEFAULT),
            'type' => 'member',
           ]);

           $userID = $conn->lastInsertId();
        }
        // thêm dữ liệu vào order và orderDetail
        $conn = $this->order->getConnection();
        $this->order->insert([
            'user_id' => $userID,
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_address' => $_POST['user_address'],
            
           ]);

           $orderID = $conn->lastInsertId();

           $key = 'cart';
           if(isset($_SESSION['user'])){
               $key .= '-' . $_SESSION['user']['id'];
           }

           foreach($_SESSION[$key] as $productID => $item){
            $this->orderDetail->insert([
                'order_id' => $orderID,
                'product_id'=> $productID,
                'quantity'=> $item['quantity'],
                'price'=> $item['price'],
                'discount_price'=> $item['discount_price'],
            ]);
    }

    // Xóa dữ liệu trong cart + cartDeatil theo CartID - $_SESSION['cart_id']

    //Xóa trong SESSION
      
    unset($_SESSION[$key]);

    if(isset($_SESSION['user'])){
        unset($_SESSION['cart_id']);
    }

        header('Location: ' . url());
        exit;
    }

}
    

   
    
     