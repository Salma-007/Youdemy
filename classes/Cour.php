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
    
    public function __construct($titre = null , $description = null, $contenu = null, $id_categorie = -1){
        $this->id_categorie = $id_categorie;
        $this->description = $description;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $conn = Database::connect();
        $this->crud  = new BaseModel($conn);
    }

    public function setId($id){
        $this->id = $id;
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
            'id_categorie'=> $this->id_categorie,
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
    // method pour ajouter cours en video
    public function courVideo(){
        $data = [
            'titre'=> $this->titre,
            'description'=> $this->description,
            'contenu'=> $this->contenu,
            'contenuVideo'=> $this->id_categorie,
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
        return $this->crud->readRecords($this->table);
    }





}