<?php

namespace Asus\BaseWeb3014\Controllers\Admin;

use Asus\BaseWeb3014\Commons\Controller;
use Asus\BaseWeb3014\Commons\Helper;
use Asus\BaseWeb3014\Models\Category;
use Rakit\Validation\Validator;

class CategoryController extends Controller{

    private Category $category;

    public function __construct(){
        $this->category = new Category();
    }

    public function index(){

        [$categories, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('categories.index', [
            'categories'=> $categories,
            'totalPage'=> $totalPage
        ]);
    }

    public function create(){
        $this->renderViewAdmin('categories.create',[]);
       
    }

    public function store(){
        $data = [
            'name'                  => $_POST['name'],
            ];
        $this->category->insert($data);

        $_SESSION['status'] = true;
        $_SESSION['msg'] = 'Thao tác thành công';

        header('Location: ' . url('admin/categories'));
        exit();

    }
       

    public function edit($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categories.edit', [
         'category'=> $category
        ]);
    }

    public function update($id)
    {
        $category = $this->category->findByID($id);

        $data = [
            'name'                  => $_POST['name'],
            ];
    
        $this->category->update($id, $data);
        $_SESSION['status'] = true;
           $_SESSION['msg'] = 'Thao tác thành công';

           header('Location: ' . url("admin/categories/{$category['id']}/edit"));
           exit();

      
}

    public function delete($id)
    {
      
        $this->category->findByID($id);

        $this->category->delete($id);

        header('Location: ' . url('admin/categories'));
        exit();
       
    }

    
}