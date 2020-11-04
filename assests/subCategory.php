<?php

      $catIdSelected = $_GET["categoryId"];

            foreach ($Subcategory['responseData']['productDetails'] as $_productDetails){ 
              $subCategoryId = $_productDetails['productId'];
              $subCategoryName= $_productDetails['productName'] ;
              $productImages = $_productDetails['productImage'] ;
              $productPrice = $_productDetails['productPrice']
              ?>
              
          <div class="form-group form-check">
           <a href="?categoryId=<?php echo $catIdSelected ?>&subcategoryid=<?php echo $subCategoryId?>"> <?php echo $subCategoryName ?> </a>
          </div>
         
          <?php } ?>

        
        
     