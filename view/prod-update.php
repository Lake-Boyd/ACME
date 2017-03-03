<?php
 
    if (empty ($_SESSION['clientData']['clientLevel']) || 
               $_SESSION['clientData']['clientLevel'] < 2){
                                  
    header("Location: http://localhost/ACME");
                                    
    } 
//build the product categories list
$prodcatList = "<select name='catId' id='catId'>";
$prodcatList .= "<option>Choose a Category</option>";
foreach ($prodcategories as $prodcategory) {
 $prodcatList .= "<option value='$prodcategory[categoryId]'";    
  if (isset ($categoryId)){
    if ($prodcategory['categoryId'] === $categoryId){
       $prodcatList .= ' selected ';
      }
    }elseif(isset($prodInfo['categoryId'])){
        if($prodcategory['categoryId'] === $prodInfo['categoryId']){
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
        <title><?php 
            if(isset($prodInfo['invName'])){
                echo "Modify $prodInfo[invName] ";
                } elseif(isset($prodName)) {
                    echo $prodName;
                    }
            ?> | ACME, Inc.</title>
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

                <h1 class="login-title">
                    <?php if(isset($prodInfo['invName'])){ 
                        echo "Modify $prodInfo[invName] ";
                        } elseif(isset($prodName)) { 
                            echo $prodName;
                            }
                     ?>                    
                </h1>
                <section class="login-buttons">
                    <h3>Please fill in the fields below.</h3>
                    
                    <?php
                        if (isset($message)) {
                         echo $message;
                        }
                        ?>
                    
                    
                    
                    <form method="post" action="/acme/products/index.php" id="addform">
                        <label for="invname">Inventory Name</label>
                        <input type="text" name="invname" id="invname" required
                       
                            <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>
                               >
                        
                        <label for="invdescription">Inventory Description</label><br>
                        <textarea name="invdescription" id="invdescription" form="addform" required><?php 
                            if(isset($invDescription)){ echo $invDescription; } 
                                elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea><br>

                        <label for="invimage">Inventory Image</label>
                        <input type="text" name="invimage" id="invimage" required

                            <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?>
                               >
                        
                        <label for="invthumbnail">Inventory Thumbnail</label>
                        <input type="text" name="invthumbnail" id="invthumbnail" required 

                            <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?>
                               >                        


                        <label for="invprice">Inventory Price</label>
                        <span class="reduced">Enter this price as any number with a two decimal limit.</span>                     
                        <input type="text" name="invprice" id="invprice" required pattern="^\d{1,5}(\.\d{1,2})?$"

                            <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?>
                               >  
                            
                        <label for="invstock">Inventory Stock</label>
                        <span class="reduced">Enter the stock amount as any positive integer.</span>                          
                        <input type="text" name="invstock" id="invstock" required  pattern="^[1-9]+[0-9]*$"

                            <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?>
                               >  

                        <label for="invsize">Inventory Size</label>
                        <input type="text" name="invsize" id="invsize" required 

                            <?php if(isset($invSize)){ echo "value='$invSize'"; } elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?>
                               >  

                        <label for="invweight">Inventory Weight</label>
                        <input type="text" name="invweight" id="invweight" required

                            <?php if(isset($invWeight)){ echo "value='$invWeight'"; } elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?>
                               >  
                        
                        <label for="invlocation">Inventory Location</label>
                        <input type="text" name="invlocation" id="invlocation" required 

                            <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?>
                               > 
                        
                        <!-- <label for="catId">Category Id</label><br> -->
                        <br>
                        <?php echo $prodcatList; ?>
                        <br><br>
                        <!--  <input type="text" name="categoryid" id="categoryid" >-->

                        <label for="invvendor">Inventory Vendor</label>
                        <input type="text" name="invvendor" id="invvendor" required 

                            <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?>
                               > 

                        <label for="invstyle">Inventory Style</label>
                        <input type="text" name="invstyle" id="invstyle" required

                            <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?>
                               >                         

                        <button type="submit" name="updateProduct" id="updateProduct">Update Product</button>
                        <!-- Add the action key - value pair -->
                        <input type="hidden" name="action" value="updateProd">
                        <input type="hidden" name="prodId" value="<?php 
                            if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                                elseif(isset($prodId)){ echo $prodId; } ?>">
                    </form>                    

                </section>

            </main>
       
            <?php include $_SERVER['DOCUMENT_ROOT'].'/acme/php/footer.php'; ?>
        
        </div>
  
    </body>    

</html>
