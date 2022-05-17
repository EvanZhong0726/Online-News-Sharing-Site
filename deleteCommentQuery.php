<!DOCTYPE html>
<html lang="en">
<head>
<title>delete comment</title>
</head>
<body>
<?php
session_start();
//retrieve comment_id session variable
$comment_id=$_SESSION['comment_id'];
require "databaseAccess.php";
//CRSF Token Check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//if yes, delete comment from comment table using prepared query
if(isset($_POST["yes"])){
    $stmt=$mysqli->prepare("delete from comments where comment_id=?");
    if(!$stmt){
       printf("Query Prep Failed: %s\n", $mysqli->error);
       exit;
   }
   $stmt->bind_param('i',$comment_id);
   $stmt->execute();
   $stmt->close();
   echo "Deleted successfully!";
   echo '<form action=usersComment.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
}
//return back to usersComment page
else{
   header ("Location: usersComment.php");
}

?>
</body>
</html>