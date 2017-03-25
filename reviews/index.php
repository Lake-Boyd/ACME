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
