<?php
$SubcategoryId = $_GET['subcategoryid'];
$url = 'http://etaaranaservices.ortusolis.in:8081/ots/api/v18_1/product/getProductList';
$data = 
    [ 
     "requestData" => [
          "searchKey" => 'product',
          "searchvalue" => $SubcategoryId
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
        $ProductCategory = json_decode($result , true); 
        if($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);

?>