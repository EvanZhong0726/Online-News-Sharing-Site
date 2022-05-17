<!DOCTYPE html>
<html lang="en">
<head>
<title>your comments</title>
<link rel="styleSheet" href="newspage.css">
</head>
<body>
<?php
require 'databaseAccess.php';
session_start();
//retrieve the comments associated with the user
$Username=$_SESSION['Username'];
$stmt=$mysqli->prepare("select comment_id, comment, stories.story_title, stories.username from comments join stories on (comments.story_id=stories.story_id) where comments.username = ? order by comments.time_posted asc");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s',$Username);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_rows==0){
    echo "You haven't commented yet <br>";
}
//print every comment associated with the user and its relevant information
while($row = $result->fetch_assoc()){
    $comment_id=$row["comment_id"];
    $comment=$row["comment"];
    $story_title=$row["story_title"];
    $username=$row["username"];
    $comment=htmlentities($comment);
    printf('Your comment to <b>%s</b> posted by <b>%s</b>:<br>%s',$story_title,$username,$comment);
    echo "<br><br>";
    echo "<form action=editComment.php method='POST'>
    <input type='submit' name='edit' value='Edit'>
    <input type='hidden' name='comment_id' value='$comment_id'>
    <input type='hidden' name='comment' value='$comment'>
    </form>
    &nbsp <form action=deleteComment.php method='POST'>
    <input type='submit' name='delete' value='Delete'>
    <input type='hidden' name='comment_id' value='$comment_id'></form>";
    echo "<br><br>";
    }
$stmt->close();
//return back to the main page
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>