<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Categorie{
    private $id;
    private $nom_categorie;
    private $table = 'categories';
    private $crud;
    private $connn;

    public function __construct($nom = null, $id = -1 ){
        $conn = Database::connect();
        $this->connn = $conn;
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
        $query = "SELECT * FROM " . $this->table . " WHERE nom_categorie = :nom_categorie";
        $stmt = $this->connn->prepare($query); 
        $stmt->bindParam(':nom_categorie', $this->nom_categorie, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_categorie'] = "categorie already exists!";
            header('Location: /categories');  
            exit(); 
        }
        else{
        $data = [
            'nom_categorie'=> $this->nom_categorie
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
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
    //get a record by id
    public function getCategoriebyId(){
        return $this->crud->getRecord($this->table,$this->id);
    }
    // count des categories
    public function getCountCategories(){
        return $this->crud->getTableCount($this->table);
    }
    // nombre de cour par categorie
    public function getCoursesCountByCategory(){
        $query = "
            SELECT c.nom_categorie as category_name, COUNT(cours.id) AS cour_count
            FROM categories c
            LEFT JOIN cours ON c.id = cours.id_categorie
            WHERE cours.status = 'accepted'
            GROUP BY c.id
        ";
        $stmt = $this->connn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

}