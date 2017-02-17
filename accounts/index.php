<?php

/* 
 * Accounts Controller
 */
// Get the database connection file
require_once '../library/dbconnect.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library for use as needed
require_once '../library/functions.php';

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


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         header('location: /acme/index.php?action=reg');
            exit;
        //$action = 'home';
    }
}

switch ($action) {
    case 'register':
        //echo 'You are in the register case statement.';
        //Filter and store the data
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        
        $email = checkEmail($email);
        $checkPassword = checkPassword($password);

        // Check for missing data
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = regVisitor($firstname, $lastname, $email, $password);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $firstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';

            exit;
        }
        break;
        
    case 'Login':
 
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);        
        $email = checkEmail($email);
        $checkPassword = checkPassword($password);

        if (empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        } else {
            $message = "Login successful!</p>";
            include '../view/login.php';
            exit;            
            
        }       

        
        break;        
        

}


