<?php
//access the web_users database
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'web_users');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>
