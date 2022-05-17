<!DOCTYPE html>
<html lang="en">
    <head>
        <title>logout</title>
</head>
<body>
<?php
session_start();
if(isset($_POST["logout"])){
    //redirect the user to the main page and destroy the session
    header("Location: wustlcsenews.php");
    session_destroy();
    exit;
}
?>
</body>
</html>
