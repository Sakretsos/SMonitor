<?php
/*Variables - Start*/
require_once("_includes/config.php");
/*Variables - End*/

/*Curl Request - Start*/
require_once("_includes/curl_seasson.php");
/*Curl Request - End*/
 
/*XML Parsing - Monitor - Start*/
$xml = simplexml_load_string($responseXML);

if(!_is_curl_installed()) {
	echo "cURL is not installed on server !.";
	
} else {
	if($xml->attributes()->id == 101 || $xml->attributes()->id == 100) {
		echo $xml->attributes()->message;

	} else {
		foreach($xml->monitor as $monitor) {
			echo "<b>Website Name: </b>" . $monitor['friendlyname'] . "<br />";
			echo "<b>Website URL / IP: </b>" . $monitor['url'] . "<br />";
			
			echo "<b>Status: </b>";
			
			if ($monitor['status'] == 0)
				echo '<b><font color="brown">Monitor Paused</font></b>';
				
			else if($monitor['status'] == 2)
				echo '<b><font color="green">Online</font></b>';
				
			else if ($monitor['status'] == 8)
				echo '<b><font color="red">Seems Down</font></b>';
				
			else if ($monitor['status'] == 9)
				echo '<b><font color="red">Down</font></b>';
			
			$customuptime = $monitor['customuptimeratio'];
			list($day, $week, $month) = split('[-]', $customuptime);
			
			echo "<br /><b> Uptime Ratio ( Day ): </b>" . $day . " %<br />";
			echo "<b>Uptime Ratio ( Weekly ): </b>" . $week . " %<br />";
			echo "<b>Uptime Ratio ( Monthly ): </b>" . $month . " %<br />";
			
			echo "<b>Uptime Ratio ( Since Created ): </b>" . $monitor['alltimeuptimeratio'] . " %<br />";
			echo "<b>Monitor Type: </b>";
			
			if($monitor['type'] == 1)
				echo 'Https';
			else if($monitor['type'] == 2)
				echo 'Keyword';
			else if ($monitor['type'] == 3)
				echo 'Ping';
			else if ($monitor['type'] == 4)
				echo 'Port';
			
			echo "<br /><b>Monitor Reports: </b><a href='monitor_report.php'>Click Me</a><br /><br />";
			
			/*foreach($monitor->log as $logs) {
				if($logs['type'] == 1)
					echo '<font color="red">Server Down </font>';
				else if($logs['type'] == 2)
					echo '<font color="green">Server Up </font>';
				else if($logs['type'] == 98)
					echo '<font color="blue">Monitor Started </font>';
				else if($logs['type'] == 99)
					echo '<font color="brown">Monitor Paused </font>';
					
				echo "<b>Date & Time: </b>" . $logs['datetime'] . "<br />";
			}*/
		}
		/*XML Parsing - Monitor - End*/
		$nextUpdate = time() + ( 5 * 60);
		echo "<b>Next Status Update: </b>" . date('H:i:s', $nextUpdate);
	}
}
?>