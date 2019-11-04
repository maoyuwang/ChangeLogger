<?php
header('Content-type: application/xml');
include_once "SoftwareController.php";
echo "<rss version='2.0' xmlns:atom='changelogger.org'>\n";
echo "<channel>\n";

$xml = new SimpleXMLElement('<xml/> ');
include_once "SoftwareController.php";
$softwareID = $_GET["softwareID"];
$software = new Software($softwareID);
$changelogs = $software->getChangelogs();
$length = count($changelogs);
$name=$software->getName();

echo "<title>Demo RSS Feed</title>\n";
echo "<description>RSS Description</description>\n";
//echo "<link>http://www.mydomain.com</link>\n";

for($i = 0; $i < $length;$i++){
    $version=$changelogs[$i]['Version'];
    $time=$changelogs[$i]['Time'];
    $detail=$changelogs[$i]['Detail'];
    $detail = json_decode($detail);
    $detail = join("\n",$detail);
    $detail = htmlspecialchars($detail);
    echo "<item>$name";
    echo "<version>$version</version>\n";
    echo "<detail>$detail</detail>\n";
    echo "<time>$time</time>\n";


    echo "<atom:link href='https://changelogger.org/feed.php?$softwareID' rel='self' type='application/rss+xml'/>\n";
    echo "</item>\n";

}


echo "</channel>\n";
echo "</rss>\n";
?>