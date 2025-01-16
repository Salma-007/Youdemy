<?php
namespace Controllers;

use Classes\Teacher;

class TeacherController{
    private $teacher;

    public function __construct(){
        $this->teacher = new Teacher();
    }
    // render teachers
    public function renderTeachers(){
        $getAllTeachers= $this->teacher->getAllTeachers();
        $getCountTeacher = $this->teacher->getCountTeachers();
        require(__DIR__ . '/../views/teachers.php');  
    }
    // render teachers
    public function renderPendingTeachers(){
        $getAllTeachers= $this->teacher->getAllPendingTeachers();
        $getCountTeacher = $this->teacher->getCountPendingTeachers();
        require(__DIR__ . '/../views/pendingTeachers.php');  
    }
    // assign roles
    public function assignTeacher(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->teacher->setId($id);
            $this->teacher->assignRoleTeacher();
            return header('Location: /pendingTeachers');
        }
    }
    // delete teacher 
    public function deleteTeacher(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->teacher->setId($id);
            $this->teacher->deleteUser();
            return header('Location: /teachers');    
        }
    }
    // ban teacher
    public function banTeacher(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->teacher->setId($id);
            $this->teacher->banUser();
            return header('Location: /teachers');    
        }
    }
    // activate teacher's account
    public function activateTeacher(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->teacher->setId($id);
            $this->teacher->activateUser();
            return header('Location: /teachers');    
        }
    }


}