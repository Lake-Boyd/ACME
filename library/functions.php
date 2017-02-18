<?php

/* functions library file

 */

function checkEmail($email){
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);    
    return $valEmail;
}


function checkPassword($password){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $password);
    
}

function checkInvStock($invstock){
    $sanStock = filter_var($invstock, FILTER_SANITIZE_NUMBER_INT);
    $valStock = filter_var($sanStock, FILTER_VALIDATE_INT);    
    return $valStock;
    
}

function checkInvPrice($invprice){
    $sanPrice = filter_var($invprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $valPrice = filter_var($sanPrice, FILTER_VALIDATE_FLOAT);    
    return $valPrice;
    
}
