<?php
include_once 'db.php';
include_once 'MessageQueue.php';
include_once 'SoftwareController.php';

// Connect to the database
$database = new db();

// Get data from URL
$type = $_GET["type"];
$address = $_GET['address'];
$softwareID = $_GET['softwareID'];

//Create SoftwareController
$software = new Software($softwareID);
$softwareName = $software->getName();

//Check notification type.
if($type == 'phone')
{
    $sql = "INSERT INTO phone (phone, softwareID) VALUES ('$address',$softwareID)";
    $MsgQueue = new MessageQueue('queue:sms');
}
else if($type == 'email'){
    $sql = "INSERT INTO email (email, softwareID) VALUES ('$address',$softwareID)";
    $MsgQueue = new MessageQueue('queue:email');
}
// Insert to database.
$database->insert($sql);
$Msg = <<< EOD
{
    "address": "$address",
    "subject": "You are added to subscriber list.",
    "content": "You have subscribed to $softwareName successfully."
}
EOD;

// Add new message to the queue.
$MsgQueue->put($Msg);