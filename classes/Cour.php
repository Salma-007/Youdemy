<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Cour{
    protected $id;
    protected $titre;
    protected $description;
    protected $contenu;
    protected $picture;
    protected $id_enseignant;
    protected $id_categorie;
    protected $status = 'pending';
    protected $table = 'cours';
    protected $crud;
    protected $tags = [];
    protected $conn;
    
    public function __construct($titre = null , $description = null, $contenu = null, $id_categorie = -1){
        $this->id_categorie = $id_categorie;
        $this->description = $description;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->conn = Database::connect();
        $this->crud  = new BaseModel($this->conn );
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setPicture($picture){
        $this->picture = $picture;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setContenu($contenu){
        $this->contenu = $contenu;
    }    

    public function setId_categorie($id_categorie){
        $this->id_categorie = $id_categorie;
    }    


    // method pour ajouter cours en document
    public function courDocument(){
        $data = [
            'titre'=> $this->titre,
            'description'=> $this->description,
            'contenuDocument'=> $this->contenu,
            'status' => $this->status,
            'picture' => $this->picture,
            'id_categorie'=> $this->id_categorie,
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
    // method pour ajouter cours en video
    public function courVideo(){
        $data = [
            'titre'=> $this->titre,
            'description'=> $this->description,
            'contenuVideo'=> $this->contenu,
            'status' => $this->status,
            'picture' => $this->picture,
            'id_categorie'=> $this->id_categorie,
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
    // overloading en cours type
    function __call($method, $arguments){
        if($method === 'ajout' && $arguments[0] === 'video'){
            return $this->courVideo();
        }   
        elseif($method === 'ajout' && $arguments[0] === 'text'){
            return $this->courDocument();
        }
    }

    public function getAllCourses(){
        $query = "select cours.id, titre, categories.nom_categorie as nom_categorie, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id 
        GROUP BY cours.id;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // ajout des tags en table pivot
    public function addTagsCourse($tag){
        $data = [
            'id_cour' => $this->id,
            'id_tag'=> $tag
        ];
        return $this->crud->insertRecord('cour_tags', $data);
    }





}