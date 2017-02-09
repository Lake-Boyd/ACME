<?php

/* 
 * Products Controller
 */
// Get the database connection file
require_once '../library/dbconnect.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model for use as needed
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



// The form block below is the structure of a drop-down list that will be used
// in the add-products page... the list build function will use the internal
// structure of this form

//<form method="post" action="action_page.php">
//  <select name="cars">
//    <option value="volvo">Volvo</option>
//    <option value="saab">Saab</option>
//    <option value="fiat">Fiat</option>
//    <option value="audi">Audi</option>
//  </select>
//  <br><br>
//  <input type="submit">
//</form>



$prodcategories = getProdCategories();

$prodcatList = "<select name='catId'>";

foreach ($prodcategories as $prodcategory) {

    $prodcatList .= "<option value='$prodcategory[categoryId]'>$prodcategory[categoryName]</option>";
}

$prodcatList .= "</select>";
//echo $prodcatList;
//exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         header('location: /acme/index.php?action=addprod');
            exit;
        //$action = 'home';
    }
}

switch ($action) {
    case 'addproduct':
        //echo 'You are in the register case statement.';
        //Filter and store the data
        
//$invId, $invName, $invDescription, $invImage, $invThumbnail, 
//        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle        
        
        $invId = filter_input(INPUT_POST, 'invid');
        $invName = filter_input(INPUT_POST, 'invname');
        $invDescription = filter_input(INPUT_POST, 'invdescription');
        $invImage = filter_input(INPUT_POST, 'invimage');
        $invThumbnail = filter_input(INPUT_POST, 'invthumbnail');        
        $invPrice = filter_input(INPUT_POST, 'invprice');
        $invStock = filter_input(INPUT_POST, 'invstock');
        $invSize = filter_input(INPUT_POST, 'invsize');
        $invWeight = filter_input(INPUT_POST, 'invweight');
        $invLocation = filter_input(INPUT_POST, 'invlocation');
        $categoryId = filter_input(INPUT_POST, 'categoryid');
        $invVendor = filter_input(INPUT_POST, 'invvendor');
        $invStyle = filter_input(INPUT_POST, 'invstyle');
       

        // Check for missing data
        if (empty($invId) || empty($invName) || empty($invDescription) || empty($invImage) ||
           empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
           empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||                   
            empty($invStyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Send the data to the model
        $addOutcome = addProduct($invId, $invName, $invDescription, $invImage, $invThumbnail, 
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

        // Check and report the result
        if ($addOutcome === 1) {
            $message = "<p>Thanks for adding a product to the inventory.</p>";
            include '../view/productmanagement.php';
            exit;
        } else {
            $message = "<p>Sorry, but the creation of a new product failed. Please try again.</p>";
            include '../view/productmanagement.php';

            exit;
        }


        break;
}


