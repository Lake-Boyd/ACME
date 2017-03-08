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

function checkCatName($catName){
    $pattern = '/^[a-zA-Z]+$/';
    return preg_match($pattern, $catName);
    
}


function makeNavList() {
    $categories = getCategories();
    $navList = '<ul class="topnav" id="myTopnav">';
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {

        $navList .= "<li><a href='/acme/products/index.php?action=category&type=$category[categoryName]"
                . "' title='View our $category[categoryName] "
                . "product line'>$category[categoryName]</a></li>";
    }

    $navList .= '<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" '
            . 'onclick="myFunction()">☰</a></li></ul>';
    
    return $navList;
}

function buildProductsDisplay($products){
    
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<img src= '$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= "<hr>";
        $pd .= "<h2>$product[invName]</h2>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</li>';
        }
    $pd .= '</ul>';
    return $pd;
    
}
