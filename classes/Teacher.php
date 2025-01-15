<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Teacher extends User{

    public function __construct(){
        parent::__construct();
        $this->role = 'enseignant';
    }

    // affichage des enseignants
    public function getAllTeachers(){
        $condition = [
            'role' => 'enseignant'
        ];
        return $this->crud->readWithCondition($this->table, $condition);
    }

    // teachers counts
    public function getCountTeachers(){
        $condition = [
            'role' => 'enseignant'
        ];
        return $this->crud->countWithCondition($this->table, $condition);
    }
    
    

}