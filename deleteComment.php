<!DOCTYPE html>
<html lang="en">
<head>
<title>delete comment</title>
</head>
<body>
<?php
session_start();
//retrieve comment_id session variable
$_SESSION['comment_id']=$_POST['comment_id'];
//CRSF Token
$token=$_SESSION['token'];
//create form to check if user really wants to delete comment
echo "Are you sure you want to delete your comment? <br>";
    //redirect to another php page if the user really wants to deactivate
echo "<form action='deleteCommentQuery.php' method='POST'>
            <input type='hidden' name='token' value='$token'> 
           <input type='submit' name='yes' value='YES'>
           <input type='submit' name='no' value='NO'>
           </form>
    ";


?>
</body>
</html>
