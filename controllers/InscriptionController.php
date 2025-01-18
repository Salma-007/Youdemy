<?php
namespace Controllers;

use Classes\Inscription;

class InscriptionController{
    private $enroll;

    public function __construct(){
        $this->enroll = new Inscription();
    }

    public function enrollStudent(){
        $this->enroll->setIdCour($_GET['id']);
        $this->enroll->setIdEtudiant($_SESSION['user_id']);
        $this->enroll->enrollStudent();
        return header('Location: /myCourses');
    }

    // mark a course as finished
    public function finishedCourse(){
        $this->enroll->setIdCour($_GET['id']);
        $this->enroll->setIdEtudiant($_SESSION['user_id']);
        $this->enroll->FinishedCourse();
        return header('Location: /myCourses');
    }

    // get the courses for a student
    public function getMyCourses(){
        // $this->enroll->setProgress(0);
        $this->enroll->setIdEtudiant($_SESSION['user_id']);
        $unfinishedCourses = $this->enroll->FinishedCoursesStudent(0);
        $finishedCourses = $this->enroll->FinishedCoursesStudent(1);
        // var_dump($unfinishedCourses);
        require(__DIR__ .'/../views/mesCours.php');
    }

}