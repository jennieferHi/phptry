<?php 
require '../vendor/autoload.php';
use Ramsey\Uuid\Uuid;
$baseurl = "https://sandbox-api-pay.line.me";
$url = "/v3/payments/request";

$uuid = Uuid::uuid4()->toString(); 

$channelId="2003132121";
$key="3283f0fb1477b6c0981cf4188a621fee"; 
$orderParams = [
  'amount' => 250,
  'currency' => 'TWD',
  'orderId' => '000001',
  'packages' => [
      [
          'id' => '000001',
          'amount' => 250,
          'name' => 'test store',
          'products' => [
              [
                  'name' => 'test product',
                  'quantity' => 1,
                  'price' => 250
              ],
          ],
      ],
  ],
  'redirectUrls' => [
      'confirmUrl' => 'https://test.astralweb.com/confirm.php',
      'cancelUrl' => 'https://test.astralweb.com/cancel.php',
  ],
];
  
 
$postData = json_encode($orderParams);
$signatureData = $key . $url .$postData. $uuid;
$authorization = base64_encode(hash_hmac('sha256', $signatureData, $key, true));
// echo $uuid . "  ".$postData." ".$authorization  ;
$header = array(
  'Content-Type: application/json; charset=UTF-8'
  , 'X-LINE-ChannelId: '.$channelId
  , 'X-LINE-Authorization-Nonce:'. $uuid
  , 'X-LINE-Authorization:'.$authorization 

);
// echo json_encode($header);
// Convert orderParams to JSON
 
$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_URL => $baseurl.$url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '', 
  CURLOPT_FOLLOWLOCATION => true, 
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$postData,
  CURLOPT_HTTPHEADER =>  $header
));

$response = curl_exec($ch);
if(curl_errno($ch)) {
  echo 'Curl 錯誤: ' . curl_error($ch);
}

curl_close($ch); 
$data = json_decode($response); 
echo $response;