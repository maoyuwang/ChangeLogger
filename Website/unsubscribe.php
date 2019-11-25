<?php
include_once "MessageQueue.php";
include_once "db.php";

// Get data from POST.
$address = $_GET['email'];
$softwareID = $_GET['id'];

// Connect to database
$db = new db();
$MsgQueue = new MessageQueue('queue:email');

// Prepare SQL.
$sql = "DELETE FROM email WHERE (`email` = '{$address}' AND `softwareID` = {$softwareID});";
$db->insert($sql);

echo "Unsubscribed successfully. You will no longer receive future updates for this software.";
?>