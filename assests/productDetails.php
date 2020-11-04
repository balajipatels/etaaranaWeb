<?php
session_start();
$SubcategoryId = $_GET['subCategoryId'];
echo "<script>alert($SubcategoryId)</script>";

$url = 'http://etaaranaservices.ortusolis.in:8081/ots/api/v18_1/product/getProductList';
$data = 
    [ 
     "requestData" => [
          "searchKey" => 'singleProduct',
          "searchvalue" => $SubcategoryId,
          "status" => 'active'
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
        $subCategoryProductDetails = json_decode($result , true); 
        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <a class="navbar-brand" href="home.php">e-Taarana</a>
    <form class="form-inline" action="/action_page.php" style="padding-left: 20%">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
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
        <li class="nav-item">
        <?php 
            foreach ($subCategoryProductDetails['responseData']['productDetails'] as $_productDetails){ 
              $productId = $_productDetails['productId'];
              $productName= $_productDetails['productName'] ;
              $productImages = $_productDetails['productImage'] ;
              $productPrice = $_productDetails['productPrice']
              ?>
          <a class="nav-link" href="productCart.php?productID=<?php echo $productId ?>&productName=<?php echo $productName?>&productImage=<?php echo $productImages?>&productPrice=<?php echo $productPrice ?> "><i class="fa fa-shopping-cart" style="font-size:30px;"></i>CART</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php 
            foreach ($subCategoryProductDetails['responseData']['productDetails'] as $_productDetails){ 
              $productId = $_productDetails['productId'];
              $productName= $_productDetails['productName'] ;
              $productImages = $_productDetails['productImage'] ;
              $productPrice = $_productDetails['productPrice'];
              ?>
  <div class="row" style="padding-top: 5%">
      <div class="column1" style="background-color:white;box-shadow: 5px 10px 18px white;">
        <div class="container"> 
          <img src="<?= $productImages ?>" class="float-left" style="height: 500px; width: fit-content;">
         </div>
          
      </div>
      <div class="column2" style="background-color:white;">
     <div class="container">
        <div class="flow-link">
          <span><a href="home.php"  class="text-dark">Home</a> /</span><span> <a href="productCategory.php"  class="text-dark"> Clothing/ </a></span><span><a href=""> Saree> </a> </span> 
        </div>
        <div style="padding: 2%">
          <h3><?= $productName ?></h3>
        </div>
        <div class="pdp-price" style="padding: 2%">
          <strong>RS. <?= $productPrice ?></strong>
          <span class="pdp-vatInfo">include all tax</span>
        </div>
        <div class="deliveryOption" style="padding: 2%">
          <h4>Delivery Options </h4>
          <div style="padding: 1%">
           <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">Primary Address
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">Secondary Address
              </label>
            </div>
            <div class="form-group">
              <label for="comment">Address:</label>
              <textarea class="form-control" rows="3" id="comment" name="text" style="width: 70%"> 1st cross, 2nd block,vijay nagar, banglore</textarea>
            </div>
          </div>
        </div>
        <div class="btn-group" style="padding-left: 5%;padding-top: 1%" >
          <button type="button" onclick="location.href= 'productCart.php?productID=<?php echo $productId ?>&productName=<?php echo $productName?>&productImage=<?php echo $productImages?>&productPrice=<?php echo $productPrice ?> '" style="width: 250px" class="btn btn-info btn-lg">Add to cart</button>
          <button type="button" style="width: 250px" class="btn btn-success btn-lg">Place order</button>
          </div>
           
    </div>
      </div>
    </div>
    
    <?php } ?>


</body>
</html>