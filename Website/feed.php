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

echo "<title>Demo RSS Feed</title>\n";
echo "<description>RSS Description</description>\n";
//echo "<link>http://www.mydomain.com</link>\n";

for($i = 0; $i < $length;$i++){
    echo "<item>n";
    echo "<version>$changelogs[$i]['Version']</version>\n";
    echo "<time>$changelogs[$i]['Time']</time>\n";
    echo "<details>$changelogs[$i]['Detail']</details>\n";
    echo "<atom:link href='https://changelogger.org/feed.php?$softwareID' rel='self' type='application/rss+xml'/>\n";
    echo "</item>\n";

}


echo "</channel>\n";
echo "</rss>\n";
?>