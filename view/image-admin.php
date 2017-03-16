<?php
 
    if (empty ($_SESSION['clientData']['clientLevel']) || 
               $_SESSION['clientData']['clientLevel'] < 2){
                                  
    header("Location: http://localhost/ACME");
                                    
    } 

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}    
    
?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title>Image Management | ACME, Inc.</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for managing images in the ACME databse.">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>	
            <link rel="stylesheet" media="screen" type="text/css" href="http://localhost/ACME/css/main.css" />
		
            <script>
		function myFunction() {
                    var x = document.getElementById("myTopnav");
                    if (x.className === "topnav") {
                            x.className += " responsive";
                            } else {
                                x.className = "topnav";
                                }
                    }
            </script>
        
    </head>
    
    
    <body>
       
        <div id="wrapper">
        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/header.php'; ?>
            
            <main class="maincontent">

                <h1 class="login-title">Image Management</h1>
                <section class="login-buttons">
                    <h3>Add new product image.</h3>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>

                    <form method="post" action="/acme/uploads/" id="imageform" enctype="multipart/form-data">

                        <label for="invItem">Product</label><br>
                        <?php echo $prodSelect; ?><br><br>
                        <label>Upload Image:</label><br>
                        <input type="file" name="file1"><br>
                        <input type="submit" class="regbtn" value="Upload">
                        <input type="hidden" name="action" value="upload"> 
                        
                    </form>                    
                    <hr>
                    
                    <h2>Existing Images</h2>
                    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                    <?php
                        if (isset($imageDisplay)) {
                         echo $imageDisplay;
                        }
                    ?>                    
                    
                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
  
    </body>    

</html>
