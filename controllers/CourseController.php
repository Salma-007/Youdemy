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
        move_uploaded_file($photo_tmp, $photo_folder);

        $categorieID =  intval($category_name);
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
            $this->cour->ajout($type);
        }
        elseif($type === 'video'){
            $this->cour->setContenu($VideoContenu);
            $this->cour->ajout($type);
        }
        
        return header('location:/coursesTeacher');  
    }

}