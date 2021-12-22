<html>
<?php
require(__DIR__ . "/../../partials/nav.php");
$user_id = get_user_id();
//echo $user_id;



?>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        var loan_re = /[0-9]*/;
        var loan_payment = form.make_payment;
        
        var flag = false;
        
        
        
        

        if(!loan_re.test(loan_payment.value)){
            flash("Please enter numerical values only", "danger");
            loan_payment.focus();
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
<form action="./loan.php" class="form" onsubmit = "return validate(this)" method="POST">

<label for="deposit">Which loan account would you like to pay off? </label> 

<?php 
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user AND account_type = 'loan' AND balance != 0");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "loan-type" id = "loan-type" value = "" onchange = UpdateHidden>
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



<br>
<label for="from">Which account would you like to use to make the payment? </label> 
<?php
$display = $pdo->prepare("SELECT * FROM Accounts WHERE user_id = :user and account_type != 'loan'");
$display->bindValue(':user', $user_id);
$display->execute();
$display->setFetchMode(PDO::FETCH_ASSOC);
echo '
<select name = "payment_account" id = "payment_account">
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
<br> <label for="make_payment">How much would you like to submit? </label> 
<input type="textbox" id="make_payment" pattern = "[0-9]*" name="make_payment"> <br>



<label for="amount-deposit">Memo (optional) </label> <input type="textbox"  id="memo" name="memo"> <br>
<input type ="submit" id = "submit" name = "submit" value="Confirm Payment">



<br> <br>
<?//php echo 'User ID is ' .  $user_id; ?>

</form>






<?php 

if(isset($_POST['submit'])){
    $hasError = false;
        $method = 'loan payment';
        $memo = $_POST["memo"];
        $loan_account = $_POST["loan-type"];
        $payment_account_num= $_POST["payment_account"];
        $amount_to_xfer = $_POST["make_payment"];
        echo $loan_account;
        

        
        $findTo = $pdo->prepare("SELECT * FROM Accounts where account_number = :account and account_type = 'loan'");
        $findTo->bindValue(':account',$loan_account);
        $findTo->execute();
        
         //get acctTo values
        while ($row = $findTo->fetch(PDO::FETCH_ASSOC)){
    
            $loan_balance = $row['balance'];
            $loan_type = $row['account_type'];
            $loanID = $row['user_id'];
            }
        $findFrom = $pdo->prepare("SELECT * FROM Accounts where account_number = :account and account_type != 'loan'");
        $findFrom->bindValue(':account',$payment_account_num );
        $findFrom->execute();
            //get acctTo values
        while ($row = $findFrom->fetch(PDO::FETCH_ASSOC)){
                $payingBalance = $row['balance'];
                $payingType = $row['account_type'];
                $payingID = $row['user_id'];
                }
        $result = $payingBalance - $amount_to_xfer;
        echo $result;
        if($result < 0){
            echo '<script> alert("Error, do not have the funds available to xfer") </script> ';
            $hasError = true;
        }

        $result1 = $loan_balance - $amount_to_xfer;
        if($result1 < 0){
            echo '<script> alert("Error, this would over pay for the loan, please view loans current balance and adjust your submission accordingly") </script> ';
            $hasError = true;
        }
        
        if (!$hasError){
            
        $payingBalance = $payingBalance - $amount_to_xfer;
        $loan_balance = $loan_balance - $amount_to_xfer;

        

        $update_paying = $pdo->prepare("UPDATE Accounts SET balance = :fromBalance WHERE account_number = :account_num_from");
        $update_paying->execute([':fromBalance' => $payingBalance, ':account_num_from' => $payment_account_num]);
        
        $update_TO = $pdo->prepare("UPDATE Accounts SET balance = :toBalance WHERE account_number = :account_num_to");
        $update_TO->execute([':toBalance' => $loan_balance, ':account_num_to' => $loan_account]);
        
        $FROMtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES (:fromID, :toID, :amount_to_xfer, :method, :memo) ");
        $FROMtransaction_history->execute([':fromID'=>$payingID, ':toID' => $loanID, ':amount_to_xfer' => -$amount_to_xfer, ':method' => $method,  ':memo'=>$memo]);

        $TOtransaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType, Memo) VALUES (:toID,:fromID, :amount_to_xfer, :method, :memo) ");
        $TOtransaction_history->execute([':fromID'=>$payingID, ':toID' => $loanID, ':amount_to_xfer'=>+$amount_to_xfer, ':method' => $method, ':memo'=>$memo]);
        flash("Loan paid successfully");
    
    
    }
    


        }
    
    
        require(__DIR__ . "/../../partials/flash.php");

?>