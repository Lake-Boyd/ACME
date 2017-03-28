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
        $pd .= "<a href='/acme/products/index.php?action=prodDetail&type=$product[invId]'>"
                . "<img src= '$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
        $pd .= "<hr>";
        $pd .= "<a href='/acme/products/index.php?action=prodDetail&type=$product[invId]'><h2>$product[invName]</h2></a>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</li>';
        }
    $pd .= '</ul>';
    return $pd;
    
}

function buildDetailDisplay($productDetails){
    $pdetails = "<div class='detailImageBox'>";
    $pdetails .= "<h1 id='prod-title'>$productDetails[invName]</h1>";
    $pdetails .= "<img class='productimage' src=$productDetails[invImage] alt='Image of $productDetails[invName] on Acme.com'></div>";
    $pdetails .= "<div class='detailbox'><p class='productdescription'>$productDetails[invDescription]</p>";
    $pdetails .= "<ul>";    
    $pdetails .= "<li class ='details'>A $productDetails[invVendor] product.</li>";
    $pdetails .= "<li class ='details'><strong>Primary Material: </strong>$productDetails[invStyle]</li>";
    $pdetails .= "<li class ='details'><strong>Product weight: </strong>$productDetails[invWeight]</li>";
    $pdetails .= "<li class ='details'><strong>Product Size: </strong>$productDetails[invSize]</li>";
    $pdetails .= "<li class ='details'><strong>Ships from: </strong>$productDetails[invLocation]</li>";
    $pdetails .= "<li class ='details'><strong>In stock: </strong>$productDetails[invStock]</li>";
    $pdetails .= "</ul>";      
    $pdetails .= "<p class ='price'>$$productDetails[invPrice]</p>";

    $pdetails .= "</div><hr>";
    return $pdetails;
    
}


/* * ********************************
* Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}


// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='".str_replace('\\', '/', $image['imgPath'])."' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&id=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
       }
    $id .= '</ul>';
    return $id;
}

function buildThumbsDisplay($thumbArray) {
    $thumbs = '<div class="thumbs"><ul id="thumbs-display">';
    foreach ($thumbArray as $thumb) {
        //var_dump($thumb); src='".str_replace('\\', '/', $image['imgPath'])."'
        //exit;
        $thumbs .= '<li>';
        $thumbs .= "<img src='" . str_replace('\\', '/', $thumb['imgPath']) . "' title='" . $thumb['imgName'] . " thumbnail image on Acme.com' alt='" . $thumb['imgName'] . " image on Acme.com'>";
        $thumbs .= '</li>';
       }
    $thumbs .= '</ul></div>';
    return $thumbs;
}

function buildRevDisplay($reviewsArray) {
    
    $reviews = '<div class="reviews"><ul id="reviews-display">';
    foreach ($reviewsArray as $review) {
        //build reviews list
        $clientName = getClientName($review['clientId']);
        $clientRevName = substr($clientName['clientFirstname'], 0, 1) . " ".$clientName['clientLastname'];
        $reviews .= '<li>';
        //$reviews .= '<p>Review Id: '. $review['reviewId'] . "</p>"; 
        $date = date('F d, Y h:i:s a', strtotime($review['reviewDate']));
        $reviews .= '<p class="clienpostname">Posted by <strong>'. $clientRevName . '</strong> on ' . $date . '</p>';

        $reviews .= '<p class="reviewtext">' . $review['reviewText'] . '</p>';
        $reviews .= '</li>';
        }
    $reviews .= '</ul></div>';
    
    return $reviews;
}

function buildClientRevsDisplay($clientReviewsArray, $clientRevName){
    
    // var_dump($clientReviewsArray);
    
        $reviews = '<div class="reviews"><ul class="reviews-display">';
    foreach ($clientReviewsArray as $review) {
        //build reviews list
        $reviews .= '<li>';
        // the title and date need to be added here
        //$reviews .= '<p>Review Id: '. $review['reviewId'] . "</p>";
        $date = date('F d, Y h:i:s a', strtotime($review['reviewDate']));
        $reviews .= '<p class="clienpostname">Posted by <strong>' . $clientRevName . '</strong> on ' . $date . '</p>';

        $reviews .= '<p class="reviewtext">' . $review['reviewText'] . '</p>';
        $reviews .= '<p class="updatelinks">'
                . '<a href="/acme/reviews/index.php?action=editReview&id=' .$review['reviewId'].'">Edit</a><span> | </span>'
                . '<a href="/acme/reviews/index.php?action=deleteReview&id=' .$review['reviewId'].'">Delete</a></p>';
        $reviews .= '</li>';
        }
    $reviews .= '</ul></div>';
    
    return $reviews;
    
}

function newRevDisplay ($prodId, $clientId){

    $newReviewForm = '<form method="post" action="/acme/reviews/index.php" id="addform">';

    $newReviewForm .= '<fieldset><label for="reviewtext">Review Text</label><br>';
            
    $newReviewForm .= '<textarea name="reviewtext" id="reviewtext" form="addform" rows="10" cols="75" required></textarea><br>';
    
    $newReviewForm .= '<button type="submit" name="addReview" id="addReview">Submit the review</button>';
                      
    $newReviewForm .= '<input type="hidden" name="action" value="addReview">';
            
    $newReviewForm .= '<input type="hidden" name="invid" value=' . $prodId . '>';
            
    $newReviewForm .= '<input type="hidden" name="clientid" value=' . $clientId . '></fieldset></form>';     

    return $newReviewForm;
}


// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invItem" id="invItem">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
       }
    $prodList .= '</select>';
    return $prodList;
}


// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
 // Gets the pathes, full and local directory
 global $image_dir, $image_dir_path;
 if (isset($_FILES[$name])) {
    // Gets the actual file name
    $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
        return;
        }
   // Get the file from the temp folder on the server
   $source = $_FILES[$name]['tmp_name'];
   // Sets the new path - images folder in this directory
   $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
   // Moves the file to the target folder
   move_uploaded_file($source, $target);
   // Send file for further processing
   processImage($image_dir_path, $filename);
   // Sets the path for the image for Database storage
   $filepath = $image_dir . DIRECTORY_SEPARATOR . $filename;
   // Returns the path where the file is stored
   return $filepath;
   }
}


// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . DIRECTORY_SEPARATOR;

    // Set up the image path
    $image_path = $dir . DIRECTORY_SEPARATOR . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}


// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    }

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
}

