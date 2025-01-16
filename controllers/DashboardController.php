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

    public function pendingCourses(){
        $getPendingCourses = $this->cour->getPendingCourses();
        require(__DIR__ .'/../views/pendingCourses.php');
    }

    // acceptation des cours
    public function acceptCourse(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
            $this->cour->acceptCourse();
            return header('Location: /pendingCourses');
        }
    }

    // rejection des cours
    public function refuseCourse(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
            $this->cour->refuseCourse();
            return header('Location: /pendingCourses');
        }
    }
    // sign in page
    public function signUpPage(){
        require(__DIR__ . '/../views/sign-up.php');  
    }
}



?>