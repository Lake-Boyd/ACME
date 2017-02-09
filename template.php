<!DOCTYPE html>
<html lang="en">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

    <head>
        <?php
            // Get the database connection file
            require_once 'connections/dbconnect.php';
            // Get the acme model for use as needed
            require_once 'model/acme-model.php';

            $categories = getCategories();
            //var_dump($categories);
            //exit;

            $navList = '<ul class="topnav" id="myTopnav">';
            $navList .= "<li><a href='.' title='View the Acme home page'>Home</a></li>";
            foreach ($categories as $category) {

                $navList .= "<li><a href='.?action=$category[categoryName]' title='View our $category[categoryName] "
                        . "product line'>$category[categoryName]</a></li>";
            }

            $navList .= '<li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a></li></ul>';
            ?>
        
        
        
        <meta charset="UTF-8">
        <title>Template</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is the TEMPLATE.">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>	
            <link rel="stylesheet" media="screen" type="text/css" href="css/template.css" />
		
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
        
            <?php include 'php/template_header.php'; ?>
            
            <main class="maincontent">
                
                <h1 class="title">Content</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer 
                    molestie lorem in blandit consequat. Integer vel laoreet neque, 
                    quis laoreet ex. Nulla aliquet ante vel magna commodo, quis sollicitudin 
                    nulla faucibus. Integer id sodales leo. Nunc sapien massa, malesuada 
                    et enim vel, venenatis vestibulum purus. In bibendum massa a dolor 
                    volutpat placerat. Donec non arcu posuere, dignissim lectus non, 
                    congue justo. Maecenas lectus magna, cursus in velit pretium, 
                    tincidunt semper erat. Aenean mauris leo, gravida nec sollicitudin at, 
                    pretium ac purus. Praesent rutrum risus sapien, at molestie metus consequat vel.</p>
                
                <p>In non faucibus quam, vitae elementum dui. Morbi nunc arcu, pellentesque a 
                    eleifend quis, accumsan id urna. Aliquam in maximus est. Phasellus ornare 
                    urna ligula, sit amet auctor leo gravida eget. Suspendisse sagittis nec 
                    lacus venenatis bibendum. Suspendisse turpis augue, malesuada non tempor 
                    et, tincidunt vitae nunc. Vivamus tellus metus, sollicitudin quis eros sed, 
                    facilisis maximus nunc. Nam semper vehicula dignissim. Vivamus finibus 
                    pulvinar suscipit. Etiam interdum dui nulla, sit amet elementum orci venenatis ac.</p>

                <p>Maecenas rutrum nisl odio, non semper dolor tempus ac. Nullam varius, justo 
                    in rhoncus commodo, est purus tempus tellus, nec gravida quam nunc et lacus. 
                    In ut volutpat erat, non tincidunt sapien. Fusce rutrum mi rutrum, facilisis 
                    neque convallis, facilisis felis. Duis vel vestibulum quam. Vestibulum ante 
                    ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
                    Suspendisse nec mauris non metus fermentum fermentum. Morbi nunc urna, 
                    lacinia sit amet neque id, tempus ornare eros. Etiam nulla est, varius 
                    nec rhoncus vitae, elementum id risus. Curabitur nec auctor orci. Sed 
                    pellentesque tellus ipsum, in vulputate augue ornare nec. Cras laoreet 
                    mollis justo eget laoreet. Nunc interdum massa ac lectus tincidunt varius. 
                    Suspendisse interdum, diam eget dignissim imperdiet, risus odio porta mauris, 
                    eget consectetur felis odio sed dolor.</p>
                
            </main>
            <section class="featured-recipes">
                
                <h3>Content</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer 
                    molestie lorem in blandit consequat. Integer vel laoreet neque, 
                    quis laoreet ex. Nulla aliquet ante vel magna commodo, quis sollicitudin 
                    nulla faucibus. Integer id sodales leo. Nunc sapien massa, malesuada 
                    et enim vel, venenatis vestibulum purus. In bibendum massa a dolor 
                    volutpat placerat. Donec non arcu posuere, dignissim lectus non, 
                    congue justo. Maecenas lectus magna, cursus in velit pretium, 
                    tincidunt semper erat. Aenean mauris leo, gravida nec sollicitudin at, 
                    pretium ac purus. Praesent rutrum risus sapien, at molestie metus consequat vel.</p>
                
            </section>
            <section class="reviews">
                
                 <h3>Content</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer 
                    molestie lorem in blandit consequat. Integer vel laoreet neque, 
                    quis laoreet ex. Nulla aliquet ante vel magna commodo, quis sollicitudin 
                    nulla faucibus. Integer id sodales leo. Nunc sapien massa, malesuada 
                    et enim vel, venenatis vestibulum purus. In bibendum massa a dolor 
                    volutpat placerat. Donec non arcu posuere, dignissim lectus non, 
                    congue justo. Maecenas lectus magna, cursus in velit pretium, 
                    tincidunt semper erat. Aenean mauris leo, gravida nec sollicitudin at, 
                    pretium ac purus. Praesent rutrum risus sapien, at molestie metus consequat vel.</p> 
                
            </section>
            

        
            <?php include 'php/template_footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
