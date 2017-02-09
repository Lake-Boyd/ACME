<!DOCTYPE html>
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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

                        <label for="invid">Inventory Id</label>
                        <input type="text" name="invid" id="invid">
                        
                        <label for="invname">Inventory Name</label>
                        <input type="text" name="invname" id="invname">
                        
                        <label for="invdescription">Inventory Description</label>
                        <textarea name="invdescription" id="invdescription" form="addform"></textarea>
                        
                        <label for="invimage">Inventory Image</label>
                        <input type="text" name="invimage" id="invimage" >
                     
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
