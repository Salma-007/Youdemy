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
        $categorieID =  intval($category_name);
        $this->cour->setTitre($titreCour);
        $this->cour->setDescription($descriptionCour);
        $this->cour->setId_categorie($categorieID);
        $this->cour->setContenu($contenuType);
        $type = $contenuType;
        var_dump($type);
        $this->cour->ajout($type);
        return header('location:/coursesTeacher');  
    }

}