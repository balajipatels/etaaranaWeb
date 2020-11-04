<?php
   foreach ($categoryProducts['responseData']['productDetails'] as $_productDetails){ 
    $productName= $_productDetails['productName'] ;
    $productImage = $_productDetails['productImage'] ;
    $categoryId = $_productDetails['productId'];
    ?>
  <div class="row">
    <!-- <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4"> -->
    <a style="color: black;" href="subCategoryDetails.php?categoryId=<?php echo $categoryId;?>">
    <div class="col-sm-3" style="margin: 2%">
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
                <img src="<?= $productImage ?>" class="rounded-circle" style="width:350px;height: 360px;border: 2px solid #DAA520;">
            </div>
            <div class="flip-card-back" style="background-image:url('<?= $productImage ?>')">
              <h3><?= $productName; ?></h3>
            </div>
          </div>
        </div>
      </div>
  </a>
  <?php } ?>
  </div>
  