<?php

namespace Asus\BaseWeb3014\Controllers\Admin;

use Asus\BaseWeb3014\Commons\Controller;
use Asus\BaseWeb3014\Commons\Helper;
use Asus\BaseWeb3014\Models\Category;
use Asus\BaseWeb3014\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller{
     private Product $product;

     private Category $category;

    public function __construct(){
        $this->product = new Product();
        $this->category = new Category();
     }

    public function index(){
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);


        $this->renderViewAdmin('products.index', [
            'products'=> $products,
            'totalPage'=> $totalPage
        ]);
    }

    public function create(){

        $categories = $this->category->all();

        $categoryPluck = array_column($categories,'name','id');

        $this->renderViewAdmin('products.create', [
            'categoryPluck'=> $categoryPluck,
        ]);

    }   

    public function store(){

        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'category_id'                  => 'required',
            'name'                         => 'required|max:100',
            'price'                        => 'required|numeric',
            'discount_price'               => 'required|numeric',
            'author'                       => 'required',
            'overview'                     => 'required|max:65000',
            'content'                      => 'required',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);

        $validation->validate();

        if($validation->fails()){

            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            
            header('Location: ' . url('admin/products/create'));
            exit();
        }else{
            $data = [
            'category_id'                  => $_POST['category_id'],
            'name'                         => $_POST['name'],
            'price'                        => $_POST['price'],
            'discount_price'               => $_POST['discount_price'],
            'author'                       => $_POST['author'],
            'overview'                     => $_POST['overview'],
            'content'                      => $_POST['content'],
            ];

            if(isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0){
                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads' . time() .  $_FILES['img_thumbnail']['name'];

                if(move_uploaded_file($from, PATH_ROOT .  $to)){
                    $data['img_thumbnail'] = $to;
                }else{
                    $_SESSION['errors']['img_thumbnail'] = ' Upload không thành công';

                    header('Location: ' . url('admin/products/create'));
                    exit();
                }

            }

            $this->product->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';
 
            header('Location: ' . url('admin/products'));
            exit();
        }


    }

    public function show($id){
          $product = $this->product->findByID($id);

          $this->renderViewAdmin('products.show', [
            'product'=> $product
          ]);
    }

    public function edit($id){
        $product = $this->product->findByID($id);

        $categories = $this->category->all();

        $categoryPluck = array_column($categories,'name','id');

        $this->renderViewAdmin('products.edit', [
         'product'=> $product,
         'categoryPluck' => $categoryPluck
        ]);
    }

    public function update($id){
        $product = $this->product->findByID($id);

        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, [
            'category_id'                  => 'required',
            'name'                         => 'required|max:100',
            'price'                        => 'required|numeric',
            'discount_price'               => 'required|numeric',
            'author'                       => 'required',
            'overview'                     => 'required|max:65000',
            'content'                      => 'required',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);

        $validation->validate();

        if($validation->fails()){

            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            
            header('Location: ' . url("admin/products/{$product['id']}/edit"));
            exit();
        }else{
            $data = [
            'category_id'                  => $_POST['category_id'],
            'name'                         => $_POST['name'],
            'price'                        => $_POST['price'],
            'discount_price'               => $_POST['discount_price'],
            'author'                       => $_POST['author'],
            'overview'                     => $_POST['overview'],
            'content'                      => $_POST['content'],
            'updated_at'                   => date('Y-m-d H:i:s'),
            ];

            
            $flagUpdate = false;

            if(isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0){
                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads' . time() .  $_FILES['img_thumbnail']['name'];

                if(move_uploaded_file($from, PATH_ROOT .  $to)){
                    $data['img_thumbnail'] = $to;
                }else{
                    $_SESSION['errors']['img_thumbnail'] = ' Upload không thành công';

                    header('Location: ' . url('admin/products/create'));
                    exit();
                }

            }

            $this->product->update($id, $data);

            if($flagUpdate && $product['img_thumbnail'] && file_exists(PATH_ROOT . $product['img_thumnail'])){
                unlink(PATH_ROOT . $product['img_thumbnail']);
               }
    

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';
 
            header('Location: ' . url("admin/products/{$product['id']}/edit"));
            exit();
        }


    }

    public function delete($id){
      
        $product = $this->product->findByID($id);

        $this->product->delete($id);

        if( $product['img_thumbnail'] && file_exists(PATH_ROOT . $product['img_thumbnail'])){
            unlink(PATH_ROOT . $product['img_thumbnail']);
           }

        header('Location: ' . url('admin/products'));
        exit();

    }

    public function detail($id){
        $product = $this->product->findByID($id);

        $this->renderViewClient('product-detail',[
          'product' => $product,
        ]);
    }

    public function productDetail($id){
        $products = $this->product->findByID($id);

        $this->renderViewClient('detail-product',[
          'product' => $products,
        ]);
    }


}

