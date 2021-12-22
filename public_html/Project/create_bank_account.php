<html>

<script>
    function yesnoCheck(that) {
        if (that.value == "checkings")  {
            //alert("check");
            document.getElementById("ifCheck").style.display = "block";
        } else {
            document.getElementById("ifCheck").style.display = "none";
        }
        if (that.value == "savings") {
            document.getElementById("ifSave").style.display = "block";
        } else {
            document.getElementById("ifSave").style.display = "none";
        }
        if (that.value == "loan"){
            document.getElementById("ifLoan").style.display = "block";
        }
        else{
            document.getElementById("ifLoan").style.display = "none";
        }
        }
    
    
    

    function checkForm(form)

    {
        if (form.account_type.value == "checkings" || form.account_type.value == "savings" ) {
            if (!form.accept.checked) {
                alert("Please click the checkbox to continue making an account", "danger");
                //flash("Please accept the condition above to continue making an account", "danger");

                form.accept.focus();
                return false;
            }

        } 

        if (form.account_type.value == "loan"){
            alert("Please click the checkbox to continue making an account", "danger");
            form.accept.focus();
            return false;
        }
        else {

            return true;
        }
    }
</script>






<?php
$hasError = false;
require(__DIR__ . "/../../partials/nav.php");
if (!is_logged_in()) {
    die(header('Location: ./logout.php'));
}
$user_id = get_user_id();
$pdo = getDB();
function randomNumber($length)
{
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
?>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        var loan_re = /[0-9]*/;
        var loan = form.loan_amount;
        var method = form.account_type
        var flag = false;
        
        
        
        

        if(!loan_re.test(loan.value)){
            flash("Please enter numerical values only", "danger");
            loan.focus();
            flag = true;
            }
        if (method.value == "loan"){
        if(loan.value < 500){
            flash("Loans must be $500 or more", "danger");
            loan.focus();
            flag = true;
        }
    }

        if(flag){
            return false;
        }
        else{
            return true;
        }

    }        
</script>





<body>
    <form name="create_acct" onsubmit = "return validate(this)" action="./create_bank_account.php" class="form" method="POST">

        <select name='account_type' onchange="yesnoCheck(this)">
            <option value="" disabled selected hidden>Choose the type of account you wish to create</option>
            <option id="checkings" value="checkings">Checkings Account</option>
            <option id="savings" value="savings"> Savings Account</option>
            <option id="loan" value="loan"> Loan</option>
            

            
        </select>
        <div id="ifCheck" value="ifCheck" style="display: none;">
            <label for="accept">A $5 initial deposit is required upon creating this account, by clicking this check you agree to this initial deposit

            </label>

            
            <input type="checkbox" id="accept" name="accept" value="" /><br />
            </label>
        </div>
        <div id="ifSave" value="ifSave" style="display: none;">
            <label for="accept">A $5 initial deposit is required upon creating this account, by clicking this check you agree to this initial deposit <br>
            Your APR will be 6% and compound monthly, Please check this box once you have read and agree to these conditions.

            </label>

            
            <input type="checkbox" id="accept" name="accept" value="" /><br />
            </label>
        </div>
        <br><br>
        <div id="ifLoan" value="ifLoan" style="display: none;">
            <label for="accept">A minimum of $500 is required to create this account.</label> <br>
            <input type="textbox" id="loan_amount" pattern = "[0-9]*" name="loan_amount"> <br>

            <br>
            APY for loan will be: 6% <br>
            By clicking this check you agree to these conditions
            
            <input type="checkbox" id="accept" name="accept" value="" /><br />
            
        </div>

        


        
        <input type="submit" id="submit" name="submit" value="Create Account"> <br><br>
        
        <a href="login.php">Go Back to Main Dashboard</a> <br>
        <a href="logout.php">Logout</a> <br>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $account_type = $_POST['account_type'];
            echo $account_type;
            if ($account_type == '') {
                flash("Error please do not leave this blank", "danger");
                $hasError = true;
            }
            if (!$hasError){
                //echo "i got here";
            do {
                $acctNum = randomNumber(12); //insert and catch exception of duplicate key, 
                $idDupe = $pdo->prepare("SELECT * FROM Accounts WHERE account_number= :acctNum");
                $idDupe->execute([':acctNum'=> $acctNum]);
                $idResult = $idDupe->fetch(PDO::FETCH_ASSOC);
            } while ($idResult);

           
            $stmt = $pdo->prepare("SELECT * FROM `Accounts` where account_type = 'world'");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $world_id = $row['user_id'];

                $world_balance = $row['balance'];
            }
            
            

                if ($account_type == "checkings" or $account_type == "savings") {
                $statement = $pdo->prepare("INSERT INTO `Accounts` (account_number, `user_id`, account_type, balance, frozen, closed) VALUES (:accNum, :uid, :a_type, '5', 0, 0)");
                $statement->execute([':accNum'=>$acctNum, ':uid'=>$user_id, ':a_type'=>$account_type]);
                $world_balance = $world_balance - 5;

                $updateWorld = $pdo->prepare("UPDATE `Accounts` set `balance` = '$world_balance' where `user_id` = '$world_id'");
                $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES (:wid, :uid, '-5', 'transaction pair') ");
                $Wtransaction_history->execute([':wid'=>$world_id, ':uid' => $user_id]);

                $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES (:uid,:wid, '+5', 'deposit') ");
                $transaction_history->execute([':wid'=>$world_id, ':uid' => $user_id]);
                }
                
                
                if($account_type == "loan"){
                    $amount = $_POST['loan_amount'];
                    //echo $account_type . ' ' . $acctNum . ' ' . $user_id;
                    $statement = $pdo->prepare("INSERT INTO `Accounts` (account_number, `user_id`, account_type, balance, frozen, closed) VALUES (:accNum, :uid, :a_type, :amt, 0, 0)");
                    $statement->execute([':accNum'=>$acctNum, ':uid'=>$user_id, ':a_type'=>$account_type, ':amt'=>$amount]);
                    $world_balance = $world_balance - $amount;
                    $updateWorld = $pdo->prepare("UPDATE `Accounts` set `balance` = :wbalance where `user_id` = '3'");
                    $updateWorld -> execute([':wbalance' => $world_balance]);
                    $Wtransaction_history =  $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES (:wid, :uid, '-$amount', 'loan') ");
                    $Wtransaction_history->execute([':wid'=>$world_id, ':uid' => $user_id]);

                    $transaction_history = $statement = $pdo->prepare("INSERT INTO `Transactions` (AccountSrc, AccountDest, BalanceChange, TransactionType) VALUES (:uid,:wid, '+$amount', :atype) ");
                    $transaction_history->execute([':wid'=>$world_id, ':uid' => $user_id, ':atype' => $account_type]);
                    
                
                }

                
            
        

            //echo $account_type;
            flash($account_type . " account created successfully");
            
        }
    }

            require(__DIR__ . "/../../partials/flash.php");
    
