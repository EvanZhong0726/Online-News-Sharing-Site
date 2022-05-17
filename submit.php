<!Doctype html>
<html lang="en">
<head>
    <title>submit story</title>
</head>
<body>
<?php
session_start();
//CRSF Token
$token=$_SESSION['token'];
//allow user to submit the story in text box
echo "<form action='submitstory.php' method='post'>
Title (smaller than 100 characters): 
<p><input type='text' name='Title' required maxlength=100></p>
You can choose to add a link to the story here:
<p><input type='text' name='Link'></p>
Text (more than 100 characters):
<p><textarea rows='6' cols='50' name='submission' required minlength=100>Enter text here...</textarea></p>
<input type='hidden' name='token' value='$token'>
<p><input type='submit' value='Submit'></p></form>
";
//go back to the logged in page
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>