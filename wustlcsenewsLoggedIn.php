<!DOCTYPE html>
<html lang="en">
<head>
<title>WUSTL CSE News</title>
<link rel="styleSheet" href="newspage.css">
</head>
<body>
    <br>
    <?php
    session_start();
    $Username=$_SESSION['Username'];
    //create CRSF Token
    $_SESSION['token']=bin2hex(openssl_random_pseudo_bytes(32));
    printf("<b>Hi, %s! Welcome to WUSTL CSE News!</b>",$Username);
    echo "<br><br>Here are all the news in WUSTL CSE department!<br><br>";
    //allow the user to submit a story, see their stories, comments, profile, to logout, or deactivate
    echo '<form action=submit.php method="POST">
<input type="submit" name="submit" value="Submit a story">
</form> &nbsp; <form action=welcome.php method="POST">
<input type="submit" name="about us" value="About us">
</form>&nbsp;<form action=logout.php method="POST">
<input type="submit" name="logout" value="Logout">
</form>&nbsp;<form action=usersStory.php method="POST">
<input type="submit" name="story" value="Your stories">
</form>&nbsp;<form action=usersComment.php method="POST">
<input type="submit" name="comment" value="Your comments">
</form>&nbsp;<form action=deactivate.php method="POST">
<input type="submit" name="deactivate" value="Deactivate">
</form>&nbsp;<form action=usersProfile.php method="POST">
<input type="submit" name="profile" value="Your profile"></form>';
require 'databaseAccess.php';
//print the stories and their relevant information
$stmt=$mysqli->prepare("select username, story_id, story_title, story, story_link from stories order by time_posted desc");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();
$result=$stmt->get_result();
echo "<br><br>";
while($row = $result->fetch_assoc()){
    $story_id=$row["story_id"];
    $_SESSION['story_id']=$story_id;
    $story_title=$row["story_title"];
    $story_link=$row["story_link"];
    $usernameStory=$row["username"];
    $stmt1=$mysqli->prepare("select comment, username from comments where story_id= ? order by time_posted asc");
    if(!$stmt1){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    } 
    $stmt1->bind_param('i',$story_id);
    $stmt1->execute();
    $result1=$stmt1->get_result();
    if(!empty($story_link)){
        printf("<b><a href=%s>%s</a></b> <br><em>by %s</em>",$story_link,$story_title, $usernameStory);
    }
    else{
        printf("<b>%s</b> <br><em>by %s</em>",$story_title,$usernameStory);
    }
    echo "<br><br>";
    $story=$row["story"];
    echo $story;
    echo "<br><br>";
    echo "<b>Comments:</b>";
    echo "<br>";
    //print the comments associated with each story
    while ($row1=$result1->fetch_assoc()){
        $comment=$row1['comment'];
        $username=$row1['username'];
        if($username!=$Username){
        printf("<em>%s commented:</em> %s",$username,$comment);}
        else{
            printf("<em>You commented:</em> %s",$comment); 
        }
        echo "<br>";
    }
    $stmt1->close();
    //allow user to add comment under each story
    echo "<form action=comment.php method='POST'>
    <input type='submit' name='comment' value='Add comment'>
    <input type='hidden' name='story_id' value='$story_id'></form>
    ";
    echo "<br><br>";
    }  
$stmt->close();
?>
</body>
</html>