<!DOCTYPE html>
<html lang="en">
<head>
<title>edit story</title>
</head>
<body>
<?php
session_start();
require "databaseAccess.php";
//retrieve story variables
date_default_timezone_set('America/Chicago');
$story_id=$_SESSION['story_id'];
$title=$_POST['Title'];
$link=$_POST['Link'];
$submission=$_POST['submission'];
$time=date('Y-m-d H:i:s',time());
//CRSF Token Check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//update story in stories with prepared queries
$stmt=$mysqli->prepare("update stories set story_title=?, story_link=?, story=?, time_posted=? where story_id=?");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ssssi', $title,$link,$submission,$time, $story_id);
$stmt->execute();
$_SESSION['story_title']=$title;
$_SESSION['story_link']=$link;
$_SESSION['story']=$submission;
$stmt->close();
echo "Edited successfully!";
//return to usersStory page
echo '<form action=usersStory.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>
