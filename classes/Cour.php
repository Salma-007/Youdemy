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
        $this->crud  = new BaseModel($this->conn);
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
        $query = "SELECT * FROM " . $this->table . " WHERE titre = :titre";
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_course'] = "course already exists!";
            header('Location: /coursesTeacher');  
            exit(); 
        }
        else{
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

    }
    // method pour ajouter cours en video
    public function courVideo(){
        $query = "SELECT * FROM " . $this->table . " WHERE titre = :titre";
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_course'] = "course already exists!";
            header('Location: /coursesTeacher');  
            exit(); 
        }
        else{
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
        $query = "SELECT cours.id, titre, cours.picture, status, users.nom AS enseignant,
                         categories.nom_categorie AS nom_categorie, description, 
                         GROUP_CONCAT(tags.nom_tag) AS tags
                  FROM cours
                  LEFT JOIN categories ON cours.id_categorie = categories.id
                  LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                  LEFT JOIN tags ON cour_tags.id_tag = tags.id
                  LEFT JOIN users ON cours.id_enseignant = users.id where status = 'accepted'
                  GROUP BY cours.id
                  LIMIT :offset, :limit"; 

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $coursesPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // get courses by categorie
    public function getCoursesByCategory($categoryId, $coursesPerPage, $offset){
        $query = "SELECT cours.id, titre, cours.picture, status, categories.nom_categorie AS nom_categorie, users.nom AS enseignant,
                            description, GROUP_CONCAT(tags.nom_tag) AS tags
                    FROM cours
                    LEFT JOIN categories ON cours.id_categorie = categories.id
                    LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                    LEFT JOIN tags ON cour_tags.id_tag = tags.id
                    LEFT JOIN users ON cours.id_enseignant = users.id
                    WHERE categories.id = :categoryId and status = 'accepted'
                    GROUP BY cours.id
                    LIMIT :offset, :limit";  

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $coursesPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
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
        $categoryId = intval($categoryId);
        $query = "select count(*) AS count
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        where categories.id = $categoryId and status = 'accepted';";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
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
    // savoir si un etudiant est inscrit ou pas
    public function isInscrit($id_etudiant){
        $sql = "SELECT 1 FROM `cours` 
                JOIN inscriptions ON cours.id = inscriptions.id_cour 
                JOIN users ON inscriptions.id_etudiant = users.id
                WHERE cours.id = :id and inscriptions.id_etudiant = :id_etudiant LIMIT 1";
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error in prepared statement: " . print_r($this->conn->errorInfo(), true));
        }

        $stmt->execute([':id' => $this->id, ':id_etudiant' => $id_etudiant]);

        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    // savoir les inscriptions d'un cour
    public function getInscriptions(){
        $query = "SELECT * FROM `users` 
                    JOIN inscriptions ON users.id = inscriptions.id_etudiant 
                    JOIN cours ON inscriptions.id_cour = cours.id
                    WHERE cours.id = :id_cour;";  
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
        ':id_cour' => $this->id,
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // get top course title
    public function topCourse(){
        $query = "SELECT cours.titre FROM `inscriptions` 
        JOIN cours ON inscriptions.id_cour = cours.id 
        GROUP BY cours.titre 
        ORDER BY count(*) DESC 
        LIMIT 1;";  
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['titre'];
    }
    // get top 3 enseignants
    public function getTop3Enseignants(){
        $query = "
            SELECT u.id, u.nom, u.email, COUNT(i.id_etudiant) AS nb_inscriptions
            FROM users u
            JOIN cours c ON u.id = c.id_enseignant
            LEFT JOIN inscriptions i ON c.id = i.id_cour
            GROUP BY u.id
            ORDER BY nb_inscriptions DESC
            LIMIT 3
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // Recherche de cours par titre
    public function getCoursesBySearch($searchTerm, $coursesPerPage, $offset){
        $query = "SELECT cours.id, titre, cours.picture, status, categories.nom_categorie AS nom_categorie, 
                        description,users.nom AS enseignant, GROUP_CONCAT(tags.nom_tag) AS tags
                FROM cours
                LEFT JOIN categories ON cours.id_categorie = categories.id
                LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                LEFT JOIN tags ON cour_tags.id_tag = tags.id
                LEFT JOIN users ON cours.id_enseignant = users.id
                WHERE titre LIKE :searchTerm AND status = 'accepted'
                GROUP BY cours.id
                LIMIT :offset, :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $coursesPerPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Compter les cours par recherche
    public function countCoursesBySearch($searchTerm){
        $query = "SELECT COUNT(*) AS total
                FROM cours
                WHERE titre LIKE :searchTerm AND status = 'accepted'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    // Recherche par catégorie et par titre
    public function getCoursesByCategoryAndSearch($categoryId, $searchTerm, $coursesPerPage, $offset){
        $query = "SELECT cours.id, titre, picture, status, categories.nom_categorie AS nom_categorie, 
                        description, GROUP_CONCAT(tags.nom_tag) AS tags
                FROM cours
                LEFT JOIN categories ON cours.id_categorie = categories.id
                LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour
                LEFT JOIN tags ON cour_tags.id_tag = tags.id
                WHERE categories.id = :categoryId AND titre LIKE :searchTerm AND status = 'accepted'
                GROUP BY cours.id
                LIMIT :offset, :limit";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $coursesPerPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Compter les cours par catégorie et recherche
    public function countCoursesByCategoryAndSearch($categoryId, $searchTerm){
        $query = "SELECT COUNT(*) AS total
                FROM cours
                LEFT JOIN categories ON cours.id_categorie = categories.id
                WHERE categories.id = :categoryId AND titre LIKE :searchTerm AND status = 'accepted'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

}