<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Cour{
    // protected $id;
    // protected $titre;
    // protected $description;
    // protected $contenu;
    // protected $picture;
    // protected $id_enseignant;
    // protected $id_categorie;
    // protected $status;
    protected $table = 'cours';
    protected $crud;
    
    public function __construct(){
        $conn = Database::connect();
        $this->crud  = new BaseModel($conn);
    }



}