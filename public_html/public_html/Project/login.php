


<?php
require(__DIR__ . "/../../partials/nav.php");
$email = se($_POST, "email", "", false);
?>
<html>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        var email = form.email;
        var user = form.username;
        var password = form.password;
        var u_re = /^[a-z0-9_-]{3,16}$/;
        var e_re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var flag = false;
        console.log(email.value);
        console.log(user.value)
        if(email.value == ""){
            flash("Email / User must not be empty", "danger");
            email.focus();
            flag = true;
        }
        
        if(password.value == ""){
            flash("Please enter in a password, do not leave empty", "danger");
            email.focus();
            flag = true;
        }

        if(!u_re.test(user.value)){
            flash("Username must only be alphanumeric and can only contain - or _", "danger");
            email.focus();
            flag = true;
            }
        if (!e_re.test(email.value)){
                flag = true;
                flash("Invalid email address", "danger");
        }


        if(flag){
            return false;
        }
        else{
            return true;
        }

    }        
</script>



<form name = "login" onsubmit="return validate()" method="POST">

    <div>
        <label for="email">Username/Email</label>
        <input type="text" name="email" id = "email"/>
        
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
                    flash("Email / Username not found", "danger");
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

