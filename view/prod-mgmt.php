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
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <meta charset="UTF-8">
        <title>ACME Product Mgmt</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the Product Management page for ACME Inc.">
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

                <h1 class="login-title">Manage Products</h1>
                <section class="login-buttons">
                    <h3>Add Products or Categories</h3>
                  

                    <ul>    
                        <li><a href='http://localhost/ACME/.?action=newprod' title="New Product">Add a new product</a></li>
                        <li><a href='http://localhost/ACME/.?action=newcat' title="New Category">Add a new category</a></li>
                    </ul>

                    <?php
                        if (isset($message)) {
                         echo $message;
                        } if (isset($prodList)) {
                         echo $prodList;
                        }
                        ?>

                </section>

            </main>
       

        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
<?php unset($_SESSION['message']); ?>