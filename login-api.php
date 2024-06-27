<?php
require __DIR__ . '/parts/db_connect.php';
include __DIR__ . "/data/db/members.php";

header('Content-Type: application/json');
$member = new Members(); 
$output=$member->login($_POST["email"],$_POST["password"]);
echo json_encode($output, JSON_UNESCAPED_UNICODE);
