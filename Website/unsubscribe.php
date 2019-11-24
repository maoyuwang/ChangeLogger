<?php
include_once "MessageQueue.php";
include_once "db.php";
$address = $_GET['email'];
$softwareID = $_GET['id'];

$db = new db();
$MsgQueue = new MessageQueue('queue:email');

$sql = "DELETE FROM email WHERE (`email` = {$address} AND `softwareID` = {$softwareID});";
$db->insert($sql);

echo "Unsubscribed successfully. You will no longer receive future updates for this software.";
?>