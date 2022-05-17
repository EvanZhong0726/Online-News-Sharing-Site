<!DOCTYPE html>
<html lang="en">
<head>
<title>delete story</title>
</head>
<body>
<?php
session_start();
//retrieve story_id session variable
$_SESSION['story_id']=$_POST['story_id'];
//CRSF Token
$token=$_SESSION['token'];
//check if user really wants to delete story
echo "Are you sure you want to delete your story? <br>";
echo "<form action='deleteStoryQuery.php' method='POST'>
           <input type='hidden' name='token' value='$token'> 
           <input type='submit' name='yes' value='YES'>
           <input type='submit' name='no' value='NO'>
           </form>
    ";


?>
</body>
</html>