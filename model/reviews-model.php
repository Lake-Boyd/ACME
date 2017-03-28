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

function getInvNameByInvId ($invId){
    
    
}

function getReviewByItem($prodId){
    $db = acmeConnect();
   // $tn = '%-tn';
    $sql = "SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews  WHERE invId = :prodId ";
    //$sql = 'SELECT imgPath, imgName FROM images  WHERE invId = :invId';
    //$sql = 'SELECT * FROM images WHERE invId IN '
    //    . '(SELECT invId FROM images WHERE imgName LIKE "%-tn")';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId);
//    $stmt->bindValue(':tn', $tn, PDO::PARAM_STR);    
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //var_dump($thumbArray);
    //exit;
    return $reviewArray;
}    
    

function checkExistingReview($clientId, $prodId){

    $db = acmeConnect();
   // $tn = '%-tn';
    $sql = "SELECT reviewId, reviewText, reviewDate, invId, clientId FROM reviews  WHERE invId = :prodId AND clientId = :clientId";
    //$sql = 'SELECT imgPath, imgName FROM images  WHERE invId = :invId';
    //$sql = 'SELECT * FROM images WHERE invId IN '
    //    . '(SELECT invId FROM images WHERE imgName LIKE "%-tn")';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId);    
    $stmt->bindValue(':prodId', $prodId);
//    $stmt->bindValue(':tn', $tn, PDO::PARAM_STR);    
    $stmt->execute();
    $checkReviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //var_dump($thumbArray);
    //exit;
    return $checkReviewArray;    
    
}
    


function getReviewByClient($clientId){

    $db = acmeConnect();
   // $tn = '%-tn';
   //$sql = "SELECT ALL reviewId, reviewText, reviewDate, invId, clientId FROM reviews  WHERE clientId = :clientId ";
    $sql = "SELECT reviews.reviewId, reviews.reviewText, reviews.reviewDate, reviews.clientId, reviews.invId, "
            . "invName FROM inventory INNER JOIN reviews ON reviews.clientId = :clientId AND "
            . "reviews.invId = inventory.invId ORDER BY reviews.reviewDate DESC";
    //$sql = 'SELECT imgPath, imgName FROM images  WHERE invId = :invId';
    //$sql = 'SELECT * FROM images WHERE invId IN '
    //    . '(SELECT invId FROM images WHERE imgName LIKE "%-tn")';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId);
//    $stmt->bindValue(':tn', $tn, PDO::PARAM_STR);    
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    //var_dump($thumbArray);
    //exit;
    return $reviewArray;    
    
}

function getReview($reviewId){

    $db = acmeConnect();
    $sql = "SELECT reviewText, reviewDate, invId, clientId FROM reviews  WHERE reviewId = :reviewId ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId);
    $stmt->execute();
    $reviewArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}


// Update a product
function updateReview($reviewId, $reviewText){
// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = NOW() WHERE reviewId = :reviewId';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    
// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}

function getProductName($invId){
 $db = acmeConnect();
 $sql = 'SELECT invName FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $nameInfo = $stmt->fetch(PDO::FETCH_NAMED);
 $stmt->closeCursor();
 return $nameInfo;
}

function deleteReview($reviewId){

    // Create a connection object using the acme connection 
    $db = acmeConnect();
    // The SQL statement    
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    // Insert the data    
    $stmt->execute();
    // Ask how many rows changed as a result of our insert    
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction    
    $stmt->closeCursor();    
    // Return the indication of success (rows changed)    
    return $rowsChanged;        
    
}
