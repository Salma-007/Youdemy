<?php
namespace Controllers;

use Classes\Cour;

class CourseController{
    private $cour;

    public function __construct(){
        $this->cour = new Cour();
    }
    // add course
    public function addCourse(){
        extract($_POST);
        $photo = $_FILES['photo_input']['name'];
        $photo_tmp = $_FILES['photo_input']['tmp_name'];

        if ($photo) {
            $photo_folder = '../public/assets/uploads/' . $photo;
            if (!file_exists($photo_folder)) {
                move_uploaded_file($photo_tmp, $photo_folder);
            }
        } else {
            $photo = 'cover-scrum-board.png';
        }
        $categorieID = intval($category_name);
        $this->cour->setPicture($photo);
        $this->cour->setTitre($titreCour);
        $this->cour->setDescription($descriptionCour);
        $this->cour->setId_categorie($categorieID);
        $type = $contenuType;
        // var_dump($type);
        $video = $VideoContenu;
        $text = $TextContenu;
        if($type === 'text'){
            $this->cour->setContenu($TextContenu);
            $id = intval($this->cour->ajout($type));
            $this->cour->setId($id);
            foreach($tags as $tag){
                $this->cour->addTagsCourse($tag);
            };
        }
        elseif($type === 'video'){
            $this->cour->setContenu($VideoContenu);
            $id =intval($this->cour->ajout($type));
            $this->cour->setId($id);
            foreach($tags as $tag){
                $this->cour->addTagsCourse($tag);
            };
        }
        return header('location: /coursesTeacher');  
    }

    // update course
    public function updateCoursebyTeacher(){
        extract($_POST);
        $this->cour->setId($courseId);
        $this->cour->setTitre($titreCour);
        $this->cour->setDescription($descriptionCour);
        $this->cour->setContenuDocument($TextContenu);
        $this->cour->setContenuVideo($VideoContenu);
        $this->cour->setId_categorie($category_name);
        $this->cour->updateCourse();
        $this->cour->deleteTagsbyCourse();
        foreach($tags as $tag){
            $this->cour->addTagsCourse($tag);
        };
        return header('location: /coursesTeacher'); 
        // var_dump($_POST);
    }

    // get course by id for the single pag course
    public function getCourseSinglePage(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->cour->setId($id);
            $course = $this->cour->getCourseById();
            if(isset($_SESSION['user_id'])){
                $inscrit = $this->cour->isInscrit($_SESSION['user_id']); 
            }
            else{
             $inscrit = 0;   
            }
            // var_dump($this->cour->isInscrit($_SESSION['user_id']));
            require(__DIR__ .'/../views/SingleCourse.php');
        }
    }
}