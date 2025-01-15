<?php
namespace Controllers;

use Classes\Tag;

class TagController{
    private $tag;

    public function __construct(){
        $this->tag = new Tag();
    }

    public function renderTags(){
        $getAllTags = $this->tag->getAllTags();
        require(__DIR__ . '/../views/tags.php');  

    }
    // add tag
    public function addTag(){
        extract($_POST);
        $this->tag->setNom($tagName);
        $this->tag->insertTag();
        return header('location: /tags');
    }
    // delete tag
    public function deleteTag(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->tag->setId($id);
            if ($this->tag->deleteTag()) {
                return header('Location: /tags');
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        } else {
            echo "ID manquant.";
        }
    }
    // Update tag
    public function updateTag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            extract($_POST);
            $this->tag->setId($tagId);
            $this->tag->setNom($tagName);
            if ($this->tag->updateTag()) {
                return header('Location: /tags');
            } else {
                echo "Erreur lors de la mise à jour de la catégorie.";
            }
        }
    }
}
