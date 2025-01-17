<?php

require __DIR__ . '/../vendor/autoload.php';
session_start();


use Controllers\CategorieController;
use Controllers\TagController;
use Controllers\DashboardController;
use Controllers\DashboardTeacherController;
use Controllers\StudentController;
use Controllers\TeacherController;
use Controllers\CourseController;

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
// var_dump($url);
$route = [
    '/dashboard' => 'controllers/DashboardController.php',
    '/coursesAdmin' => 'controllers/DashboardController.php',
    '/categories' => 'controllers/CategorieController.php',
    '/createCategorie' => 'controllers/CategorieController.php',
    '/deleteCategorie' => 'controllers/CategorieController.php',
    '/updateCategorie' => 'controllers/CategorieController.php',
    '/tags' => 'controllers/TagController.php',
    '/createTag' => 'controllers/TagController.php',
    '/deleteTag' => 'controllers/TagController.php',
    '/updateTag' => 'controllers/TagController.php',
    '/students' => 'controllers/StudentController.php',
    '/deleteStudent' => 'controllers/StudentController.php',
    '/banStudent' => 'controllers/StudentController.php',
    '/activateStudent' => 'controllers/StudentController.php',
    '/teachers' => 'controllers/TeacherController.php',
    '/pendingTeachers' => 'controllers/TeacherController.php',
    '/assignRole' => 'controllers/TeacherController.php',
    '/deleteTeacher' => 'controllers/TeacherController.php',
    '/banTeacher' => 'controllers/TeacherController.php',
    '/activateTeacher' => 'controllers/TeacherController.php',
    '/coursesTeacher' => 'controllers/DashboardTeacherController.php',
    '/coursInscriptionsTeacher' => 'controllers/DashboardTeacherController.php',
    '/addCourse' => 'controllers/CourseController.php',
    '/pendingCourses' => 'controllers/CourseController.php',
    '/accepterCours' => 'controllers/DashboardController.php',
    '/refuserCours' => 'controllers/DashboardController.php',
    '/signUp' => 'controllers/DashboardController.php',
    '/signIn' => 'controllers/DashboardController.php',
    '/add_user' => 'controllers/StudentController.php',
    '/verify_user' => 'controllers/StudentController.php',
];

if(array_key_exists($url, $route)){
    switch($url){
        case '/dashboard': 
            $controller = new DashboardController();
            $controller->home();
            break;
        case '/coursesAdmin': 
            $controller = new DashboardController();
            $controller->courses();
            break;
        case '/coursesTeacher': 
            $controller = new DashboardTeacherController();
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
        case '/deleteStudent': 
            $controller = new StudentController();
            $controller->deleteStudent();
            break;
        case '/banStudent': 
            $controller = new StudentController();
            $controller->banStudent();
            break;
        case '/activateStudent': 
            $controller = new StudentController();
            $controller->activateStudent();
            break;
        case '/teachers': 
            $controller = new TeacherController();
            $controller->renderTeachers();
            break;
        case '/pendingTeachers': 
            $controller = new TeacherController();
            $controller->renderPendingTeachers();
            break;
        case '/assignRole': 
            $controller = new TeacherController();
            $controller->assignTeacher();
            break;
        case '/deleteTeacher': 
            $controller = new TeacherController();
            $controller->deleteTeacher();
            break;
        case '/banTeacher': 
            $controller = new TeacherController();
            $controller->banTeacher();
            break;
        case '/activateTeacher': 
            $controller = new TeacherController();
            $controller->activateTeacher();
            break;
        case '/coursInscriptionsTeacher': 
            $controller = new DashboardTeacherController();
            $controller->inscriptions();
            break;
        case '/addCourse': 
            $controller = new CourseController();
            $controller->addCourse();
            break;
        case '/pendingCourses': 
            $controller = new DashboardController();
            $controller->pendingCourses();
            break;
        case '/accepterCours': 
            $controller = new DashboardController();
            $controller->acceptCourse();
            break;
        case '/refuserCours': 
            $controller = new DashboardController();
            $controller->refuseCourse();
            break;
        case '/signUp': 
            $controller = new DashboardController();
            $controller->signUpPage();
            break;
        case '/signIn': 
            $controller = new DashboardController();
            $controller->signInPage();
            break;
        case '/add_user': 
            $controller = new StudentController();
            $controller->signUpUser();
            break;
        case '/verify_user': 
            $controller = new StudentController();
            $controller->signInUser();
            break;
    }
}

?>