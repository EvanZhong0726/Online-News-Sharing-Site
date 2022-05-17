<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Deactivate </title>
</head>
<body>
<?php
session_start();
//CRSF token
$token=$_SESSION['token'];
//check if user wants to deactivate
if(isset($_POST["deactivate"])){
    echo "Are you sure you want to deactivate your account? <br>";
    echo "You will be redirected to the main page afterwards!";
    //redirect to another php page if the user really wants to deactivate
    echo "<form action='deactivateQuery.php' method='POST'>
            <input type='hidden' name='token' value='$token'>
           <input type='submit' name='yes' value='YES'>
           <input type='submit' name='no' value='NO'>
           </form>
    ";
    exit;
}
?>
</body>
</html>