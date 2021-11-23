<html> 

<h1>Welcome to Whitty's Bank</h1>
<body>  
<form action="./index.php" class="form" method="POST">
<input type ="text" id="uid" name = "uid" placeholder = "Username"> <br>
<input type ="text" id="pw" name = "pw" placeholder = "Password"> <br>
<input type ="submit" name = "submit" value="Login"> <br>
<script>
window.history.forward();
</script>
</form>
</body>
<style>
    body {
        background-color: beige;
        font: 20px Verdana, Sans-Serif;
    }
    h1{
        font: 30px Verdana, Sans-Serif;
    }
</style>
<a href="register.php">Create an Account</a> <br>
</html>
<?php
include 'db.php';
$error = False;
session_start();
$pdo = getDB();

if(isset($_POST['submit']))//check if user exists in sql db
{
    
    $user_or_email = $_POST['uid']; 
    $pwd = $_POST['pw'];
     
    if (empty($user_or_email)){
        echo '<script>alert("Missing Username")</script>';
        $error = True;


    }
   else if(empty($pwd)){
        echo '<script>alert("Missing a password, please type one in")</script>';
        $error = True;
    }


    $statement = $pdo->query("SELECT * from `Users` where email = '$user_or_email' or username = '$user_or_email'");
    $statement->execute();
    if (!$error){
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

        $username = $row['username'];
        $email = $row['email'];
        $hashword = $row['password'];
    }
    if(password_verify($pwd, $hashword)) {

        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;


        
        header('Location: ./login.php');
        
    }
    else {
        echo '<script>alert("Incorrect Login Information")</script>';
        
    }

    
   
}
}
?>
</html>





