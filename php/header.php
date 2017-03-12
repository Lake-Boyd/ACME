<header>
    <div class="banner">
        
        <div class="logoimage">
            <img src="http://localhost/ACME/images/logo.gif" alt="ACME Logo image">
	</div>				
				

    
        <div class="bannerlinks">


            <?php 
         
                if (isset($_SESSION['loggedin'])) {
                $userFirstName = $_SESSION['clientData']['clientFirstname'];   
                    echo "<div class='welcome'><p class='welcome'>Welcome $userFirstName</p></div>"
                        . "<div id='myaccount'><a href='/acme/accounts/?action=Logout' title='Logout'>"
                        . "Logout</a>"
                        . "</div>";
                } else {
                  
                    echo "<div class='welcome'><p class='welcome'>Welcome Guest</p></div>"
                        . "<div id='myaccount'><a href='/acme/?action=login' title='Login'>"
                        . "<img src='http://localhost/ACME/images/account.gif' alt='account image'>My Account</a>"
                        . "</div>";                    
                }   
               ?> 


            <div id="help">

                <a href="#">
                    <img src="http://localhost/ACME/images/help.gif" alt="help image">Help</a>        

            </div>    
        </div>
    </div>    

    <nav>

        
       <?php echo $navList; ?>
        
    </nav>				
			
</header>