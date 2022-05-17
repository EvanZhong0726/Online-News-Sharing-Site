<!DOCTYPE html>
<html lang="en">
<head>
<title>edit comment</title>
</head>
<body>
<?php
session_start();
//retrieve comment_id and comment variable 
$_SESSION['comment_id']=$_POST['comment_id'];
$_SESSION['comment']=$_POST['comment'];
$comment=$_SESSION['comment'];
$comment=htmlentities($comment);
//CRSF Token
$token=$_SESSION['token'];
//alow user to edit in comment in text box
echo "<form action='editCommentQuery.php' method='post'>
Your comment: 
<p><textarea rows='4' cols='50' name='submission'>$comment</textarea></p>
<input type='hidden' name='token' value='$token'>
<p><input type='submit' value='Submit'></p></form>
";
//or return back to usersComment page
echo '<form action=usersComment.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>