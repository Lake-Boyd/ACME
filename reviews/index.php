<?php

/* This is the reviews controller!

 */
//Create or acces a session 

// Get the database connection file
require_once '../library/dbconnect.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model for use as needed
require_once '../model/reviews-model.php';
// Get the functions library for use as needed
require_once '../library/functions.php';

session_start();

$navList = makeNavList();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         header('location: /acme/reviews/index.php?action=default');
            exit;
        //$action = 'home';
    }
}


switch ($action) {
    
    case 'addReview':

        $reviewText = filter_input(INPUT_POST, 'reviewtext', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invid', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientid', FILTER_SANITIZE_NUMBER_INT);


        // Check for missing data
        if (empty($reviewText) || empty($invId) || empty($clientId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/product-detail.php';
            exit;
        }

        // Send the data to the model
        $insertOutcome = insertReview($reviewText, $invId, $clientId);

        // Check and report the result
        if ($insertOutcome === 1) {
            $revMessage = "<p>Thanks for adding a review to the product.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            //$actionkeystring = "/ACME/products/index.php?action=prodDetail&type=$invId";
            header ("Location: http://localhost/ACME/products/index.php?action=prodDetail&type=$invId");
            exit;
        } else {
            $revMessage = "<p>Sorry, but the creation of a new product review failed. Please try again.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            include '../view/product-detail.php';
            exit;
        }

        
    break; 
    
    case 'editReview':
        
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $reviewInfo = getReview($reviewId);
        $reviewText = $reviewInfo['reviewText'];
        $invId = $reviewInfo['invId'];
        //echo $reviewId;
        //echo $reviewText;
        //var_dump($reviewInfo);
        //exit;
        
            if (count($reviewInfo) < 1){
                $message = 'Sorry, no product information could be found.';
            }
            include '../view/review-update.php';
            exit;

        
    break;
    
    case 'updateReview':

        $reviewText = filter_input(INPUT_POST, 'reviewtext', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewid', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invid', FILTER_SANITIZE_NUMBER_INT);
        //$invId = $reviewInfo['invId'];
        // Check for missing data
        if (empty($reviewText) || empty($reviewId)) {
            $message = '<p>Please provide complete and correct information for all item fields!</p>';
            include '../view/review-update.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateReview($reviewId, $reviewText);

        // Check and report the result
        if ($updateResult) {
          $message = "<p class='notice'>Congratulations, the review was successfully updated.</p>";
          $_SESSION['message'] = $message;
          // header ('Location: http://localhost/ACME/products/index.php?action=prodDetail&type=' . $invId);          
          header('location: /ACME/accounts/?action=loggedin');
          exit;
            } else {
                $message = "<p class='notice'>Error. The review was not updated.</p>";
                include '../view/review-update.php';
                exit;
                }

    break; 

    case 'deleteReview':

       $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $reviewInfo = getReview($reviewId);
        $reviewText = $reviewInfo['reviewText'];
        $invId = $reviewInfo['invId'];
        $invReviewNameInfo = getProductName($invId);
        //echo $reviewId;
        //echo $reviewText;
        //var_dump($reviewInfo);
        //exit;
        
            if (count($reviewInfo) < 1){
                $message = "<p class='notice'>Sorry, no review information could be found.</p>";
            }
            include '../view/review-delete.php';
            exit;
    break; 

 

    case 'confirmDelete':
        //$invReviewName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewid', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = getReview($reviewId);
        $invId = $reviewInfo['invId'];
        $invReviewNameInfo = getProductName($invId);
        $invReviewName = $invReviewNameInfo['invName'];

        // Send the data to the model
        $deleteResult = deleteReview($reviewId);
        
        // Check and report the result
        if ($deleteResult) {
          $message = "<p class='notice'>Congratulations! The ". $invReviewName ." review was successfully deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /acme//accounts/?action=loggedin');
          exit;
            } else {
                $message = "<p class='notice'>Error. The " . $invReviewName . " review was not deleted.</p>";
                header('location: /acme//accounts/?action=loggedin');
                exit;
                }

    break; 



    case 'confirm-del':
        
    break; 

    case 'default':
        
        if (isset($_SESSION['loggedin'])) {
            include '../view/admin.php';
            exit;                  
            } else {
                header("Location: http://localhost/ACME/");
                exit;                  
            }        
        
        
    break; 
    
}
