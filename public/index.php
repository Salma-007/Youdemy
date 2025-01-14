<?php

require __DIR__ . '/../vendor/autoload.php';

use Controllers\CategorieController;
use Controllers\DashboardController;

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
// var_dump($url);
$route = [
    '/dashboard' => 'controllers/DashboardController.php',
    '/categories' => 'controllers/CategorieController.php',
    '/createCategorie' => 'controllers/CategorieController.php',
    '/deleteCategorie' => 'controllers/CategorieController.php'
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
    }
}






?>