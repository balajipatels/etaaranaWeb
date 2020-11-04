<?php
session_start();
$categoryId = $_GET['categoryId'];

$url = 'http://etaaranaservices.ortusolis.in:8081/ots/api/v18_1/product/getProductList';
$data = 
    [ 
     "requestData" => [
          "searchKey" => 'subcategory',
          "searchvalue" => $categoryId,
          "distributorId" => '1'
          ]
     ];


       
  $postdata = json_encode($data , true);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        $Subcategory = json_decode($result , true); 
        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);

        

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>SUB Category</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="plugins/jquery3.5.1.min.js"></script>
  <script src="plugins/popper.min.js"></script>
  <script src="plugins/bootstrap.min.js"></script>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="home.php">
    <img src="images/e_tarana.jpg" alt="Logo" style="width:40px;">
  </a>
    <a class="navbar-brand" href="#">e-Taarana</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


  <!-- <div class="container"> -->

    <div class="row" style="padding-top: 5%">
      <div class="column1" style="background-color:white;box-shadow: 5px 10px 18px blue;">
        <div class="container">
           <h5>Select Sub-Category</h5>
           <?php
            include 'subCategory.php';
             ?>    
        </div>
      </div>
      <div class="column2" style="background-color:white;">
     <div class="container">
      <div class="row" >
      <?php 
     include 'productSubCategory.php';
            foreach ($ProductCategory['responseData']['productDetails'] as $_productDetails){ 
              $subCategoryProductId = $_productDetails['productId'];
              $subCategoryProductName= $_productDetails['productName'] ;
              $subCategoryProductImages = $_productDetails['productImage'] ;
              $subCategoryProductPrice = $_productDetails['productPrice']
              ?>
        <!-- <div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-4"> -->
              <a style="color: black;" href="productDetails.php?subCategoryId=<?php echo $subCategoryProductId;?>">
          <div class="col-sm-4" >
            <img src="<?= $subCategoryProductImages; $_SESSION['productImages'] = $subCategoryProductImages; ?>" style="width:250px;height: 260px;">
            <h3><?= $subCategoryProductName; $_SESSION['productName'] = $subCategoryProductName;?></h3>
            <p><?= $subCategoryProductPrice; $_SESSION['productPrice'] = $subCategoryProductPrice;?></p>
          </div>
          </a>
         
          <?php } ?>
        <!-- </div> -->
      </div>


    </div>
      </div>
    </div>
  <!-- </div> -->


 

</body>

</html>