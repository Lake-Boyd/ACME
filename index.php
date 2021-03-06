<?php

/* 
 * Acme Controller
 */
// Get the database connection file
require_once 'library/dbconnect.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// Get the products model for use as needed
require_once 'model/products-model.php';
// Get the functions library for use as needed
require_once 'library/functions.php';

//Create or acces a session 
session_start();



$navList = makeNavList();




$prodcategories = getProdCategories();

$prodcatList = "<select name='catId' id='catId'>";

foreach ($prodcategories as $prodcategory) {

    $prodcatList .= "<option value='$prodcategory[categoryId]' id='$prodcategory[categoryName]'>$prodcategory[categoryName]</option>";
}

$prodcatList .= "</select>";


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

switch ($action) {
    case 'home':
        include 'view/home.php';
        break;
    
        case 'error':
        include 'errordocs/500.php';
        break;
    
        case 'login':
        include 'view/login.php';
        break;

        case 'reg':
        include 'view/registration.php';
        break;
   
}


