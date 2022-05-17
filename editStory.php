<!DOCTYPE html>
<html lang="en">
<head>
<title>edit story</title>
</head>
<body>
<?php
session_start();
//retrieve story variables
$_SESSION['story_id']=$_POST['story_id'];
$_SESSION['story_title']=$_POST['story_title'];
$_SESSION['story_link']=$_POST['story_link'];
$_SESSION['story']=$_POST['story'];
$story_title=$_SESSION['story_title'];
$story_link=$_SESSION['story_link'];
$story=$_SESSION['story'];
$story_title=htmlentities($story_title);
$story_link=htmlentities($story_link);
$story=htmlentities($story);
//CRSF Token
$token=$_SESSION['token'];
//allow user to edit the story in text boxes
echo "<form action='editStoryQuery.php' method='post'>
Title (smaller than 50 characters): 
<p><textarea rows='1' cols='50' name='Title' required maxlength=50>$story_title</textarea></p>
You can choose to add a link to the story here:
<p><textarea rows='1' cols='50' name='Link'>$story_link</textarea></p>
Text (more than 100 characters):
<p><textarea rows='6' cols='50' name='submission' required minlength=100>$story</textarea></p>
<input type='hidden' name='token' value='$token'>
<p><input type='submit' value='Submit'></p></form>
";
//return to usersStory page
echo '<form action=usersStory.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>