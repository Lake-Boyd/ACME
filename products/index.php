<?php

/* 
 * Products Controller
 */
// Get the database connection file
require_once '../library/dbconnect.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';

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

    $prodcatList .= "<option value='$prodcategory[categoryId]' name='$prodcategory[categoryName]' id='$prodcategory[categoryName]'>$prodcategory[categoryName]</option>";
}

$prodcatList .= "</select>";
//echo $prodcatList;
//exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         header('location: /acme/index.php?action=prodman');
            exit;
        //$action = 'home';
    }
}

switch ($action) {
    case 'addprod':
        //echo 'You are in the add product case statement.';
        //Filter and store the data
        
       
        

        $invName = filter_input(INPUT_POST, 'invname');
        $invDescription = filter_input(INPUT_POST, 'invdescription');
        $invImage = filter_input(INPUT_POST, 'invimage');
        $invThumbnail = filter_input(INPUT_POST, 'invthumbnail');        
        $invPrice = filter_input(INPUT_POST, 'invprice');
        $invStock = filter_input(INPUT_POST, 'invstock');
        $invSize = filter_input(INPUT_POST, 'invsize');
        $invWeight = filter_input(INPUT_POST, 'invweight');
        $invLocation = filter_input(INPUT_POST, 'invlocation');
        $categoryId = filter_input(INPUT_POST, 'catId');
        $invVendor = filter_input(INPUT_POST, 'invvendor');
        $invStyle = filter_input(INPUT_POST, 'invstyle');
        
//        echo $invName .'<br>';
//        echo $invDescription .'<br>';
//        echo $invImage .'<br>';        
//        echo $invThumbnail .'<br>';
//        echo $invPrice .'<br>';
//        echo $invStock .'<br>';
//        echo $invSize .'<br>';
//        echo $invWeight .'<br>';
//        echo $invLocation .'<br>';
//        echo $categoryId .'<br>';
//        echo $invVendor .'<br>';
//        echo $invStyle .'<br>';   
//        exit;

        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) ||
           empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
           empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||                   
            empty($invStyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/new-prod.php';
            exit;
        }

        // Send the data to the model
        $addOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, 
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

        // Check and report the result
        if ($addOutcome === 1) {
            $message = "<p>Thanks for adding a product to the inventory.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            include '../view/prod-mgmt.php';
            exit;
        } else {
            $message = "<p>Sorry, but the creation of a new product failed. Please try again.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            include '../view/prod-mgmt.php';
            exit;
        }
        break;
        
        
    case 'addcat':
        //echo 'You are in the add category case statement.';
        //Filter and store the data

        $catName = filter_input(INPUT_POST, 'categoryname');

        // Check for missing data
        if (empty($catName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/new-cat.php';
            exit;
        }

        // Send the data to the model
        $addOutcome = addCategory($catName);

        // Check and report the result
        if ($addOutcome === 1) {
            $message = "<p>Thanks for adding a category to the database.</p>";
            header("Location: http://localhost/ACME/products/");
            //include '../view/prod-mgmt.php';
            exit;
        } else {
            $message = "<p>Sorry, but the creation of a new category failed. Please try again.</p>";
            //header("Location: http://localhost/ACME/products/");
            include '../view/prod-mgmt.php';
            exit;
        }
        break;        
        
        
}


