<!DOCTYPE html>
<html lang="en">
<head>
<title>edit comment</title>
</head>
<body>
<?php
session_start();
require "databaseAccess.php";
//retrieve variables for comment
date_default_timezone_set('America/Chicago');
$comment_id=$_SESSION['comment_id'];
$submission=$_POST['submission'];
$time=date('Y-m-d H:i:s',time());
//CRSF Token check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//update comment in comments table using prepared queries
$stmt=$mysqli->prepare("update comments set comment=?, time_posted=? where comment_id=?");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ssi', $submission,$time, $comment_id);
$stmt->execute();
$_SESSION['comment']=$submission;
$stmt->close();
echo "Edited successfully!";
echo '<form action=usersComment.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>
