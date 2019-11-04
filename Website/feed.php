<?php
header('Content-type: application/xml');
include_once "SoftwareController.php";
echo "<rss version='2.0' xmlns:atom='changelogger.org'>\n";
echo "<channel>\n";

echo "<title>Demo RSS Feed</title>\n";
echo "<description>RSS Description</description>\n";
//echo "<link>http://www.mydomain.com</link>\n";




echo "</channel>\n";
echo "</rss>\n";
?>
?>