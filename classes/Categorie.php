<?php
namespace Classes;
// require realpath(__DIR__.'/../vendor/autoload.php');
use Config\Database;
use Classes\BaseModel;
use PDO;

class Categorie{
    private $id;
    private $nom_categorie;
    private $table = 'categories';
    private $crud;

    public function __construct($nom = null, $id = -1 ){
        $conn = Database::connect();
        $this->id = $id;
        $this->nom_categorie = $nom;
        $this->crud  = new BaseModel($conn);
    }

    public function setNom($nom){
        $this->nom_categorie = $nom;
    }

    public function getNom(){
        return $this->nom_categorie;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    // fonction d'ajout
    public function insertCategorie(){
        $data = [
            'nom_categorie'=> $this->nom_categorie
        ];
        return $this->crud->insertRecord($this->table, $data);
        
    }

    // fonction suppression
    public function deleteCategorie(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }
    
    // fonction update
    public function updateCategorie(){
        $data = [
            'nom_categorie'=>$this->nom_categorie
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }

    // recuperation de toutes Categories
    public function getAllCategories(){
        return $this->crud->readRecords($this->table);
    }

    //get a record
    public function getCategorie(){
        return $this->crud->getRecord($this->table,$this->id);
    }

}