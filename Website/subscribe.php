<?php
include_once 'db.php';

$database = new db();

$type = $_GET["type"];
$address = $_GET['address'];
$softwareID = $_GET['softwareID'];

if($type == 'phone')
{
    $sql = "INSERT INTO phone (phone, softwareID) VALUES ($address,$softwareID)";
}
else if($type == 'email'){
    $sql = "INSERT INTO email (email, softwareID) VALUES ($address,$softwareID)";
}

$database->insert($sql);