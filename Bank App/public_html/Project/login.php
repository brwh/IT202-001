
<a href="/Project/register.php">Create an Account</a> <br>
</html>
<?php
require(__DIR__ . "/../../partials/nav.php");
$email = se($_POST, "email", "", false);
?>
<html>
<script>
    function validate() {}        
</script>



<form name = "login" onsubmit="return validate()" method="POST">

    <div>
        <label for="email">Username/Email</label>
        <input type="text" name="email" id = "email"/>
        <span class="error" aria-live="polite"></span>
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" />
    </div>
    <input type="submit" value="Login" />
    
</form>




<?php
//TODO 2: add PHP Code
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = se($_POST, "email", "", false);
    $username = $email;
    
    $password = se($_POST, "password", "", false);

    //TODO 3
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty", "danger");
        $hasError = true;
    }
    if (str_contains($email, "@")) {
        //sanitize
        $email = sanitize_email($email);
        //validate
        if (!is_valid_email($email)) {
            flash("Invalid email address", "warning");
            $hasError = true;
        }
    } else {
        if (!preg_match('/^[a-z0-9_-]{3,30}$/i', $email)) {
            flash("Username must only be alphanumeric and can only contain - or _", "warning");
            $hasError = true;
        }
    }
    if (empty($password)) {
        flash("Password must not be empty", "danger");
        $hasError = true;
    }
    if (strlen($password) < 8) {
        flash("Password too short", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        //TODO 4
        $db = getDB();
        $stmt = $db->prepare("SELECT * from Users where email = '$email' or username = '$email'");
        try {
            $r = $stmt->execute();
            if ($r) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    $hash = $user["password"];
                    unset($user["password"]);
                    if (password_verify($password, $hash)) {
                        flash("Welcome $email");
                        $_SESSION["user"] = $user;
                        //lookup potential roles
                        $stmt = $db->prepare("SELECT Roles.name FROM Roles 
                        JOIN UserRoles on Roles.id = UserRoles.role_id 
                        where UserRoles.user_id = :user_id and Roles.is_active = 1 and UserRoles.is_active = 1");
                        $stmt->execute([":user_id" => $user["id"]]);
                        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all since we'll want multiple
                        //save roles or empty array
                        if ($roles) {
                            $_SESSION["user"]["roles"] = $roles; //at least 1 role
                        } else {
                            $_SESSION["user"]["roles"] = []; //no roles
                        }
                        die(header("Location: home.php"));
                    } else {
                        flash("Invalid password", "danger");
                    }
                } else {
                    flash("Email not found", "danger");
                }
            }
        } catch (Exception $e) {
            flash("<pre>" . var_export($e, true) . "</pre>");
        }

    }
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>

<?php
/*
<?php 
session_start();
include 'xfetchinfo.php';

include 'login_check.php';
include './lib/db.php';
if(!check_login()) {
    header('Location: ./index.php');
}
?>

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


<h1> <?php echo 'Welcome to your Dashboard ' . $username . ' ' . $user_id .  ' !'; ?> <br><br> </h1>
<?php include 'xferinfo.php'; ?>
<nav>
    <a href="logout.php">Logout</a> <br></html> <br>
    <a href="account_edit.php">Edit account information</a> <br>
    <a href="create_bank_account.php"> Create Bank Account</a> <br>
    <a href="myAccounts.php"> View My Bank Accounts</a> <br>
    <a href="transactions.php"> Deposit / Withdrawal / Transfer</a> <br>
    <a href="t_history.php"> Transaction History</a> <br>
</nav>   
<html>
*/
?>