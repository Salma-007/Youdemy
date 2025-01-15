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



}