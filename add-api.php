<?php

$errors = [];
$success_message = '';

require __DIR__ . '/parts/db_connect.php';  
 include __DIR__ . '/data/db/address_book.php'; 
header('Content-Type: application/json');
 
$address_book = new Address_book();
 if(!empty(($_POST))){
  $result=$address_book ->create($_POST["name"],$_POST["email"],$_POST["mobile"],$_POST["birthday"],$_POST["address"]);
  echo json_encode($result); 
}else{
  echo json_encode([]);
}

 
 
 


 


