<!DOCTYPE html>
<html lang="en">
<head>
<title>deactivate</title>
</head>
<body>
<?php
session_start();
//retrieve username session variable
$username=$_SESSION['Username'];
require "databaseAccess.php";
//CRSF Token Check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//delete user from users table using prepared queries
if(isset($_POST["yes"])){
    $stmt=$mysqli->prepare("delete from users where username=?");
    if(!$stmt){
       printf("Query Prep Failed: %s\n", $mysqli->error);
       exit;
   }
   $stmt->bind_param('s',$username);
   $stmt->execute();
   $stmt->close();
   echo "Deleted successfully!";
   echo '<form action=wustlcsenews.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
}
else{
   //switch back to mainpage if user does not want to delete his profile
   header ("Location: wustlcsenewsLoggedIn.php");
}
?>
</body>
</html>