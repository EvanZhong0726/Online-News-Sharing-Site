<!DOCTYPE html>
<html lang="en">
<head>
<title>edit profile</title>
</head>
<body>
<?php
session_start();
//retrieve profile variables
$username=$_SESSION['Username'];
$email=$_SESSION['email'];
$wustl_id=$_SESSION['wustl_id'];
$introduction=$_SESSION['introduction'];
$username=htmlentities($username);
$email=htmlentities($email);
$wustl_id=htmlentities($wustl_id);
$introduction=htmlentities($introduction);
//CRSF Token
$token=$_SESSION['token'];
//allow user to edit the profile in text boxes
echo "<form action='editProfileQuery.php' method='post'>
Username:
<p><textarea rows='1' cols='40' name='username'>$username</textarea></p>
<br>
Email:
<p><textarea rows='1' cols='40' name='email'>$email</textarea></p>
<br>
WUSTL_ID:
<p><textarea rows='1' cols='40' name='wustl_id'>$wustl_id</textarea></p>
<br>
Introduction:
<p><textarea rows='5' cols='40' name='introduction'>$introduction</textarea></p>
<input type='hidden' name='token' value='$token'>
<p><input type='submit' value='Submit'></p></form>
";
//return to usersProfile page
echo '<form action=usersProfile.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>