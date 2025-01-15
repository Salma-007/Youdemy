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

    // setter id
    public function setId($id){
        $this->id = $id;
    }

    // affichage des enseignants
    public function getAllTeachers(){
        $condition = [
            'role' => 'enseignant'
        ];
        return $this->crud->readWithCondition($this->table, $condition);
    }

    // pending teachers
    public function getAllPendingTeachers(){
        $condition = [
            'role' => 'enseignant',
            'enseignantConfirmed' => 0
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

    // pending teachers counts
    public function getCountPendingTeachers(){
        $condition = [
            'role' => 'enseignant',
            'enseignantConfirmed' => 0
        ];
        return $this->crud->countWithCondition($this->table, $condition);
    }
    // assign role teacher
    public function assignRoleTeacher(){
        $data = [
            'enseignantConfirmed' => 1
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    

}