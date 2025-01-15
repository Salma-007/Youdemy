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


}