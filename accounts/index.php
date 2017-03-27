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
// Get the functions library for use as needed
require_once '../model/reviews-model.php';
//Create or acces a session 
session_start();

$navList = makeNavList();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
         header('location: /acme/index.php?action=reg');
            exit;
        //$action = 'home';
    }
}


if (isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
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

        //check for existing email address
        $existingEmail = checkExistingEmail($email);
        if ($existingEmail){
            $message = '<p class = "notice">That email already exists. '
                    . 'Do you wish to login instead?</p>';
            include '../view/login.php';
            exit;
        }
        
        
        // Check for missing data
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // hash the checked password
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // Send the data to the model
        $regOutcome = regVisitor($firstname, $lastname, $email, $password);

        // Check and report the result
        if ($regOutcome === 1) {
            // set the cookie
            setcookie('firstname', $firstname, strtotime('+1 year'), '/');
            //set and include the message
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
            $email = checkEmail($email);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($password);

            // Run basic checks, return if errors
            if (empty($email) || empty($passwordCheck)) {
              $message = '<p class="notice">Please provide a valid email address and password.</p>';
              include '../view/login.php';
              exit;
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($email);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($password, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
              $message = '<p class="notice">Please check your password and try again.</p>';
              include '../view/login.php';
              exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            $message = "<p class='notice'>Congratulations, ". $_SESSION['clientData']['clientFirstname']. ". You are logged-in.</p>";
            $_SESSION['message'] = $message;
            $firstname = $_SESSION['clientData']['clientFirstname'];
            // delete the cookie
            setcookie('firstname', $firstname, strtotime('-1 year'), '/');
            $clientId = $_SESSION['clientData']['clientId'];
            $clientFirstName = $_SESSION['clientData']['clientFirstname'];
            $clientRevName = substr($clientFirstName, 0, 1) . " ".$_SESSION['clientData']['clientLastname'];
            $clientReviewsArray = getReviewByClient($clientId);
            if (isset($clientReviewsArray)) {
                    $reviewList = buildClientRevsDisplay($clientReviewsArray, $clientRevName);
                        } 
            

            //$cookiename = $_COOKIE[0];
            // echo $cookiename;
            // exit;
            //echo $_SESSION['loggedin'][0];
            
            include '../view/admin.php';
            exit;        

        break;        


    case 'loggedin':
        
        if (isset($_SESSION['loggedin'])){
            include '../view/admin.php';
            exit;             
        }else {
            header("Location: http://localhost/ACME/");
            exit;            
        }
        
        break;

        
    case 'Logout':

        // remove all session variables
        session_unset(); 

        // destroy the session 
        session_destroy();
        //go to the home view
        // header("Location: http://localhost/ACME/view/home.php");
        include '../view/admin.php';
        exit;        
        
        break;

    case 'updateClient':
        $clientId = $_SESSION['clientData']['clientId'];
        $clientInfo = getClientInfo($clientId);
            if (count($clientInfo) < 1){
                $message = 'Sorry, no client information could be found.';
            }
            include '../view/client-update.php';
            exit;
        break;

    case 'accUpdate':

        //Filter and store the data
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $email = checkEmail($email);
        $sessionEmail = $_SESSION['clientData']['clientEmail'];
        $clientid = $_SESSION['clientData']['clientId'];
        $existingEmail = checkExistingEmail($email);
        
        if (($sessionEmail != $email) && ($existingEmail = 1) ){
               $message = '<p class = "notice">That email already exists. '
                        . 'Please enter another email address.</p>';
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
                }
            
            

        if (empty($firstname) || empty($lastname) || empty($email)) {
            $message = '<p class="notice">Please provide information for all empty form fields.</p>';
            $_SESSION['message'] = $message;
            include '../view/client-update.php';
            exit;
        }
        $clientUpResult = updateClient($clientid, $firstname, $lastname, $email); 
        $clientData = getClientbyId($clientid);

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view

            if ($clientUpResult) {
                $message = "<p class='notice'>Congratulations, ". $_SESSION['clientData']['clientFirstname']. " your account was successfully updated.</p>";
                $_SESSION['message'] = $message;
                include '../view/admin.php';              
              //header('location: /acme/view/admin.php');
                }


            include '../view/admin.php';
            exit;        
       
        break;    
    
    case 'passUpdate':

        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $clientid = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($password);

         if (empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
            }        
        
        $password = password_hash($password, PASSWORD_DEFAULT);


 
        $clientUpResult = updatePassword($password, $clientid); 
        $clientData = getClientbyId($clientid);

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            if ($clientUpResult) {
                $message = "<p class='notice'>Congratulations, ". $_SESSION['clientData']['clientFirstname']. " your password was successfully updated.</p>";
                $_SESSION['message'] = $message;
                include '../view/admin.php';              
              //header('location: /acme/view/admin.php');
                }

 
            exit;             
            
            
        break; 
        
    
}


