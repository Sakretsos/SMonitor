<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SMonitor - Official Widget</title>
<link href="_css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript" src="_scripts/update_data.js"></script>
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

if(!is_curl_installed()) {
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
							
			echo "<br /><b> Uptime Ratio ( Day ): </b><br />";
			echo "<div class='graph'><strong class='bar' style='width:" . $day . "%;'>" . $day . "%</strong></div><br />";
			
			echo "<br /><b>Uptime Ratio ( Weekly ): </b><br />";
			echo "<div class='graph'><strong class='bar' style='width:" . $week . "%;'>" . $week . "%</strong></div><br />";
			
			echo "<br /><b>Uptime Ratio ( Monthly ): </b><br />";
			echo "<div class='graph'><strong class='bar' style='width:" . $month . "%;'>" . $month . "%</strong></div><br />";
			
			echo "<br /><b>Uptime Ratio ( Since Created ): </b><br />";
			echo "<div class='graph'><strong class='bar' style='width:" . $monitor['alltimeuptimeratio'] . "%;'>" . $monitor['alltimeuptimeratio'] . "%</strong></div><br />";
			
			echo "<br /><b>Monitor Type: </b>";
			
			if($monitor['type'] == 1)
				echo 'Https';
			else if($monitor['type'] == 2)
				echo 'Keyword';
			else if($monitor['type'] == 3)
				echo 'Ping';
			else if($monitor['type'] == 4)
			{
				echo 'Port - ';
				
				if($monitor['subtype'] == 1)
					echo 'Http (80)';
				else if($monitor['subtype'] == 2)
					echo 'Https (443)';
				else if($monitor['subtype'] == 3)
					echo 'FTP (21)';
				else if($monitor['subtype'] == 4)
					echo 'SMTP (25)';
				else if($monitor['subtype'] == 5)
					echo 'POP3 (110)';
				else if($monitor['subtype'] == 6)
					echo 'IMAP (143)';
				else if($monitor['subtype'] == 99)
					echo 'Custom Port ( ' . $monitor['port'] . ' )';
			}
			
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
		
		/*Javascript Update Data - Start*/
		echo "<div id='update_data'></div>";
		/*Javascript Update Data - End*/
	}
}
?>
</body>
</html>