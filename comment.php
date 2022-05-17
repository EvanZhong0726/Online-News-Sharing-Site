<!DOCTYPE html>
<html lang="en">
<head>
<title>comment</title>
</head>
<body>
<?php
session_start();
//retrieve story_id
$_SESSION['story_id']=$_POST['story_id'];
$token=$_SESSION['token'];
//CRSF Token
//comment form
echo "<form action='commentstory.php' method='post'>
Your comment:
<p><textarea rows='4' cols='50' name='comment'>Enter text here...</textarea></p>
<input type='hidden' name='token' value='$token'>
<p><input type='submit' value='Submit'></p></form>
";
//return button
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>