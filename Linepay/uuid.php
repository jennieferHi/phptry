<?php 
require '../vendor/autoload.php';
$url = "https://sandbox-api-pay.line.me";
use Ramsey\Uuid\Uuid;

$uuid = Uuid::uuid4();

printf(
    "UUID: %s\nVersion: %d\n",
    $uuid->toString(),
    $uuid->getFields()->getVersion()
);

 $header = array(
    'Content-Type: application/json; charset=UTF-8'
    , 'X-LINE-ChannelId: 2003132121'
    , 'X-LINE-ChannelSecret: 3283f0fb1477b6c0981cf4188a621fee',

  );

