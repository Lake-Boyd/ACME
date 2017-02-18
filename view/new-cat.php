<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title>ACME Add Categories</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for adding new categories to the ACME databse.">
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

                <h1 class="login-title">Add a new category.</h1>
                <section class="login-buttons">
                    <h3>Please fill in the fields below.</h3>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    <form method="post" action="/acme/products/index.php" id="addform">

                        <label for="categoryname">Category Name</label>
                        <span class="reduced">Enter the name as upper or lower case letters. Do not use numbers or special characters.</span>                           
                        <input type="text" name="categoryname" id="categoryname" 
                            <?php if(isset($catName)){echo "value='$catName'";} ?> required
                            pattern="^[a-zA-Z]+$"> 
                        
                        <button type="submit" name="addcategory" id="addcategory">Submit Category</button>
                        <!-- Add the action key - value pair -->
                        <input type="hidden" name="action" value="addcat">
                    </form>

                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>

