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
            <link rel="stylesheet" media="screen" type="text/css" href="../css/main.css" />
		
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
            <div id="wrapper">

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
                <?php
                /*
                 * To change this license header, choose License Headers in Project Properties.
                 * To change this template file, choose Tools | Templates
                 * and open the template in the editor.
                 */



                $trucks = array(array("Ford", array("F-150", "Ranger", "Raptor")),
                                array("Chevrolet", array("Silverado", "Colorado", "Tahoe")),
                                array("Toyota", array("Tundra", "Tacoma", "Tacoma TRD Sport"))
                );

                $make = 0;

                for ($mfgarraykey = 0; $mfgarraykey < 3; $mfgarraykey++) {
                    echo "<p><strong>Truck Manufacturer: " . $trucks[$mfgarraykey][$make] . "</strong></p>";


                    for ($pointer = 1; $pointer < 2; $pointer++) {
                        $modelarray = $trucks[$mfgarraykey][$pointer];
                        echo "<ul>";
                        foreach ($modelarray as $string){
                        //for ($model = 0; $model <= 2; $model++) {
                        //    echo "<li>Model: " . $modelarray[$model] . " </li>";
                        echo "<li>Model: " . $string . " </li>";    
                            }
                        echo "</ul>";
                    }
                    //$make = 0;
                }
                ?>

            </main>
       

        
            <?php include '../php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>
