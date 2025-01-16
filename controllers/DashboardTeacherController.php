<?php
namespace Controllers;
use Classes\Categorie;
use Classes\Tag;

class DashboardTeacherController{

    public function __construct(){
        $this->categorie = new Categorie();
        $this->tag = new Tag();
    }

    public function home(){   
        $getAllCategories = $this->categorie->getAllCategories();
        $getAllTags = $this->tag->getAllTags();
        require(__DIR__ .'/../views/coursesTeacher.php');
    }
    public function inscriptions(){   
        require(__DIR__ .'/../views/coursInscriptionsTeacher.php');
    }
}









?>