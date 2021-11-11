<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome!</title>
<style>
    body {
        background-color: beige;
        font: 20px Verdana, Sans-Serif;
    }
    h1{
        font: 30px Verdana, Sans-Serif;
    }
</style>
<h1>Welcome to Whitty's Bank!</h1>
<h2?> Please Login Below </h2>
</head>
<body>
    <form action="other.php" method="post">        
       <label style="display: inline-block">Email:  </label>
       <input type="text" name="uid" style="margin-top: 1%;margin-bottom: 1%;"><br>
       
       <label style="margin-right: .45%;">Password: </label>
       <input type="password" name="pw" style="margin-bottom: 1%;"><br>
       <input type="submit" name="submit" value="Login" style='background-color: #42CBF7;font: 20px;border: none;' class="submit">
       <input type="submit" name="submitNewUser" value="Create new account" style='background-color: #42CBF7;font: 30px;border: none;' class="submit">
    </form>

    <?php 
    if (isset($_SESSION["error"])) { 
        $error = $_SESSION["error"];
        echo "<script type='text/javascript'>alert('$error');</script>";
    }
    ?>

</body>
</html>

<?php
unset($_SESSION["error"]);
?>