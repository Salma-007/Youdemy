<?php
namespace Classes;
require realpath(__DIR__.'/../vendor/autoload.php');
use Config\Database;
$conn = Database::connect();
use PDO;

class BaseModel{
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    } 

    // methode d'insertion 
    public function insertRecord($table, $data) {
        
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }
        $result = $stmt->execute(array_values($data));
        return $this->conn->lastInsertId();
    }

    // methode de suppression 
    public function deleteRecord($table, $id) {

        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }
        $result = $stmt->execute([':id' => $id]);
        return $result;
    }

    // methode de update 
    public function updateRecord($table, $data, $id) {
        $args = array();
        
        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }
        
        $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }

        $params = array_values($data);
        $params[] = $id;
        
        // Execute the prepared statement with the parameters
        $result = $stmt->execute($params);
        
        return $result;
    }

    //methode d'affichage de tous les records
    public function readRecords($table) {
        $query = "SELECT * FROM $table;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //methode d'afficher une record de table cours
    public function getRecordCour($table, $id){
        $query = "select cours.id as id, titre, picture, status, contenuVideo, contenuDocument ,categories.nom_categorie as categorie_id, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id WHERE cours.id = :id
        GROUP BY cours.id;";
        // $query = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
            if ($stmt->execute(['id' => $id])) {
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        } else {
            return null;
        }
    }

    //methode de get count of a table
    public function getTableCount($table){
        $query = "SELECT COUNT(*) as count from $table;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    
    // get records with condition
    public function readWithCondition($table, $conditions){
        $query = "SELECT * from $table";
        try {
            if (!empty($conditions)) {
                $conditionFields = [];
                foreach ($conditions as $column => $value) {
                    $conditionFields[] = "$column= :$column";
                }
                $query .= " WHERE " . implode(" AND ", $conditionFields);
            }
            $result = $this->conn->prepare($query);

            $result->execute($conditions);

            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error selecting records: " . $e->getMessage());
            return;
        }
    }
    
    // get records with condition
    public function countWithCondition($table, $conditions){
            $query = "SELECT count(*) as count from $table";
            try {
                if (!empty($conditions)) {
                    $conditionFields = [];
                    foreach ($conditions as $column => $value) {
                        $conditionFields[] = "$column= :$column";
                    }
                    $query .= " WHERE " . implode(" AND ", $conditionFields);
                }
    
                $result = $this->conn->prepare($query);
    
                $result->execute($conditions);
    
                $stmt = $result->fetch(PDO::FETCH_ASSOC);
                return $stmt['count'];
            } catch (PDOException $e) {
                error_log("Error selecting records: " . $e->getMessage());
                return;
            }
    }
    //methode d'afficher une record
    public function getRecord($table, $id){
        $query = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
            if ($stmt->execute(['id' => $id])) {
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        } else {
            return null;
        }
    }

}


?>