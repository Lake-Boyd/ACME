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



$categories = getCategories();
//var_dump($categories);
//exit;

$navList = '<ul class="topnav" id="myTopnav">';
$navList .= "<li><a href='.' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {

    $navList .= "<li><a href='.?action=$category[categoryName]"
            . "' title='View our $category[categoryName] "
            . "product line'>$category[categoryName]</a></li>";
}

$navList .= '<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" '
        . 'onclick="myFunction()">☰</a></li></ul>';

//echo $navList;
//exit;

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

        case 'prodman':
        include 'view/prod-mgmt.php';
        break;

        case 'newprod':
        include 'view/new-prod.php';
        //header("Location: http://localhost/ACME/view/new-prod.php");            
        break;

        case 'newcat':
        include 'view/new-cat.php';
        //header("Location: http://localhost/ACME/view/new-cat.php");             
        break;


    
}


