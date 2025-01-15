<?php
namespace Classes;

use Config\Database;
use Classes\BaseModel;
use PDO;

abstract class User{
    protected $table = 'users';
    protected $crud;
    protected $role;

    public function __construct(){
        $conn = Database::connect();
        $this->crud  = new BaseModel($conn);
    }

    public function login(){

    }
    public function logout(){

    }

}