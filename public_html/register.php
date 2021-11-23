<html>
<style>
div.return{
  font-size: small;
}
  body {
        background-color: beige;
        font: 20px Verdana, Sans-Serif;
    }
    h1{
        font: 30px Verdana, Sans-Serif;
    }

</style>
<body>
<form action="./register.php" class="form" method="POST">
<h1> New User Registration <h1> 

<input type = "text" id = "reg_uid" name="rid" value="" placeholder = "Username"> <br>
<input type ="text"  id = "reg_email" name= "remail" value="" placeholder = "Email"> <br>
<input type = "text" id = "reg_pw" name = "rpw" value ="" placeholder = "Password"> <br>
<input type ="text" id="verify_pw" name = "ver_pw" placeholder = "Re-type password"> <br>


<input type = "submit" id = "register" name = "Register" value = "Register">


</form>
<div class = "return">
<a href="index.php">Go Back to Login Page</a> <br>
</div>
<body>
<?php
include './db.php';
$pdo = getDB();
session_start();
if(isset($_POST['Register'])) {
  $id = "";
  $uid =  $_POST['rid'];
  $email = $_POST['remail'];
  $pw = $_POST['rpw'];
  $verify_pw = $_POST['ver_pw'];


  if (preg_match("/[a-zA-Z0-9]+/",$uid)==0) {
  echo '<script>alert("Please enter in a username")</script>';

}
$uStmt = $pdo->prepare("SELECT * FROM Users WHERE username='$uid'");
$eStmt = $pdo->prepare("SELECT * FROM Users WHERE email='$email'");
$uStmt->execute();
$eStmt->execute();
$uResult = $uStmt->fetch(PDO::FETCH_ASSOC);
$eResult = $eStmt->fetch(PDO::FETCH_ASSOC);
$error = False;

if($uResult) {
  echo  '<script>alert("Username already in use, please type in a different username")</script>';
  $error = True;
}
else if ($eResult) {
  echo '<script>alert("Email already in use, please type in a different email")</script>';
  $error = True;
}


else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo  '<script>alert("Invalid email format, please try again")</script>';
  $error = True;
}

else if($pw != $verify_pw){
    echo '<script>alert("Passwords do not match please try again")</script>';
    $error = True;
}
  if(!$error){
  $hash_pw = password_hash($pw, PASSWORD_DEFAULT);

  //query through db and insert values

  $statement = $pdo->prepare("INSERT INTO `Users` (username, email, password) VALUES ('$uid', '$email', '$hash_pw') ");
  $statement ->execute();
  session_destroy();
  header('Location: ./index.php');
  
  }
  

  }
