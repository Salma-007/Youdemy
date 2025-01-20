<?php
namespace Controllers;

use Classes\Student;

class StudentController{
    private $student;

    public function __construct(){
        $this->student = new Student();
    }
    // render students
    public function renderStudents(){
        $getAllStudents= $this->student->getAllStudents();
        $getCountStudent = $this->student->getCountStudents();
        require(__DIR__ . '/../views/students.php');  
    }
    // delete student 
    public function deleteStudent(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->student->setId($id);
            $this->student->deleteUser();
            return header('Location: /students');    
        }
    }
    // ban student
    public function banStudent(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->student->setId($id);
            $this->student->banUser();
            return header('Location: /students');    
        }
    }
    // activate student's account
    public function activateStudent(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->student->setId($id);
            $this->student->activateUser();
            return header('Location: /students');    
        }
    }
    // sign up
    public function signUpUser(){
        extract($_POST);
        $this->student->setNom($username);
        $this->student->setEmail($email);
        if (isset($role)) {
            $this->student->setRole($role);
        }
        $this->student->setPassword($pswd);
        $this->student->registerUser();
        return header('location: /signUp');
    }
    // sign in
    public function signInUser(){
        extract($_POST);
        $this->student->login($email, $pswd);
        // return header('location: /signUp');
    }

}