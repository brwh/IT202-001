<html>
<?php
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
$pdo = getDB();
//echo $user_id;



?>

<?php


if(!is_logged_in()) {
    header('Location: ./logout.php');
}

$user_id = get_user_id();
?>



<body>  


<form action="./send_money.php" class="form" method="POST">
<label for="from">Which account would you like to transfer from? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type-FROM" id = "account-type-FROM">
<option value="" disabled selected hidden> </option>
';
while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr;'  </option> 
    ';
}
?> 
</select>
<br> <label for="amount-xfer-to">How much money would you like to transfer? </label> 
<input type="textbox" id="xfer_to_box" pattern = "[0-9]*" name="xfer_to_box"> <br>



<br><br>
<label for="to">Which user would you like to transfer to? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id <> '3' AND user_id <> :user ");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-send-TO" id = "account-type-TO">
<option value="" disabled selected hidden> </option>
';
while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    <option id = '.$row["account_number"].' value = '.$row["account_number"].'> ' . $row["user_id"]. ' - ' .$row["account_type"]. ' - ' . $tempstr;' </option> 
    ';
}
?> 
</select>
<label for="memo">Memo (optional) </label> <input type="textbox"  id="memo" name="memo"> <br>
<br>
<input type ="submit" id = "submit" name = "submit" value="Confirm Transfer">
</div>
</form>
<!- -----------------------------------TRANSFER END------------------------------------------ ->
<br> <br>
<?//php echo 'User ID is ' .  $user_id; ?>

</form>






<?php 
$hasError = false;
if(isset($_POST['submit'])){
    //echo $user_id;
    $fromAcctNum = $_POST["account-type-FROM"];
    $toAcctNum = $_POST["account-send-TO"];
    $amtToSend = $_POST["xfer_to_box"];
    
    $memo = $_POST['memo'];
    

    //identify each account - TO First
    $findTOAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
    $findTOAccount->bindValue(':type', $toAcctNum);
    $findTOAccount->execute();
    
    while ($row = $findTOAccount->fetch(PDO::FETCH_ASSOC)){
        $toBalance = $row['balance'];
        $toType = $row['account_type'];
        $toID = $row['user_id'];
        }
    $last4to = substr($toAcctNum, -4);
    $last4from = substr($fromAcctNum, -4);   
    echo $toBalance;
    echo $toType;
    echo $toAcctNum;
    echo $amtToSend;




    // next find FROM
    $findFROMAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
    $findFROMAccount->bindValue(':type', $fromAcctNum);
    $findFROMAccount->execute();
    
    while ($row = $findFROMAccount->fetch(PDO::FETCH_ASSOC)){
        $fromBalance = $row['balance'];
        $fromType = $row['account_type'];
        $fromID = $row['user_id'];
        }
    echo $fromBalance;
    echo $fromType;
    echo $fromAcctNum;
    $result = $fromBalance - $amtToSend;
    echo $result;
    if ($result < 0){
        echo "this passed";
        flash("Not enough funds to make the transfer, please try again", "danger");
        $hasError = true;
    }

    if (!$hasError){
        $toID4 = $toID . ' - ' . $last4to;
        $fromID4 = $fromID . ' - ' . $last4from;
        $fromBalance = $fromBalance - $amtToSend;
        $toBalance = $toBalance + $amtToSend;

        $update_FROM = $pdo->prepare("UPDATE Accounts SET balance = '$fromBalance' WHERE account_number = '$fromAcctNum'");
        $update_FROM->execute();
        
        $update_TO = $pdo->prepare("UPDATE Accounts SET balance = '$toBalance' WHERE account_number = '$toAcctNum'");
        $update_TO->execute();
        
        $FROMtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$fromID', '$toID', '-$amtToSend', 'Transaction Pair', '$memo') ");
        $FROMtransaction_history->execute();

        $TOtransaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$toID','$fromID', '+$amtToSend', 'Transaction Pair', '$memo') ");
        $TOtransaction_history->execute();
    }
    

    

}
?>


  




