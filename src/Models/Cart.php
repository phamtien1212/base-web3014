<?php

namespace Asus\BaseWeb3014\Models;

use Asus\BaseWeb3014\Commons\Model;

class Cart extends Model{
    
    protected string $tableName = 'carts'; 

    public function findByUserID($userID){
        return $this->queryBuilder
        ->select('*')
        ->from($this->tableName)
        ->where('user_id = ?')
        ->setParameter(0, $userID)
        ->fetchAssociative();
    }
}