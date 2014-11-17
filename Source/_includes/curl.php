<?php
/*Check Curl if Installed - Start*/
function is_curl_installed() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	} else {
		return false;
	}
}
/*Check Curl if Installed - End*/
/*Curl Request - Start*/
function curl_seasson($url) {
	$c = curl_init($url);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	$responseXML = curl_exec($c);
	curl_close($c);
	
	return $responseXML;
}
/*Curl Request - End*/
?>