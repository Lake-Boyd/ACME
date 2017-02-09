<!DOCTYPE html>
<html lang="en">

<!--
Error Page
-->
    <head>
        <meta charset="UTF-8">
        <title>FAILURE</title>
        <meta name="author" content="Boyd Lake">
        <meta name="description" content="This page is the Error Page.">
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
            <header>
                <div class="banner">

                    <div class="logoimage">
                        <img src="http://localhost/ACME/images/logo.gif" alt="ACME Logo image">
                    </div>				



                    <div class="bannerlinks">

                        <div id="myaccount">
                            <a href='.?action=login' title='Login'>  
                                <img src="http://localhost/ACME/images/account.gif" alt="account image">My Account</a>

                        </div>

                        <div id="help">

                            <a href="#">
                                <img src="http://localhost/ACME/images/help.gif" alt="help image">Help</a>        

                        </div>    
                    </div>
                </div> 

                <nav>


                    <ul class="topnav" id="myTopnav">
                        <li><a class="active" href="#" title="Home">Home</a></li>
                        <li><a href="#" title="Anvils">Anvils</a></li>						
                        <li><a href="#" title="Cannons">Cannons</a></li>
                        <li><a href="#" title="Protection">Protection</a></li>
                        <li><a href="#" title="Rockets">Rockets</a></li>                
                        <li><a href="#" title="Traps">Traps</a></li>						
                        <li class="icon"><a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a></li>
                    </ul>




                </nav>
            </header>

            <main class="maincontent">

                <h1 class="title">System Failure</h1>

            </main>
            <section class="featured-recipes">

                <h3>StrongBad says there was a failure.</h3>

            </section>



            <?php include 'php/footer.php'; ?>

        </div>


    </body>
</html>
