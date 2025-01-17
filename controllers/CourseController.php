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
        $photo_folder = '../public/assets/uploads/' . $photo; 
        // checking of the same photo already exists in file
        if(!file_exists($photo_folder)){
            move_uploaded_file($photo_tmp, $photo_folder);
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

}