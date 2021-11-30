<html>
<script>
    function yesnoCheck(that) {
    if (that.value == "checkings") {
  //alert("check");
        document.getElementById("ifYes").style.display = "block";
    } else {
        document.getElementById("ifYes").style.display = "none";
    }
}

</script>
<?php
session_start();
include 'xfetchinfo.php';
include 'db.php';
include 'login_check.php';
if(!check_login()) {
    header('Location: ./logout.php');
}
$pdo = getDB();
function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
?>

<body>  
<form action="./create_bank_account.php" class="form" method="POST">

<select name = 'account_type' onchange="yesnoCheck(this)">
    <option value="" disabled selected hidden>Choose the type of account you wish to create</option>
    <option id = "account" value="checkings">Checkings Account</option> 
    <option id = "account" value="savings"> Savings Account</option>
</select>
<div id="ifYes" value="ifYes" style="display: none;">
        <label for="accept">A $5 initial deposit is required upon creating a checkings account, by clicking this check you agree to this initial deposit</label> <input type="checkbox" id="accept" name="accept" value="yes" /><br />
</label>    
    </div>  
<br><br>

<?php echo 'User ID is ' .  $user_id; ?>



<input type ="submit" id = "submit" name = "submit" value="Create Account"> <br><br>

<a href="login.php">Go Back to Main Dashboard</a> <br>
<a href="logout.php">Logout</a> <br>

<?php 

if(isset($_POST['submit'])){
    $account_type = $_POST['account_type'];

do {
    $acctNum = randomNumber(12);
    $idDupe = $pdo->prepare("SELECT * FROM Accounts WHERE account_number= '$acctNum'");
    $idDupe->execute();
    $idResult = $idDupe->fetch(PDO::FETCH_ASSOC);
}
while ($idResult);

$statement = $pdo->prepare("INSERT INTO `Accounts` (account_number, `user_id`, account_type) VALUES ('$acctNum', '$user_id', '$account_type')");
$statement->execute();


}




