<!DOCTYPE html>
<html lang="en">
<head>
<title>your profile</title>
<link rel="styleSheet" href="newspage.css">
</head>
<body>
<?php
require 'databaseAccess.php';
session_start();
//retrieve all users variables
$Username=$_SESSION['Username'];
$stmt=$mysqli->prepare("select email, wustl_id, introduction from users where username = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s',$Username);
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();
$email=$row["email"];
$_SESSION['email']=$email;
$wustl_id=$row["wustl_id"];
$_SESSION['wustl_id']=$wustl_id;
$introduction=$row["introduction"];
$_SESSION['introduction']=$introduction;
//print the profile
printf("Username: %s <br> Email: %s <br> WUSTL_ID:  %d  <br><br>Introduction: <textarea readonly name='intro' rows='5' cols='40'>%s</textarea>",$Username,$email,$wustl_id,$introduction);
$stmt->close();
echo "<br><br>";
//allow the user to return 
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
//allow the user to edit 
echo '<form action=editProfile.php method="POST">
<input type="submit" name="edit" value="Edit"></form>';
?>
</body>
</html>