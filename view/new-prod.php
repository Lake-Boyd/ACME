<?php 
//build the product categories list
$prodcatList = "<select name='catId' id='catId'>";
$prodcatList .= "<option>Choose a Category</option>";
foreach ($prodcategories as $prodcategory) {
 $prodcatList .= "<option value='$prodcategory[categoryId]'";    
  if (isset ($categoryId)){
    if ($prodcategory['categoryId'] === $categoryId){
       $prodcatList .= ' selected ';
      }
    }
  $prodcatList .= ">$prodcategory[categoryName]</option>";    
  }
$prodcatList .= "</select>";
?>
<!DOCTYPE html>
<html lang="en">
<!--
This page is for managing the product database.
-->
    <head>
        <meta charset="UTF-8">
        <title>ACME Add Products</title>
            <meta name="author" content="Boyd Lake">
            <meta name="description" content="This page is for adding new products to the ACME databse.">
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

                <h1 class="login-title">Add a product.</h1>
                <section class="login-buttons">
                    <h3>Please fill in the fields below.</h3>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    
                    <form method="post" action="/acme/products/index.php" id="addform">
                        <label for="invname">Inventory Name</label>
                        <input type="text" name="invname" id="invname" 
                            <?php if(isset($invName)){echo "value='$invName'";} ?> required>
                        
                        <label for="invdescription">Inventory Description</label><br>
                        <textarea name="invdescription" id="invdescription" form="addform" 
                        required><?php if(isset($invDescription)){echo $invDescription;} ?></textarea><br>
                        
                        <label for="invimage">Inventory Image</label>
                        <input type="text" name="invimage" id="invimage" 
                            <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>

                        <label for="invthumbnail">Inventory Thumbnail</label>
                        <input type="text" name="invthumbnail" id="invthumbnail" 
                            <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>
                        
                        <label for="invprice">Inventory Price</label>
                        <span class="reduced">Enter this price as any number with a two decimal limit.</span>                     
                        <input type="text" name="invprice" id="invprice" 
                            <?php if(isset($invPrice)){echo "value='$invPrice'";} ?> required 
                            pattern="^\d{1,5}(\.\d{1,2})?$">                        
                        
                        <label for="invstock">Inventory Stock</label>
                        <span class="reduced">Enter the stock amount as any positive integer.</span>                          
                        <input type="text" name="invstock" id="invstock" 
                            <?php if(isset($invStock)){echo "value='$invStock'";} ?> required 
                            pattern="^[1-9]+[0-9]*$">

                        <label for="invsize">Inventory Size</label>
                        <input type="text" name="invsize" id="invsize" 
                            <?php if(isset($invSize)){echo "value='$invSize'";} ?> required>

                        <label for="invweight">Inventory Weight</label>
                        <input type="text" name="invweight" id="invweight" 
                            <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> required>

                        <label for="invlocation">Inventory Location</label>
                        <input type="text" name="invlocation" id="invlocation" 
                            <?php if(isset($invLocation)){echo "value='$invLocation'";} ?> required>

                        <!-- <label for="catId">Category Id</label><br> -->
                        <br>
                        <?php echo $prodcatList; ?>
                        <br><br>
                        <!--  <input type="text" name="categoryid" id="categoryid" >-->

                        <label for="invvendor">Inventory Vendor</label>
                        <input type="text" name="invvendor" id="invvendor" 
                            <?php if(isset($invVendor)){echo "value='$invVendor'";} ?> required>

                        <label for="invstyle">Inventory Style</label>
                        <input type="text" name="invstyle" id="invstyle" 
                            <?php if(isset($invStyle)){echo "value='$invStyle'";} ?> required>                        
                        
                        <button type="submit" name="addproduct" id="addproduct">Submit Product</button>
                        <!-- Add the action key - value pair -->
                        <input type="hidden" name="action" value="addprod">
                    </form>                    

                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
        
        
    </body>
</html>


