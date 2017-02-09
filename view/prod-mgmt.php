<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title>ACME Registration</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the product management page for ACME Inc.">
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

                <h1 class="login-title">Register a new account.</h1>
                <section class="login-buttons">
                    <h3>Please fill in the fields below.</h3>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    <form method="post" action="/acme/products/index.php" id="addform">

                        <!-- <label for="invid">Inventory Id</label> -->
                        <input type="hidden" name="invid" id="invid" value="">
                        
                        <label for="invname">Inventory Name</label>
                        <input type="text" name="invname" id="invname">
                        
                        <label for="invdescription">Inventory Description</label>
                        <textarea name="invdescription" id="invdescription" form="addform"></textarea>
                        
                        <label for="invimage">Inventory Image</label>
                        <input type="text" name="invimage" id="invimage" >

                        <label for="invthumbnail">Inventory Thumbnail</label>
                        <input type="text" name="invthumbnail" id="invthumbnail" >
                        
                        <label for="invprice">Inventory Price</label>
                        <input type="text" name="invprice" id="invprice" >                        
                        
                        <label for="invstock">Inventory Stock</label>
                        <input type="text" name="invstock" id="invstock" >

                        <label for="invsize">Inventory Size</label>
                        <input type="text" name="invsize" id="invsize" >

                        <label for="invweight">Inventory Weight</label>
                        <input type="text" name="invweight" id="invweight" >

                        <label for="invlocation">Inventory Location</label>
                        <input type="text" name="invlocation" id="invlocation" >

                        <label for="categoryid">Category Id</label>
                        
                        <?php
                        
                            echo $prodcatList ;
                        
                        ?>
                        
                        <input type="text" name="categoryid" id="categoryid" >

                        <label for="invvendor">Inventory Vendor</label>
                        <input type="text" name="invvendor" id="invvendor" >

                        <label for="invstyle">Inventory Style</label>
                        <input type="text" name="invstyle" id="invstyle" >                        
                        
                        <button type="submit" name="addprod" id="addprod">Submit Product</button>
                        <!-- Add the action key - value pair -->
                        <input type="hidden" name="action" value="addproduct">
                    </form>

                </section>

            </main>
       

        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
