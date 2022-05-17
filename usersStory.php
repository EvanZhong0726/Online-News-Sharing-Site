<!DOCTYPE html>
<html lang="en">
<head>
<title>your stories</title>
<link rel="styleSheet" href="newspage.css">
</head>
<body>
<?php
require 'databaseAccess.php';
//retrieve stories associated with the user with prepared queries
session_start();
$Username=$_SESSION['Username'];
$stmt=$mysqli->prepare("select story_id, story_title, story, story_link from stories where username = ? order by time_posted desc");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->bind_param('s',$Username);
$stmt->execute();
$result=$stmt->get_result();
//if there is no story, output user has not posted yet
if($result->num_rows==0){
    echo "You haven't posted yet <br>";
}
//else print every story associated with the user and its relevant information
while($row = $result->fetch_assoc()){
    $story_id=$row["story_id"];
    $story_title=$row["story_title"];
    $story_link=$row["story_link"];
    $story=$row["story"];
    $story_id=htmlentities($story_id);
    $story_title=htmlentities($story_title);
    $story_link=htmlentities($story_link);
    $story=htmlentities($story);
    if(!empty($story_link)){
        printf("<b><a href=%s>%s</a></b>",$story_link,$story_title);
    }
    else{
        printf("<b>%s</b>",$story_title);
    }
    echo "<br>";
    echo htmlentities($story);
    echo "<br><br>";
    echo "<form action=editStory.php method='POST'>
    <input type='submit' name='edit' value='Edit'>
    <input type='hidden' name='story_id' value='$story_id'>
    <input type='hidden' name='story_title' value='$story_title'>
    <input type='hidden' name='story_link' value='$story_link'>
    <input type='hidden' name='story' value='$story'>
    </form>
    &nbsp <form action=deleteStory.php method='POST'>
    <input type='submit' name='delete' value='Delete'>
    <input type='hidden' name='story_id' value='$story_id'></form>";
    echo "<br><br>";
    }
$stmt->close();
echo '<form action=wustlcsenewsLoggedIn.php method="POST">
<input type="submit" name="return" value="Return">
</form>';
?>
</body>
</html>