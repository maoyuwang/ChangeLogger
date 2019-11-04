<?php
include_once "SoftwareController.php";
$softwareID = $_GET["softwareID"];
$software = new Software($softwareID);
echo $softwareID;
?>
