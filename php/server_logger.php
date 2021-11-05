<!-- This script will log all actions that a user does, this includes IP, resource requested and what request was made. -->
<?php 
	$requester_ip = $_SERVER["REMOTE_ADDR"];
	$requester_location = $_SERVER["REQUEST_URI"];
	$requester_action = $_SERVER["REQUEST_METHOD"];
	$requester_ua = $_SERVER["HTTP_USER_AGENT"];
	if(isset($_SERVER['HTTP_REFERER'])) {
  		//do what you need to do here if it's set 
		$requester_referer = $_SERVER["HTTP_REFERER"];
   }else{
		$requester_referer = $_SERVER["HTTP_REFERER"] = "";
	}
	
	$userLogData = array($requester_ip, $requester_location, $requester_action, $requester_ua, $requester_referer);
	# Store this array somewhere.
	# Can be used to track or limit users with a specific IP address.
	# Can use UA to determine which local site to serve user and for analytics.
	# Headers can be forged, so headers can be used to enhance user experience but not for security purposes.
?>