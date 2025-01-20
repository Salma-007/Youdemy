<?php
namespace Classes;

use Config\Database;
use Classes\BaseModel;
use PDO;

abstract class User{
    protected $table = 'users';
    protected $crud;
    protected $role;
    protected $nom;
    protected $email;
    protected $password;
    protected $id;
    protected $connection;

    public function __construct(){
        $conn = Database::connect();
        $this->connection = $conn;
        $this->crud  = new BaseModel($conn);
    }

    // setter id
    public function setId($id){
        $this->id = $id;
    }
    // setter nom
    public function setNom($nom){
        $this->nom = $nom;
    }
    // setter email
    public function setEmail($email){
        $this->email = $email;
    }
    // setter role
    public function setRole($role){
        $this->role = $role;
    }
    // setter password
    public function setPassword($password){
        $this->password = $password;
    }
    // Login method 
    public function login($email, $password) {
        // Sanitize input
        $email = trim($email);
        $password = trim($password);
        $query = "SELECT id, password_hash, nom, role, enseignantConfirmed, isBanned FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->connection->prepare($query); 
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['confirmedTeacher'] = $user['enseignantConfirmed'];
                $_SESSION['banned'] = $user['isBanned'];
                if ($user['role'] === 'admin' ) {
                    header('Location: /dashboard');
                    exit();
                } else if ($user['role'] === 'enseignant' && $user['isBanned'] === 0) {
                    header('Location: /coursesTeacher');
                    exit();
                } else if ($user['role'] === 'etudiant' && $user['isBanned'] === 0) {
                    header('Location: /youdemy');
                    exit();
                }else{
                    $_SESSION['error_message'] = "you are banned";
                    header('Location: /signIn');  
                exit(); 
                }
                return true;
            } else {
                $_SESSION['error_message'] = "password not correct";
                header('Location: /signIn');  
                exit(); 
            }
        }  
        else {
            $_SESSION['error_message'] = "erreur d'authentification";
            header('Location: /signIn');  
            exit(); 
        } 

    }
    // logout method
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();   
        session_destroy(); 
        header('Location: /signIn');
    }
    // delete user 
    public function deleteUser(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }
    // ban user
    public function banUser(){
        $data = [
            'isBanned' => 1
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    // activate user
    public function activateUser(){
        $data = [
            'isBanned' => 0
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }
    // sign up
    public function registerUser(){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->connection->prepare($query); 
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['error_signup'] = "email already exists!";
            header('Location: /signUp');  
            exit(); 
        }
        else{
        $data = [
            'nom' => $this->nom,
            'email' => $this->email,
            'password_hash' => password_hash($this->password, PASSWORD_DEFAULT),
            'role' => $this->role
        ];
        return $this->crud->insertRecord($this->table, $data);

        $_SESSION['message_successs'] = "account created successfully!";
        header('Location: /signUp');  
        exit(); 
        }
    }
    // courses per teacher
    public function coursesPerTeacher(){
        $query = "select cours.id, titre, picture, status ,categories.nom_categorie as nom_categorie, description, GROUP_CONCAT(tags.nom_tag) AS tags 
        FROM cours 
        LEFT JOIN categories ON cours.id_categorie = categories.id 
        LEFT JOIN cour_tags ON cours.id = cour_tags.id_cour 
        left JOIN tags ON cour_tags.id_tag = tags.id where users.role = 'enseignant'
        GROUP BY cours.id;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function isAuth(){
        if($_SESSION['user_id']){
            if ($_SESSION['role'] === 'admin') {
                header('Location: /dashboard');
                exit();
            } else if ($_SESSION['role'] === 'enseignant') {
                header('Location: /coursesTeacher');
                exit();
            } else {
                header('Location: /youdemy');
                exit();
            }
        }
        else{
            header('Location: /youdemy');
            exit();
        }
    }

}