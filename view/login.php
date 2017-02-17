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
            <meta name="description" content="This page is the Login page for ACME Inc.">
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

                <h1 class="login-title">Login</h1>
                <section class="login-buttons">
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>                    
                    
                    
                    <form method="post" action="/acme/accounts/index.php">

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email" 
                            <?php if(isset($email)){echo "value='$email'";} ?> required>
                        
                        <label for="password">Password</label>
                        <span>Passwords must be at least 8 characters and contain at least 1 number, 
                            1 capital letter and 1 special character</span>                        
                        <input type="password" name="password" id="password" placeholder="Password" 
                         required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">                        
                        
                        <button type="submit" name="Login" id="Login">Login</button>
                        <input type="hidden" name="action" value="Login">
                    </form>
                    <form method="post" action=".?action=reg">
                        <button type="submit" name="reg" id="reg">Register a new account</button>
                    </form>

                </section>

            </main>
       

        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
