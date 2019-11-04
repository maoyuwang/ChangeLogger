<?php
$xml = new SimpleXMLElement('<xml/>');
for ($i = 1; $i <= 8; ++$i) {
    $track = $xml->addChild('item');
    $track->addChild('update_time', "1999/99");
    $track->addChild('version', "0.0");
    $track->addChild('content', "nothing");
}
Header('Content-type: text/xml');
echo $xml->asXML();
?>
