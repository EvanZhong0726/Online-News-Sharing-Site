<!DOCTYPE html>
<head>
<title>comment</title>
</head>
<body>
<?php
session_start();
require "databaseAccess.php";
//retrieve time, username, story_id, comment
date_default_timezone_set('America/Chicago');
$Username=$_SESSION['Username'];
$story_id=$_SESSION['story_id'];
$comment=$_POST['comment'];
//CRSF token check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//changing time to military time
$time=date('Y-m-d H:i:s',time());
//inserting comment into comment table using prepared queries
$stmt=$mysqli->prepare("insert into comments (comment, time_posted, username, story_id) values(?,?,?,?)");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('sssi', $comment,$time,$Username, $story_id);
$stmt->execute();
$stmt->close();
echo "Commented successfully!";
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>