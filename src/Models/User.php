<?php

namespace Asus\BaseWeb3014\Models;

use Asus\BaseWeb3014\Commons\Model;

class User extends Model{
    protected string $tableName = 'users';

    public function findByEmail($email){
        return $this->queryBuilder
        ->select('*')
        ->from($this->tableName)
        ->where('email = ?')
        ->setParameter(0, $email)
        ->fetchAssociative();
    }
}