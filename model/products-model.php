<?php

/* 
 * This is the Products Model
 */


function getProdCategories() {
    // Create a connection object from the acme connection function
    $db = acmeConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT categoryName, categoryId FROM categories
            ORDER BY categoryName ASC';
    // The next line creates the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $categories variable    
    $prodcategories = $stmt->fetchAll();
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    // The next line sends the array of data back to where the function
    // was called (this should be the controller)    
    return $prodcategories;
}

function addProduct($invName, $invDescription, $invImage, $invThumbnail, 
        $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, 
        invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
           VALUES (:invName, :invDescription, :invImage, :invThumbnail, 
        :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);  
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);  
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);  
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);  
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);  
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);  
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);  
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);  
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);      

// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}


function addCategory($categoryName){
    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'INSERT INTO categories (categoryName)
           VALUES (:categoryName)';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    

// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}

function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_NAMED);
 $stmt->closeCursor();
 return $products;
}

function getProductInfo($prodId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :prodId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_NAMED);
 $stmt->closeCursor();
 return $prodInfo;
}

// Update a product
function updateProduct($prodName, $prodDescription, $prodImage, $prodThumbnail, 
        $prodPrice, $prodStock, $prodSize, $prodWeight, $prodLocation, $categoryId, $prodVendor, $prodStyle, $prodId){
    

// Create a connection object using the acme connection function    
    
    $db = acmeConnect();

// The SQL statement    
    
    $sql = 'UPDATE inventory SET invName = :prodName, invDescription = :prodDescription, invImage = :prodImage,
        invThumbnail = :prodThumbnail, invPrice = :prodPrice, invStock = :prodStock, invSize = :prodSize, 
        invWeight = :prodWeight, invLocation = :prodLocation, categoryId = :categoryId, invVendor = :prodVendor, invStyle = :prodStyle WHERE invId = :prodId';

// Create the prepared statement using the acme connection
    
    $stmt = $db->prepare($sql);

// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    
    //$stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':prodName', $prodName, PDO::PARAM_STR);
    $stmt->bindValue(':prodDescription', $prodDescription, PDO::PARAM_STR);
    $stmt->bindValue(':prodImage', $prodImage, PDO::PARAM_STR);
    $stmt->bindValue(':prodThumbnail', $prodThumbnail, PDO::PARAM_STR);  
    $stmt->bindValue(':prodPrice', $prodPrice, PDO::PARAM_STR);  
    $stmt->bindValue(':prodStock', $prodStock, PDO::PARAM_STR);  
    $stmt->bindValue(':prodSize', $prodSize, PDO::PARAM_STR);  
    $stmt->bindValue(':prodWeight', $prodWeight, PDO::PARAM_STR);  
    $stmt->bindValue(':prodLocation', $prodLocation, PDO::PARAM_STR);  
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);  
    $stmt->bindValue(':prodVendor', $prodVendor, PDO::PARAM_STR);  
    $stmt->bindValue(':prodStyle', $prodStyle, PDO::PARAM_STR);      
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    
// Insert the data    
    
    $stmt->execute();

// Ask how many rows changed as a result of our insert    
    
    $rowsChanged = $stmt->rowCount();

// Close the database interaction    
    
    $stmt->closeCursor();    

// Return the indication of success (rows changed)    
    
    return $rowsChanged;
    
}


function deleteProduct($prodId){
// Create a connection object using the acme connection function    
    $db = acmeConnect();
// The SQL statement    
    $sql = 'DELETE FROM inventory WHERE invId = :prodId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
// Insert the data    
    $stmt->execute();
// Ask how many rows changed as a result of our insert    
    $rowsChanged = $stmt->rowCount();
// Close the database interaction    
    $stmt->closeCursor();    
// Return the indication of success (rows changed)    
    return $rowsChanged;    
}

//get a list of products based on category

function getProductsByCategory($type){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN '
            . '(SELECT categoryId FROM categories WHERE categoryName = :catType)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}