<?php
include_once 'db.php';
include_once 'MessageQueue.php';
include_once 'SoftwareController.php';


$database = new db();

$type = $_GET["type"];
$address = $_GET['address'];
$softwareID = $_GET['softwareID'];
$software = new Software($softwareID);
$softwareName = $software->getName();


if($type == 'phone')
{
    $sql = "INSERT INTO phone (phone, softwareID) VALUES ('$address',$softwareID)";
    $MsgQueue = new MessageQueue('queue:phone');
}
else if($type == 'email'){
    $sql = "INSERT INTO email (email, softwareID) VALUES ('$address',$softwareID)";
    $MsgQueue = new MessageQueue('queue:email');
}

$database->insert($sql);
$Msg = <<< EOD
{
    "address": "$address",
    "subject": "You are added to subscriber list.",
    "content": "You have subscribed to $softwareName successfully."
}
EOD;

$MsgQueue->put($Msg);