<?php
namespace Controllers;
use Classes\Categorie;
use Classes\Tag;
use Classes\Cour;
use Classes\User;
use Classes\Inscription;

class DashboardTeacherController{
    private $cour;
    private $categorie;
    private $tag;
    private $inscriptions;

    public function __construct(){
        $this->categorie = new Categorie();
        $this->tag = new Tag();
        $this->cour = new Cour();
        $this->inscriptions = new Inscription();
    }

    public function home(){  
        // User::isAuth(); 
        $getAllCategories = $this->categorie->getAllCategories();
        $getAllTags = $this->tag->getAllTags();
        $getCountCategorie = $this->categorie->getCountCategories();
        $getCountInscriptions = $this->inscriptions->getCountInscriptions($_SESSION['user_id']);
        $getAllCourses = $this->cour->getAllCoursesByTeacher($_SESSION['user_id']);
        $getCountCourses = $this->cour->getCountCoursesByTeacher($_SESSION['user_id']);
        require(__DIR__ .'/../views/coursesTeacher.php');
    }
    public function inscriptions(){   
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
        $users = $this->cour->getInscriptions();
        require(__DIR__ .'/../views/coursInscriptionsTeacher.php');
        }
        // echo $users;
    }
    // get course by id
    public function getCoursebyId(){
        $getAllCategories = $this->categorie->getAllCategories();
        $getAllTags = $this->tag->getAllTags();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
            $courseData = $this->cour->getCourseById();
            require(__DIR__ . '/../views/updateCourse.php');  
        }
    }
    public function deleteCourse(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
            if ($this->cour->deleteCourse()) {
                return header('Location: /coursesTeacher');
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        } else {
            echo "ID manquant.";
        }
    }
    
}









?>