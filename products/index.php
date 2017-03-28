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
// Get the functions library for use as needed
require_once '../library/functions.php';
// Get the uploads model for use as needed
require_once '../model/uploads-model.php';
// Get the reviews model for use as needed
require_once '../model/reviews-model.php';
// Get the accounts model for use as needed
require_once '../model/accounts-model.php';


//Create or acces a session 
session_start();

$navList = makeNavList();



$prodcategories = getProdCategories();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         // header('location: ../view/?action=prodman');
         $action = 'prodman';

          //  exit;
        //$action = 'home';
    }
}

switch ($action) {
    
    case 'prodman':
        $products = getProductBasics();
        if (count ($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';

            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            
            foreach ($products as $product){
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";        
                }
                
            $prodList .= '</tbody></table>';            
        }else {
            
        $message = '<p class="notify">Sorry, no products were returned.</p>';
        
        }
        include '../view/prod-mgmt.php';
      break;    

    case 'newprod':
        include '../view/new-prod.php';
        //header("Location: http://localhost/ACME/view/new-prod.php");            
      break;

    case 'newcat':
        include '../view/new-cat.php';
        //header("Location: http://localhost/ACME/view/new-cat.php");             
      break;
      
      
    case 'addprod':

        $invName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invdescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invimage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invthumbnail', FILTER_SANITIZE_STRING);        
        $invPrice = filter_input(INPUT_POST, 'invprice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invstock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invsize', FILTER_SANITIZE_STRING);
        $invWeight = filter_input(INPUT_POST, 'invweight', FILTER_SANITIZE_STRING);
        $invLocation = filter_input(INPUT_POST, 'invlocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'catId', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invvendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invstyle', FILTER_SANITIZE_STRING);
        

        
        $invPrice = checkInvPrice($invPrice);
        $invStock = checkInvStock($invStock);        

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

        $catName = filter_input(INPUT_POST, 'categoryname', FILTER_SANITIZE_STRING);
        $checkCat = checkCatName($catName);  

        // Check for missing data
        if (empty($checkCat)) {
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
    
    case 'mod':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
            if (count($prodInfo) < 1){
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/prod-update.php';
            exit;
        break;
        
    case 'updateProd':

        $invName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invdescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invimage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invthumbnail', FILTER_SANITIZE_STRING);        
        $invPrice = filter_input(INPUT_POST, 'invprice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invstock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invsize', FILTER_SANITIZE_STRING);
        $invWeight = filter_input(INPUT_POST, 'invweight', FILTER_SANITIZE_STRING);
        $invLocation = filter_input(INPUT_POST, 'invlocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'catId', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invvendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invstyle', FILTER_SANITIZE_STRING);
        
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
        
        $invPrice = checkInvPrice($invPrice);
        $invStock = checkInvStock($invStock);        

        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) ||
           empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) ||
           empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) ||                   
            empty($invStyle)) {
            $message = '<p>Please provide complete and correct information for all item fields! Double-check'
                    . 'the item category.</p>';
            include '../view/prod-update.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, 
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $prodId);

        // Check and report the result
        if ($updateResult) {
          $message = "<p class='notice'>Congratulations, ". $invName . " was successfully updated.</p>";
          $_SESSION['message'] = $message;
          header('location: /acme/products/');
          exit;
            } else {
                $message = "<p class='notice'>Error. ". $invName ." was not updated.</p>";
                include '../view/prod-update.php';
                exit;
                }
    
     break;

    case 'del':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
            if (count($prodInfo) < 1){
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/prod-delete.php';
            exit;        
    break;
    
    case 'deleteProd':

        $invName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);

        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

        // Send the data to the model
        $deleteResult = deleteProduct($prodId);

        // Check and report the result
        if ($deleteResult) {
          $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /acme/products/');
          exit;
            } else {
                $message = "<p class='notice'>Error. $invName was not deleted.</p>";
                header('location: /acme/products/');
                exit;
                }
       
    break;

    case 'category':
        
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)){
                $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
            }else {
                $prodDisplay = buildProductsDisplay($products);
            }

        //echo $prodDisplay;
        //exit;            
            
        include '../view/category.php';
    break;    
    
        case 'prodDetail':
        
        $prodId = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT);
        //echo $prodname;
        $productDetails = getProductDetails($prodId);
        $thumbArray = getThumbs($prodId);

        //var_dump($thumbArray);
        //exit; 
        if (!count($productDetails)){
                $message = "<p class='notice'>Sorry, no products could be found.</p>";
            }else {
                $detailDisplay = buildDetailDisplay($productDetails);
            }
        if (!count($thumbArray)){
                $message = "<p class='notice'>Sorry, no thumbnails could be found.</p>";
            }else {
                $thumbsDisplay = buildThumbsDisplay($thumbArray);
            }

        $reviewsArray = getReviewByItem($prodId);

        if (isset ($_SESSION['loggedin'])) {
            $clientId = $_SESSION['clientData']['clientId'];
            $existingReview = checkExistingReview($clientId, $prodId);
            if (empty ($existingReview)) {
                // 
                $addRevDisplay = newRevDisplay($prodId, $clientId);
                }            
         }else {
                $revMessage = "<p class='notice'>You must be <a href='/acme/?action=login' title='Login'>"
                        . "logged-in</a> to submit a review for this product.</p>";             
            }

            
        if (!count($reviewsArray)){
                // if a current user review already exists display reviews if they exist. If they don't, report it
                $message = "<p class='notice'>Sorry, no reviews could be found for this product.</p>";
                }else {
                    $reviewsDisplay = buildRevDisplay($reviewsArray);
                    }         
         
            
        //echo $thumbsDisplay;
        //exit;            
            
        include '../view/product-detail.php';
    break; 
    
}


