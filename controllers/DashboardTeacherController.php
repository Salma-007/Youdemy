<?php
namespace Controllers;
use Classes\Categorie;
use Classes\Tag;
use Classes\Cour;

class DashboardTeacherController{

    public function __construct(){
        $this->categorie = new Categorie();
        $this->tag = new Tag();
        $this->cour = new Cour();
    }

    public function home(){   
        $getAllCategories = $this->categorie->getAllCategories();
        $getAllTags = $this->tag->getAllTags();
        $getAllCourses = $this->cour->getAllCourses();
        require(__DIR__ .'/../views/coursesTeacher.php');
    }
    public function inscriptions(){   
        require(__DIR__ .'/../views/coursInscriptionsTeacher.php');
    }
}









?>