<?php

require_once '../controllers/CameraController.php';
require_once '../models/CameraModel.php';
require_once '../models/config.php';
require_once '../controllers/index2.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
 
$category = new TheLoaiController(); 

switch ($action) {
    case 'logout';
    $category -> logout();
    case 'detail_category':
    $category->showMachinesByCategory($categoryId);
    }
?>