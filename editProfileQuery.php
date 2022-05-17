<!DOCTYPE html>
<html lang="en">
<head>
<title>edit profile</title>
</head>
<body>
<?php
session_start();
require "databaseAccess.php";
//retrieve users Profile variables
$username=$_POST['username'];
$email=$_POST['email'];
$wustl_id=intval($_POST['wustl_id']);
$introduction=$_POST['introduction'];
//CRSF Token Check
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//update users profile with prepared queries
$stmt=$mysqli->prepare("update users set username=?, email=?, wustl_id=?, introduction=? where username=?");
 if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('ssiss', $username, $email,$wustl_id,$introduction,$_SESSION['Username']);
$stmt->execute();
$stmt->close();
$_SESSION['Username']=$username;
$_SESSION['email']=$email;
$_SESSION['wustl_id']=$wustl_id;
$_SESSION['introduction']=$introduction;
echo "Edited successfully!";
//return to users Profile
echo '<form action=usersProfile.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>