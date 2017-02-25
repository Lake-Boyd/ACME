<?php 
//check to see if user is logged in
if (!$_SESSION['loggedin']){
    header("Location: http://localhost/ACME/");
    exit;
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
        <title>ACME Login</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the Admin page for ACME Inc. website">
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


                
                <h1 class="login-title">
                    
                    <?php 
                        echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
                    ?></h1>
                
                <section class="login-buttons">
                    
                    <ul class="userdata">
                        <li>First Name:
                            <?php 
                                echo " ". $_SESSION['clientData']['clientFirstname'];
                            ?></li>                       

                        <li>Last Name:
                            <?php 
                                echo " ". $_SESSION['clientData']['clientLastname'];
                            ?></li>                         
                        <li>Email:
                            <?php 
                                echo " ". $_SESSION['clientData']['clientEmail'];
                            ?></li>                       

                        <li>Level:
                            <?php 
                                echo " ". $_SESSION['clientData']['clientLevel'];
                            ?></li>
                        
                    </ul>

                            <?php 
                                if ($_SESSION['clientData']['clientLevel'] > 1){
                                  
                                    echo "<p class='products'><a href='../products/'>Products</a></p>";
                                    
                                } 
                            ?>                    
                    
                    
                </section>

            </main>
       

        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
