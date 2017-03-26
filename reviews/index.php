<?php

/* This is the reviews controller!

 */
//Create or acces a session 
session_start();

// Get the database connection file
require_once '../library/dbconnect.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model for use as needed
require_once '../model/reviews-model.php';
// Get the functions library for use as needed
require_once '../library/functions.php';


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
            include '../view/new-prod.php';
            exit;
        }

        // Send the data to the model
        $insertOutcome = insertReview($reviewText, $invId, $clientId);

        // Check and report the result
        if ($insertOutcome === 1) {
            $message = "<p>Thanks for adding a review to the product.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            include '../view/product-detail.php';
            exit;
        } else {
            $message = "<p>Sorry, but the creation of a new product review failed. Please try again.</p>";
            //header("Location: http://localhost/ACME/view/prod-mgmt.php");
            include '../view/product-detail.php';
            exit;
        }

        
    break;    
    
    case 'editReview':
        
    break; 

    case 'updateReview':
        
    break; 

    case 'confirmDelete':
        
    break; 

    case 'deleteReview':
        
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
