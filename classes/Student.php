<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Student extends User{

    public function __construct(){
        parent::__construct();
        $this->role = 'etudiant';
    }

    // affichage des etudiants
    public function getAllStudents(){
        $condition = [
            'role' => 'etudiant'
        ];
        return $this->crud->readWithCondition($this->table, $condition);
    }

    // student counts
    public function getCountStudents(){
        $condition = [
            'role' => 'etudiant'
        ];
        return $this->crud->countWithCondition($this->table, $condition);
    }
    

}