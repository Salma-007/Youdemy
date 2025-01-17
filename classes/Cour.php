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
    protected $contenuDocument;
    protected $contenuVideo;    
    
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
    public function setContenuVideo($contenuVideo){
        $this->contenuVideo = $contenuVideo;
    }
    public function setContenuDocument($contenuDocument){
        $this->contenuDocument = $contenuDocument;
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
            'id_enseignant'=> $_SESSION['user_id'],
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
            'id_enseignant'=> $_SESSION['user_id'],
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
    // recuperation de touts les cours
    public function getAllCourses(){
        $query = "select cours.id, titre, cours.picture, status, users.nom as enseignant ,categories.nom_categorie as nom_categorie, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id 
        left join users on cours.id_enseignant = users.id
        GROUP BY cours.id;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllCoursesLimit($coursesPerPage, $offset){
        // Requête SQL avec paramètres limit et offset
        $query = "SELECT cours.id, titre, cours.picture, status, users.nom AS enseignant,
                         categories.nom_categorie AS nom_categorie, description, 
                         GROUP_CONCAT(tags.nom_tag) AS tags
                  FROM cours
                  LEFT JOIN categories ON cours.id_categorie = categories.id
                  LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                  LEFT JOIN tags ON cour_tags.id_tag = tags.id
                  LEFT JOIN users ON cours.id_enseignant = users.id where status = 'accepted'
                  GROUP BY cours.id
                  LIMIT :offset, :limit";  // Utilisation de :offset et :limit pour la pagination
    
        // Préparer la requête
        $stmt = $this->conn->prepare($query);
        
        // Lier les paramètres
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $coursesPerPage, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();
        
        // Récupérer les résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    // get courses by categorie
    public function getCoursesByCategory($categoryId, $coursesPerPage, $offset){
        // Requête SQL avec LIMIT et OFFSET pour la pagination
        $query = "SELECT cours.id, titre, picture, status, categories.nom_categorie AS nom_categorie, 
                            description, GROUP_CONCAT(tags.nom_tag) AS tags
                    FROM cours
                    LEFT JOIN categories ON cours.id_categorie = categories.id
                    LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                    LEFT JOIN tags ON cour_tags.id_tag = tags.id
                    WHERE categories.id = :categoryId and status = 'accepted'
                    GROUP BY cours.id
                    LIMIT :offset, :limit";  // Utilisation de :offset et :limit

        // Préparer la requête
        $stmt = $this->conn->prepare($query);

        // Exécuter la requête avec les paramètres directement passés dans execute
        $stmt->execute([
            ':categoryId' => $categoryId,
            ':offset' => $offset,
            ':limit' => $coursesPerPage
        ]);

        // Récupérer les résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }
    // recuperation des cours by teacher
    public function getAllCoursesByTeacher($id_enseignant){
        $query = "select cours.id, titre, picture, status ,categories.nom_categorie as nom_categorie, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id where id_enseignant = $id_enseignant
        GROUP BY cours.id;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // recuperation de pending cours
    public function getPendingCourses(){
        $query = "select cours.id, titre, picture, status ,categories.nom_categorie as nom_categorie, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id where status = 'pending'
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
    // count des cours
    public function getCountCourses(){
        return $this->crud->getTableCount($this->table);
    }
    // count des cours acceptés
    public function getCountCoursesAccepted(){
        $data = [
            'status' => 'accepted',
        ];
        return $this->crud->countWithCondition($this->table, $data);
    }
    // count courses per category
    public function countCoursesByCategory($categoryId){
        $query = "select count(*) 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        where categories.id = $categoryId and status = 'accepted';";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // methode pour accepter cours
    public function acceptCourse(){
        $data = [
            'status' => 'accepted'
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    // methode pour refuser cours
    public function refuseCourse(){
        $data = [
            'status' => 'refused'
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    // get course by id
    public function getCourseById(){
        return $this->crud->getRecordCour($this->table, $this->id);
    }
    // update course
    public function updateCourse(){
        $data = [
            'titre'=>$this->titre,
            'description'=>$this->description,
            'id_categorie'=>$this->id_categorie,
            'contenuVideo'=>$this->contenuVideo,
            'contenuDocument'=>$this->contenuDocument,
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    // delete tags by course if
    public function deleteTagsbyCourse(){
        $sql = "DELETE FROM cour_tags  WHERE id_cour = :id";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }
        $result = $stmt->execute([':id' => $this->id]);
        
        return $result;
    }
    // get count of courses by teacher
    public function getCountCoursesByTeacher($id_enseignant){
        $data = [
            'id_enseignant' => $id_enseignant,
        ];
        return $this->crud->countWithCondition($this->table, $data);
    }
    // supprimer cours
    public function deleteCourse(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }



}