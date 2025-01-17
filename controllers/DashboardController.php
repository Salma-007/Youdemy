<?php
namespace Controllers;
use Classes\Cour;
use Classes\Categorie;
use Classes\Tag;
use Classes\User;

class DashboardController{
    private $cour;
    private $categorie;
    private $tag;
    private $coursesPerPage = 4;

    public function __construct(){
        $this->cour = new Cour();
        $this->categorie = new Categorie();
        $this->tag = new Tag();
    }

    public function home(){   
        // User::isAuth();
        $getCountCourses = $this->cour->getCountCourses();
        $getCountCategorie = $this->categorie->getCountCategories();
        $getCountTags = $this->tag->getCountTags();
        require(__DIR__ .'/../views/dashboard.php');
    }

    // affichage des cours
    public function CoursesHome(){
        $categories = $this->categorie->getAllCategories();
        
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $categoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;

        // Calculer l'offset pour la pagination
        $offset = ($currentPage - 1) * $this->coursesPerPage;

        // Récupérer les cours selon les filtres
        if ($categoryId) {
            $courses = $this->cour->getCoursesByCategory($categoryId, $this->coursesPerPage, $offset);
            $totalCourses = $this->cour->countCoursesByCategory($categoryId);
        } else {
            $courses = $this->cour->getAllCoursesLimit($this->coursesPerPage, $offset);
            $totalCourses = $this->cour->getCountCoursesAccepted();
        }

        // Calculer le nombre total de pages
        $totalPages = ceil($totalCourses / $this->coursesPerPage);
        require(__DIR__ .'/../views/youdemy.php');
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
    // sign in page
    public function signInPage(){
        require(__DIR__ . '/../views/sign-in.php');  
    }
}



?>