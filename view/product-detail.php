<?php 

?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for viewing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo $productDetails['invName']; ?> Products | Acme, Inc.</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for viewing products in the ACME databse.">
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
                
                <section class="productsection">
                    
                    <?php if(isset($message)){ echo $message; } ?>
                    
                    <?php if(isset($detailDisplay)){ echo $detailDisplay; } ?>    
                    <?php if(isset($thumbsDisplay)){ echo $thumbsDisplay; } ?>
                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>

