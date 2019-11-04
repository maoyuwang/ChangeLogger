<?php
$softwareID = $_GET["softwareID"];
include_once "SoftwareController.php";
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$latestVersion = $changelogs[0]['Version'];
$xml = new SimpleXMLElement('<xml/>');
for ($i = 1; $i <= 8; ++$i) {
    $track = $xml->addChild('item');
    $track->addChild('update_time', "1999/99");
    $track->addChild('version', "0.0");
    $track->addChild('content', "nothing");
}
Header('Content-type: text/xml');
print($xml->asXML());
?>
