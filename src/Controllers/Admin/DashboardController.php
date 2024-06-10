<?php

namespace Asus\BaseWeb3014\Controllers\Admin;

use Asus\BaseWeb3014\Commons\Controller;

class DashboardController extends Controller{

    public function dashboard(){
        $this->renderViewAdmin('dashboard', []);
    }

}