<!DOCTYPE html>
<html lang="en">
<head>
<title>submit story</title>
</head>
<body>
<?php
session_start();
require "databaseAccess.php";
//retrieve story variables
date_default_timezone_set('America/Chicago');
$Username=$_SESSION['Username'];
$title=$_POST['Title'];
$link=$_POST['Link'];
$submission=$_POST['submission'];
$time=date('Y-m-d H:i:s',time());
//CRSF Token check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//if link is empty only insert other variables into the story table with prepared queries
if(empty($link)){
$stmt=$mysqli->prepare("insert into stories (username, story_title, story, time_posted) values (?,?,?,?)");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ssss', $Username,$title,$submission,$time);
$stmt->execute();
$stmt->close();
echo "Submitted successfully!";
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';}
//else insert all variables into the story table with prepared queries
else{
$stmt=$mysqli->prepare("insert into stories (username, story_title, story, time_posted, story_link) values (?,?,?,?,?)");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('sssss', $Username,$title,$submission,$time, $link);
$stmt->execute();
$stmt->close();
//return
echo "Submitted successfully!";
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
}
?>
</body>
</html>
