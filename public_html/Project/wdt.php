
<html>
<?php
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
//echo $user_id;



?>
<script>
    function yesnoCheck(that) {
    if (that.value == "deposit") {
  //alert("check");
        document.getElementById("ifdep").style.display = "block";
    } else {
        document.getElementById("ifdep").style.display = "none";
    }
    if (that.value == "withdraw") { 
        document.getElementById("ifwith").style.display = "block";
    } 
    else {
        document.getElementById("ifwith").style.display = "none";
    }
    if (that.value == "transfer") { 
        document.getElementById("ifxfr").style.display = "block";
    } 
    else {
        document.getElementById("ifxfr").style.display = "none";
    }

    }    
    
    function process(formObj)
{ var F=formObj.description1;
// check for valid selection
if(F.selectedIndex==0){return;}
// ------
formObj.hidden1.value=F.options[F.selectedIndex].value;
formObj.hidden2.value=F.options[F.selectedIndex].text;
alert("hidden1= "+formObj.hidden1.value);
alert("hidden2= "+formObj.hidden2.value);
}
//–>
</script>
</script>
<?php


if(!is_logged_in()) {
    header('Location: ./logout.php');
}

$user_id = get_user_id();


$world_type = 'world';
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
<form action="./wdt.php" class="form" method="POST">

<select name = 'method-select' onchange="yesnoCheck(this)">
    <option value="" disabled selected hidden>Please select from these options: (Deposit / Withdraw / Transfer)</option>
    <option id = "action_type" value="deposit">Deposit</option> 
    <option id = "action_type" value="withdraw"> Withdraw</option>
    <option id = "action_type" value="transfer"> Transfer Money Between Accounts</option>
</select>

<!- -----------------------------------DEPOSIT------------------------------------------ ->
<div id="ifdep" value="ifdep" style="display: none;">

<label for="deposit">Which account would you like to deposit to? </label> 

<?php 
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type" id = "account-type" onchange = UpdateHidden>
<option value="" disabled selected hidden> </option>
';

while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    
    <option id = '.$row["account_type"].' value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr;' </option> 
    ';
}


?>
</select>

<br> <label for="amount-deposit">How much would you like to deposit? </label> <input type="textbox" pattern = "[0-9]*" id="deposit_box" name="deposit_box"> <br>
<br><br>
<label for="amount-deposit">Memo (optional) </label> <input type="textbox"  id="memo" name="memo"> <br>
<input type ="submit" id = "submit"  name = "submit" value="Confirm Deposit"> 
</div>
<!- -----------------------------------DEPOSIT END------------------------------------------ ->



<!- -----------------------------------WITHDRAW------------------------------------------ ->
<div id="ifwith" value="ifwith" style="display: none;">

<label for="withdraw">Which account would you like to withdraw from? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type" id = "account-type">
<option value="" disabled selected hidden> </option>
';
while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    
    echo '
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. ' - ' . $tempstr;' </option> 
    
    ';
}
?>
</select>
<br><label for="amount-withdraw">How much money would you like to withdraw? </label> 
<input type="textbox" pattern = "[0-9]*" id="withdraw_box" name="withdraw_box"> <br>
<br><br>
<input type ="submit"  id = "submit" name = "submit" value="Confirm Withdraw"> 
</div>

<!- -----------------------------------WITHDRAW END------------------------------------------ ->




<!- -----------------------------------TRANSFER------------------------------------------ ->
<div id="ifxfr" value="ifxfr" style="display: none;">

<label for="from">Which account would you like to transfer from? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type-FROM" id = "account-type-TO">
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
<br> <label for="amount-xfer-from">How much money would you like to transfer? </label> 
<input type="textbox" id="xfer_to_box" pattern = "[0-9]*" name="xfer_to_box"> <br>



<br><br>
<label for="to">Which account would you like to transfer to? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type-TO" id = "account-type-FROM">
<option value="" disabled selected hidden> </option>
';
while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr;' </option> 
    ';
}
?> 
</select>

<input type ="submit" id = "submit" name = "submit" value="Confirm Transfer">
</div>

<!- -----------------------------------TRANSFER END------------------------------------------ ->
<br> <br>
<?//php echo 'User ID is ' .  $user_id; ?>

</form>






<?php 

if(isset($_POST['submit'])){
    //echo $user_id;
    
    $method = $_POST['method-select'];
    $memo = $_POST['memo'];
    
    $findw = $pdo->prepare("SELECT * FROM Accounts WHERE account_type = 'world' ");
    
    $findw->execute();
        
    while ($row = $findw->fetch(PDO::FETCH_ASSOC)){
        $world_balance = $row['balance'];
        $world_id = $row['user_id'];
        }   
    

    if ($method == 'deposit') {
        $deposit_to_this_account = $_POST['account-type'];
        //echo 'this is my deposit var' . $deposit_to_this_account;
        $deposit_amount = $_POST['deposit_box'];
        
        $findAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type ");
        $findAccount->bindValue(':type', $deposit_to_this_account);
        $findAccount->execute();
        
        while ($row = $findAccount->fetch(PDO::FETCH_ASSOC)){
        $current_account_balance = $row['balance'];
        }   
        //echo $deposit_amount . ' ' . $deposit_to_this_account . ' ' . $method;
        echo $world_balance . ' ' . $world_type;
        $new_world_total = $world_balance - $deposit_amount; 
        $new_balance = $current_account_balance + $deposit_amount;
        
        
        
        
        $update_world_balance = $pdo->prepare("UPDATE Accounts SET balance = '$new_world_total' WHERE account_type = '$world_type'");
        $update_world_balance->execute();

        $update_account = $pdo->prepare("UPDATE Accounts SET balance = '$new_balance' WHERE account_type= '$deposit_to_this_account' AND `user_id` = '$user_id'");
        $update_account->execute();
    
        $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$world_id', '$user_id', '-$deposit_amount', '$method', '$memo') ");
        $Wtransaction_history->execute();

        $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$user_id','$world_id', '+$deposit_amount', '$method', '$memo') ");
        $transaction_history->execute();
    
    
    }

    if($method == 'withdraw'){
        $withdraw_from_this_account = $_POST['account-type'];
        $withdraw_amount = $_POST['withdraw_box'];
        //echo $withdraw_amount . ' ' . $withdraw_from_this_account . ' ' . $method;
        //echo $world_balance . ' ' . $world_type;
        $withdraw_from_this_account = $_POST['account-type'];
        $withdraw_amount = $_POST['withdraw_box'];
        $findAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
        $findAccount->bindValue(':type',$withdraw_from_this_account );
        $findAccount->execute();
        
        while ($row = $findAccount->fetch(PDO::FETCH_ASSOC)){
        $current_account_balance = $row['balance'];
        }  
        
        if (($current_account_balance - $withdraw_amount) < 0){
            flash("Error balance cannot go below 0, please withdraw a smaller amount", "danger");
            return false;
        }
        
        $new_world_total = $world_balance + $withdraw_amount; 
        $new_balance = $current_account_balance - $withdraw_amount;

        $update_world_balance = $pdo->prepare("UPDATE Accounts SET balance = '$new_world_total' WHERE account_type= 'world'");
        $update_world_balance->execute();

        $update_account = $pdo->prepare("UPDATE Accounts SET balance = '$new_balance' WHERE account_type= '$withdraw_from_this_account' AND `user_id` = '$user_id'");
        $update_account->execute();
        

        $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$world_id', '$user_id', '+$$withdraw_amount', '$method', '$memo') ");
        $Wtransaction_history->execute();

        $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$user_id','$world_id', '-$$withdraw_amount', '$method', '$memo') ");
        $transaction_history->execute();
    }

    

    if($method == 'transfer'){
        $account_type_from = $_POST["account-type-FROM"];
        $account_type_to = $_POST["account-type-TO"];
        $amount_to_xfer = $_POST["xfer_to_box"];

        $findFROMAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
        $findFROMAccount->bindValue(':type', $account_type_from);
        $findFROMAccount->execute();
        
        while ($row = $findFROMAccount->fetch(PDO::FETCH_ASSOC)){
        $xferFROMBalance = $row['balance'];
        $from_type = $row['id'];
        }   
        $findTOAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
        $findTOAccount->bindValue(':type', $account_type_to);
        $findTOAccount->execute();
    
        while ($row = $findTOAccount->fetch(PDO::FETCH_ASSOC)){
            $xferTOBalance = $row['balance'];
            $to_type = $row['id'];
            }   
        $xferFROMBalance = $xferFROMBalance - $amount_to_xfer;
        $xferTOBalance = $xferTOBalance + $amount_to_xfer;

        $update_FROM = $pdo->prepare("UPDATE Accounts SET balance = '$xferFROMBalance' WHERE account_number = '$account_type_from'");
        $update_FROM->execute();
        
        $update_TO = $pdo->prepare("UPDATE Accounts SET balance = '$xferTOBalance' WHERE account_number = '$account_type_to'");
        $update_TO->execute();
        
        $FROMtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$from_type', '$to_type', '-$amount_to_xfer', '$method', '$memo') ");
        $FROMtransaction_history->execute();

        $TOtransaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$to_type','$from_type', '+$amount_to_xfer', '$method', '$memo') ");
        $TOtransaction_history->execute();
        
    }
}
