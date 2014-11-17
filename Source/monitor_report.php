<?php
/*Variables - Start*/
require_once("_includes/config.php");
/*Variables - End*/

/*Curl Request - Start*/
require_once("_includes/curl.php");
/*Curl Request - End*/
 
/*XML Parsing - Monitor - Start*/
$responseXML = curl_seasson($url);
$xml = simplexml_load_string($responseXML);
 
foreach($xml->monitor as $monitor) {
    echo "<b>Website Name: </b>" . $monitor['friendlyname'] . "<br />";
	echo "<b>Monitor Reports: </b><br />";
	
	foreach($monitor->log as $logs) {
		if($logs['type'] == 1)
			echo '<font color="red">Server Down </font>';
		else if($logs['type'] == 2)
			echo '<font color="green">Server Up </font>';
		else if($logs['type'] == 98)
			echo '<font color="blue">Monitor Started </font>';
		else if($logs['type'] == 99)
			echo '<font color="brown">Monitor Paused </font>';
			
		echo "<b>Date & Time: </b>" . $logs['datetime'] . "<br />";	
	}
	echo "<b>Server Status: </b><a href='./index.php'>Go Back</a><br /><br />";
}
/*XML Parsing - Monitor - End*/
?>