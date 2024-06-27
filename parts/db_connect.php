<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'a1234567';
$db_name = 'proj57';

# data source name

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];


try {
  $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
  // $stmt=$pdo->query("Select * from address_book limit 2");
  // echo json_encode($stmt->fetchAll((PDO::FETCH_ASSOC)));
} catch (PDOException $ex) {
  echo $ex->getMessage();
}

# 啟動 session 的功能
if(!isset($_SESSION)) {
  session_start();
}
