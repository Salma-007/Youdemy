<?php
namespace Controllers;

use Classes\Categorie;

class CategorieController{
    private $categorie;

    public function __construct(){
        $this->categorie = new Categorie();
    }

    public function renderCategories(){
        $getAllCategories = $this->categorie->getAllCategories();
        require(__DIR__ . '/../views/categories.php');  

    }
    public function addCategorie(){
        extract($_POST);
        $this->categorie->setNom($categoryName);
        $this->categorie->insertCategorie();
        return header('location: /categories');
    }
    public function deleteCategorie(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->categorie->setId($id);
            if ($this->categorie->deleteCategorie()) {
                return header('Location: /categories');
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        } else {
            echo "ID manquant.";
        }
    }
}
