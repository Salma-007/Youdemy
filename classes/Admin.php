<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Admin extends User{

    public function __construct(){
        parent::__construct();
        $this->role = 'admin';
    }

    

}