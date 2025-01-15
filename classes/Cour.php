<?php
namespace Classes;
// require realpath(__DIR__.'/../vendor/autoload.php');
use Config\Database;
use Classes\BaseModel;
use PDO;

abstract class Cour{
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

    public abstract function ajouterCour();
    public abstract function afficherCour();


}