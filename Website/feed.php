<?php
$softwareID = $_GET["softwareID"];
include_once "SoftwareController.php";
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$latestVersion = $changelogs[0]['Version'];

$xml = new SimpleXMLElement('<xml/>');

$length = count($changelogs);
for($i = 0; $i < $length;$i++){
    $track = $xml->addChild($software->getName());
    $track->addChild('update_time', $changelogs[$i]['Time']);
    $track->addChild('version', $changelogs[$i]['Version']);
    $track->addChild('content', $changelogs[$i]['Detail']);
}

Header('Content-type: text/xml');
print($xml->asXML());
?>
