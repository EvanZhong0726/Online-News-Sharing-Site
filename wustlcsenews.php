<!DOCTYPE html>
<html lang="en">
<head>
<title>WUSTL CSE News</title>
<link rel="styleSheet" href="newspage.css">
</head>
<body>
    <br>
    <strong>Hi! Welcome to WUSTL CSE News!</strong>
    <br><br>
    Here are all the news in WUSTL CSE department!
    <br><br><form action=login.html method="POST">
    <input type="submit" name="Login" value="Login">
    </form> &nbsp; <form action=welcome.php method="POST">
<input type="submit" name="submit" value="About us">
</form>
<?php
require 'databaseAccess.php';
//retrieve variables associated with each story from new story to old story
$stmt=$mysqli->prepare("select username, story_id, story_title, story, story_link from stories order by time_posted desc");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();
$result=$stmt->get_result();
$i=0;
echo "<br><br>";
//print every story and associated comments 
while($row = $result->fetch_assoc()){
    $i++;
    $story_id=$row["story_id"];
    $_SESSION['story_id']=$story_id;
    $story_title=$row["story_title"];
    $story_link=$row["story_link"];
    $Username=$row["username"];
    $stmt1=$mysqli->prepare("select comment, username from comments where story_id= ? order by time_posted asc");
    if(!$stmt1){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    } 
    $stmt1->bind_param('i',$story_id);
    $stmt1->execute();
    $result1=$stmt1->get_result();
    if(!empty($story_link)){
        printf("<b><a href=%s>%s</a></b> <br><em>by %s</em>",$story_link,$story_title, $Username);
    }
    else{
        printf("<b>%s</b> <br><em>by %s</em>",$story_title,$Username);
    }
    echo "<br><br>";
    $story=$row["story"];
    echo $story;
    echo "<br><br>";
    echo "<b>Comments:</b>";
    echo "<br>";
    while ($row1=$result1->fetch_assoc()){
        $comment=$row1['comment'];
        $username=$row1['username'];
        printf("<em>%s commented:</em> %s",$username,$comment);
        echo "<br>";
    }
    echo "<br><br>";
    }
$stmt->close();
?>
</body>
</html>