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

require(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
    die(header('Location: ./logout.php'));
}
$user_id = get_user_id();
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
    $acctNum = randomNumber(12); //insert and catch exception of duplicate key, 
    $idDupe = $pdo->prepare("SELECT * FROM Accounts WHERE account_number= '$acctNum'");
    $idDupe->execute();
    $idResult = $idDupe->fetch(PDO::FETCH_ASSOC);
}
while ($idResult);

$stmt = $pdo -> prepare("SELECT * FROM `Accounts` where account_type = 'world'");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $world_id = $row['user_id'];
    
    $world_balance = $row['balance'];




$statement = $pdo->prepare("INSERT INTO `Accounts` (account_number, `user_id`, account_type, balance) VALUES ('$acctNum', '$user_id', '$account_type', '-5')");
$statement->execute();

$world_balance = $world_balance + 5;
$updateWorld = $pdo->prepare("UPDATE `Accounts` set `balance` = '$world_balance' where `user_id` = 3");
//refresh account balance function
$Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES ('$world_id', '$user_id', '+5', 'deposit') ");
$Wtransaction_history->execute();

$transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES ('$user_id','$world_id', '-5', 'deposit') ");
$transaction_history->execute();
}



}