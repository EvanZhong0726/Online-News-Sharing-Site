<!DOCTYPE html>
<html lang="en">
<head>
<title>login failure</title>
</head>
<body>
<?php
session_start();
if(isset($_POST["return"])){
    //redirect the user to the main page and destroy the session
    header("Location: login.html");
    exit;
}
?>
</body>
</html>