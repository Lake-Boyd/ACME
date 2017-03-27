<?php

/* 
 * Accounts model file
 */

function regVisitor($firstname, $lastname, $email, $password){

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,
           clientEmail, clientPassword)
           VALUES (:firstname, :lastname, :email, :password)';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);   

// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}

// check for existing email address

function checkExistingEmail($email){
    
    $db = acmeConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    if (empty($matchEmail)){
        return 0;
        //echo 'Nothing found';
        //exit;
        } else {
        return 1;
        //echo 'Match found';
        //exit;        
        }
   
}


// Get client data based on an email address
function getClient($email){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, '
          . 'clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

// Get client data based on an email address
function getClientbyId($clientid){
  $db = acmeConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, '
          . 'clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientid';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientid', $clientid, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

function getClientInfo($clientid){
 $db = acmeConnect();
 $sql = 'SELECT * FROM clients WHERE clientId = :clientid';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientid', $clientid, PDO::PARAM_INT);
 $stmt->execute();
 $clientInfo = $stmt->fetch(PDO::FETCH_NAMED);
 $stmt->closeCursor();
 return $clientInfo;
}

function getClientName($clientId){
    
  $db = acmeConnect();
  $sql = 'SELECT clientFirstname, clientLastname FROM clients WHERE clientId = :clientid';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientid', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;    
    
    
}

function updateClient($clientid, $firstname, $lastname, $email){
    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'UPDATE clients SET clientFirstname = :firstname, clientLastname = :lastname, clientEmail = :email
         WHERE clientId = :clientid';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientid', $clientid, PDO::PARAM_STR);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  

    
// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}


function updatePassword($password, $clientid){
    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'UPDATE clients SET clientPassword = :password
         WHERE clientId = :clientid';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':clientid', $clientid, PDO::PARAM_STR);
 
// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}