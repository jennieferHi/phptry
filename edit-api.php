<?php
 include __DIR__ . '/data/db/address_book.php'; 
require __DIR__ . '/parts/db_connect.php';
header('Content-Type: application/json');

$output = [
  "success" => false,
  "error" => "",
  "code" => 0,
  "postData" => $_POST,
  "errors" => [],
];

// TODO: 資料輸入之前, 要做檢查
# filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if(empty($sid)){
  $output['error'] = '沒有資料編號';
  $output['code'] = 401;
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}

$address_book = new Address_book();
if(!empty(($_POST))){
  $result=$address_book ->edit($sid,$_POST["name"],$_POST["email"],$_POST["mobile"],$_POST["birthday"],$_POST["address"]);
 
}else{
  echo json_encode([]);
}

// $stmt->rowCount(); # 資料變更了幾筆



echo json_encode($output, JSON_UNESCAPED_UNICODE);
