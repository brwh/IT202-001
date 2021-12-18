<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>
<?php
if (isset($_POST["save"])) {
    $email = se($_POST, "email", null, false);
    $username = se($_POST, "username", null, false);
    $hasError = false;
    //sanitize
    $email = sanitize_email($email);
    //validate
    if (!is_valid_email($email)) {
        flash("Invalid email address", "danger");
        $hasError = true;
    }
    if (!preg_match('/^[a-z0-9_-]{3,16}$/i', $username)) {
        flash("Username must only be alphanumeric and can only contain - or _", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        $params = [":email" => $email, ":username" => $username, ":id" => get_user_id()];
        $db = getDB();
        $stmt = $db->prepare("UPDATE Users set email = :email, username = :username where id = :id");
        try {
            $stmt->execute($params);
        } catch (Exception $e) {
            users_check_duplicate($e->errorInfo);
        }
    }
    //select fresh data from table
    $stmt = $db->prepare("SELECT id, email, IFNULL(username, email) as `username` from Users where id = :id LIMIT 1");
    try {
        $stmt->execute([":id" => get_user_id()]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            //$_SESSION["user"] = $user;
            $_SESSION["user"]["email"] = $user["email"];
            $_SESSION["user"]["username"] = $user["username"];
        } else {
            flash("User doesn't exist", "danger");
        }
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again", "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }


    //check/update password
    $current_password = se($_POST, "currentPassword", null, false);
    $new_password = se($_POST, "newPassword", null, false);
    $confirm_password = se($_POST, "confirmPassword", null, false);
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            //TODO validate current
            $stmt = $db->prepare("SELECT password from Users where id = :id");
            try {
                $stmt->execute([":id" => get_user_id()]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (isset($result["password"])) {
                    if (password_verify($current_password, $result["password"])) {
                        $query = "UPDATE Users set password = :password where id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            ":id" => get_user_id(),
                            ":password" => password_hash($new_password, PASSWORD_BCRYPT)
                        ]);

                        flash("Password reset", "success");
                    } else {
                        flash("Current password is invalid", "warning");
                    }
                }
            } catch (Exception $e) {
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            flash("New passwords don't match", "warning");
        }
    }
}
?>

<?php
$email = get_user_email();
$username = get_username();
?>
<form method="POST" onsubmit="return validate(this);">
    <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php se($email); ?>" />
    </div>
    <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php se($username); ?>" />
    </div>
    <!-- DO NOT PRELOAD PASSWORD -->
    <div>Password Reset</div>
    <div class="mb-3">
        <label for="cp">Current Password</label>
        <input type="password" name="currentPassword" id="cp" />
    </div>
    <div class="mb-3">
        <label for="np">New Password</label>
        <input type="password" name="newPassword" id="np" />
    </div>
    <div class="mb-3">
        <label for="conp">Confirm Password</label>
        <input type="password" name="confirmPassword" id="conp" />
    </div>
    <input type="submit" value="Update Profile" name="save" />
</form>

<script>
    function validate(form) {
        let pw = form.newPassword.value;
        let con = form.confirmPassword.value;
        let isValid = true;
        //TODO add other client side validation....

        //example of using flash via javascript
        //find the flash container, create a new element, appendChild
        if (pw !== con) {
            //find the container
            /*let flash = document.getElementById("flash");
            //create a div (or whatever wrapper we want)
            let outerDiv = document.createElement("div");
            outerDiv.className = "row justify-content-center";
            let innerDiv = document.createElement("div");
            //apply the CSS (these are bootstrap classes which we'll learn later)
            innerDiv.className = "alert alert-warning";
            //set the content
            innerDiv.innerText = "Password and Confirm password must match";
            outerDiv.appendChild(innerDiv);
            //add the element to the DOM (if we don't it merely exists in memory)
            flash.appendChild(outerDiv);*/
            flash("Password and Confirm password must match", "warning");
            isValid = false;
        }
        return isValid;
    }
</script>
<?php
require_once(__DIR__ . "/../../partials/flash.php");

/*
?>

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
*/
?>
