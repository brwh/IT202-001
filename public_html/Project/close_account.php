
<html>
<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<h1>  Which Account Do You Wish to Close? </h1>



<?php 
if(!is_logged_in()) {
    header('Location: ./logout.php');
}

$user_id = get_user_id();


$world_type = 'world';
$pdo = getDB();
?>



<body>  
<form action="./close_account.php" class="form" method="POST">

<select name = 'account-select' onchange="yesnoCheck(this)">
    <option value="" disabled selected hidden> Which account do you wish to close?: </option>
    <?php 
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);


while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    
    <option id = '.$row["account_type"].' value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr . '(Balance: ' . $row["balance"] . ')';' </option> 
    ';
}
?>

</select>

<input type="submit" id="submit" name="submit" value="Close this Account"> 
</form>
<?php

if (isset($_POST['submit'])) {
    $balError = false;
    $hasError = false;
    if ($_POST['account-select'] == '') {
        $hasError = true;
        flash("Error: Please choose from a list of your accounts that you want to close. ", "danger");
    }

    if (!$hasError){

        $acct_num = $_POST['account-select'];
        $stmt = $pdo -> prepare("SELECT * FROM Accounts where account_number = :acctnum");
        $stmt -> execute([':acctnum' => $acct_num]);
        while ($row = $stmt->fetch()){
            $balance = $row['balance'];
            $account_type = $row['account_type'];

}
if($balance != 0){
    $balError = true;
}

if(!$balError) {
    $stmt = $pdo -> prepare("UPDATE Accounts set Closed = 1 where account_number = :acctnum");
    $stmt -> execute([':acctnum' => $acct_num]);
    flash("Bank Account Closed.", "success");
}
else{
    flash("Error, you cannot close a non-empty bank account. Please empty account / Pay off loan before trying again", "danger");
}



require(__DIR__ . "/../../partials/flash.php");
}

}
?>

</html>

