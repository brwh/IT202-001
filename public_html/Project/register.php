<?php
require(__DIR__ . "/../../partials/nav.php");
reset_session();
$email = se($_POST, "email", "", false);
$username = se($_POST, "username", "", false);

?>
<form name = 'register' onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>

        <input type="text" name="email" value = "<?php if (isset($email)) echo $email; ?>" >

       
    </div>
    <div>
        <label for="username">Username</label>

        <input type="text" name="username" value = "<?php if (isset($username)) echo $username; ?>" /> 

    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password"> <!--required minlength="8" /> -->
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm"> <!-- required minlength="8"  /> -->
    </div>
    <input type="submit" name = "Register" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        var email = form.email;
        var user = form.username;
        var password = form.password;
        var confirm = form.confirm;
        var u_re = /^[a-z0-9_-]{3,16}$/;
        var e_re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var flag = false;
        console.log(email.value);
        console.log(user.value)
        if(user.value == ""){
            flash("User must not be empty", "danger");
            email.focus();
            flag = true;
        }
        if(email.value == ""){
            flash("Email must not be empty", "danger");
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

        if(password.value.length < 8){
            flash("Password too short, must be larger than 8 characters", "danger");
            email.focus();
            flag = true;

        }

        if (password.value != confirm.value){
            flash("Passwords did not match!", "danger");
            email.focus();
            flag = true;
        }

        if(flag){
            return false;
        }
        else{
            return true;
        }

    }
</script>
<?php
//TODO 2: add PHP Code
if (isset($_POST["Register"])){
if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $confirm = se(
        $_POST,
        "confirm",
        "",
        false
    );
    $username = se($_POST, "username", "", false);
    //TODO 3
    $hasError = false;
    if (empty($email)) {
        flash("Email must not be empty", "danger");
        $hasError = true;
    }
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
    if (empty($password)) {
        flash("password must not be empty", "danger");
        $hasError = true;
    }
    if (empty($confirm)) {
        flash("Confirm password must not be empty", "danger");
        $hasError = true;
    }
    if (strlen($password) < 8) {
        flash("Password too short", "danger");
        $hasError = true;
    }
    if (
        strlen($password) > 0 && $password !== $confirm
    ) {
        flash("Passwords must match", "danger");
        $hasError = true;
    }
    $pdo = getDB();
    $uStmt = $pdo->prepare("SELECT * FROM Users WHERE username='$username'");
    $eStmt = $pdo->prepare("SELECT * FROM Users WHERE email='$email'");
    $uStmt->execute();
    $eStmt->execute();
    $uResult = $uStmt->fetch(PDO::FETCH_ASSOC);
    $eResult = $eStmt->fetch(PDO::FETCH_ASSOC);
    $Haserror = False;

if($uResult) {
  flash("Username already in use, please type in a different username", "danger");
  $hasError = True;
}

if ($eResult) {
    flash("Email already in use, please type in a different email", "danger");

  $hasError = True;
}
    if (!$hasError) {
        //TODO 4
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Users (email, password, username) VALUES(:email, :password, :username)");
        try {
            $stmt->execute([":email" => $email, ":password" => $hash, ":username" => $username]);
            flash("Successfully registered!");
        } catch (Exception $e) {
            users_check_duplicate($e->errorInfo);
        }
    }
}
}
?>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>