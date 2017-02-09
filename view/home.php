<!DOCTYPE html>
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <head>
        <meta charset="UTF-8">
        <title>ACME Roadrunner Rocket</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the home page for ACME Inc.">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>	
            <link rel="stylesheet" media="screen" type="text/css" href="css/main.css" />
		
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
        
            <?php include 'php/header.php'; ?>
            
            <main class="maincontent">
                
                <h1 class="title">Welcome to Acme!</h1>
                
                <img src="images/dinnerrocketfeature.jpg" alt="main content background image">
                
                <div class="rocketbutton">
                    
                    <ul>
                      <li><h2>Get Dinner Rocket</h2></li>
                      <li>Quick lighting fuse</li>
                      <li>NHTSA approved seat belts</li>
                      <li>Mobile launch stand included</li>
                      <li><a href="#"><img id="actionbtn" alt="Add to cart button" src="images/iwantit.gif"></a></li>
                    </ul>
                    
                </div>
                
            </main>
            <section class="featured-recipes">
                
                <h3>Featured Recipes</h3>
                
                <div class="recipelink">
                    <img src="images/recipes/bbqsand.jpg" alt="BBQ image">
                    <a href="#">Pulled Roadrunner BBQ</a>
                </div>

                <div class="recipelink">
                    <img src="images/recipes/potpie.jpg" alt="Pot Pie image">
                    <a href="#">Roadrunner Pot Pie</a>
                </div>

                <div class="recipelink">
                    <img src="images/recipes/soup.jpg" alt="Soup image">
                    <a href="#">Roadrunner Soup</a>
                </div>

                <div class="recipelink">
                    <img src="images/recipes/taco.jpg" alt="Tacos image">
                    <a href="#">Roadrunner Tacos</a>
                </div>                
                
            </section>
            <section class="reviews">
                
                 <h3>Reviews</h3>
 

                    <ul>
                      <li>"I don't know how I ever caught roadrunners before this." (9/10)</li>
                      <li>"That thing was fast!" (8/10)</li>
                      <li>"Talk about fast delivery." (10/10)</li>
                      <li>"I didn't even have to pull the meat apart." (9/10)</li>
                      <li>"I'm on my thirtieth one. I love these things!" (10/10)</li>
                    </ul>
                 
                 
            </section>
            

        
            <?php include 'php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
