<?php 

 
    if (empty ($_SESSION['clientData']['clientLevel'])){
                                  
    header("Location: http://localhost/ACME");
                                    
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
        <title>ACME Client Update</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the Registration page for ACME Inc.">
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

                <h1 class="login-title">Update account.</h1>
                <section class="login-buttons">

                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset>
                            <legend>Use this form to update your account information.</legend>
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" 
                                <?php if(isset($firstname)){echo "value='$firstname'";}  elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; }?> required>
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname"
                                <?php if(isset($lastname)){echo "value='$lastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; }?> required>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email"
                                <?php if(isset($email)){echo "value='$email'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; }?> required>

                            <button type="submit" name="accupdate" id="accupdate">Update Account</button>
                            <!-- Add the action key - value pair -->
                            <input type="hidden" name="action" value="accUpdate">                            
                            <input type="hidden" name="clientId" value="<?php 
                                if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                                    elseif(isset($clientId)){ echo $clientId; } ?>">                            
                        </fieldset>
                    </form>
                    <h2>Password update.</h2>

                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>                    
                    
                    <form method="post" action="/acme/accounts/index.php">
                        <fieldset>
                            <legend>Use this form to update your password.</legend>
                            <label for="password">Password</label>
                            <span class="reduced">Passwords must be at least 8 characters and contain at least 1 number, 
                                1 capital letter and 1 special character</span>
                            <input type="password" name="password" id="password" placeholder="Password" required 
                                   pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                            <button type="submit" name="passupdate" id="passupdate">Update Password</button>
                            <!-- Add the action key - value pair -->
                            <input type="hidden" name="action" value="passUpdate">
                            <input type="hidden" name="clientId" value="<?php 
                                if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
                                    elseif(isset($clientId)){ echo $clientId; } ?>">  
                        </fieldset>
                    </form>

                </section>

            </main>
       

        
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
