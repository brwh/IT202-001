<?php
session_start();
include 'xfetchinfo.php';
//$current_user = $_SESSION['username'];
//$current_email  = $_SESSION['email'];
?>
<html>

<body>  
<form action="./account_edit.php" class="form" method="POST">
<input type ="text" id="edit_user" name = "edit_user" placeholder = "Change Username"> <?php echo 'current username is: ' . $current_user; ?>  <br>
<input type ="text" id="email_edit" name = "email_edit" placeholder = "Change Email"> <?php echo 'current email is: ' . $current_email; ?> <br>
<input type ="text" id="edit_pw" name = "edit_pw" placeholder = "Change Password"> <br>
<input type ="text" id="verify_pw" name = "verify_pw" placeholder = "Verifiy Changed Password"> <br>
<input type ="submit" id = "submit" name = "submit" value="Make Changes"> <br>

<a href="login.php">Go Back to Main Dashboard</a> <br>
<a href="logout.php">Logout</a> <br>
 <br>
</form>
</body>


<?php
include 'db.php';
$pdo = getDB();

if(isset($_POST['submit'])) {
  
  $uid =  $_POST['edit_user'];
  $email = $_POST['email_edit'];
  $pw = $_POST['edit_pw'];
  $verify_pw = $_POST['verify_pw'];
  


  if (preg_match("/[a-zA-Z0-9]+/",$uid)==0 && !empty($uid)) {
  echo '<script>alert("Please enter in a valid username")</script>';
  $error = true;

}
$uStmt = $pdo->prepare("SELECT * FROM Users WHERE username= '$uid'");
$eStmt = $pdo->prepare("SELECT * FROM Users WHERE email= '$email'");
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


else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
  echo  '<script>alert("Invalid email format, please try again")</script>';
  $error = True;
}

else if($pw != $verify_pw && !empty($pw)){
    echo '<script>alert("Passwords do not match please try again")</script>';
    $error = True;
}
  if(!$error){ //no errors
  $hash_pw = password_hash($pw, PASSWORD_DEFAULT);

  //query through db and insert values
  if (!empty($pw)) {
    $statement = $pdo->prepare("UPDATE `Users` SET password = '$hash_pw' WHERE username = '$current_user'");
    $statement ->execute();

  }
  if (!empty($email)) {
    $statement = $pdo->prepare("UPDATE `Users` SET email = '$email' WHERE email = '$current_email'");
    $statement ->execute();

  }
  if (!empty($username)) {
    $statement = $pdo->prepare("UPDATE `Users` SET username = '$uid' WHERE username = '$current_user'");
    $statement ->execute();

  }

  
  
  
  }
  

  }


$username = $_SESSION['username'];
$email = $_SESSION['email'];

//echo $username . " " . $email; 


?>
</html>