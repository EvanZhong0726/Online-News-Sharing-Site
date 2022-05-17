<!DOCTYPE html>
<html lang="en">
<head>
<title>delete story</title>
</head>
<body>
<?php
session_start();
//retrieve story_id session variable
$story_id=$_SESSION['story_id'];
require "databaseAccess.php";
//CRSF Token check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//delete story from stories table with prepared queries
if(isset($_POST["yes"])){
    $stmt=$mysqli->prepare("delete from stories where story_id=?");
    if(!$stmt){
       printf("Query Prep Failed: %s\n", $mysqli->error);
       exit;
   }
   $stmt->bind_param('i',$story_id);
   $stmt->execute();
   $stmt->close();
   echo "Deleted successfully!";
   echo '<form action=usersStory.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
}
//go back to userStory page
else{
   header ("Location: usersStory.php");
}
?>
</body>
</html>