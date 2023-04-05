<?php
require_once '../controllers/LoginController.php';


$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$userController = new UserController();
switch ($action) {
    // case 'login':
        //$userController->login();
        //break;
    case 'add':
        $category->addCategory();
    default:
        header('Location: login.php');
        exit();
}
