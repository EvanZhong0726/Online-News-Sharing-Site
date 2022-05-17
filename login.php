<!DOCTYPE html>
<html lang="en">
<head>
    <title>login</title>
</head>
<body>
<?php
//Creating a session
session_start();
require 'databaseAccess.php';
//Storing username as a session variable
$_SESSION['Username']=$_POST['Username'];
$_SESSION['Password']=$_POST['Password'];
$username=$_SESSION['Username'];
$password=$_SESSION['Password'];
//checking if the name is valid
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	session_destroy();
	exit;
}
else{
	$stmt = $mysqli->prepare("select username, password from users");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		session_destroy();
		exit;
	}
	$stmt->execute();

	$result = $stmt->get_result();
    //check if username and password match with password_verify
	while($row = $result->fetch_assoc()){
		if($username==htmlspecialchars($row["username"] ) && password_verify($password, $row["password"])){ 	
			$stmt->close(); 
			header("Location: wustlcsenewsLoggedIn.php");	
			exit; 
		}
		//if not, output incorrect password
		elseif ($username==htmlspecialchars($row["username"])){
			echo "Incorrect password, try again!";
			$stmt->close();
			echo '<form action=loginFailure.php method="POST">
                 <input type="submit" name="return" value="return">
                 </form>';
				 session_destroy();
			exit;
		}
	}
}
$stmt->close();
//if username not found, output username doesn't exit
echo "Username does not exist, please register!";
//let the user return to the mainpage
echo '<form action=loginFailure.php method="POST">
<input type="submit" name="return" value="return">
</form>';
session_destroy();
?>

</body>
</html>