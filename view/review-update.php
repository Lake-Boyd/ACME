<?php

?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title>Review Update | ACME, Inc.</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for updating the reviews to the ACME databse.">
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

                <h1 class="login-title">Review Update</h1>
                <section class="login-buttons">
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>

                    <form method="post" action="/acme/reviews/index.php" id="reviewform">
                        <fieldset>
                        <label for="invname">Inventory Name</label>

                        <label for="reviewtext">Inventory Description</label><br>
                        <textarea name="reviewtext" id="reviewtext" form="reviewform" required><?php 
                            if(isset($reviewText)){ echo $reviewText; } 
                                elseif(isset($review['reviewText'])) {echo $review['reviewText']; }?></textarea><br>

                        <button type="submit" name="updateReview" id="updateReview">Update Review</button>
                        <!-- Add the action key - value pair -->
                        <input type="hidden" name="action" value="updateReview">
                        <input type="hidden" name="invid" value="<?php 
                            if(isset($reviewInfo['invId'])){ echo $reviewInfo['invId'];} 
                                elseif(isset($invId)){ echo $invId; } ?>">
                        <input type="hidden" name="reviewid" value="<?php 
                            if(isset($reviewInfo['reviewId'])){ echo $reviewInfo['reviewId'];} 
                                elseif(isset($reviewId)){ echo $reviewId; } ?>">
                    </form>                    
                    </fieldset>
                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
  
    </body>    

</html>
