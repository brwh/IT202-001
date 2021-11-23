<html>
<body>  
<form action="./account_edit.php" class="form" method="POST">
<input type ="text" id="uid" name = "uid" placeholder = "Username"> <br>
<input type ="text" id="eid" name = "eid" placeholder = "Email"> <br>
<input type ="text" id="pw" name = "pw" placeholder = "Password"> <br>
<input type ="submit" name = "submit" value="Make Changes"> <br>
<a href="index.php">Go Back to Login Page</a> <br>
 <br>
</form>
</body>
</html>

<?php
session_start();
$username = $_SESSION['username'];
$email = $_SESSION['email'];

echo $username . " " . $email;

