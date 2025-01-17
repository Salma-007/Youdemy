<?php
namespace Controllers;

use Classes\Inscription;

class InscriptionController{
    private $enroll;

    public function __construct(){
        $this->enroll = new Inscription();
    }

    public function enrollStudent(){
        $this->enroll->setIdCour($_GET['id']);
        $this->enroll->setIdEtudiant($_SESSION['user_id']);
        $this->enroll->enrollStudent();
        return header('Location: /youdemy');
    }


}