<?php
 
    if (empty ($_SESSION['clientData']['clientLevel']) || 
               $_SESSION['clientData']['clientLevel'] < 2){
                                  
    header("Location: http://localhost/ACME");
      exit;                              
    } 
?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
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

                <h1 class="login-title"><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
                <section class="login-buttons">
                    <p>Confirm Product Deletion. The delete is permanent.</p>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    
                    <form method="post" action="/acme/products/index.php" id="addform">
                        <fieldset>
                            <label for="invname">Product Name</label>
                            <input type="text" name="invname" id="invname" required readonly 
                                <?php if(isset($invName)){ echo "value='$invName'"; } 
                                elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>>
                                   

                            <label for="invdescription">Product Description</label><br>
                            <textarea name="invdescription" id="invdescription" form="addform" required readonly ><?php 
                            if(isset($invDescription)){ echo $invDescription; } 
                                elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea><br>

                            <button type="submit" name="deleteProduct" id="deleteProduct" >Delete Product</button>
                            <!-- Add the action key - value pair -->
                            <input type="hidden" name="action" value="deleteProd">
                            <input type="hidden" name="prodId" value="<?php 
                            if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                                elseif(isset($prodId)){ echo $prodId; } ?>">
                        </fieldset>
                    </form>                    

                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
