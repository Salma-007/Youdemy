<?php
namespace Classes;
// require realpath(__DIR__.'/../vendor/autoload.php');
use Config\Database;
use Classes\BaseModel;
use PDO;

class Tag{
    private $id;
    private $nom_tag;
    private $table = 'tags';
    private $crud;
    private $connn;

    public function __construct($nom = null, $id = -1 ){
        $conn = Database::connect();
        $this->id = $id;
        $this->connn = $conn;
        $this->nom_Tag = $nom;
        $this->crud  = new BaseModel($conn);
    }

    public function setNom($nom){
        $this->nom_tag = $nom;
    }

    public function getNom(){
        return $this->nom_tag;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    // fonction d'ajout
    public function insertTag(){
        $query = "SELECT * FROM " . $this->table . " WHERE nom_tag = :nom_tag";
        $stmt = $this->connn->prepare($query); 
        $stmt->bindParam(':nom_tag', $this->nom_tag, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_tag'] = "tag already exists!";
            header('Location: /tags');  
            exit(); 
        }
        else{
        $data = [
            'nom_tag'=> $this->nom_tag
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
    }

    // fonction suppression
    public function deleteTag(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }
    
    // fonction update
    public function updateTag(){
        $query = "SELECT * FROM " . $this->table . " WHERE nom_tag = :nom_tag";
        $stmt = $this->connn->prepare($query); 
        $stmt->bindParam(':nom_tag', $this->nom_tag, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_tag_update'] = "tag already exists!";
            header('Location: /tags');  
            exit(); 
        }
        else{
            $data = [
                'nom_tag'=>$this->nom_tag
            ];
            return $this->crud->updateRecord($this->table, $data, $this->id);
        }
    }

    // recuperation de toutes Tags
    public function getAllTags(){
        return $this->crud->readRecords($this->table);
    }

    //get a record by id
    public function getTagbyId(){
        return $this->crud->getRecord($this->table,$this->id);
    }

    // count des tags
    public function getCountTags(){
        return $this->crud->getTableCount($this->table);
    }

}