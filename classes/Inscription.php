<?php
namespace Classes;
use Config\Database;
use Classes\BaseModel;
use PDO;

class Inscription{
    private $id_cour;
    private $id_etudiant;
    private $isFinished = 0;
    protected $table = 'inscriptions';
    private $conn;

    public function __construct(){
        $this->conn = Database::connect();
        $this->crud  = new BaseModel($this->conn );
    }

    public function setIdCour($id_cour){
        $this->id_cour = $id_cour;
    }
    public function setIdEtudiant($id_etudiant){
        $this->id_etudiant = $id_etudiant;
    }
    public function setProgress($isFinished){
        $this->isFinished = $isFinished;
    }

    // inscription d'un étudiant
    public function enrollStudent() {
        // Vérifier si l'étudiant est deja inscrit dans le cours
        $query = "SELECT COUNT(*) FROM {$this->table} WHERE id_cour = :id_cour AND id_etudiant = :id_etudiant";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cour', $this->id_cour, PDO::PARAM_INT);
        $stmt->bindParam(':id_etudiant', $this->id_etudiant, PDO::PARAM_INT);
        
        $stmt->execute();
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            return "L'étudiant est déjà inscrit à ce cours.";
        } else {
            $data = [
                'id_cour' => $this->id_cour,
                'id_etudiant' => $this->id_etudiant,
                'isFinished' => $this->isFinished,
            ];
            return $this->crud->insertRecord($this->table, $data);
        }
    }

    // finish course
    public function FinishedCourse(){
        $sql = "UPDATE $this->table SET isFinished = 1 where id_cour = :id_cour and id_etudiant = :id_etudiant";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }
        $result = $stmt->execute([':id_cour' => $this->id_cour, ':id_etudiant' => $this->id_etudiant]);
        return $result;
    }

}