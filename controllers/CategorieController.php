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
}
