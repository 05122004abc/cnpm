<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');


$vnp_TmnCode = "EO12VGN9"; //Mã website tại VNPAY 
$vnp_HashSecret = "DOOUNUDGQTZKLGQILJLBAOWBIDJVJLVO"; //Chuỗi bí mật

$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/web3/vnpay_php/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
