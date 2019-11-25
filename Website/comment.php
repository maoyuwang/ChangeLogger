<?php
include_once "Comments.php";

/**
 * Receive the comment and add to the database.
 */
$softwareID = $_POST["id"];
$user = $_POST["user"];
$content = $_POST["content"];
$rating = $_POST["rating"];

$comments = new Comments($softwareID);
$comments->addComment($user,$rating,$content);