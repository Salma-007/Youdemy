<?php

require __DIR__ . '/../vendor/autoload.php';

use Controllers\CategorieController;

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
// var_dump($url);
$route = [
    '/dashboard' => 'classes/DashboardController.php',
    '/categories' => 'controllers/CategorieController.php'
];

if(array_key_exists($url, $route)){
    switch($url){
        case '/dashboard': echo'hello dashboard';
        break;
        case '/categories': 
            $controller = new CategorieController();
            $controller->renderCategories();
            break;
    }
}






?>