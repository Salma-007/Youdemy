<?php

require __DIR__ . '/../vendor/autoload.php';

use Controllers\CategorieController;
use Controllers\TagController;
use Controllers\DashboardController;
use Controllers\StudentController;
use Controllers\TeacherController;

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
// var_dump($url);
$route = [
    '/dashboard' => 'controllers/DashboardController.php',
    '/categories' => 'controllers/CategorieController.php',
    '/createCategorie' => 'controllers/CategorieController.php',
    '/deleteCategorie' => 'controllers/CategorieController.php',
    '/updateCategorie' => 'controllers/CategorieController.php',
    '/tags' => 'controllers/TagController.php',
    '/createTag' => 'controllers/TagController.php',
    '/deleteTag' => 'controllers/TagController.php',
    '/updateTag' => 'controllers/TagController.php',
    '/students' => 'controllers/StudentController.php',
    '/teachers' => 'controllers/TeacherController.php',
];

if(array_key_exists($url, $route)){
    switch($url){
        case '/dashboard': 
            $controller = new DashboardController();
            $controller->home();
            break;
        case '/categories': 
            $controller = new CategorieController();
            $controller->renderCategories();
            break;
        case '/createCategorie':
            $controller = new CategorieController();
            $controller->addCategorie();
            break;
        case '/deleteCategorie':  
            $controller = new CategorieController();
            $controller->deleteCategorie();  
            break;
        case '/updateCategorie': 
            $controller = new CategorieController();
            $controller->updateCategorie();
            break;
        case '/tags': 
            $controller = new TagController();
            $controller->renderTags();
            break;
        case '/createTag':
            $controller = new TagController();
            $controller->addTag();
            break;
        case '/deleteTag':  
            $controller = new TagController();
            $controller->deleteTag();  
            break;
        case '/updateTag': 
            $controller = new TagController();
            $controller->updateTag();
            break;
        case '/students': 
            $controller = new StudentController();
            $controller->renderStudents();
            break;
        case '/teachers': 
            $controller = new TeacherController();
            $controller->renderTeachers();
            break;
    }
}

?>