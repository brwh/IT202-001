<html>
<style>
    body {
        background-color: beige;
        font: 20px Verdana, Sans-Serif;
    }
    h1{
        font: 30px Verdana, Sans-Serif;
    }
</style>
<nav>
    <a href="logout.php">Logout</a> <br></html> <br>
    <a href="account_edit.php">Edit account information</a> <br>
</nav>   
<?php
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];
echo 'Welcome to your Dashboard ' . $username . '!';

?>
<html>