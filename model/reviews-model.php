<?php

/* Reviews model
 */

function insertReview($reviewText, $invId, $clientId ){

    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
           VALUES (:reviewText, :invId, :clientId)';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);  
     

// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
    
}

function getReviewByItem(){
    
    
}

function getReviewByClient(){
    
    
}

function getReview(){
    
    
}

function updateReview(){
    
    
}

function deleteReview(){
    
    
}
