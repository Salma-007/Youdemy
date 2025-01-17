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
        
        $query = "SELECT id, password_hash, role FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        // Check if the user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify the password
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                
                return true;
            } else {
                return false; 
            }
        }
        
        return false; 
    }
    // logout method
    public function logout() {
        session_start();
        session_unset();   
        session_destroy(); 
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
        $data = [
            'nom' => $this->nom,
            'email' => $this->email,
            'password_hash' => password_hash($this->password, PASSWORD_DEFAULT),
            'role' => $this->role
        ];
        return $this->crud->insertRecord($this->table, $data);
    
}

}