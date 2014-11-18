<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SMonitor - Official Widget</title>
<link href="_css/reset.css" rel="stylesheet" type="text/css" />
<link href="_css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript" src="_scripts/update_data.js"></script>
<div class='header'></div>
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
			echo "<div class='servers_bg'>
			<p>Website Name: " . $monitor['friendlyname'] . "<br />" .
			"Website URL / IP: " . $monitor['url'] . "<br />" .
			"Monitor Type: "; 
			
			if($monitor['type'] == 1)
				echo 'Http(s)';
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
			
			echo "<br /><br />";
			
			if ($monitor['status'] == 0)
				echo "<img src='_images/paused.png' width='108' height='82'>";
				
			else if($monitor['status'] == 2)
				echo "<img src='_images/on.png' width='108' height='82'>";
				
			else if ($monitor['status'] == 9)
				echo "<img src='_images/off.png' width='108' height='82'>";
			
			$customuptime = $monitor['customuptimeratio'];
			list($day, $week, $month, $year) = split('[-]', $customuptime);
			
			echo "<ul class='new_graphics'>
					<li>
						<span style='height:" . $day . "%' title='" . $day . " %'></span>
					</li>
					<li>
						<span style='height:" . $week . "%' title='" . $week . " %'></span>
					</li>
					<li>
						<span style='height:" . $month . "%' title='" . $month . " %'></span>
					</li>
					<li>
						<span style='height:" . $year . "%' title='" . $year . " %'></span>
					</li>
					<li>
						<span style='height:" . $monitor['alltimeuptimeratio'] . "%' title='" . $monitor['alltimeuptimeratio'] . " %'></span>
					</li>
				</ul></p></div>";
		}
		/*XML Parsing - Monitor - End*/
		
		/*Javascript Update Data - Start*/
		echo "<center><div id='update_data'></div></center>";
		/*Javascript Update Data - End*/
	}
}
?>
</body>
</html>