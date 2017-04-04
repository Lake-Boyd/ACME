<?php
 
//    if (empty ($_SESSION['clientData']['clientLevel']) || 
//               $_SESSION['clientData']['clientLevel'] < 2){
//                                  
//    header("Location: http://localhost/ACME");
//      exit;                              
//    } 

    if (isset($_SESSION['loggedin'])) {
        $userFirstName = $_SESSION['clientData']['clientFirstname'];
    }       

?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($invReviewNameInfo['invName'])){ echo "Delete $invReviewNameInfo[invName] Review";} ?> | Acme, Inc.</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for deleting products to the ACME databse.">
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

                <h1 class="login-title"><?php if(isset($invReviewNameInfo['invName'])){ echo "Delete ". $invReviewNameInfo['invName'] . "Review";} ?></h1>
                <section class="login-buttons">
                    <p>Confirm Review Deletion. The delete is permanent.</p>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>

                    <form method="post" action="/acme/reviews/index.php" id="reviewform">
                        <fieldset>
                            <label for="reviewtext">Review Text</label><br>
                            <textarea name="reviewtext" id="reviewtext" form="reviewform" rows="10" cols="75" required readonly><?php 
                            if(isset($reviewText)){ echo $reviewText; } 
                                elseif(isset($review['reviewText'])) {echo $review['reviewText']; }?></textarea><br>

                            <button type="submit" name="confirmDelete" id="confirmDelete" >Delete Review</button>
                            <!-- Add the action key - value pair -->
                            <input type="hidden" name="action" value="confirmDelete">
                            <input type="hidden" name="reviewid" value="<?php 
                            if(isset($reviewInfo['reviewId'])){ echo $reviewInfo['reviewId'];} 
                                elseif(isset($reviewId)){ echo $reviewId; } ?>">
                        </fieldset>
                    </form>                    

                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
