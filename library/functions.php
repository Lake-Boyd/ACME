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
        $pd .= "<a href='/acme/products/index.php?action=prodDetail&type=$product[invName]'>"
                . "<img src= '$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $pd .= "<hr>";
        $pd .= "<a href='/acme/products/index.php?action=prodDetail&type=$product[invName]'><h2>$product[invName]</h2></a>";
        $pd .= "<span>$product[invPrice]</span>";
        $pd .= '</li>';
        }
    $pd .= '</ul>';
    return $pd;
    
}

function buildDetailDisplay($productDetails){
    
    $pdetails = "<h1 id='prod-title'>$productDetails[invName]</h1>";
    $pdetails .= "<img class='productimage' src=$productDetails[invImage] alt='Image of $productDetails[invName] on Acme.com'></a>";
    $pdetails .= "<div class='detailbox'><p class='productdescription'>$productDetails[invDescription]</p>";
    $pdetails .= "<ul>";    
    $pdetails .= "<li class ='details'>A $productDetails[invVendor] product.</li>";
    $pdetails .= "<li class ='details'>Primary Material: $productDetails[invStyle]</li>";
    $pdetails .= "<li class ='details'>Product weight: $productDetails[invWeight]</li>";
    $pdetails .= "<li class ='details'>Product Size: $productDetails[invSize]</li>";
    $pdetails .= "<li class ='details'>Ships from: $productDetails[invLocation]</li>";
    $pdetails .= "<li class ='details'>In stock: $productDetails[invStock]</li>";
    $pdetails .= "</ul>";      
    $pdetails .= "<p class ='price'>$productDetails[invPrice]</p>";

    $pdetails .= "</div>";
    return $pdetails;
    
}