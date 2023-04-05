<?php

require_once '../controllers/CategoryController.php';
require_once '../models/CategoryModel.php';
require_once '../models/config.php';
require_once '../controllers/index1.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
 
$category = new TheLoaiController();    
switch ($action) {
    case 'add_category':
        $category->addCategory();
        break;
    case 'delete_category':
        $category->deleteCategory();
    case 'edit_category':
        $category->editCategory();
    case 'search_category':
        $category->searchCategory();
        break;
    default:
        $category->getList();
        break;
    case 'detail_category':
        $category->showMachinesByCategory($categoryId);
       
    case 'huy';
    $category -> huy();
    case 'logout';
    $category -> logout();
    }
?>