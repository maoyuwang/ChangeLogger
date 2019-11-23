<?php
Header('Content-type: text/xml');
$xml = new SimpleXMLElement('<xml/> ');
include_once "SoftwareController.php";
$softwareID = $_GET["softwareID"];
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$length = count($changelogs);
for($i = 0; $i < $length;$i++){
    $track = $xml->addChild('item');
    $track->addChild('version', $changelogs[$i]['Version']);
    $track->addChild('update_time', $changelogs[$i]['Time']);
    $track->addChild('content', htmlspecialchars($changelogs[$i]['Detail']));
}
echo $xml->asXML();
?>