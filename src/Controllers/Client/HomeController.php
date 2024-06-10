<?php

namespace Asus\BaseWeb3014\Controllers\Client;

use Asus\BaseWeb3014\Commons\Controller;
use Asus\BaseWeb3014\Models\Category;
use Asus\BaseWeb3014\Models\Product;

class HomeController extends Controller{

    private Product $product;

    private Category $category;

    public function __construct(){
        $this->product = new Product();
        $this->category = new Category();

    }
    public function index(){

        
        $categories = $this->category->all();
        
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

        $this->renderViewClient('home', [
            'products'=> $products,
            'totalPage'=> $totalPage,
            'categories'=> $categories,
        ]);
  
    }
}