<?php
namespace Controllers;
use Classes\Cour;
use Classes\Categorie;
use Classes\Tag;

class DashboardController{
    private $cour;
    private $categorie;
    private $tag;

    public function __construct(){
        $this->cour = new Cour();
        $this->categorie = new Categorie();
        $this->tag = new Tag();
    }

    public function home(){   
        $getCountCourses = $this->cour->getCountCourses();
        $getCountCategorie = $this->categorie->getCountCategories();
        $getCountTags = $this->tag->getCountTags();
        require(__DIR__ .'/../views/dashboard.php');
    }
    public function courses(){
        $getAllCourses = $this->cour->getAllCourses();
        require(__DIR__ .'/../views/coursesAdmin.php');
    }
}



?>