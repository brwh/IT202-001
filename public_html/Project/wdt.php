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
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user AND closed = 0 and account_type != 'loan' and frozen = 0");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type" id = "account-type" value = "" onchange = UpdateHidden>
<option value="" disabled selected hidden> </option>
';

while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    
    <option id = '.$row["account_type"].' value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr . '(Balance: ' . $row["balance"] . ')';' </option> 
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
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user AND closed = 0 and account_type != 'loan' and frozen = 0");
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
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. ' - ' . $tempstr. '(Balance: ' . $row["balance"] . ')';' </option> 
    
    ';
}
?>
</select>
<br><label for="amount-withdraw">How much money would you like to withdraw? </label> 
<input type="textbox" pattern = "[0-9]*" id="withdraw_box" name="withdraw_box"> <br>
<br><br>
Memo (optional) <input type="textbox"  id="memo" name="memo"> <br>
<input type ="submit"  id = "submit" name = "submit" value="Confirm Withdraw"> 
</div>

<!- -----------------------------------WITHDRAW END------------------------------------------ ->




<!- -----------------------------------TRANSFER------------------------------------------ ->
<div id="ifxfr" value="ifxfr" style="display: none;">

<label for="from">Which account would you like to transfer from? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user AND closed = 0 and account_type != 'loan' and frozen = 0");
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
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr. '(Balance: ' . $row["balance"] . ')';' </option>  
    ';
}
?> 
</select>
<br> <label for="amount-xfer-from">How much money would you like to transfer? </label> 
<input type="textbox" id="xfer_to_box" pattern = "[0-9]*" name="xfer_to_box"> <br>



<br><br>
<label for="to">Which account would you like to transfer to? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user AND closed = 0 and account_type != 'loan' and frozen = 0");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "account-type-TO" id = "account-type-TO">
<option value="" disabled selected hidden> </option>
';
while ($row = $display->fetch()){
    $tempstr = substr($row["account_number"], -4);
    echo '
    <option id = '.$row["account_type"].'  value = '.$row["account_number"].'> '.$row["account_type"]. - $tempstr. '(Balance: ' . $row["balance"] . ')';' </option>  
    ';
}
?> 
</select>
<label for="amount-deposit">Memo (optional) </label> <input type="textbox"  id="memo" name="memo"> <br>
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
    
       


    $hasError = false;
    $memo = $_POST['memo'];

    if(empty($method)){
        
        $hasError = true;
        flash("Error please select a method from the options below", "danger");
    }
    


    if(!$hasError){
        $findw = $pdo->prepare("SELECT * FROM Accounts WHERE account_type = 'world' ");
    
        $findw->execute();
        
    while ($row = $findw->fetch(PDO::FETCH_ASSOC)){
        $world_balance = $row['balance'];
        $world_id = $row['user_id'];
        }   
    
    
    if ($method == 'deposit' and !$hasError) {
        
        

        $memo = $_POST['memo'];
        $account_num = $_POST['account-type'];
        $deposit_amount = $_POST['deposit_box'];

        if ($account_num == '' or $method == '' or $deposit_amount == ''){
            $hasError = true;
            flash("Error please do not leave ANY of these fields blank", "danger");
        }
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
        //echo $world_balance . ' ' . $world_type;
        $new_world_total = $world_balance - $deposit_amount; 
        
        $new_balance = $current_account_balance + $deposit_amount;
        
        
        
        
        $update_world_balance = $pdo->prepare("UPDATE Accounts SET balance = '$new_world_total' WHERE account_type = '$world_type'");
        $update_world_balance->execute();

        $update_account = $pdo->prepare("UPDATE Accounts SET balance = '$new_balance' WHERE account_number = '$deposit_to_this_account'");
        $update_account->execute();
    
        $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$world_id', '$user_id', '-$deposit_amount', '$method', '$memo') ");
        $Wtransaction_history->execute();

        $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$user_id','$world_id', '+$deposit_amount', '$method', '$memo') ");
        $transaction_history->execute();
    
    
    }

    if($method == 'withdraw' and !$hasError){

    
        $hasError = false;
        
        $withdraw_amount = $_POST['withdraw_box'];
        //echo $withdraw_amount . ' ' . $withdraw_from_this_account . ' ' . $method;
        //echo $world_balance . ' ' . $world_type;
        
        $memo = $_POST['memo'];
        $account_num = $_POST['account-type'];
        

        
        $withdraw_amount = $_POST['withdraw_box'];
        $findAccount = $pdo->prepare("SELECT * FROM Accounts WHERE account_number = :type");
        $findAccount->bindValue(':type',$account_num );
        $findAccount->execute();
        
        while ($row = $findAccount->fetch(PDO::FETCH_ASSOC)){
            $balance = $row['balance'];
            }  
        
        $world_balance = $row['balance'];
        $world_id = $row['user_id'];
        echo 'this is the wbalance: ';
        echo $world_balance;
       
        if(!$hasError){
        echo "we have no errors";
        $world_balance = $world_balance + $withdraw_amount; 
        $balance = $balance - $withdraw_amount;

        $updateW = $pdo->prepare("UPDATE Accounts SET balance = :balance WHERE account_type= 'world'");
        $updateW->execute([':balance' => $word_balance]);

        $update_account = $pdo->prepare("UPDATE Accounts SET balance = :balance WHERE account_number = :anum");
        $update_account->execute([':balance' => $balance, ':anum'=> $account_num]);
        

        $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$world_id', '$user_id', '+$$withdraw_amount', '$method', '$memo') ");
        $Wtransaction_history->execute();

        $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$user_id','$world_id', '-$$withdraw_amount', '$method', '$memo') ");
        $transaction_history->execute();
        
        flash("Withdrawn from account successfully");
    
    }
    
    
    }

    

    if($method == 'transfer' and !$hasError){
        $hasError = false;
        
        $memo = $_POST["memo"];
        $account_num_from = $_POST["account-type-FROM"];
        $account_num_to = $_POST["account-type-TO"];
        $amount_to_xfer = $_POST["xfer_to_box"];
        //echo $account_num_from . ' - ' . $account_num_to . ' - ' . $amount_to_xfer;
        
        
        

        
        $findTo = $pdo->prepare("SELECT * FROM Accounts where account_number = :account");
        $findTo->bindValue(':account',$account_num_to );
        $findTo->execute();
        
         //get acctTo values
        while ($row = $findTo->fetch(PDO::FETCH_ASSOC)){
            $toBalance = $row['balance'];
            $toType = $row['account_type'];
            $toID = $row['user_id'];
            }
          //echo $toBalance;
          //echo $toType;
        $findFrom = $pdo->prepare("SELECT * FROM Accounts where account_number = :account");
        $findFrom->bindValue(':account',$account_num_from );
        $findFrom->execute();
            //get acctTo values
        while ($row = $findFrom->fetch(PDO::FETCH_ASSOC)){
                $fromBalance = $row['balance'];
                $fromType = $row['account_type'];
                $fromID = $row['user_id'];
                }
        $result = $fromBalance - $amount_to_xfer;
        echo $result;
        if($result < 0){
            echo '<script> alert("Error, do not have the funds available to xfer") </script> ';
            $hasError = true;
        }
        
        if (!$hasError){
            
        $fromBalance = $fromBalance - $amount_to_xfer;
        $toBalance = $toBalance + $amount_to_xfer;

        $update_FROM = $pdo->prepare("UPDATE Accounts SET balance = '$fromBalance' WHERE account_number = '$account_num_from'");
        $update_FROM->execute();
        
        $update_TO = $pdo->prepare("UPDATE Accounts SET balance = '$toBalance' WHERE account_number = '$account_num_to'");
        $update_TO->execute();
        
        $FROMtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$fromID', '$toID', '-$amount_to_xfer', '$method', '$memo') ");
        $FROMtransaction_history->execute();

        $TOtransaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES ('$toID','$fromID', '+$amount_to_xfer', '$method', '$memo') ");
        $TOtransaction_history->execute();
        flash("Transfer was successful");        
    }
    


        }
    }
}

?>