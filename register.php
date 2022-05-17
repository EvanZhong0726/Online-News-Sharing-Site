<!DOCTYPE html>
<html lang="en">
<head>
<title>register</title>
</head>
<body>
<?php
session_start();
require 'databaseAccess.php';
//retrive user variables
$_SESSION['Username']=$_POST['Username'];
$_SESSION['Password']=$_POST['Password'];
$password1=$_POST['Password1'];
$username=$_SESSION['Username'];
$password=$_SESSION['Password'];
$email=$_POST['Email'];
$wustl_id=$_POST['Wustl_ID'];
//check if wustl_id is valid
if(strlen((string)$wustl_id)!=6){ 
	echo "Invalid Wustl ID!";
	echo '<form action=login.html method="POST">
	<input type="submit" name="return" value="return">
	</form>';
	session_destroy();
	exit;
}
//check if email is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "Invalid email format";
	echo '<form action=login.html method="POST">
	<input type="submit" name="return" value="return">
	</form>';
	session_destroy();
	exit;
}
//hash the password
$hashpassword=password_hash($password, PASSWORD_BCRYPT); 
//check if username is valid
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username. Please choose another one";
	echo '<form action=login.html method="POST">
<input type="submit" name="return" value="return">
</form>';
    session_destroy();
	exit;
}
//check if password is strong enough
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);
if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
	echo '<form action=login.html method="POST">
<input type="submit" name="return" value="return">
</form>';
    session_destroy();
	exit;
}
//check if password is typed correctly
if ($password1!=$password){
	echo "Your passwords don't match. Please try again!";
	echo '<form action=login.html method="POST">
	<input type="submit" name="return" value="return">
	</form>';
	session_destroy();
	exit;	
}
//check if username and email already exists
$stmt = $mysqli->prepare("select username, email from users"); 
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	session_destroy();
	exit;
	
}
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){ 
	if($row["username"]===$username){ 
		echo "This username already exists! Please choose another one";
		echo '<form action=loginFailure.php method="POST">
                 <input type="submit" name="return" value="return">
                 </form>';
		exit; 
	}
	if($row["email"]===$email){ 
		echo "This email address already has an associated account. Registration failure!";
		echo '<form action=loginFailure.php method="POST">
                 <input type="submit" name="return" value="return">
                 </form>';
		exit; 
	}
}
//insert new user into user table with prepared queries
$stmt = $mysqli->prepare("insert into users (username, password, email, wustl_id) values (?,?,?,?)"); 
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('sssi', $username, $hashpassword,$email,$wustl_id);
$stmt->execute();
$stmt->close();
//return to their logged in page
echo "Successfully Registered!";
echo "<br><br>";
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="return">
</form>'
?>
</body>
</html>



