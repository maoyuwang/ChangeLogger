<?php
Header('Content-type: text/xml');
$xml = new SimpleXMLElement('<xml/> ');
include_once "SoftwareController.php";
$softwareID = $_GET["softwareID"];
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$length = count($changelogs);
for($i = 0; $i < $length;$i++){
    $detail=join("\n",$changelogs[$i]['Detail']);
    $track = $xml->addChild('item');
    $track->addChild('version', $changelogs[$i]['Version']);
    $track->addChild('update_time', $changelogs[$i]['Time']);
    $track->addChild('content', $detail);
}

echo $xml->asXML();
?>